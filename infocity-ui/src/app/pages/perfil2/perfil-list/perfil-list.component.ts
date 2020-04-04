import { Component } from '@angular/core';

import { BaseResourceListComponent } from "../../../shared/components/base-resource-list/base-resource-list.component";

import { Perfil } from "../shared/perfil.model";
import { PerfilService } from "../shared/perfil.service";

@Component({
  selector: 'app-perfil-list',
  templateUrl: './perfil-list.component.html',
  styleUrls: ['./perfil-list.component.css']
})
export class PerfilListComponent extends BaseResourceListComponent<Perfil> {

  constructor(private perfilService: PerfilService) { 
    super(perfilService);
  }

}