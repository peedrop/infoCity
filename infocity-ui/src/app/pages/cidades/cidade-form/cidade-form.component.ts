import { Component, OnInit, Injector } from '@angular/core';
import { Validators } from "@angular/forms";

import { BaseResourceFormComponent } from "../../../shared/components/base-resource-form/base-resource-form.component"

import { Cidade } from "../shared/cidade.model";
import { CidadeService } from "../shared/cidade.service";

import { Estado } from "../../estados/shared/estado.model";
import { EstadoService } from "../../estados/shared/estado.service";

@Component({
  selector: 'app-cidade-form',
  templateUrl: './cidade-form.component.html',
  styleUrls: ['./cidade-form.component.css']
})
export class CidadeFormComponent extends BaseResourceFormComponent<Cidade> implements OnInit{

  estados: Array<Estado>;

  constructor(
    protected cidadeService: CidadeService,
    protected estadoService: EstadoService,
    protected injector: Injector
  ) {
    super(injector, new Cidade(), cidadeService, Cidade.fromJson)
  }

  ngOnInit() {
    this.loadEstados();
    super.ngOnInit();
  }
  
  protected buildResourceForm() {
    this.resourceForm = this.formBuilder.group({
      id: [null],
      nome: [null, [Validators.required, Validators.minLength(2)]],
      idEstado: [null, [Validators.required]]
    });
  }

  private loadEstados(){
    this.estadoService.getAll().subscribe(
      estados => this.estados = estados
    );
  }

  protected creationPageTitle(): string {
    return "Cadastro de Nova Cidade";
  }

  protected editionPageTitle(): string {
    const resourceName = this.resource.nome || "";
    return "Editando Cidade: " + resourceName;
  }
}