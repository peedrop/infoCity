import { Component, OnInit, Injector } from '@angular/core';
import { Validators } from "@angular/forms";

import { BaseResourceFormComponent } from "../../../shared/components/base-resource-form/base-resource-form.component"

import { Coleta } from "../shared/coleta.model";
import { ColetaService } from "../shared/coleta.service";

import { Tipo } from "../../tipo/shared/tipo.model";
import { TipoService } from "../../tipo/shared/tipo.service";

import toastr from "toastr";

@Component({
  selector: 'app-coleta-form',
  templateUrl: './coleta-form.component.html',
  styleUrls: ['./coleta-form.component.css']
})
export class ColetaFormComponent extends BaseResourceFormComponent<Coleta> implements OnInit{

  tipos: Array<Tipo>;

  constructor(
    protected coletaService: ColetaService,
    protected tipoService: TipoService,
    protected injector: Injector
  ) {
    super(injector, new Coleta(), coletaService, Coleta.fromJson)
  }

  ngOnInit() {
    this.loadTipos();
    super.ngOnInit();
  }

  protected buildResourceForm() {
    this.resourceForm = this.formBuilder.group({
      id: [null],
      dataRegistro: [null, [Validators.required]],
      horaInicio: [null, [Validators.required]],
      horaTermino: [null, [Validators.required]],
      observacao: [null, [Validators.required]],
      flagSituacao: [1, [Validators.required]],
      distancia: [null, [Validators.required]],
      idTipo: [null, [Validators.required]],
    });
  }

  private loadTipos(){
    this.tipoService.getAll().subscribe(
      tipos => this.tipos = tipos
    );
  }
  
  protected actionsForSuccess(resource: Coleta){
    toastr.success("Solicitação processada com sucesso!");
    
    const baseComponentPath: string = '/coletas';

    if (this.currentAction == 'new'){
      this.router.navigateByUrl(baseComponentPath, {skipLocationChange: true}).then(
        () => this.router.navigate([baseComponentPath, resource.id, resource.idTipo, "map", "new"])
      )
    }else{
      this.router.navigateByUrl(baseComponentPath, {skipLocationChange: true}).then(
        () => this.router.navigate([baseComponentPath, resource.id, resource.idTipo, "map", "edit"])
      )
    }
    
  }

  protected creationPageTitle(): string {
    return "Planejamento da solução";
  }

  protected editionPageTitle(): string {
    return "Planejamento da solução";
  }
}