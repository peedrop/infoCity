import { Injectable, Injector } from '@angular/core';

import { Descarte } from "./descarte.model";

import { BaseResourceService } from "../../../shared/services/base-resource.service";

import { environment } from "../../../../environments/environment";
import { Observable } from 'rxjs';
import { map, catchError } from 'rxjs/operators';

@Injectable({
  providedIn: 'root'
})

export class DescarteService extends BaseResourceService<Descarte> {

  constructor(protected injector: Injector) {
    super(environment.apiUrl+"/colaboracao", injector, Descarte.fromJson);
  }

  getAllByUser(id: number): Observable<Descarte[]> {
    var inicio = new Date().getTime();
    var url = this.apiPath + "ByUser/" + id;
    //fica tentando por 500 milesegundos
    while(new Date().getTime() < inicio + 500){
      var observableT = this.http.get(url).pipe(
        map(this.jsonDataToResources.bind(this)),
        catchError(this.handleError)
      )
    }
    return observableT;
  }

  getByColeta(id: number): Observable<Descarte[]> {
    var url = environment.apiUrl + "/colaboracaoByPlanejamento/" + id;
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
  getIdDescarteByIdColeta(id: number): Observable<number[]> {
    var url = environment.apiUrl + "/colaboracaoIdColaboracaosByPlanejamento/" + id;
    var inicio = new Date().getTime();
    //fica tentando por 500 milesegundos
    while(new Date().getTime() < inicio + 500){
      var observableT = this.http.get(url).pipe(
        catchError(this.handleError)
      )
    }
    return observableT;
  }
  getAllNotIn(idTipo: number): Observable<Descarte[]> {
    var url = this.apiPath + "NotIn/" + idTipo;
    var inicio = new Date().getTime();
      var observableT = this.http.get(url).pipe(
        map(this.jsonDataToResources.bind(this)),
        catchError(this.handleError)
      )
    return observableT;
  }

}
