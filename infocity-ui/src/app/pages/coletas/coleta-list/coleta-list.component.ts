import { Component } from '@angular/core';

import { BaseResourceListComponent } from "../../../shared/components/base-resource-list/base-resource-list.component";

import { Coleta } from "../shared/coleta.model";
import { ColetaService } from "../shared/coleta.service";

@Component({
  selector: 'app-coleta-list',
  templateUrl: './coleta-list.component.html',
  styleUrls: ['./coleta-list.component.css']
})
export class ColetaListComponent extends BaseResourceListComponent<Coleta> {

  constructor(private coletaService: ColetaService) { 
    super(coletaService);
  }

  formatarData(data: string){
    return data.substring(0,10).split('-').reverse().join('/');
   }

   situacaoName(sit: number){
    if(sit == 1)
      return 'Planejado';
    else
      return 'Executado';
   }

}