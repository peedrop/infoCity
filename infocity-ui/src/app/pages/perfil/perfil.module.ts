import { NgModule } from '@angular/core';
import { SharedModule } from "../../shared/shared.module";

import { PerfilRoutingModule } from './perfil-routing.module';
import { PerfilComponent } from './perfil/perfil.component';

@NgModule({
  declarations: [
    PerfilComponent
  ],
  imports: [
    SharedModule,
    PerfilRoutingModule
  ]
})
export class PerfilModule { }
