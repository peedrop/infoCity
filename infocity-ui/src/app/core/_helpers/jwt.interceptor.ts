import { Injectable } from '@angular/core';
import { HttpRequest, HttpHandler, HttpEvent, HttpInterceptor } from '@angular/common/http';
import { Observable } from 'rxjs';

@Injectable()
export class JwtInterceptor implements HttpInterceptor {
    intercept(request: HttpRequest<any>, next: HttpHandler): Observable<HttpEvent<any>> {
        // add authorization header with jwt token if available

        //NÃO COLOCA AUTORIZAÇÃO
        if(request.url.match(/viacep/)){
            //alert('achouu');
            return next.handle(request);
        }
        if(request.url.match(/maps.googleapis.com/)){
            //alert('achouu maps');
            return next.handle(request);
        }

        let currentUser = JSON.parse(localStorage.getItem('currentUser'));
        if (currentUser) {
            let username: string = currentUser.email;
            let password: string = currentUser.senha;
            request = request.clone({
                setHeaders: { 
                    Authorization: "Basic " + btoa(username + ":" + password)
                }
            });
        }

        return next.handle(request);
    }
}