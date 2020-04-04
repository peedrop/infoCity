import { Injectable, Injector } from '@angular/core';
import { Tipo } from "./tipo.model";

import { BaseResourceService } from "../../../shared/services/base-resource.service";
import { environment } from "../../../../environments/environment";

@Injectable({
  providedIn: 'root'
})
export class TipoService extends BaseResourceService<Tipo> {

  constructor(protected injector: Injector) {
    super(environment.apiUrl+"/tipo", injector, Tipo.fromJson);
  }

}