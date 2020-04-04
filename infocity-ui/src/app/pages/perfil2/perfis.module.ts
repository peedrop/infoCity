import { NgModule } from '@angular/core';
import { SharedModule } from "../../shared/shared.module";

import { PerfisRoutingModule } from './perfis-routing.module';
import { PerfilListComponent } from './perfil-list/perfil-list.component';
import { PerfilFormComponent } from './perfil-form/perfil-form.component';

@NgModule({
  declarations: [
    PerfilListComponent, 
    PerfilFormComponent
  ],
  imports: [
    SharedModule,
    PerfisRoutingModule
  ]
})
export class PerfisModule { }
