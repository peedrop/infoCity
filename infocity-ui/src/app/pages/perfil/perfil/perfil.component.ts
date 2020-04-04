import { Component, OnInit, AfterContentChecked } from '@angular/core';
import { FormBuilder, FormControl, FormGroup, Validators } from "@angular/forms";
import { ActivatedRoute, Router } from "@angular/router";

import { Usuario } from "../../usuarios/shared/usuario.model";
import { HomeService } from "../../home/home.service";
import { AuthenticationService } from '../../../core/services/authentication.service';

import { switchMap } from "rxjs/operators";

import toastr from "toastr";

@Component({
  selector: 'app-perfil',
  templateUrl: './perfil.component.html',
  styleUrls: ['./perfil.component.css']
})
export class PerfilComponent implements OnInit {

  //currentAction: string;
  currentUser: Usuario;
  usuarioForm: FormGroup;
  serverErrorMessages: string[] = null;
  submittingForm: boolean = false;
  usuario: Usuario = new Usuario();
  userSalvo: Usuario = new Usuario();;

  constructor(
    private usuarioService: HomeService,
    private authenticationService: AuthenticationService,
    private route: ActivatedRoute,
    private router: Router,
    private formBuilder: FormBuilder
  ) { 
    this.authenticationService.currentUser.subscribe(x => this.currentUser = x);
  }

  ngOnInit() {
    this.buildUsuarioForm();
    this.loadUsuario();
  }

  submitForm(){
    this.submittingForm = true;
    this.updateUsuario();
  }

  // PRIVATE METHODS

  private buildUsuarioForm() {
    this.usuarioForm = this.formBuilder.group({
      id: [null],
      nome: [null, [Validators.required, Validators.minLength(2)]],
      email: [null, [Validators.required, Validators.email]],
      senha: [null, [Validators.required, Validators.minLength(5)]],
      dataNascimento: [null, [Validators.required]],    
      sexo: [null, [Validators.required]],
      flagSituacao: [null],
      foto: 'padrao.png',
      idPerfil: [null]
    });
  }

  private loadUsuario() {
    this.route.paramMap.pipe(
      switchMap(params => this.usuarioService.getById(this.currentUser.id))
    )
    .subscribe(
      (usuario) => {
        this.usuario = usuario;
        this.usuarioForm.patchValue(usuario) // binds loaded usuario data to CategoryForm
      },
      (error) => alert('Ocorreu um erro no servidor, tente mais tarde.')
    )
  }

  private updateUsuario(){
    const usuario: Usuario = Object.assign(new Usuario(), this.usuarioForm.value);
    this.userSalvo = usuario;
    this.usuarioService.update(usuario)
      .subscribe(
        usuario => this.actionsForSuccess(usuario),
        error => this.actionsForError(error)
      )
  }

  
  private actionsForSuccess(usuario: Usuario){
    toastr.success("Solicitação processada com sucesso!");

    // redirect/reload component page
    //this.atualizarCurrentUser();
    this.router.navigateByUrl("perfil", {skipLocationChange: true}).then(
      () => this.router.navigate(["perfil"])
    )
  }

  private actionsForError(error){
    toastr.error("Ocorreu um erro ao processar a sua solicitação!");

    this.submittingForm = false;

    if(error.status === 422)
      this.serverErrorMessages = JSON.parse(error._body).errors;
    else
      this.serverErrorMessages = ["Falha na comunicação com o servidor. Por favor, tente mais tarde."]
  }

  atualizarCurrentUser() {
    localStorage.removeItem('currentUser');
    localStorage.setItem('currentUser', JSON.stringify(this.userSalvo));
    this.authenticationService.login(this.userSalvo.email, this.userSalvo.senha);
  }

}