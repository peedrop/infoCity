import { Injectable, Injector } from '@angular/core';
import { Cidade } from "./cidade.model";

import { BaseResourceService } from "../../../shared/services/base-resource.service";
import { environment } from "../../../../environments/environment";

@Injectable({
  providedIn: 'root'
})
export class CidadeService extends BaseResourceService<Cidade> {

  constructor(protected injector: Injector) {
    super(environment.apiUrl+"/cidade", injector, Cidade.fromJson);
  }

}