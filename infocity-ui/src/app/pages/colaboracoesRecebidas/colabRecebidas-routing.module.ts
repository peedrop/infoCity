import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';

import { ColabRecebidasListComponent } from "./colabRecebidas-list/colabRecebidas-list.component";
import { ColabRecebidasFormComponent } from "./colabRecebidas-form/colabRecebidas-form.component";

const routes: Routes = [
  { path: '', component: ColabRecebidasListComponent },
  { path: ':id/edit', component: ColabRecebidasFormComponent },
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule]
})
export class ColabRecebidasRoutingModule { }
