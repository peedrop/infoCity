import { Injectable, Injector } from '@angular/core';
import { ColetaDescarte } from "./coletaDescarte.model";

import { BaseResourceService } from "../../shared/services/base-resource.service";
import { environment } from "../../../environments/environment";
import { Observable } from 'rxjs';
import { map, catchError } from 'rxjs/operators';

@Injectable({
  providedIn: 'root'
})
export class ColetaDescarteService extends BaseResourceService<ColetaDescarte> {

  constructor(protected injector: Injector) {
    super(environment.apiUrl+"/planejamentoColaboracao", injector, ColetaDescarte.fromJson);
  }

  delete(id: number): Observable<any> {
    const url = `${environment.apiUrl}/planejamentoColaboracao/${id}`;

    return this.http.delete(url).pipe(
      catchError(this.handleError),
      map(() => null)
    )
  }
  verificarEdit(id: number): Observable<any> {
    const url = `${environment.apiUrl}/planejamentoColaboracaoVerificarEdit/${id}`;
    var observableT = this.http.get(url).pipe(
      map(resposta => console.log(resposta)),
      catchError(this.handleError)
    )
    return observableT;
  }

}