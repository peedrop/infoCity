import { Component, OnInit, AfterContentChecked } from '@angular/core';
import { FormBuilder, FormControl, FormGroup, Validators } from "@angular/forms";
import { ActivatedRoute, Router } from "@angular/router";

import { Usuario } from "../usuarios/shared/usuario.model";
import { HomeService } from "./home.service";

import { switchMap } from "rxjs/operators";

import toastr from "toastr";

@Component({
  selector: 'app-entry-form',
  templateUrl: './home.component.html',
})
export class HomeComponent implements OnInit{
  
  currentAction: string;
  usuarioForm: FormGroup;
  pageTitle: string;
  serverErrorMessages: string[] = null;
  submittingForm: boolean = false;

  imaskConfig = {
    mask: Number,
    scale: 2,
    thousandsSeparator: '',
    padFractionalZeros: true,
    normalizeZeros: true,
    radix: ','
  };

  ptBR = {
    firstDayOfWeek: 0,
    dayNames: ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado'],
    dayNamesShort: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sab'],
    dayNamesMin: ['Do', 'Se', 'Te', 'Qu', 'Qu', 'Se', 'Sa'],
    monthNames: [
      'Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho',
      'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'
    ],
    monthNamesShort: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
    today: 'Hoje',
    clear: 'Limpar'
  }

  constructor(
    private usuarioService: HomeService,
    private route: ActivatedRoute,
    private router: Router,
    private formBuilder: FormBuilder,
  ) { }

  ngOnInit() {
    this.buildUsuarioForm();
  }

  submitForm(){
    this.submittingForm = true;
    this.createEntry();
  }

  /*
  get typeOptions(): Array<any>{
    return Object.entries(Entry.types).map(
      ([value, text]) => {
        return {
          text: text,
          value: value
        }
      }
    )
  }*/


  private buildUsuarioForm() {
    this.usuarioForm = this.formBuilder.group({
    id: [null],
    nome: [null, [Validators.required, Validators.minLength(2)]],
    email: [null, [Validators.required, Validators.email]],
    senha: [null, [Validators.required, Validators.minLength(5)]],
    dataNascimento: [null, [Validators.required]],    
    sexo: [null, [Validators.required]],
    flagSituacao: 1,
    idPerfil: 4,  //4 - colaborador
    foto: 'padrao.png'
    });
  }


  private createEntry(){
    const usuario: Usuario = Object.assign(new Usuario(), this.usuarioForm.value);

    this.usuarioService.create(usuario)
      .subscribe(
        usuario => this.actionsForSuccess(usuario),
        error => this.actionsForError(error)
      )
  }

  private actionsForSuccess(usuario: Usuario){
    toastr.success("Solicitação processada com sucesso!");

    // redirect/reload component page
    /*
    this.router.navigateByUrl("entries", {skipLocationChange: true}).then(
      () => this.router.navigate(["entries", entry.id, "edit"])
    )*/
  }


  private actionsForError(error){
    toastr.error("Ocorreu um erro ao processar a sua solicitação!");

    this.submittingForm = false;

    if(error.status === 422)
      this.serverErrorMessages = JSON.parse(error._body).errors;
    else
      this.serverErrorMessages = ["Falha na comunicação com o servidor. Por favor, tente mais tarde."]
  }
}