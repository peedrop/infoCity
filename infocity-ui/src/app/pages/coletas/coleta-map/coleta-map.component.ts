import { Component, OnInit, AfterContentChecked, Injector } from '@angular/core';
import { FormBuilder, FormControl, FormGroup, Validators } from "@angular/forms";
import { ActivatedRoute, Router } from "@angular/router";
import { switchMap } from "rxjs/operators";
import toastr from "toastr";


import { Coleta } from "../shared/coleta.model";
import { ColetaService } from "../shared/coleta.service";

import { Estado } from "../../estados/shared/estado.model";
import { EstadoService } from "../../estados/shared/estado.service";

import { Descarte } from "../../descartes/shared/descarte.model";
import { DescarteService } from "../../descartes/shared/descarte.service";
import { ColabRecebidasService } from "../../colaboracoesRecebidas/colabRecebidas.service";

import { ColetaDescarte } from '../../coletaDescarte/coletaDescarte.model';
import { ColetaDescarteService } from '../../coletaDescarte/coletaDescarte.service';

@Component({
  selector: 'app-coleta-map',
  templateUrl: './coleta-map.component.html',
  styleUrls: ['./coleta-map.component.css']
})
export class ColetaMapComponent implements OnInit, AfterContentChecked{
  
  currentAction: string;

  idPlanejamento: number = 0;
  idTipoPlanejamento: number = 0;
  planejamento: Coleta;
  descartes: Array<Descarte> = [];

  edit: boolean = false;
  todosSelecionados: boolean = false;
  descartesAdicionados: Array<number> = [];
  descartesEdit: Array<Descarte> = [];

  waypoints = [];  
  marcadores = [];

  partida = { lat: -19.5667188, lng: -42.641239 }; //secretaria de obras
  chegada = { lat: -19.5367654, lng: -42.6258008 }; //ascati
  lat: number = -19.5385044;
  lng: number = -42.6512444;
  zoom: number = 10;
  coletaDescartes: Array<ColetaDescarte> = [];
  
  
  /*
  
  estados: Array<Estado>;
  
  pedro = [{location: "-19.54305760,-42.64648490"},{location: "-19.5499196,-42.6455489"}];
  
  
  */

  constructor(
    protected injector: Injector,
    protected route: ActivatedRoute,
    protected router: Router,
    protected coletaService: ColetaService,
    protected descarteService: DescarteService,
    protected coletaDescarteService: ColetaDescarteService,
    protected colabRecebidasService: ColabRecebidasService,
  ) {
    this.route.params.subscribe(params => this.idPlanejamento = params['id']);
    this.route.params.subscribe(params => this.idTipoPlanejamento = params['tipo']);
  }
 

  ngOnInit() {
    this.setCurrentAction();
    this.loadColaboracoes();
  }

  ngAfterContentChecked(){
    
  }

  protected setCurrentAction() {
    if(this.route.snapshot.url[3].path == "new")
      this.currentAction = "new"
    else
      this.currentAction = "edit"
  }

  private loadColaboracoes(){ // pegando colab não associadas e aceitas
    
    this.descarteService.getAllNotIn(this.idTipoPlanejamento).subscribe(
      descartes => this.descartes = descartes
    );
    if( this.currentAction == "edit"){
      let id = +this.route.snapshot.url[0].path;
      //alert(id);
      this.descarteService.getByColeta(id).subscribe(
        descartesEdit => this.descartesEdit = descartesEdit,
      );
      this.descarteService.getIdDescarteByIdColeta(id).subscribe(
        descartesAdicionados => this.descartesAdicionados = descartesAdicionados,
      );
    } 
  }

  adicionarDescarte(idDescarte: number){
    if(idDescarte != null && idDescarte != 0){
      if( !this.verificarExiste(idDescarte) ){
        this.descartesAdicionados.push(idDescarte);
        this.atualizarMarcadores();
      }else{
        let index = this.descartesAdicionados.indexOf(idDescarte);
        this.descartesAdicionados.splice(index, 1);
        this.atualizarMarcadores();
      }
    }
  }

  verificarExiste(idDescarte: number){
    return this.descartesAdicionados.includes(idDescarte);
  }

  atualizarMarcadores(){
    this.marcadores = [];
    this.waypoints = [];
    this.descartes.forEach(element => {
      this.descartesAdicionados.forEach(element2 => {
        if(element.id == element2){
          this.marcadores.push({ latitude: element.latitude, longitude: element.longitude });
          this.waypoints.push({ location: element.latitude + "," +element.longitude });
        }
      });
    });
    if(this.descartesEdit.length > 0){
      this.descartesEdit.forEach(element => {
        this.descartesAdicionados.forEach(element2 => {
          if(element.id == element2){
            this.marcadores.push({ latitude: element.latitude, longitude: element.longitude });
            this.waypoints.push({ location: element.latitude + "," +element.longitude });
          }
        });
      });
    }
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
      this.descartesAdicionados = [];
      this.todosSelecionados = false;
      this.atualizarMarcadores();
    }else{
      this.descartes.forEach(element => {
        if( !this.verificarExiste(element.id) ){
          this.descartesAdicionados.push(element.id);
        }
      });
      this.todosSelecionados = true;
      this.atualizarMarcadores();
    }
  }
  protected createColetaDescarte(){
    //limpar associações dessa coleta
    if(this.currentAction == 'edit'){
      this.coletaDescarteService.delete(this.idPlanejamento).subscribe();
      //alert('deletou todas associações');
    }

    if (this.descartesAdicionados.length > 0){
      //alert('descartes adicionados > 0');
      this.descartesAdicionados.forEach(element => {
        var coletaDescarte = new ColetaDescarte();
        coletaDescarte.idPlanejamento = this.idPlanejamento;
        coletaDescarte.idColaboracao = element;
        coletaDescarte.dataRealizacao = "0000-00-00 00:00:00";
        coletaDescarte.observacao = "nada";
        this.coletaDescartes.push(coletaDescarte);
        this.coletaDescarteService.create(coletaDescarte)
        .subscribe();
        //alert(element + "trocou pra 3");
        this.colabRecebidasService.trocarSituacao(element,3).subscribe();
      });
    }
    this.actionsForSuccess();
    console.log(this.coletaDescartes);
  }
  protected actionsForSuccess(){
    toastr.success("Solicitação processada com sucesso!");
    
    const baseComponentPath: string = '/coletas';

    if (this.currentAction == 'new'){
      this.router.navigateByUrl(baseComponentPath, {skipLocationChange: true}).then(
        () => this.router.navigate([baseComponentPath, this.idPlanejamento, this.idTipoPlanejamento, "users", "new"])
      )
    }else{
      this.router.navigateByUrl(baseComponentPath, {skipLocationChange: true}).then(
        () => this.router.navigate([baseComponentPath, this.idPlanejamento, this.idTipoPlanejamento, "users", "edit"])
      )
    }

  }
}