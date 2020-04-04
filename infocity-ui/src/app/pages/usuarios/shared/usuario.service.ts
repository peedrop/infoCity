import { Injectable, Injector } from '@angular/core';
import { Usuario } from "./usuario.model";

import { BaseResourceService } from "../../../shared/services/base-resource.service";
import { environment } from "../../../../environments/environment";

import { Observable } from 'rxjs';
import { map, catchError } from 'rxjs/operators';

@Injectable({
  providedIn: 'root'
})
export class UsuarioService extends BaseResourceService<Usuario> {

  constructor(protected injector: Injector) {
    super(environment.apiUrl+"/usuario", injector, Usuario.fromJson);
  }

  getAllCorporativo(idPlanejamento: number): Observable<Usuario[]> {
    var url = this.apiPath + "Corporativo/" + idPlanejamento;
    var observableT = this.http.get(url).pipe(
      map(this.jsonDataToResources.bind(this)),
      catchError(this.handleError)
    )
    return observableT;
  }

  getByColeta(id: number): Observable<Usuario[]> {
    var url = this.apiPath + "ByPlanejamento/" + id;
    var observableT = this.http.get(url).pipe(
      map(this.jsonDataToResources.bind(this)),
      catchError(this.handleError)
    )
    return observableT;
  }

  getIdUsuarioByIdColeta(id: number): Observable<number[]> {
    var url = this.apiPath + "IdsByIdColeta/" + id;
    var observableT = this.http.get(url).pipe(
      catchError(this.handleError)
    )
    return observableT;
  }

}