import { Container } from "./Container.mjs";
import { when } from "./Utilities";

export class ApiModule{
    #baseURL = `${location.origin}/api`;

    constructor(){
        this.container = new Container();
        this.authService = this.container.get('AuthService');
    }

    async post(url, data){
        return await axios.post(this.#baseURL + url, data, this.headers());
    }

    async put(url, params = null, data = null){
        return await axios.put(this.#baseURL + url, data ?? data, {params: params}, this.headers())
    }
    async get(url, params = null){
        return await axios.get(this.#baseURL + url, {params: params}, this.headers());
    }

    async delete(url, params = null){
        return await axios.delete(this.#baseURL + url, {params: params}, this.headers())
    }

    send(url, method, data, params = null){
        const self = this;
        const request = when(method == 'POST', async function(){
            return await self.post(url, data)
        }, async function(){
            return await self.put(url, params, data)
        })

        return request;
    }
    headers(){
        return {
            headers: {
                'Authorization': this.authService.getToken()
            }
        }
    }

}
