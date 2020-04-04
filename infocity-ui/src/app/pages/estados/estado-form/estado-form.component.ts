import { Component, Injector } from '@angular/core';
import { Validators } from "@angular/forms";

import { BaseResourceFormComponent } from "../../../shared/components/base-resource-form/base-resource-form.component"

import { Estado } from "../shared/estado.model";
import { EstadoService } from "../shared/estado.service";


@Component({
  selector: 'app-estado-form',
  templateUrl: './estado-form.component.html',
  styleUrls: ['./estado-form.component.css']
})
export class EstadoFormComponent extends BaseResourceFormComponent<Estado> {

  constructor(protected estadoService: EstadoService, protected injector: Injector) { 
    super(injector, new Estado(), estadoService, Estado.fromJson)
  }


  protected buildResourceForm() {
    this.resourceForm = this.formBuilder.group({
      id: [null],
      nome: [null, [Validators.required, Validators.minLength(2)]],
      sigla: [null, [Validators.required]]
    });
  }


  protected creationPageTitle(): string {
    return "Cadastro de Novo Estado";
  }

  protected editionPageTitle(): string {
    const estadoName = this.resource.nome || "";
    return "Editando Estado: " + estadoName;
  }
}