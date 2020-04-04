import { BaseResourceModel } from "../../../shared/models/base-resource.model";
import { Cidade } from "../../cidades/shared/cidade.model";
import { Usuario } from '../../usuarios/shared/usuario.model';

export class Endereco extends BaseResourceModel{
  constructor(
    public id?: number,
    public latitude?: number,
    public longitude?: number,
    public rua?: string,
    public numero?: string,
    public bairro?: string,
    public complemento?: string,
    public cep?: string,

    public idCidade?: number,
    public idUsuario?: number,

    public cidade?: Cidade,
    public usuario?: Usuario
  ){
    super();
   }

  static fromJson(jsonData: any): Endereco {
    return Object.assign(new Endereco(), jsonData); 
  }

} 