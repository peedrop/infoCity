import { Injectable, Injector } from '@angular/core';
import { Comentario } from "./comentario.model";

import { BaseResourceService } from "../../shared/services/base-resource.service";
import { environment } from "../../../environments/environment";

import { Observable, throwError } from "rxjs";
import { map, catchError } from "rxjs/operators";

@Injectable({
  providedIn: 'root'
})
export class ComentarioService extends BaseResourceService<Comentario> {

  constructor(protected injector: Injector) {
    super(environment.apiUrl+"/comentario", injector, Comentario.fromJson);
  }

  getByIdColaboracao(id: number): Observable<Comentario> {
    const url = `${this.apiPath}Colaboracao/${id}`;
    var observableT = this.http.get(url).pipe(
      map(this.jsonDataToResource.bind(this)),
      catchError(this.handleError)
    )
    return observableT;
  }

}