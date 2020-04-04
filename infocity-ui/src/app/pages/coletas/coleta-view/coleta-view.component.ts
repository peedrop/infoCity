import { Component } from '@angular/core';
import { ActivatedRoute, Router } from "@angular/router";
import toastr from "toastr";
import { BaseResourceListComponent } from 'src/app/shared/components/base-resource-list/base-resource-list.component';

import { Descarte } from "../../descartes/shared/descarte.model";
import { DescarteService } from "../../descartes/shared/descarte.service";
import { ColabRecebidasService } from "../../colaboracoesRecebidas/colabRecebidas.service";
import { ColetaService } from "../shared/coleta.service";

@Component({
  selector: 'app-coleta-view',
  templateUrl: './coleta-view.component.html',
  styleUrls: ['./coleta-view.component.css']
})
export class ColetaViewComponent extends BaseResourceListComponent<Descarte> {

  idPlanejamento: number = 0;
  pageTitle = "Colaborações desse planejamento";
  
  constructor(
    protected route: ActivatedRoute,
    protected router: Router,
    protected descarteService: DescarteService,
    protected colabRecebidasService: ColabRecebidasService,
    protected coletaService: ColetaService,
    ) { 
    super(descarteService);
    this.route.params.subscribe(params => this.idPlanejamento = params['id']);
  }

  ngOnInit() {
    this.descarteService.getByColeta(this.idPlanejamento).subscribe(
      resources => this.resources = resources.sort((a,b) => b.id - a.id),
      error => alert('Erro ao carregar a lista')
    )
  }

  formatarData(data: string){
    var datas = data.split(" ");
    data = datas[0];
    var hora = datas[1];
    var final = data.substring(0,10).split('-').reverse().join('/') +" - "+ hora;
    return final;
   }

   trocarSituacao(id: number, situacao: number){
    if(id != 0 && id != null){
      this.colabRecebidasService.trocarSituacao(id,situacao).subscribe();
      this.ngOnInit();
    }
   }
   finalizarPlanejamento(){
    
    const mustDelete = confirm('Deseja realmente finalizar este planejamento?');
    
    if (mustDelete){
      this.coletaService.trocarSituacao(this.idPlanejamento).subscribe(
        resource => toastr.success("Solicitação processada com sucesso!"),
        error => toastr.error("Ocorreu um erro ao processar a sua solicitação!"),
      )
    }
   }
  
}