import { Component, Injector } from '@angular/core';
import { Validators } from "@angular/forms";

import { BaseResourceFormComponent } from "../../../shared/components/base-resource-form/base-resource-form.component"

import { Tipo } from "../shared/tipo.model";
import { TipoService } from "../shared/tipo.service";


@Component({
  selector: 'app-tipo-form',
  templateUrl: './tipo-form.component.html',
  styleUrls: ['./tipo-form.component.css']
})
export class TipoFormComponent extends BaseResourceFormComponent<Tipo> {

  constructor(protected tipoService: TipoService, protected injector: Injector) { 
    super(injector, new Tipo(), tipoService, Tipo.fromJson)
  }


  protected buildResourceForm() {
    this.resourceForm = this.formBuilder.group({
      id: [null],
      nome: [null, [Validators.required, Validators.minLength(2)]]
    });
  }


  protected creationPageTitle(): string {
    return "Cadastro de Novo Tipo";
  }

  protected editionPageTitle(): string {
    const tipoName = this.resource.nome || "";
    return "Editando Tipo: " + tipoName;
  }
}