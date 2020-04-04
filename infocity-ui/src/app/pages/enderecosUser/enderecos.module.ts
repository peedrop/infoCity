import { NgModule } from '@angular/core';
import { SharedModule } from "../../shared/shared.module";

import { EnderecosRoutingModule } from './enderecos-routing.module';

import { EnderecoListComponent } from './endereco-list/endereco-list.component';
import { EnderecoFormComponent } from './endereco-form/endereco-form.component';

import { CalendarModule } from "primeng/calendar";
import { IMaskModule } from "angular-imask";

@NgModule({
  declarations: [
    EnderecoListComponent,
    EnderecoFormComponent
  ],
  imports: [
    SharedModule,
    EnderecosRoutingModule,
    CalendarModule,
    IMaskModule
  ]
})
export class EnderecosModule { }
