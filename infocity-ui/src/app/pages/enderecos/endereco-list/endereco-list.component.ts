import { Component } from '@angular/core';

import { BaseResourceListComponent } from 'src/app/shared/components/base-resource-list/base-resource-list.component';

import { Endereco } from "../shared/endereco.model";
import { EnderecoService } from "../shared/endereco.service";


@Component({
  selector: 'app-endereco-list',
  templateUrl: './endereco-list.component.html',
  styleUrls: ['./endereco-list.component.css']
})
export class EnderecoListComponent extends BaseResourceListComponent<Endereco> {

  constructor(private enderecoService: EnderecoService) {
    super(enderecoService);
   }

}
