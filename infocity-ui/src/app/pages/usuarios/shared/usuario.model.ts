import { BaseResourceModel } from "../../../shared/models/base-resource.model";
import { Perfil } from "../../perfil2/shared/perfil.model";

export class Usuario extends BaseResourceModel {
  constructor(
    public id?: number,
    public nome?: string,
    public email?: string,
    public senha?: string,
    public dataNascimento?: string,
    public sexo?: string,
    public flagSituacao?: number,
    public foto?: string,
    public idPerfil?: number,
    public perfil?: Perfil
  ){
    super();
  }

  static fromJson(jsonData: any): Usuario {
    return Object.assign(new Usuario(), jsonData);
  }
} 