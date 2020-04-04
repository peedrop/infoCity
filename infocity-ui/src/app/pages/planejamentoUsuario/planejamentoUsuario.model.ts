import { BaseResourceModel } from "../../shared/models/base-resource.model";

export class PlanejamentoUsuario extends BaseResourceModel {
  constructor(
    public id?: number,
    public idPlanejamento?: number,
    public idUsuario?: number
  ){
    super();
  }

  static fromJson(jsonData: any): PlanejamentoUsuario {
    return Object.assign(new PlanejamentoUsuario(), jsonData);
  }
} 