import { isNull, isNullOrWhiteSpace, when } from "./Utilities";
export class AuthService{
    constructor(){
        this.token = null;
        this.id = null;
        this.role = null;
        this.name = null;
        this.id = null;
        this.longitude = null;
        this.latitude = null;

    }

    attempt(token, id, name, role){
        when(
            isNullOrWhiteSpace(token) ||
            isNullOrWhiteSpace(name) ||
            isNullOrWhiteSpace(role) ||
            isNullOrWhiteSpace(id),
            () => {
                throw new Error("Falha ao realizar o login")
            }
        )
        this.name = name;
        this.role = role;
        this.token = token;
        this.id = id;
        localStorage.setItem('auth', JSON.stringify(this));
    }
    isAuthenticated() {
        return !isNullOrWhiteSpace(localStorage.getItem('auth'))
    }
    logout(){
        localStorage.removeItem('auth');
    }
    getToken(){
        return !isNull(localStorage.getItem('auth')) ? JSON.parse(localStorage.getItem('auth')).token : null;
    }
    toJson(){
        return JSON.parse(localStorage.getItem('auth'));
    }
    authId(){
        return this.toJson().id;
    }
}
