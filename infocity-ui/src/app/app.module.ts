import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { BrowserAnimationsModule } from '@angular/platform-browser/animations';

import { CollapseModule } from 'ngx-bootstrap/collapse';
import { ToastrModule } from 'ngx-toastr';

import { AppRoutingModule } from './app-routing.module';

import { AppComponent } from './app.component';
import { NavbarComponent } from './components/navbar/navbar.component';
import { SidebarComponent } from './components/sidebar/sidebar.component';
import { FooterComponent } from './components/footer/footer.component';
import { DashboardComponent } from './pages/dashboard/dashboard.component';
import { TablesComponent } from './pages/tables/tables.component';
import { FormsComponent } from './pages/forms/forms.component';
import { TypographyComponent } from './pages/typography/typography.component';
import { MapsComponent } from './pages/maps/maps.component';
import { NotificationsComponent } from './pages/notifications/notifications.component';


//infocity antigo

 import { CoreModule } from "./core/core.module";
// login
//import { NgModule }      from '@angular/core';
 import { FormsModule }    from '@angular/forms';
 import { ReactiveFormsModule }    from '@angular/forms';
 import { HttpClientModule, HTTP_INTERCEPTORS } from '@angular/common/http';

// used to create fake backend
 import { fakeBackendProvider } from './core/_helpers/fake-backend';

//import { AppComponent }  from './app.component';
//import { routing }        from './app.routing';

 import { AlertComponent } from './core/components/alert/alert.component';
 import { JwtInterceptor } from './core/_helpers/jwt.interceptor';
 import { ErrorInterceptor } from './core/_helpers/error.interceptor';
//import { HomeComponent } from './home';
 import { LoginComponent } from './pages/login/login.component';
 import { HomeComponent } from './pages/home/home.component';
//import { RegisterComponent } from './register';
import { CalendarModule } from "primeng/calendar";



@NgModule({
  declarations: [
    AppComponent,
    NavbarComponent,
    SidebarComponent,
    FooterComponent,
    DashboardComponent,
    TablesComponent,
    FormsComponent,
    TypographyComponent,
    MapsComponent,
    NotificationsComponent,

    //infocity antigo
    //login
     AlertComponent,
    //HomeComponent,
    LoginComponent,
    HomeComponent,
    //RegisterComponent
  ],
  imports: [
    BrowserModule,
    AppRoutingModule,
    CommonModule,
    BrowserAnimationsModule,
    CollapseModule.forRoot(),
    ToastrModule.forRoot(),

    //infocity antigo
     CoreModule,
     ReactiveFormsModule,
     FormsModule,
     HttpClientModule,
     CalendarModule
    ],
  providers: [
     { provide: HTTP_INTERCEPTORS, useClass: JwtInterceptor, multi: true },
         { provide: HTTP_INTERCEPTORS, useClass: ErrorInterceptor, multi: true },
  ],
  bootstrap: [AppComponent]
})
export class AppModule { }
