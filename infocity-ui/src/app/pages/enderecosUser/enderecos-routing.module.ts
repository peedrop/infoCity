import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';

import { EnderecoListComponent } from "./endereco-list/endereco-list.component";
import { EnderecoFormComponent } from "./endereco-form/endereco-form.component";

const routes: Routes = [
  { path: '', component: EnderecoListComponent },
  { path: 'new', component: EnderecoFormComponent },
  { path: ':id/edit', component: EnderecoFormComponent },
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule]
})
export class EnderecosRoutingModule { }
