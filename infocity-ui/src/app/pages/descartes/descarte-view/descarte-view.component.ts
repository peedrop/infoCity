import { Component, OnInit, Injector, AfterContentChecked } from '@angular/core';
import { Validators } from "@angular/forms";
import { ActivatedRoute, Router } from "@angular/router";
import { formatDate } from "@angular/common";
import { switchMap } from "rxjs/operators";

import { BaseResourceFormComponent } from "../../../shared/components/base-resource-form/base-resource-form.component"

import { Comentario } from "../../comentario/comentario.model";
import { ComentarioService } from "../../comentario/comentario.service";

import { Descarte } from "../../descartes/shared/descarte.model";
import { DescarteService } from "../../descartes/shared/descarte.service";

import { AuthenticationService } from 'src/app/core/services/authentication.service';
import { Usuario } from "../../usuarios/shared/usuario.model";

@Component({
  selector: 'app-descarte-view',
  templateUrl: './descarte-view.component.html',
  styleUrls: ['./descarte-view.component.css']
})
export class DescarteViewComponent extends BaseResourceFormComponent<Comentario> implements OnInit, AfterContentChecked{

  currentUser: Usuario;
  descarte: Descarte;
  comentario: Comentario;
  idDescarte: number = 0;
  title = 'Visualizando colaboração';
  //colorStars
  colorStar1 = 'black';
  colorStar2 = 'black';
  colorStar3 = 'black';
  colorStar4 = 'black';
  colorStar5 = 'black';

  constructor(
    protected comentarioService: ComentarioService,
    protected descarteService: DescarteService,
    protected injector: Injector,
    protected route: ActivatedRoute,
    protected router: Router,
    protected authenticationService: AuthenticationService,
  ) {
    super(injector, new Comentario(), comentarioService, Comentario.fromJson);
    this.route.params.subscribe(params => this.idDescarte = params['id']);
    this.authenticationService.currentUser.subscribe(x => this.currentUser = x);
  }

  ngOnInit() {
    super.ngOnInit();
    //this.loadComentario();
  }
  ngAfterContentChecked(){
      //this.abacate();
  }
  
  protected buildResourceForm() {
    this.resourceForm = this.formBuilder.group({
      id: [null],
      comentario: [null, [Validators.required, Validators.minLength(5)]],
      data: formatDate(new Date(), 'yyyy-MM-dd hh:mm:ss', 'en_US'),
      avaliacao: [null, [Validators.required]],
      idUsuario: this.currentUser.id,
      idColaboracao: this.idDescarte
    });
  }
  submitForm(){
    this.submittingForm = true;
    this.comentarioService.delete(this.idDescarte).subscribe();
    this.createResource();
  }
  excluir(){
    this.comentarioService.delete(this.idDescarte).subscribe();
    this.clickStar(0);
    this.ngOnInit();
  }
  clickStar(star: number){
    this.resourceForm.get('avaliacao').setValue(star);
      switch (star) {
        case 1:
            this.colorStar1 = 'rgb(172, 172, 17)';
            this.colorStar2 = 'black';
            this.colorStar3 = 'black';
            this.colorStar4 = 'black';
            this.colorStar5 = 'black';
        break;
            
        case 2:
            this.colorStar1 = 'rgb(172, 172, 17)';
            this.colorStar2 = 'rgb(172, 172, 17)';
            this.colorStar3 = 'black';
            this.colorStar4 = 'black';
            this.colorStar5 = 'black';     
        break;

        case 3:
            this.colorStar1 = 'rgb(172, 172, 17)';
            this.colorStar2 = 'rgb(172, 172, 17)';
            this.colorStar3 = 'rgb(172, 172, 17)';
            this.colorStar4 = 'black';
            this.colorStar5 = 'black';
        break; 
          
        case 4:
            this.colorStar1 = 'rgb(172, 172, 17)';
            this.colorStar2 = 'rgb(172, 172, 17)';
            this.colorStar3 = 'rgb(172, 172, 17)';
            this.colorStar4 = 'rgb(172, 172, 17)';
            this.colorStar5 = 'black';
        break;

        case 5:
            this.colorStar1 = 'rgb(172, 172, 17)';
            this.colorStar2 = 'rgb(172, 172, 17)';
            this.colorStar3 = 'rgb(172, 172, 17)';
            this.colorStar4 = 'rgb(172, 172, 17)';
            this.colorStar5 = 'rgb(172, 172, 17)';
        break;

        default:
            this.colorStar1 = 'black';
            this.colorStar2 = 'black';
            this.colorStar3 = 'black';
            this.colorStar4 = 'black';
            this.colorStar5 = 'black';
        break;
      }

  }
  /*
  loadComentario(){
    this.comentarioService.getByIdColaboracao(this.idDescarte).subscribe(
        comentario => this.comentario = comentario
    );
  }
  abacate(){
    this.resourceForm.get('avaliacao').setValue(this.comentario.avaliacao);
    this.resourceForm.get('comentario').setValue(this.comentario.comentario);
  }*/
  protected loadResource() {
    this.descarteService.getById(this.idDescarte).subscribe(
        descarte => this.descarte = descarte
    );
    this.route.paramMap.pipe(
    switchMap(params => this.comentarioService.getByIdColaboracao(this.idDescarte))
    )
    .subscribe(
    (comentario) => {
        this.comentario = comentario;
        if (comentario.avaliacao != 0){
            this.click('b'+comentario.avaliacao);
        } 
        this.resourceForm.get('avaliacao').setValue(comentario.avaliacao);
        this.resourceForm.get('comentario').setValue(comentario.comentario);
    },
    (error) => alert('Ocorreu um erro no servidor, tente mais tarde.')
    )
  }

  click(id)
{
    var element = document.getElementById(id);
    if(element.click)
        element.click();
    else if(document.createEvent)
    {
        var eventObj = document.createEvent('MouseEvents');
        eventObj.initEvent('click',true,true);
        element.dispatchEvent(eventObj);
    }
}
  

}