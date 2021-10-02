/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
window.Vue = require('vue').default;
window.Swal=Swal
import {
    Button,
    HasError,
    AlertError,
    AlertErrors,
    AlertSuccess
  } from 'vform/src/components/bootstrap5'
  import VueRouter from 'vue-router';

  import Crudcomponent from './components/crud-component.vue'
 import About from './components/about-component.vue'
 import Category from './components/category-component'
 import Uploadfile from './components/uploadfile-component'
 import Createcat from './components/createcategory-component'
 import Createpro from './components/createproduct-component'
 import showproduct from  './components/showproduct-component'
 import Edit from './components/edit-component'
 import showlogin from './components/login-component'
 import Swal from 'sweetalert2'
import Vue from 'vue';
import Cart from './components/addcart-component'
import Info from './components/showinfo-component'
import Payment from './components/payment-component'
import myorder from './components/myorder-component'
import VueSession from 'vue-session'
import store from './vuex'
export const eventBus = new Vue();

import { result } from 'lodash';
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

Vue.component('example-component', require('./components/ExampleComponent.vue'));
Vue.component('crud-component',require('./components/crud-component.vue'));
Vue.component('home-component',require('./components/home-component.vue'));
Vue.component('about-component',require('./components/about-component.vue'));
Vue.component('pagination',require('laravel-vue-pagination'));
Vue.component('footer-component',require('./components/footer-component').default);
Vue.component('category-component',require('./components/category-component').default);
Vue.component('edit-component',require('./components/edit-component').default);
Vue.component('index-component',require('./components/index-component.vue').default);
Vue.component('uploadfile-component',require('./components/uploadfile-component.vue').default);
Vue.component('createcategory-component',require('./components/createcategory-component.vue').default);
Vue.component('createproduct-component',require('./components/createproduct-component.vue').default);
Vue.component('usersignup-component',require('./components/usersignup-component').default);
Vue.component('userface-component',require('./components/userface-component.vue').default);
Vue.component('showproduct-component',require('./components/showproduct-component.vue').default);
Vue.component('login-component',require('./components/login-component.vue').default);
Vue.component('addcart-component',require('./components/addcart-component.vue').default);
Vue.component('showinfo-component',require('./components/showinfo-component.vue').default);
Vue.component('payment-component',require('./components/payment-component.vue').default);
Vue.component('myorder-component',require('./components/myorder-component.vue').default);
Vue.component(Button.name, Button)
Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)
Vue.component(AlertErrors.name, AlertErrors)
Vue.component(AlertSuccess.name, AlertSuccess)
//for myecommerce
Vue.component('ecommerceheader-component',
require('./components/myecommerce/ecommerceheader.vue').default)
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
//for import myecommerce
import Ehome from './components/myecommerce/ecommercehome.vue'
import Eregister from './components/myecommerce/ecommerceregister.vue'
import Elogin from './components/myecommerce/ecommercelogin'
import Ecategory from './components/myecommerce/ecommercecategory'
import Eproduct from './components/myecommerce/ecommerceaddproduct'
import Eedit from './components/myecommerce/ecommerceproductedit'


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
const routes=[
  {
    name:'crud-component',
    path:'/vuejs/crud',
    component:Crudcomponent
  },
  {
    name:'about',
    path:'/vuejs/about',
    component:About
  },
  {
    name:'Category',
    path:'/vuejs/category',
    component:Category
  },
  {
    name:'Uploadfile',
    path:'/upload',
    component:Uploadfile
  },
  {
    name:'Createcategory',
    path:'/createcat',
    component:Createcat
  },
  {
    name:'Createproduct',
    path:'/createpro',
    component:Createpro
  },
  {
    name:'Edit',
    path:'/edit/:id',
    component:Edit,
    props:true
  },
  {
    name:'showedit',
    path:'/',
    components:Edit,
    props:true
  },
  {
    name:'Showproduct',
    path:'/vue/showproduct',
    component:showproduct,
    props:true
  },
  {
    name:'showlogin',
    path:'/vue/showlogin',
    component:showlogin,
  },
  {
    name:'addorder',
    path:'/vue/viewcart',
    component:Cart
  },
  {
    name:'info',
    path:'/vue/showinfo/:id',
    component:Info
  },
  {
    name:'payment',
    path:'/vue/payment',
    component:Payment
  },
  {
    name:'myorder',
    path:'/vue/myorder',
    component:myorder
  },
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
  }

]
const router=new VueRouter({
  mode:'history',
  routes
  
})
const app = new Vue({
    el: '#app',
    el: '#eco',
    el: '#ecouser',
    components:{
      Crudcomponent,
      About,
      Category,
      Edit
    },
    router,
    VueSession,
    store

});


