import { Component, OnInit, AfterContentChecked, Injector } from '@angular/core';
import { ActivatedRoute, Router } from "@angular/router";
import toastr from "toastr";


import { Coleta } from "../shared/coleta.model";
import { ColetaService } from "../shared/coleta.service";

import { Usuario } from "../../usuarios/shared/usuario.model";
import { UsuarioService } from "../../usuarios/shared/usuario.service";

import { PlanejamentoUsuario } from '../../planejamentoUsuario/planejamentoUsuario.model';
import { PlanejamentoUsuarioService } from '../../planejamentoUsuario/planejamentoUsuario.service';

@Component({
  selector: 'app-coleta-users',
  templateUrl: './coleta-users.component.html',
  styleUrls: ['./coleta-users.component.css']
})
export class ColetaUsersComponent implements OnInit, AfterContentChecked{
  
  currentAction: string;

  idPlanejamento: number = 0;
  idTipoPlanejamento: number = 0;
  planejamento: Coleta;
  usuarios: Array<Usuario> = [];

  edit: boolean = false;
  todosSelecionados: boolean = false;
  usuariosAdicionados: Array<number> = [];
  usuariosEdit: Array<Usuario> = [];

  planejamentoUsuarios: Array<PlanejamentoUsuario> = [];

  constructor(
    protected injector: Injector,
    protected route: ActivatedRoute,
    protected router: Router,
    protected coletaService: ColetaService,
    protected usuarioService: UsuarioService,
    protected planejamentoUsuarioService: PlanejamentoUsuarioService,
  ) {
    this.route.params.subscribe(params => this.idPlanejamento = params['id']);
    this.route.params.subscribe(params => this.idTipoPlanejamento = params['tipo']);
  }
 

  ngOnInit() {
    this.setCurrentAction();
    this.loadUsuarios();
  }

  ngAfterContentChecked(){
    
  }

  protected setCurrentAction() {
    if(this.route.snapshot.url[3].path == "new")
      this.currentAction = "new"
    else
      this.currentAction = "edit"
  }

  private loadUsuarios(){ // pegando usuarios corporativos 
    
    this.usuarioService.getAllCorporativo(this.idPlanejamento).subscribe(
      usuarios => this.usuarios = usuarios
    );
    if( this.currentAction == "edit"){
      let id = +this.route.snapshot.url[0].path;
      //alert(id);
      this.usuarioService.getByColeta(id).subscribe(
        usuariosEdit => this.usuariosEdit = usuariosEdit,
      );
      this.usuarioService.getIdUsuarioByIdColeta(id).subscribe(
        usuariosAdicionados => this.usuariosAdicionados = usuariosAdicionados,
      );
    } 
  }

  adicionarUsuario(idUsuario: number){
    if(idUsuario != null && idUsuario != 0){
      if( !this.verificarExiste(idUsuario) ){
        this.usuariosAdicionados.push(idUsuario);
        //alert(idUsuario);
      }else{
        let index = this.usuariosAdicionados.indexOf(idUsuario);
        this.usuariosAdicionados.splice(index, 1);
        //alert(idUsuario);
      }
    }
  }

  verificarExiste(idUsuario: number){
    return this.usuariosAdicionados.includes(idUsuario);
  }

  formatarData(data: string){
    var datas = data.split(" ");
    data = datas[0];
    var hora = datas[1];
    var final = data.substring(0,10).split('-').reverse().join('/') +" - "+ hora;
    return final;
   }
  
  selecionarTodos(){
    if(this.todosSelecionados){
      this.usuariosAdicionados = [];
      this.todosSelecionados = false;
    }else{
      this.usuarios.forEach(element => {
        if( !this.verificarExiste(element.id) ){
          //alert(element.id);
          this.usuariosAdicionados.push(element.id);
        }
      });
      this.todosSelecionados = true;
    }
  }
  protected createPlanejamentoUsuario(){
    //limpar associações dessa coleta
    if(this.currentAction == 'edit'){
      this.planejamentoUsuarioService.delete(this.idPlanejamento).subscribe();
      //alert('deletou todas associações');
    }

    if (this.usuariosAdicionados.length > 0){
      //alert('usuarios adicionados > 0');
      this.usuariosAdicionados.forEach(element => {
        var planejamentoUsuario = new PlanejamentoUsuario();
        planejamentoUsuario.idPlanejamento = this.idPlanejamento;
        planejamentoUsuario.idUsuario = element;
        this.planejamentoUsuarios.push(planejamentoUsuario);
        this.planejamentoUsuarioService.create(planejamentoUsuario)
        .subscribe();
        //alert('criou 1 elemento');
      });
    }
    this.actionsForSuccess();
    console.log(this.planejamentoUsuarios);
  }

  protected actionsForSuccess(){
    toastr.success("Solicitação processada com sucesso!");
    
    const baseComponentPath: string = '/coletas';

    this.router.navigateByUrl(baseComponentPath, {skipLocationChange: true}).then(
      () => this.router.navigate([baseComponentPath])
    )
  }

}