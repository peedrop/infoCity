import { BaseResourceModel } from "../../shared/models/base-resource.model";

export class ColetaDescarte extends BaseResourceModel {
  constructor(
    public id?: number,
    public dataRealizacao?: string,
    public observacao?: string,
    public idPlanejamento?: number,
    public idColaboracao?: number
  ){
    super();
  }

  static fromJson(jsonData: any): ColetaDescarte {
    return Object.assign(new ColetaDescarte(), jsonData);
  }
} 