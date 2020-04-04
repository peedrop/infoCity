import { Component } from '@angular/core';

import { BaseResourceListComponent } from "../../../shared/components/base-resource-list/base-resource-list.component";

import { Cidade } from "../shared/cidade.model";
import { CidadeService } from "../shared/cidade.service";

@Component({
  selector: 'app-cidade-list',
  templateUrl: './cidade-list.component.html',
  styleUrls: ['./cidade-list.component.css']
})
export class CidadeListComponent extends BaseResourceListComponent<Cidade> {

  constructor(private cidadeService: CidadeService) { 
    super(cidadeService);
  }

}