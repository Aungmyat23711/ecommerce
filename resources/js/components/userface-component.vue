<template>
  <div id="print">
       <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
  <a class="navbar-brand" href="#">Navbar</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <router-link class="nav-link" to="/vue/showproduct">Shop</router-link>
      </li>
      
      <li class="nav-item">
        <router-link class="nav-link" to="/vue/myorder" >myorder</router-link>
      </li>
      <li class="nav-item">
         <!-- <button class="btn btn-danger" @click="print">Print</button> -->
      </li>
    </ul>
    <ul class="navbar-nav ">
            <li class="nav-item" v-if="this.show ? false : true" >
        <a class="nav-link" @click='logout' href="#">logout</a>
      </li>
      <li class="nav-item" v-if="this.show ? true:false">
        <router-link class="nav-link" to="/vue/showlogin">login</router-link>
      </li>
      <li class="nav-item" v-if="this.show ? true:false">
        <a class="nav-link" href="/signup">Signup</a>
      </li>
          </ul>
    <div class="card" style="margin-right:50px;">
          {{this.user.name}}
          
    </div>
    
  </div>
</nav>
       </header>
       <main style="margin-top:70px;padding-bottom:100px;" class="main"><router-view></router-view></main>
       <footer>
         <div class="bg-dark text-center text-white footer">
          <h1>Footer</h1>
         </div>
       </footer>
  </div>
</template>

<script>
import axios from 'axios'
export default {
  data()
  {
     return {
       user:{
         id:'',
         name:'',
       },
       show:true,
       count:''

     }
  },
methods:
{
  async getuser()
  {
     await axios.get('/vue/getuser')
     .then((resp)=>{
       console.log(resp.data);
       this.user.name=resp.data.name;   
     })
     if(this.user.name==undefined)
     {
       this.show=true
     }
     else{this.show=false}
  },
   async logout()
  {
   this.user.name='';
    await axios.get('/vue/logout')
    .then((resp)=>{
      this.show=true;
    })
  },
  print() {
      window.print()
    }

},
async mounted()
{
  this.getuser();

},
}
</script>

<style>
.footer{
  position:absolute;
  bottom: 0;
  width:100%;
}
 

</style>