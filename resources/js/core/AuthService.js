import { isNull, isNullOrWhiteSpace, when } from "./Utilities";
export class AuthService{
    constructor(){
        this.token = null;
        this.role = null;
        this.name = null;
        this.id = null;
        this.longitude = null;
        this.latitude = null;

    }

    attempt(token, name, role){
        when(
            isNullOrWhiteSpace(token) ||
            isNullOrWhiteSpace(name ||
            isNullOrWhiteSpace(role)),
            () => {
                throw new Error("Falha ao realizar o login")
            }
        )
        this.name = name;
        this.role = role;
        this.token = token;
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
}
