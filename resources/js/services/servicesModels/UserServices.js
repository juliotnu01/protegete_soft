import {store} from '../../plugins/store'
export default class UserServices  {
    async get(){
        try{
            let {data} = await axios('/api/user/get');
            store.commit('setUsers',data);
        }catch(e){
            console.log(e)
        }
    }
}