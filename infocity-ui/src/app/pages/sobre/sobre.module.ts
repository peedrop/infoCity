import { NgModule } from '@angular/core';
import { SharedModule } from "../../shared/shared.module";

import { SobreRoutingModule } from './sobre-routing.module';
import { SobreComponent } from './sobre/sobre.component';

@NgModule({
  declarations: [
    SobreComponent
  ],
  imports: [
    SharedModule,
    SobreRoutingModule
  ]
})
export class SobreModule { }
