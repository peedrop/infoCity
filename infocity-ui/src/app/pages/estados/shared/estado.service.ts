import { Injectable, Injector } from '@angular/core';
import { Estado } from "./estado.model";

import { BaseResourceService } from "../../../shared/services/base-resource.service";
import { environment } from "../../../../environments/environment";

@Injectable({
  providedIn: 'root'
})
export class EstadoService extends BaseResourceService<Estado> {

  constructor(protected injector: Injector) {
    super(environment.apiUrl+"/estado", injector, Estado.fromJson);
  }

}