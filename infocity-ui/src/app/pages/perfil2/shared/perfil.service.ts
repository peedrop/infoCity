import { Injectable, Injector } from '@angular/core';
import { Perfil } from "./perfil.model";

import { BaseResourceService } from "../../../shared/services/base-resource.service";
import { environment } from "../../../../environments/environment";

@Injectable({
  providedIn: 'root'
})
export class PerfilService extends BaseResourceService<Perfil> {

  constructor(protected injector: Injector) {
    super(environment.apiUrl+"/perfil", injector, Perfil.fromJson);
  }

}