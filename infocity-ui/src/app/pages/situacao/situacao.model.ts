import { BaseResourceModel } from "../../shared/models/base-resource.model";

export class Situacao extends BaseResourceModel {
    constructor(
        public id?: number,
        public nome?: string
    ){
        super();
    }

    static fromJson(jsonData: any): Situacao {
        return Object.assign(new Situacao(), jsonData);
    }
}