<template>
<div class="fixed bg-white index">
    <div class="container bg-primary my-1 sticky-md-top" >
      <div class="row" align='center' style="padding-top:10px;">
         <div class="col-md-6 ">
             <div class="text-white">
              <h5>{{time}}</h5>
             </div>
         </div>
         <div class="col-md-6 text-white">
           <h5>{{date}}</h5>
         </div>
      </div>
        
    </div>
    <div class="nav">
            <nav class="container-fluid navbar navbar-expand-lg navbar-light bg-light head">
  <a class="navbar-brand" href="#"><h4><font class="acc">Accessories</font> <font class="shop">Shop</font></h4></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <div class="navbar-nav mr-auto text">

        <router-link class="nav-link" active-class="active" to="/ecommerce/user/home">Home <span class="sr-only">(current)</span></router-link>
   
      
        <router-link v-if='euser' class="nav-link" active-class="active" to="/ecommerce/user/exchange">myorder</router-link>

      
        <router-link v-if='!euser' class="nav-link" active-class="active" to="/ecommerce/user/register">Register</router-link>
      
      
        <router-link v-if='!euser' class="nav-link" active-class="active" to="/ecommerce/user/login">login</router-link>
      
  
      
        <font v-if='euser' style="cursor:pointer;" @click='logout' class="nav-link">logout</font>
      
    </div>
    <form class="d-flex">
            <div class="ultwo">
      <div><i class="fas fa-user"></i>
      <span v-if='euser' class="badge badge-primary name">{{euser.name}}</span>
      </div>
      <div>
     <router-link to="/ecommerce/user/cart"><i class="fas fa-shopping-cart"></i></router-link>
           <span class="badge badge-primary">{{count}}</span>
      </div>
    </div>
        </form>
    
  </div>
</nav>   
    </div>
</div>
  
</template>

<script>

import {mapGetters} from 'vuex'
import {eventBus} from './../../app'
export default {
data()
{
  return {
    time:'',
    date:'',
    count:'',
  }
},
methods:{
  getTime()
  {
    var date=new Date();
    var time=date.getHours()+" Hours "+date.getMinutes()+" Minutes "+date.getSeconds()+" Seconds ";
    this.time=time;
  },
  getDate()
  {
    var date=new Date();
    var day=date.getDate()+'/'+(date.getMonth()+1)+'/'+date.getFullYear();
    this.date=day
  },
  logout()
  {
    this.$store.dispatch('euser',null)
  },
  async getcount()
  {
    await axios.get('/ecommerce/user/getcount')
    .then((resp)=>{
      console.warn('count',resp.data)
      this.count=resp.data
    })
  }
},
created()
{
  this.getcount();
  window.setInterval(()=>{
    this.getTime()
  },1000);
  this.getDate();
  eventBus.$on('countcart',()=>{
    this.getcount();
  }) 
},
computed:{
  ...mapGetters(['euser'])
}
}
</script>

<style lang="scss" scoped>
.acc{
  box-shadow: 10px;
  font-weight: bolder;
  color: black;
  font-family: fantasy;
}
.shop{
   box-shadow: 10px;
  font-weight: bolder;
  color: rgb(9, 9, 185);
  font-family: fantasy;
}
.ul{
  display: flex;
  list-style: none;
}
.ul li{
  color:  black;
  
}
.margin{
 position: static;
 width: 100%;

}
.ultwo{
  list-style: none;
  display: flex;
}
.ultwo div{
  color:black;
  padding-left:20px;
  font-size: 24px;
}
.ultwo div:hover{
  background: none;
  opacity: 0.5;
}
.fixed{
  position: fixed;
  width: 100%;
  z-index: 1;
}
.active{
  background: rgb(88, 190, 190);
}
.index{
  z-index: 4;
}

@media only screen and (max-width:600px){
  .head{
    padding-bottom:100px ;
  }

.navbar-light .navbar-nav .nav-link {
    color: red;
    
}
.ultwo[data-v-1ddd19d8] {
    list-style: none;
    display: flex;
}
.name{
  display: none;
}
.navbar-collapse {
    flex-basis: 100%;
    flex-grow: 1;
    backdrop-filter: blur(21px) saturate(180%);
    -webkit-backdrop-filter: blur(21px) saturate(180%);
    background-color: rgba(255, 255, 255, 0.75);
    border-radius: 12px;
    border: 1px solid rgba(209, 213, 219, 0.3);
}
.active{
  background: none;
  font-size: 15px;
}
.navbar-light .navbar-nav .nav-link {
    color: rgb(14, 18, 223);
    font-size: 15px;
    
}
.index{
  z-index: 4;
}
}
</style>