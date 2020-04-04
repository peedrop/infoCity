import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import { DashboardComponent } from './pages/dashboard/dashboard.component';
import { TablesComponent } from './pages/tables/tables.component';
import { FormsComponent } from './pages/forms/forms.component';
import { TypographyComponent } from './pages/typography/typography.component';
import { MapsComponent } from './pages/maps/maps.component';
import { NotificationsComponent } from './pages/notifications/notifications.component';

//infocity antigo
//login
import { LoginComponent } from './pages/login/login.component';
import { HomeComponent } from './pages/home/home.component';
import { AuthGuard } from './core/guards/auth.guard';

const routes: Routes = [
  {path: '',   redirectTo: '/sobre', pathMatch: 'full'},
  //{ path: '**', redirectTo: '/dashboard' },
  
  {path: 'dashboard', component: DashboardComponent},
  {path: 'forms', component: FormsComponent},
  {path: 'tables', component: TablesComponent},
  {path: 'typography', component: TypographyComponent},
  {path: 'maps', component: MapsComponent},
  {path: 'notifications', component: NotificationsComponent},

  //infocity antigo
  //curso
  /*
  { path: 'entries', loadChildren: './pages/entries/entries.module#EntriesModule', canActivate: [AuthGuard] },
  { path: 'categories', loadChildren: './pages/categories/categories.module#CategoriesModule', canActivate: [AuthGuard] },
  { path: 'reports', loadChildren: './pages/reports/reports.module#ReportsModule', canActivate: [AuthGuard] },

  //infocity
  //{ path: 'usuarios', loadChildren: './pages/usuarios/usuarios.module#UsuariosModule', canActivate: [AuthGuard] },
  { path: 'usuarios', loadChildren: './pages/usuarios/usuarios.module#UsuariosModule', canActivate: [AuthGuard] },
  { path: 'estados', loadChildren: './pages/estados/estados.module#EstadosModule', canActivate: [AuthGuard] },
  { path: 'cidades', loadChildren: './pages/cidades/cidades.module#CidadesModule', canActivate: [AuthGuard] },
  { path: 'enderecos', loadChildren: './pages/enderecos/enderecos.module#EnderecosModule', canActivate: [AuthGuard] },

  //login
  //{ path: '', component: HomeComponent, canActivate: [AuthGuard] },
    { path: 'login', component: LoginComponent },
    */
   //curso
  { path: 'entries', loadChildren: './pages/entries/entries.module#EntriesModule', canActivate: [AuthGuard] },
  { path: 'categories', loadChildren: './pages/categories/categories.module#CategoriesModule', canActivate: [AuthGuard] },
  { path: 'reports', loadChildren: './pages/reports/reports.module#ReportsModule', canActivate: [AuthGuard] },

  //infocity
  { path: 'usuarios', loadChildren: './pages/usuarios/usuarios.module#UsuariosModule', canActivate: [AuthGuard] },
  { path: 'estados', loadChildren: './pages/estados/estados.module#EstadosModule', canActivate: [AuthGuard] },
  { path: 'cidades', loadChildren: './pages/cidades/cidades.module#CidadesModule', canActivate: [AuthGuard] },
  { path: 'coletas', loadChildren: './pages/coletas/coletas.module#ColetasModule', canActivate: [AuthGuard] },
  { path: 'enderecos', loadChildren: './pages/enderecos/enderecos.module#EnderecosModule', canActivate: [AuthGuard] },
  { path: 'enderecosUser', loadChildren: './pages/enderecosUser/enderecos.module#EnderecosModule', canActivate: [AuthGuard] },
  { path: 'descartes', loadChildren: './pages/descartes/descartes.module#DescartesModule', canActivate: [AuthGuard] },
  { path: 'colabRecebidas', loadChildren: './pages/colaboracoesRecebidas/colabRecebidas.module#ColabRecebidasModule', canActivate: [AuthGuard] },
  { path: 'sobre', loadChildren: './pages/sobre/sobre.module#SobreModule', canActivate: [AuthGuard] },
  { path: 'perfil', loadChildren: './pages/perfil/perfil.module#PerfilModule', canActivate: [AuthGuard] },
  { path: 'perfil2', loadChildren: './pages/perfil2/perfis.module#PerfisModule', canActivate: [AuthGuard] },
  { path: 'tipo', loadChildren: './pages/tipo/tipos.module#TiposModule', canActivate: [AuthGuard] },

  //login
  //{ path: '', component: HomeComponent, canActivate: [AuthGuard] },
   // { path: 'login', component: LoginComponent },
    { path: 'home', component: HomeComponent },

    // otherwise redirect to home
    { path: '**', redirectTo: '/sobre' }

  
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
