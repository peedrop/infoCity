import { Component, Injector } from '@angular/core';
import { Validators } from "@angular/forms";

import { BaseResourceFormComponent } from "../../../shared/components/base-resource-form/base-resource-form.component"
import { switchMap } from "rxjs/operators";
import { Descarte } from "../../descartes/shared/descarte.model";
import { ColabRecebidasService } from "../colabRecebidas.service";

import { Comentario } from "../../comentario/comentario.model";
import { ComentarioService } from "../../comentario/comentario.service";


@Component({
  selector: 'app-colabRecebidas-form',
  templateUrl: './colabRecebidas-form.component.html',
  styleUrls: ['./colabRecebidas-form.component.css']
})
export class ColabRecebidasFormComponent extends BaseResourceFormComponent<Descarte> {

  comentario: Comentario;

  constructor(
    protected colabRecebidasService: ColabRecebidasService, 
    protected comentarioService: ComentarioService,
    protected injector: Injector
    ) { 
    super(injector, new Descarte(), colabRecebidasService, Descarte.fromJson)
  }

  ngOnInit() {
    this.setCurrentAction(); // qual ação
    this.buildResourceForm(); // construir form
    this.loadResource(); // carregar categoria, pegar e preencher form com ela
    this.loadComentario();
  }

  loadComentario(){
    this.route.paramMap.pipe(
      switchMap(params => this.comentarioService.getByIdColaboracao(+params.get("id")))
    )
    .subscribe(
      (comentario) => {
        this.comentario = comentario;
      },
      (error) => alert('abacate error')
    )
  }
  protected buildResourceForm() {
    this.resourceForm = this.formBuilder.group({
    });
  }

  formatarData(data: string){
    var datas = data.split(" ");
    data = datas[0];
    var hora = datas[1];
    var final = data.substring(0,10).split('-').reverse().join('/') +" - "+ hora;
    return final;
   }

   
  protected creationPageTitle(): string {
    return "Cadastro de Novo Estado";
  }

  protected editionPageTitle(): string {
    const estadoName = this.resource.id || "";
    return "Visualizando Colaboração nº: " + estadoName;
  }
}