import { Component, Injector, OnInit } from '@angular/core';
import { Validators } from "@angular/forms";

import { BaseResourceFormComponent } from "../../../shared/components/base-resource-form/base-resource-form.component";

import { Descarte } from "../shared/descarte.model";
import { DescarteService } from "../shared/descarte.service";

import { Cidade } from "../../cidades/shared/cidade.model";
import { CidadeService } from "../../cidades/shared/cidade.service";

import { Tipo } from "../../tipo/shared/tipo.model";
import { TipoService } from "../../tipo/shared/tipo.service";

import { Usuario } from "../../usuarios/shared/usuario.model";
import { UsuarioService } from "../../usuarios/shared/usuario.service";
import { AuthenticationService } from 'src/app/core/services/authentication.service';
import { EnderecoService } from '../../enderecos/shared/endereco.service';
import { Endereco } from '../../enderecos/shared/endereco.model';
import { HttpClient } from '@angular/common/http';
import { switchMap } from "rxjs/operators";

@Component({
  selector: 'app-descarte-form',
  templateUrl: './descarte-form.component.html',
  styleUrls: ['./descarte-form.component.css']
})
export class DescarteFormComponent extends BaseResourceFormComponent<Descarte> implements OnInit{

  cidades: Array<Cidade>;
  tipos: Array<Tipo>;
  enderecos: Array<Endereco>;
  usuarios: Array<Usuario>;
  currentUser: Usuario;
  tipoColabSelect: string = ' Nada selecionado';

  imaskCep = {
    mask: '00000-000'
  };
  
  constructor(
    protected descarteService: DescarteService,
    protected cidadeService: CidadeService,
    protected tipoService: TipoService,
    protected usuarioService: UsuarioService,
    protected enderecoService: EnderecoService,
    private authenticationService: AuthenticationService,
    protected injector: Injector,
    protected http: HttpClient
  ) { 
    super(injector, new Descarte(), descarteService, Descarte.fromJson);
    this.authenticationService.currentUser.subscribe(x => this.currentUser = x);
  }

  ngOnInit() {
    this.loadCidades();
    this.loadEnderecos();
    this.loadTipos();
    super.ngOnInit();
  }
  
  trocarTipoColab(x: number){
    if(x != null && x != 0){
      this.resourceForm.get('idTipo').setValue(x);
      switch(x) { 
        case 1: { 
            this.tipoColabSelect = " Coleta seletiva";
           break; 
        } 
        case 2: { 
           this.tipoColabSelect = " Foco de dengue"; 
          break; 
        } 
        case 3: { 
          this.tipoColabSelect = " Buraco na rua"; 
         break; 
        }
        case 4: { 
          this.tipoColabSelect = " Semáforo com defeito"; 
         break; 
        }
        case 5: { 
          this.tipoColabSelect = " Iluminação pública"; 
         break; 
        }
        case 6: { 
          this.tipoColabSelect = " Lixo na rua"; 
         break; 
        }
        default: { 
           this.tipoColabSelect = " Erro! Clique novamente"; 
          break; 
        }
      }
    }

  }
  submitForm(){
    this.submittingForm = true;
    this.loadLatitudeAndLongitude();
  }

  protected buildResourceForm() {
    this.resourceForm = this.formBuilder.group({
      id: [null],
      titulo: [null, [Validators.required, Validators.minLength(2)]],
      descricao: [null, [Validators.required, Validators.minLength(2)]],
      dataRegistro: new Date(),
      //endereco
      latitude: [9.9, [Validators.required]],
      longitude: [9.9, [Validators.required]],
      rua: [null, [Validators.required]],
      numero: [null, [Validators.required]],
      bairro: [null, [Validators.required]],
      complemento: [null, [Validators.required]],
      cep: [null, [Validators.required]],
      idCidade: [null, [Validators.required]],
      idUsuario: [this.currentUser.id, [Validators.required]],
      idTipo: [null, [Validators.required]],
      idSituacao: [1, [Validators.required]],
    });
  }
  private loadCidades(){
    this.cidadeService.getAll().subscribe(
      cidades => this.cidades = cidades
    );
  }
  
