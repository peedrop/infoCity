import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';

import { ColetaListComponent } from "./coleta-list/coleta-list.component";
import { ColetaMapComponent } from "./coleta-map/coleta-map.component";
import { ColetaFormComponent } from "./coleta-form/coleta-form.component";
import { ColetaUsersComponent } from "./coleta-users/coleta-users.component";
import { ColetaViewComponent } from './coleta-view/coleta-view.component';

const routes: Routes = [
  { path: '', component: ColetaListComponent },
  { path: 'new', component: ColetaFormComponent },
  { path: ':id/edit', component: ColetaFormComponent },
  { path: ':id/view', component: ColetaViewComponent },
  { path: ':id/:tipo/map/new', component: ColetaMapComponent },
  { path: ':id/:tipo/map/edit', component: ColetaMapComponent },
  { path: ':id/:tipo/users/new', component: ColetaUsersComponent },
  { path: ':id/:tipo/users/edit', component: ColetaUsersComponent },
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule]
})
export class ColetasRoutingModule { }
