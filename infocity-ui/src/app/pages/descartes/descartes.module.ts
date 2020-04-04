import { NgModule } from '@angular/core';
import { SharedModule } from "../../shared/shared.module";

import { DescartesRoutingModule } from './descartes-routing.module';

import { DescarteListComponent } from './descarte-list/descarte-list.component';
import { DescarteFormComponent } from './descarte-form/descarte-form.component';

import { CalendarModule } from "primeng/calendar";
import { IMaskModule } from "angular-imask";
import { DescarteViewComponent } from './descarte-view/descarte-view.component';

@NgModule({
  declarations: [
    DescarteListComponent,
    DescarteFormComponent,
    DescarteViewComponent
  ],
  imports: [
    SharedModule,
    DescartesRoutingModule,
    CalendarModule,
    IMaskModule
  ]
})
export class DescartesModule { }
