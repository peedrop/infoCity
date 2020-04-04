import { AppService } from './../../services/app.service';
import { Component, OnInit } from '@angular/core';
import { Router, ActivatedRoute } from '@angular/router';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { first } from 'rxjs/operators';
import { AuthenticationService } from '../../core/services/authentication.service';
import { Usuario } from '../../pages/usuarios/shared/usuario.model';
import { AlertService } from '../../core/services/alert.service';

@Component({
  selector: 'app-navbar',
  templateUrl: './navbar.component.html',
  styleUrls: ['./navbar.component.scss']
})
export class NavbarComponent implements OnInit {

  loginForm: FormGroup;
  loading = false;
  submitted = false;
  returnUrl: string;
  currentUser: Usuario;

  constructor(
    private formBuilder: FormBuilder,
    private appService: AppService,
    private route: ActivatedRoute,
    private router: Router,
    private authenticationService: AuthenticationService,
    private alertService: AlertService
    ) { 
      this.authenticationService.currentUser.subscribe(x => this.currentUser = x);
      if (this.authenticationService.currentUserValue) { 
        this.router.navigate(['/']);
      };
    }
  isCollapsed = true;
  ngOnInit() {
    this.loginForm = this.formBuilder.group({
        username: [null, Validators.required],
        password: [null, Validators.required]
    });

    // get return url from route parameters or default to '/'
    this.returnUrl = this.route.snapshot.queryParams['returnUrl'] || '/';
  }
  // convenience getter for easy access to form fields
  get f() { return this.loginForm.controls; }

  onSubmit() {
      this.submitted = true;

      // stop here if form is invalid
      if (this.loginForm.invalid) {
          return;
      }

      this.loading = true;
      this.authenticationService.login(this.f.username.value, this.f.password.value)
          .pipe(first())
          .subscribe(
              data => {
                  this.router.navigate([this.returnUrl]);
                  this.loading = false;
              },
              /*
              error => {
                  this.alertService.error(error);
                  this.loading = false;
              }*/
              );
  }

  toggleSidebarPin() {
    this.appService.toggleSidebarPin();
  }
  toggleSidebar() {
    this.appService.toggleSidebar();
  }
  logout() {
    this.authenticationService.logout();
    this.router.navigate(['/home']);
  }

}

