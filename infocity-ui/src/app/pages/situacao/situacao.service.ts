import { Injectable, Injector } from '@angular/core';
import { Situacao } from "./situacao.model";

import { BaseResourceService } from "../../shared/services/base-resource.service";
import { environment } from "../../../environments/environment";

@Injectable({
  providedIn: 'root'
})
export class SituacaoService extends BaseResourceService<Situacao> {

  constructor(protected injector: Injector) {
    super(environment.apiUrl+"/situacao", injector, Situacao.fromJson);
  }

}