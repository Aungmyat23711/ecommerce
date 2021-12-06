/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
window.Vue = require('vue').default;
window.Swal=Swal

 import VueRouter from 'vue-router';
 import Swal from 'sweetalert2'
import Vue from 'vue';
import VueSession from 'vue-session'
import store from './vuex'

import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'

Vue.use(BootstrapVue)
Vue.use(IconsPlugin)

export const eventBus = new Vue();
Vue.use(VueSession)
 Vue.use(VueRouter)
//
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))


//for myecommerce
Vue.component('ecommerceheader-component',
require('./components/myecommerce/ecommerceheader.vue').default)
Vue.component('pagination',require('laravel-vue-pagination'));
Vue.component('ecommerceframe-component',require('./components/myecommerce/ecommerceframe.vue').default)
Vue.component('ecommercehome-component',require('./components/myecommerce/ecommercehome.vue').default)
Vue.component('ecommercefooter-component',require('./components/myecommerce/ecommercefooter.vue').default)
Vue.component('ecommerceregister-component',require('./components/myecommerce/ecommerceregister.vue').default)
Vue.component('ecommercelogin-component',require('./components/myecommerce/ecommercelogin.vue').default)
Vue.component('ecommercecategory-component',require('./components/myecommerce/ecommercecategory.vue').default)
Vue.component('ecommerceaddproduct-component',require('./components/myecommerce/ecommerceaddproduct').default)
Vue.component('ecommerceproductedit-component',require('./components/myecommerce/ecommerceproductedit').default)
//for myecommerce user
Vue.component('ecommerceuserframe-component',require('./components/userecommerce/ecommerceuserframe').default)
Vue.component('ecommerceheaderuser-component',require('./components/userecommerce/ecommerceheader').default);
Vue.component('ecommerceuserhome-component',require('./components/userecommerce/ecommerceuserhome').default);

//for aseries world

//for import myecommerce
import Ehome from './components/myecommerce/ecommercehome.vue'
import Eregister from './components/myecommerce/ecommerceregister.vue'
import Elogin from './components/myecommerce/ecommercelogin'
import Ecategory from './components/myecommerce/ecommercecategory'
import Eproduct from './components/myecommerce/ecommerceaddproduct'
import Eedit from './components/myecommerce/ecommerceproductedit'
import Euhome from './components/userecommerce/ecommerceuserhome'
import Einfo from './components/userecommerce/ecommerceinfo'
import Euregister from './components/userecommerce/ecommerceregister'
import Eulogin from './components/userecommerce/ecommercelogin'
import Exchange from './components/userecommerce/ecommercetodayexchange'
import Ecart from './components/userecommerce/ecommercecart'
import Esubmitorder from './components/userecommerce/ecommercesubmitorder'
import Ephoto from './components/myecommerce/ecommerceaddphoto'
import Eaddphoto from './components/myecommerce/ecommercephotoaction'
//for import anime

import { mapGetters } from 'vuex';



/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
const routes=[

  //for myecommerce site
  {
    name:'ecommercehome',
    path:'/ecommerce/home',
    component:Ehome
  },
  {
    name:'ecommerceregister',
    path:'/ecommerce/register',
    component:Eregister
  },
  {
    name:'ecommercelogin',
    path:'/ecommerce/login',
    component:Elogin
  },
  {
    name:'ecommercecategory',
    path:'/ecommerce/category',
    component:Ecategory
  },
  {
    name:'ecommerceaddproduct',
    path:'/ecommerce/product',
    component:Eproduct
  },
  {
    name:'ecommerceproductedit',
    path:'/ecommerce/edit/',
    component:Eedit,
    props:true
  },
  {
    name:'addphoto',
    path:'/ecommerce/photo',
    component:Ephoto
  },
  {
    name:'photoadd',
    path:'/ecommerce/addphoto/:id',
    component:Eaddphoto,
  },
  {
    name:'ecommerceuserhome',
    path:'/ecommerce/user/home',
    component:Euhome,
  },
  {
    name:'ecommerceinfo',
    path:'/ecommerce/user/info/:id',
    component:Einfo
  },
  {
    name:'ecommerceuregister',
    path:'/ecommerce/user/register',
    component:Euregister,
    beforeEnter:(to,from,next)=>{
      if(store.state.euser){
        next('/ecommerce/user/home')
      }else{
        next()
      }
     }
  },
  {
    name:'ecommercelogin',
    path:'/ecommerce/user/login',
    component:Eulogin,
    beforeEnter:(to,from,next)=>{
     if(store.state.euser){
       next('/ecommerce/user/home')
     }else{
       next()
     }
    }
  },{
    name:'ecommercetodayexchange',
    path:'/ecommerce/user/exchange',
    component:Exchange
  },
  {
    name:'ecommercecart',
    path:'/ecommerce/user/cart',
    component:Ecart
  },
  {
    name:'ecommercesubmitorder',
    path:'/ecommerce/user/submitorder',
    component:Esubmitorder,
    props:true
  },

]
const router=new VueRouter({
  mode:'history',
  routes
  
})
const app = new Vue({
    el: '#user',
    router,
    VueSession,
    store,
    // created()
    // {
     
    // },
    // data:{
    //   chat:{
    //     message:[],
    //     user:[],
    //     color:[],
    //     typing:''
    //   },
    // message:'',
    // },
    // methods:{
    //  send()
    //  {
    //    if(this.message.length!=0)
    //    {
    //      this.chat.message.push(this.message)
    //      this.chat.user.push('you')
    //      this.chat.color.push('success')
    //      axios.post('/animeframe/chatpage/send',{
    //        message:this.message,
    //        user:this.adminInfo,
    //        userId:this.adminInfo.room_id
    //      })
    //      .then((resp)=>{
    //        this.message=""
    //      })
    //    }
    //  }
    // },
    // mounted()
    // {
    //   Echo.channel('chatting.1')
    //   .listen('ChatEvent',(e)=>{
    //     console.warn(e)
    //     alert('Hello')
    //   //  this.chat.message.push(e.message)
    //   //  this.chat.user.push(e.user.name)
    //   //  this.chat.color.push('warning')
    //   })
     
    // }
    
    // computed:{
    //   ...mapGetters(['adminInfo'])
    // },
    
});


