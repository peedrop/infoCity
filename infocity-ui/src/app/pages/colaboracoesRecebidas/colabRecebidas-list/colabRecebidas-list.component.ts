import { Component } from '@angular/core';

import { BaseResourceListComponent } from 'src/app/shared/components/base-resource-list/base-resource-list.component';

import { Descarte } from "../../descartes/shared/descarte.model";
import { ColabRecebidasService } from "../colabRecebidas.service";


@Component({
  selector: 'app-colabRecebidas-list',
  templateUrl: './colabRecebidas-list.component.html',
  styleUrls: ['./colabRecebidas-list.component.css']
})
export class ColabRecebidasListComponent extends BaseResourceListComponent<Descarte> {

  situacao: number = 1;

  constructor(private colabRecebidasService: ColabRecebidasService) {
    super(colabRecebidasService);
   }
 
   ngOnInit() {
    this.colabRecebidasService.getBySituacao(this.situacao).subscribe(
      resources => this.resources = resources.sort((a,b) => b.id - a.id),
      error => alert('Erro ao carregar a lista')
    )
  }

  mudarFiltro(situacao: number){
    this.situacao = situacao;
    this.ngOnInit();
  }

   formatarData(data: string){
    var datas = data.split(" ");
    data = datas[0];
    var hora = datas[1];
    var final = data.substring(0,10).split('-').reverse().join('/') +" - "+ hora;
    return final;
   }

  trocarSituacao(resource: Descarte, situacao: number) {
    //alert(resource.id + "" + situacao);
    this.colabRecebidasService.trocarSituacao(resource.id, situacao).subscribe(
      () => this.resources = this.resources.filter(element => element != resource),
      () => alert("Erro ao tentar aceitar/recusar!")
    )
  }
  

}
