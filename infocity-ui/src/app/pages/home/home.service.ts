import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from "@angular/common/http";

import { Observable, throwError } from "rxjs";
import { map, catchError, flatMap } from "rxjs/operators";

import { Usuario } from "../usuarios/shared/usuario.model";

import { environment } from "../../../environments/environment";

@Injectable({
  providedIn: 'root'
})
export class HomeService {

  private apiPath: string = environment.apiUrl+"/usuario";

  constructor(private http: HttpClient) { }


  getAll(): Observable<Usuario[]> {
    return this.http.get(this.apiPath).pipe(
      catchError(this.handleError),
      map(this.jsonDataToUsuarios)
    )
  }

  getById(id: number): Observable<Usuario> {
    const url = `${this.apiPath}/${id}`;

    return this.http.get(url).pipe(
      catchError(this.handleError),
      map(this.jsonDataToUsuario)
    )
  }

  create(usuario: Usuario): Observable<Usuario> {
    return this.http.post(this.apiPath, usuario).pipe(
      catchError(this.handleError),
      map(this.jsonDataToUsuario)
    )
  }

  update(usuario: Usuario): Observable<Usuario> {
    return this.http.put(this.apiPath, usuario).pipe(
      catchError(this.handleError),
      map(() => usuario)
    )
  }

  delete(id: number): Observable<any> {
    const url = `${this.apiPath}/${id}`;

    return this.http.delete(url).pipe(
      catchError(this.handleError),
      map(() => null)
    )
  }



  // PRIVATE METHODS

  private jsonDataToUsuarios(jsonData: any[]): Usuario[] {
    const usuarios: Usuario[] = [];
    jsonData.forEach(element => usuarios.push(element as Usuario));
    return usuarios;
  }

  private jsonDataToUsuario(jsonData: any): Usuario {
    return jsonData as Usuario;
  }

  private handleError(error: any): Observable<any>{
    console.log("ERRO NA REQUISIÇÃO => ", error);
    return throwError(error);
  }
}