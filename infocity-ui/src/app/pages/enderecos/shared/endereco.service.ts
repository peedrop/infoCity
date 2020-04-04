import { Injectable, Injector } from '@angular/core';
import { map, catchError } from "rxjs/operators";
import { Observable } from "rxjs";

import { Endereco } from "./endereco.model";

import { BaseResourceService } from "../../../shared/services/base-resource.service";

import { environment } from "../../../../environments/environment";

@Injectable({
  providedIn: 'root'
})

export class EnderecoService extends BaseResourceService<Endereco> {

  constructor(protected injector: Injector) {
    super(environment.apiUrl+"/endereco", injector, Endereco.fromJson);
  }
  
  getAllUserId(id: number): Observable<Endereco[]> {
    const url = `${environment.apiUrl}/endereco/usuario/${id}`;
    //var inicio = new Date().getTime();
    //fica tentando por 500 milesegundos
    //while(new Date().getTime() < inicio + 2000){
      var observableT = this.http.get(url).pipe(
        map(this.jsonDataToResources.bind(this)),
        catchError(this.handleError)
      )
    //}
    return observableT;
  }
}
