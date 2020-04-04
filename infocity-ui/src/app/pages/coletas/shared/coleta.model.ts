import { BaseResourceModel } from "../../../shared/models/base-resource.model";
import { Tipo } from '../../tipo/shared/tipo.model';

export class Coleta extends BaseResourceModel {
  constructor(
    public id?: number,
    public dataRegistro?: string,
    public horaInicio?: string,
    public horaTermino?: string,
    public observacao?: string,
    public flagSituacao?: number,
    public distancia?: number,
    public idTipo?: number,
    public tipo?: Tipo
  ){
    super();
  }

  static fromJson(jsonData: any): Coleta {
    return Object.assign(new Coleta(), jsonData);
  }
} 