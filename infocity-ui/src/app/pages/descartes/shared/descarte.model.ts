import { BaseResourceModel } from "../../../shared/models/base-resource.model";
import { Cidade } from "../../cidades/shared/cidade.model";
import { Usuario } from '../../usuarios/shared/usuario.model';
import { Tipo } from '../../tipo/shared/tipo.model';
import { Situacao } from '../../situacao/situacao.model';

export class Descarte extends BaseResourceModel{
  constructor(
    public id?: number,
    public titulo?: string,
    public descricao?: string,
    public dataRegistro?: string,
    public latitude?: number,
    public longitude?: number,
    public rua?: string,
    public numero?: string,
    public bairro?: string,
    public complemento?: string,
    public cep?: string,

    public idCidade?: number,
    public cidade?: Cidade,

    public idUsuario?: number,
    public usuario?: Usuario,

    public idTipo?: number,
    public tipo?: Tipo,

    public idSituacao?: number,
    public situacao?: Situacao,
  ){
    super();
   }

  static fromJson(jsonData: any): Descarte {
    return Object.assign(new Descarte(), jsonData); 
  }

} 