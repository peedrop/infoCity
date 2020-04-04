import { NgModule } from '@angular/core';
import { SharedModule } from "../../shared/shared.module";

import { CidadesRoutingModule } from './cidades-routing.module';

import { CidadeListComponent } from './cidade-list/cidade-list.component';
import { CidadeFormComponent } from './cidade-form/cidade-form.component';

import { CalendarModule } from "primeng/calendar";
import { IMaskModule } from "angular-imask";

@NgModule({
  declarations: [
    CidadeListComponent,
    CidadeFormComponent
  ],
  imports: [
    SharedModule,
    CidadesRoutingModule,
    CalendarModule,
    IMaskModule
  ]
})
export class CidadesModule { }
