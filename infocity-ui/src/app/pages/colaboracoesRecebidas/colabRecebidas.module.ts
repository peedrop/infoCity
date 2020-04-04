import { NgModule } from '@angular/core';
import { SharedModule } from "../../shared/shared.module";

import { ColabRecebidasRoutingModule } from './colabRecebidas-routing.module';

import { ColabRecebidasListComponent } from './colabRecebidas-list/colabRecebidas-list.component';
import { ColabRecebidasFormComponent } from './colabRecebidas-form/colabRecebidas-form.component';

import { CalendarModule } from "primeng/calendar";
import { IMaskModule } from "angular-imask";

@NgModule({
  declarations: [
    ColabRecebidasListComponent,
    ColabRecebidasFormComponent
  ],
  imports: [
    SharedModule,
    ColabRecebidasRoutingModule,
    CalendarModule,
    IMaskModule
  ]
})
export class ColabRecebidasModule { }
