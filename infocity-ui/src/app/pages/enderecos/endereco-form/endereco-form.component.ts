import { Component, OnInit, Injector } from '@angular/core';
import { Validators } from "@angular/forms";
import { HttpClient } from '@angular/common/http';

import { BaseResourceFormComponent } from "../../../shared/components/base-resource-form/base-resource-form.component"

import { Endereco } from "../shared/endereco.model";
import { EnderecoService } from "../shared/endereco.service";

import { Usuario } from "../../usuarios/shared/usuario.model";
import { UsuarioService } from "../../usuarios/shared/usuario.service";

import { Cidade } from "../../cidades/shared/cidade.model";
import { CidadeService } from "../../cidades/shared/cidade.service";

import { ConsultaCepService } from "../../../shared/services/consulta-cep.service";

@Component({
  selector: 'app-endereco-form',
  templateUrl: './endereco-form.component.html',
  styleUrls: ['./endereco-form.component.css']
})
export class EnderecoFormComponent extends BaseResourceFormComponent<Endereco> implements OnInit{

  usuarios: Array<Usuario>;
  cidades: Array<Cidade>;

  imaskCep = {
    mask: '00000-000'
  };

  constructor(
    protected enderecoService: EnderecoService,
    protected usuarioService: UsuarioService,
    protected cidadeService: CidadeService,
    protected cepService: ConsultaCepService,
    protected injector: Injector,
    protected http: HttpClient
  ) {
    super(injector, new Endereco(), enderecoService, Endereco.fromJson)
  }

  ngOnInit() {
    this.loadUsuariosCidades();
    super.ngOnInit();
  }
  submitForm(){
    this.submittingForm = true;
    this.loadLatitudeAndLongitude();
  }
  protected buildResourceForm() {
    this.resourceForm = this.formBuilder.group({
      id: [null],
      latitude: [9.9, [Validators.required]],
      longitude: [9.9, [Validators.required]],
      rua: [null, [Validators.required]],
      numero: [null, [Validators.required]],
      bairro: [null, [Validators.required]],
      complemento: [null, [Validators.required]],
      cep: [null, [Validators.required]],
      idCidade: [null, [Validators.required]],
      idUsuario: [null, [Validators.required]],
    });
  }

  private loadUsuariosCidades(){
    this.usuarioService.getAll().subscribe(
      usuarios => this.usuarios = usuarios
    );
    this.cidadeService.getAll().subscribe(
      cidades => this.cidades = cidades
    );
  }

  protected creationPageTitle(): string {
    return "Cadastro de Novo Endereço";
  }

  protected editionPageTitle(): string {
    const resourceName = this.resource.id || "";
    return "Editando Endereço: " + resourceName;
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
    console.log(dados.results[0].geometry.location.lat);
    console.log(dados.results[0].geometry.location.lng);
    this.resourceForm.get('latitude').setValue(dados.results[0].geometry.location.lat);
    this.resourceForm.get('longitude').setValue(dados.results[0].geometry.location.lng); 
    

    if(this.currentAction == "new")
      this.createResource();
    else // currentAction == "edit"
      this.updateResource();
  }
}