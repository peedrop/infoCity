import { Component } from '@angular/core';

import { BaseResourceListComponent } from "../../../shared/components/base-resource-list/base-resource-list.component";

import { Usuario } from "../shared/usuario.model";
import { UsuarioService } from "../shared/usuario.service";

@Component({
  selector: 'app-usuario-list',
  templateUrl: './usuario-list.component.html',
  styleUrls: ['./usuario-list.component.css']
})
export class UsuarioListComponent extends BaseResourceListComponent<Usuario> {

  constructor(private usuarioService: UsuarioService) { 
    super(usuarioService);
  }

}