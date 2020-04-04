import { Injectable, Injector } from '@angular/core';
import { Coleta } from "./coleta.model";

import { BaseResourceService } from "../../../shared/services/base-resource.service";
import { environment } from "../../../../environments/environment";
import { Observable } from 'rxjs';
import { map, catchError } from 'rxjs/operators';

@Injectable({
  providedIn: 'root'
})
export class ColetaService extends BaseResourceService<Coleta> {

  constructor(protected injector: Injector) {
    super(environment.apiUrl+"/planejamento", injector, Coleta.fromJson);
  }
  trocarSituacao(id: number): Observable<any> {
    const url = this.apiPath+"Finalizar/" + id;
    
    return this.http.delete(url).pipe(
      map(() => null),
      catchError(this.handleError)
    )
  }

}