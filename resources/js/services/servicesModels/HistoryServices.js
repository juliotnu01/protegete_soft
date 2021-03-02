import {store} from '../../plugins/store'
export default class HistoryServices  {
    async get(){
        try{
            let {data} = await axios('/api/historia/get');
            store.commit('setHistorias',data);
        }catch(e){
            console.log(e)
        }
    }
}