import { Component } from '@angular/core';

import { BaseResourceListComponent } from 'src/app/shared/components/base-resource-list/base-resource-list.component';

import { Descarte } from "../shared/descarte.model";
import { DescarteService } from "../shared/descarte.service";

import { Usuario } from "../../usuarios/shared/usuario.model";
import { UsuarioService } from "../../usuarios/shared/usuario.service";
import { AuthenticationService } from 'src/app/core/services/authentication.service';

@Component({
  selector: 'app-descarte-list',
  templateUrl: './descarte-list.component.html',
  styleUrls: ['./descarte-list.component.css']
})
export class DescarteListComponent extends BaseResourceListComponent<Descarte> {

  currentUser: Usuario;

  constructor(private descarteService: DescarteService,private authenticationService: AuthenticationService,) {
    super(descarteService);
    this.authenticationService.currentUser.subscribe(x => this.currentUser = x);
   }

   ngOnInit() {
    this.descarteService.getAllByUser(this.currentUser.id).subscribe(
      resources => this.resources = resources.sort((a,b) => b.id - a.id),
      error => alert('Erro ao carregar a lista')
    )
  }
 
   deleteResource(resource: Descarte) {
    const mustDelete = confirm('Deseja realmente excluir este item?');
    
    if (mustDelete){
      this.descarteService.delete(resource.id).subscribe(
        () => this.ngOnInit(),
        () => alert("Erro ao tentar excluir!")
      )
    }
  }
   formatarData(data: string){
    var datas = data.split(" ");
    data = datas[0];
    var hora = datas[1];
    var final = data.substring(0,10).split('-').reverse().join('/') +" - "+ hora;
    return final;
   }

}
