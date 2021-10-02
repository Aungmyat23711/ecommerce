import { is } from '@babel/types';
import Vue from 'vue';
import Vuex from 'vuex';
import createPersistedState from 'vuex-persistedstate'

Vue.use(Vuex)

const state={
    user:null,
    search:null,
}
const store=new Vuex.Store({
    state,
    getters:{
    user:(state)=>{
        return state.user
    },
    search:(state)=>{
        return state.search
    }
    },
    actions:{
    user(context,user)
    {
        context.commit('user',user)
    },
    search(context,search)
    {
        context.commit('search',search)
    }
    },
    mutations:{
    user(state,user){
        state.user=user
    },
    search(state,search){
        state.search=search
    }
    },
    plugins:[
        createPersistedState({
            key:['user-data','search-data'],
            paths:['user','search'],
            storage:{
                getItem:(key)=>localStorage.getItem(key),
                setItem:(key,value)=>localStorage.setItem(key,value),
                removeItem:(key)=>localStorage.removeItem(key)
            }
        })
    ]
})
export default store;