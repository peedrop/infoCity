import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';

import { CidadeListComponent } from "./cidade-list/cidade-list.component";
import { CidadeFormComponent } from "./cidade-form/cidade-form.component";

const routes: Routes = [
  { path: '', component: CidadeListComponent },
  { path: 'new', component: CidadeFormComponent },
  { path: ':id/edit', component: CidadeFormComponent },
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule]
})
export class CidadesRoutingModule { }
