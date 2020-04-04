import { Injectable, Injector } from '@angular/core';
import { PlanejamentoUsuario } from "./planejamentoUsuario.model";

import { BaseResourceService } from "../../shared/services/base-resource.service";
import { environment } from "../../../environments/environment";
import { Observable } from 'rxjs';
import { map, catchError } from 'rxjs/operators';

@Injectable({
  providedIn: 'root'
})
export class PlanejamentoUsuarioService extends BaseResourceService<PlanejamentoUsuario> {

  constructor(protected injector: Injector) {
    super(environment.apiUrl+"/planejamentoUsuario", injector, PlanejamentoUsuario.fromJson);
  }

  delete(id: number): Observable<any> {
    const url = `${environment.apiUrl}/planejamentoUsuario/${id}`;

    return this.http.delete(url).pipe(
      catchError(this.handleError),
      map(() => null)
    )
  }
  verificarEdit(id: number): Observable<any> {
    const url = `${environment.apiUrl}/planejamentoUsuario/${id}`;
    var observableT = this.http.get(url).pipe(
      map(resposta => console.log(resposta)),
      catchError(this.handleError)
    )
    return observableT;
  }

}