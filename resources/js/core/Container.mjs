import { ApiModule } from "./ApiModule";
import { AuthService } from "./AuthService";
import { Notify } from "./Notify";

export class Container{
    #bindings;
    constructor(){
        this.#bindings = [];
        this.resolve();
    }

    resolve(){
        this.bind("Api", () => new ApiModule());
        this.bind("Notify", () => new Notify());
        this.bind('AuthService', () => new AuthService());
    }

    bind(key, callback){
        this.exists(key);
        this.#bindings[key] = callback;
    }

    exists(key) {
        if (Object.hasOwn(this.#bindings, key)){
            throw ReferenceError(`Class ${key} already exists`);
        }
    }

    get(key) {
        if (!Object.hasOwn(this.#bindings, key)){
            throw ReferenceError(`Class ${key} doesn't exists`);
        }
        return this.#bindings[key]();
    }
}
