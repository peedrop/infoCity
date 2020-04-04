import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';

import { DescarteListComponent } from "./descarte-list/descarte-list.component";
import { DescarteFormComponent } from "./descarte-form/descarte-form.component";
import { DescarteViewComponent } from './descarte-view/descarte-view.component';

const routes: Routes = [
  { path: '', component: DescarteListComponent },
  { path: 'new', component: DescarteFormComponent },
  { path: ':id/edit', component: DescarteFormComponent },
  { path: ':id/view', component: DescarteViewComponent },
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule]
})
export class DescartesRoutingModule { }
