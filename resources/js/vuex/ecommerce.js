
const state={
    user:null,
    search:null,
    euser:null,
    usersearch:null,
}
export default({
    state,
    getters:{
    user:(state)=>{
        return state.user
    },
    search:(state)=>{
        return state.search
    },
    euser:(state)=>{
        return state.euser
    },
    usersearch:(state)=>{
       return state.usersearch
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
    },
    euser(context,euser)
    {
       context.commit('euser',euser)
    },
    usersearch(context,usersearch)
    {
        context.commit('usersearch',usersearch);
    }
    },
    mutations:{
    user(state,user){
        state.user=user
    },
    search(state,search){
        state.search=search
    },
    euser(state,euser)
    {
        state.euser=euser
    },
    usersearch(state,usersearch)
    {
        state.usersearch=usersearch;
    }
    },
    
})