import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { BehaviorSubject, Observable, throwError } from 'rxjs';
import { map } from 'rxjs/operators';

//import { environment } from '@environments/environment';
import { Usuario } from '../../pages/usuarios/shared/usuario.model';
import toastr from "toastr";

import { environment } from "../../../environments/environment";

@Injectable({ providedIn: 'root' })
export class AuthenticationService {
    private currentUserSubject: BehaviorSubject<Usuario>;
    public currentUser: Observable<Usuario>;

    constructor(private http: HttpClient) {
        this.currentUserSubject = new BehaviorSubject<Usuario>(JSON.parse(localStorage.getItem('currentUser')));
        this.currentUser = this.currentUserSubject.asObservable();
    }

    public get currentUserValue(): Usuario {
        return this.currentUserSubject.value;
    }

    login(email: string, senha: string) {
        return this.http.post<any>(environment.apiUrl+"/login", { email, senha })
            .pipe(map(user => {
                // login successful if there's a jwt token in the response
                if(user.email == email && user.senha == senha){
                    // armazenar dados do usuário no armazenamento local para manter o usuário logado entre as atualizações da página
                    localStorage.setItem('currentUser', JSON.stringify(user));
                    this.currentUserSubject.next(user);
                }else{
                    toastr.options.showMethod = 'slideDown';
                    toastr.error("Erro: Email ou senha incorreta!!!", {timeOut: 1000});
                }
                return user;
            }));
    }

    logout() {
        // remove user from local storage to log user out
        localStorage.removeItem('currentUser');
        this.currentUserSubject.next(null);
    }
}