import { Component } from '@angular/core';

import { BaseResourceListComponent } from 'src/app/shared/components/base-resource-list/base-resource-list.component';
import { AuthenticationService } from '../../../core/services/authentication.service';

import { Endereco } from "../../enderecos/shared/endereco.model";
import { EnderecoService } from "../../enderecos/shared/endereco.service";
import { Usuario } from '../../usuarios/shared/usuario.model';


@Component({
  selector: 'app-endereco-list',
  templateUrl: './endereco-list.component.html',
  styleUrls: ['./endereco-list.component.css']
})
export class EnderecoListComponent extends BaseResourceListComponent<Endereco> {

  currentUser: Usuario;

  constructor(private enderecoService: EnderecoService,private authenticationService: AuthenticationService) {
    super(enderecoService);
    this.authenticationService.currentUser.subscribe(x => this.currentUser = x);
   }

   ngOnInit() {
    this.enderecoService.getAllUserId(this.currentUser.id).subscribe(
      resources => this.resources = resources.sort((a,b) => b.id - a.id),
      error => alert('Erro ao carregar a lista')
    )
  }

}
