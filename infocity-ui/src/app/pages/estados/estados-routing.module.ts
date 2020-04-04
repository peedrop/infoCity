import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';

import { EstadoListComponent } from './estado-list/estado-list.component';
import { EstadoFormComponent } from './estado-form/estado-form.component';

const routes: Routes = [
  { path: '', component: EstadoListComponent },
  { path: 'new', component: EstadoFormComponent },
  { path: ':id/edit', component: EstadoFormComponent }
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule]
})
export class EstadosRoutingModule { }
