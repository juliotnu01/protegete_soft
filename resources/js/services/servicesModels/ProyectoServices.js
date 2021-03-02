import {store} from '../../plugins/store'
export default class ProyectoServices  {
    async get(){
        try{
            let {data} = await axios('/api/proyecto/get');
            store.commit('setProyectos',data);
        }catch(e){
            console.log(e)
        }
    }
    async store(model) {
        try{
            let {data} = await axios.post('/api/proyecto/store', model)
        }catch(e){
            console.log(e)
        }
    }
    async put(model) {
        try{
            let {data} = await axios.put('/api/proyecto/update', model)
        }catch(e){
            console.log(e)
        }
    }
    async putEstadoProyecto(model, proyecto) {
        try{
            let {data} = await axios.put('/api/proyecto/update-estado-proyecto', {model,proyecto})
        }catch(e){
            console.log(e)
        }
    }
    async guardarCandidatoSupervisor(model) {
        try{
            let {data} = await axios.post('/api/proyecto/store-candidato-supervisor', {model})
        }catch(e){
            console.log(e)
        }
    }
    async guardarCandidatoInterventor(model) {
        try{
            let {data} = await axios.post('/api/proyecto/store-candidato-interventor', {model})
        }catch(e){
            console.log(e)
        }
    }
    async guardarCandidatoContratista(model) {
        try{
            let {data} = await axios.post('/api/proyecto/store-candidato-contratista', {model})
        }catch(e){
            console.log(e)
        }
    }
}