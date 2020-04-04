import { NgModule } from '@angular/core';
import { SharedModule } from "../../shared/shared.module";

import { UsuariosRoutingModule } from './usuarios-routing.module';

import { UsuarioListComponent } from './usuario-list/usuario-list.component';
import { UsuarioFormComponent } from './usuario-form/usuario-form.component';

import { CalendarModule } from "primeng/calendar";
import { IMaskModule } from "angular-imask";

@NgModule({
  declarations: [
    UsuarioListComponent,
    UsuarioFormComponent
  ],
  imports: [
    SharedModule,
    UsuariosRoutingModule,
    CalendarModule,
    IMaskModule
  ]
})
export class UsuariosModule { }
