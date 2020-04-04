import { BaseResourceModel } from "../../shared/models/base-resource.model";

export class Comentario extends BaseResourceModel {
    constructor(
        public id?: number,
        public comentario?: string,
        public data?: string,
        public avaliacao?: number,
        public idUsuario?: number,
        public idColaboracao?: number,
    ){
        super();
    }

    static fromJson(jsonData: any): Comentario {
        return Object.assign(new Comentario(), jsonData);
    }
}