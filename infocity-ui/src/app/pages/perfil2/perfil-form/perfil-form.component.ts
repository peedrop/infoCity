import { Component, Injector } from '@angular/core';
import { Validators } from "@angular/forms";

import { BaseResourceFormComponent } from "../../../shared/components/base-resource-form/base-resource-form.component"

import { Perfil } from "../shared/perfil.model";
import { PerfilService } from "../shared/perfil.service";


@Component({
  selector: 'app-perfil-form',
  templateUrl: './perfil-form.component.html',
  styleUrls: ['./perfil-form.component.css']
})
export class PerfilFormComponent extends BaseResourceFormComponent<Perfil> {

  constructor(protected perfilService: PerfilService, protected injector: Injector) { 
    super(injector, new Perfil(), perfilService, Perfil.fromJson)
  }


  protected buildResourceForm() {
    this.resourceForm = this.formBuilder.group({
      id: [null],
      nome: [null, [Validators.required, Validators.minLength(2)]]
    });
  }


  protected creationPageTitle(): string {
    return "Cadastro de Novo Perfil";
  }

  protected editionPageTitle(): string {
    const perfilName = this.resource.nome || "";
    return "Editando Perfil: " + perfilName;
  }
}