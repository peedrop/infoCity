import { NgModule } from '@angular/core';
import { SharedModule } from "../../shared/shared.module";

import { EstadosRoutingModule } from './estados-routing.module';
import { EstadoListComponent } from './estado-list/estado-list.component';
import { EstadoFormComponent } from './estado-form/estado-form.component';

@NgModule({
  declarations: [
    EstadoListComponent, 
    EstadoFormComponent
  ],
  imports: [
    SharedModule,
    EstadosRoutingModule
  ]
})
export class EstadosModule { }
