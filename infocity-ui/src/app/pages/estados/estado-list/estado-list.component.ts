import { Component } from '@angular/core';

import { BaseResourceListComponent } from "../../../shared/components/base-resource-list/base-resource-list.component";

import { Estado } from "../shared/estado.model";
import { EstadoService } from "../shared/estado.service";

@Component({
  selector: 'app-estado-list',
  templateUrl: './estado-list.component.html',
  styleUrls: ['./estado-list.component.css']
})
export class EstadoListComponent extends BaseResourceListComponent<Estado> {

  constructor(private estadoService: EstadoService) { 
    super(estadoService);
  }

}