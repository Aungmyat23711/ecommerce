import Crudcomponent from './components/crud-component.vue'
import Categorycomponent from './components/category-component.vue'
import VueRouter from 'vue-router';
import Vue from 'vue'
Vue.use(VueRouter)
const routes=[
    {
      path:'/crud',
      component:Crudcomponent
    },
    {
      path:'/cateogry',
      component:Categorycomponent
    }
  ]
  const router=new VueRouter({
    mode:'history',
    routes
    
  })
  export default {
      components:{
          Crudcomponent,
          Categorycomponent
      },
      router
  }