  private loadEnderecos(){
    this.enderecoService.getAllUserId(this.currentUser.id).subscribe(
      enderecos => this.enderecos = enderecos
    );
  }

  private loadTipos(){
    this.tipoService.getAll().subscribe(
      tipos => this.tipos = tipos
    );
  }
  protected creationPageTitle(): string {
    return "Registro de Colaboração";
  }
  protected editionPageTitle(): string {
    return "Registro de Colaboração"; 
  }
  //=========== Completar endereço ===================
  completarEnd(endereco: Endereco){
    var idEndereco = ((document.getElementById("idEndereco") as HTMLInputElement).value);
    if(idEndereco != null && idEndereco != "" && idEndereco != '0'){
      var endereco: Endereco;
      endereco = this.enderecos.find(function(element) {
        return element.id == +idEndereco;
      });
      this.resourceForm.get('latitude').setValue(endereco.latitude);
      this.resourceForm.get('longitude').setValue(endereco.longitude);
      this.resourceForm.get('rua').setValue(endereco.rua);
      this.resourceForm.get('numero').setValue(endereco.numero);
      this.resourceForm.get('bairro').setValue(endereco.bairro);
      this.resourceForm.get('complemento').setValue(endereco.complemento);
      this.resourceForm.get('cep').setValue(endereco.cep);
      this.resourceForm.get('idCidade').setValue(endereco.idCidade);
    }
  }

  //======================= CEP =======================

  consultaCep() {
    let cep = this.resourceForm.get('cep').value;
    cep = cep.replace(/\D/g, '');
    if (cep != null && cep !== '') {
      var validacep = /^[0-9]{8}$/;
      if(validacep.test(cep)){
        this.resetaDadosForm();
        this.http.get(`//viacep.com.br/ws/${cep}/json`).subscribe(dados => this.populaDadosForm(dados))
      }
    }
  }
  
  populaDadosForm(dados){
    //console.log(dados);
    this.resourceForm.get('rua').setValue(dados.logradouro);
    this.resourceForm.get('complemento').setValue(dados.complemento);
    this.resourceForm.get('bairro').setValue(dados.bairro);
  }

  resetaDadosForm(){
    this.resourceForm.patchValue({
      endereco: {
        rua: null,
        complemento: null,
        bairro: null,
      }
    });
  }

  //======================= LATITUDE E LONGITUDE =======================

  loadLatitudeAndLongitude(){
    let rua = this.resourceForm.get('rua').value;
    let numero = this.resourceForm.get('numero').value;
    let bairro = this.resourceForm.get('bairro').value;
    let idCidade = this.resourceForm.get('idCidade').value;
    let cep = this.resourceForm.get('cep').value;

    let cidade: Cidade;
    cidade = this.cidades.find(function(element) {
      return element.id == idCidade;
    });
    var address = rua+"+"+numero+"+"+bairro+"+"+cidade.nome+"+"+cidade.estado.sigla+"+"+cep+"+"+"Brasil";
    var key ="AIzaSyCoe5_XKjkIecnjKXb9RtqYUlPgAkeOeCY";
    //https://maps.googleapis.com/maps/api/geocode/json?address= &key=
    //R.+Portugal,+384+-+Ana+Rita,+Timóteo+-+MG,+35182-260
    //Rua Portugal+384+Ana Rita+Timóteo+MG+35.182-260+Brasil
    
    console.log(address);
    this.http.get(`https://maps.googleapis.com/maps/api/geocode/json?address=${address}&key=${key}`)
    .subscribe(dados => this.setLatitudeLongitude(dados));
  }
  setLatitudeLongitude(dados){
    console.log(dados);
    console.log(dados.results[0].geometry.location.lat);
    console.log(dados.results[0].geometry.location.lng);
    this.resourceForm.get('latitude').setValue(dados.results[0].geometry.location.lat);
    this.resourceForm.get('longitude').setValue(dados.results[0].geometry.location.lng); 
    console.log(this.resourceForm.get('latitude').value);

    if(this.currentAction == "new")
      this.createResource();
    else // currentAction == "edit"
      this.updateResource();
  }
}
