import { Injectable, Injector } from '@angular/core';

import { Descarte } from "../descartes/shared/descarte.model";

import { BaseResourceService } from "../../shared/services/base-resource.service";

import { environment } from "../../../environments/environment";
import { Observable } from 'rxjs';
import { map, catchError } from 'rxjs/operators';

@Injectable({
  providedIn: 'root'
})

export class ColabRecebidasService extends BaseResourceService<Descarte> {

  constructor(protected injector: Injector) {
    super(environment.apiUrl+"/colaboracao", injector, Descarte.fromJson);
  }

  getBySituacao(id: number): Observable<Descarte[]> {
    const url = environment.apiUrl+"/colabBySituacao/" + id;
    var inicio = new Date().getTime();
    //fica tentando por 500 milesegundos
    while(new Date().getTime() < inicio + 500){
      var observableT = this.http.get(url).pipe(
        map(this.jsonDataToResources.bind(this)),
        catchError(this.handleError)
      )
    }
    return observableT;
  }

  trocarSituacao(id: number, situacao: number): Observable<any> {
    //alert("oi");
    const url = this.apiPath+"/trocarSituacao/" + id + "/" + situacao;
    
    return this.http.delete(url).pipe(
      map(() => null),
      catchError(this.handleError)
    )
  }
}
