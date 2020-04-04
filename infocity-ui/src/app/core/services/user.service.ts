import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';

//import { environment } from '@environments/environment';
import { Usuario } from '../../pages/usuarios/shared/usuario.model';

@Injectable({ providedIn: 'root' })
export class UserService {
    constructor(private http: HttpClient) { }

    getAll() {
        return this.http.get<Usuario[]>(`http://localhost/estagio/infoCity/index.php/user`);
    }

    getById(id: number) {
        return this.http.get(`http://localhost/estagio/infoCity/index.php/users/${id}`);
    }

    register(user: Usuario) {
        return this.http.post(`http://localhost/estagio/infoCity/index.php/user`, user);
    }

    update(user: Usuario) {
        return this.http.put(`http://localhost/estagio/infoCity/index.php/users/${user.id}`, user);
    }

    delete(id: number) {
        return this.http.delete(`http://localhost/estagio/infoCity/index.php/users/${id}`);
    }
}