import { when } from "./Utilities";

export class ApiModule{
    #baseURL = `${location.origin}/api`;

    constructor(){}

    async post(url, data){
        return await axios.post(this.#baseURL + url, data);
    }

    async put(url, params = null, data = null){
        return await axios.put(this.#baseURL + url, data ?? data, {params: params})
    }
    async get(url, params = null){
        return await axios.get(this.#baseURL + url, {params: params});
    }

    async delete(url, params = null){
        return await axios.delete(this.#baseURL + url, {params: params})
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

}
