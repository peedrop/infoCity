import { NgModule } from '@angular/core';
import { SharedModule } from "../../shared/shared.module";

import { ColetasRoutingModule } from './coletas-routing.module';

import { ColetaListComponent } from './coleta-list/coleta-list.component';
import { ColetaFormComponent } from './coleta-form/coleta-form.component';

import { CalendarModule } from "primeng/calendar";
import { IMaskModule } from "angular-imask";

import { AgmCoreModule } from '@agm/core';
import { AgmDirectionModule } from 'agm-direction';
import { ColetaMapComponent } from './coleta-map/coleta-map.component';
import { ColetaUsersComponent } from './coleta-users/coleta-users.component';
import { ColetaViewComponent } from './coleta-view/coleta-view.component';

@NgModule({
  declarations: [
    ColetaListComponent,
    ColetaFormComponent,
    ColetaMapComponent,
    ColetaUsersComponent,
    ColetaViewComponent
  ],
  imports: [
    SharedModule,
    ColetasRoutingModule,
    CalendarModule,
    IMaskModule,
    AgmCoreModule.forRoot({
      apiKey: 'AIzaSyCoe5_XKjkIecnjKXb9RtqYUlPgAkeOeCY'
    }),
    AgmDirectionModule,
  ]
})
export class ColetasModule { }
