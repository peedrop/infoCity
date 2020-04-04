import { Component, OnInit, Injector } from '@angular/core';
import { Validators } from "@angular/forms";

import { BaseResourceFormComponent } from "../../../shared/components/base-resource-form/base-resource-form.component"

import { Usuario } from "../shared/usuario.model";
import { UsuarioService } from "../shared/usuario.service";

import { Perfil } from "../../perfil2/shared/perfil.model";
import { PerfilService } from "../../perfil2/shared/perfil.service";

@Component({
  selector: 'app-usuario-form',
  templateUrl: './usuario-form.component.html',
  styleUrls: ['./usuario-form.component.css']
})
export class UsuarioFormComponent extends BaseResourceFormComponent<Usuario> implements OnInit{

  perfis: Array<Perfil>;

  constructor(
    protected usuarioService: UsuarioService,
    protected perfilService: PerfilService,
    protected injector: Injector
  ) {
    super(injector, new Usuario(), usuarioService, Usuario.fromJson)
  }

  ngOnInit() {
    this.loadPerfils();
    super.ngOnInit();
  }
  
  protected buildResourceForm() {
    this.resourceForm = this.formBuilder.group({
      id: [null],
      nome: [null, [Validators.required, Validators.minLength(2)]],
      email: [null, [Validators.required, Validators.email]],
      senha: [null, [Validators.required, Validators.minLength(5)]],
      dataNascimento: [null, [Validators.required]],    
      sexo: [null, [Validators.required]],
      flagSituacao: 1,
      foto: 'padrao.png',
      idPerfil: [null, [Validators.required]]
    });
  }

  private loadPerfils(){
    this.perfilService.getAll().subscribe(
      perfis => this.perfis = perfis
    );
  }

  protected creationPageTitle(): string {
    return "Cadastro de Novo Usuario";
  }

  protected editionPageTitle(): string {
    const resourceName = this.resource.nome || "";
    return "Editando Usuario: " + resourceName;
  }
}