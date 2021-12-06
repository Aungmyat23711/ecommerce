<template>
  <div class='fullpanel bg-white'>
      <div class="container">
         <div class="row">
             <div class="col-md-4">
                <p style="padding-top:20px;">{{this.date}} <font class="text-white bg-danger" 
                style="border:1px solid black;border-radius:20px;padding:2px;">{{this.time}}</font></p>
             </div>
             <div class="col-md-4">
                <h1 class="text-center text-dark">Ecommerce Website</h1>
                <p class="text-center">Computer parts and accessories</p>
             </div>
             <div class="col-md-4">
                
             </div>
         </div>
      </div>
       <div class="navbar">
           <ul class="ul" id="hideul">
              <li><router-link to='/ecommerce/home'><i class="fas fa-home"></i></router-link></li>
              <li><router-link to='/ecommerce/category'>Category</router-link></li>
              <li><router-link to='/ecommerce/product'>Product</router-link></li>
              <li><router-link to='/ecommerce/photo'>Add Photo</router-link></li>

              <div style='display:flex;' v-if='!user'>
                  <li><router-link to='/ecommerce/login'>Login</router-link></li>
                  <li><router-link to='/ecommerce/register'>Register</router-link></li>
              </div>
              <div v-if='user'>
                 <li><font @click="logoutuser" to="#">Logout</font></li> 
              </div>
           </ul>
           <div class="listicon">
                 <p v-on:click='clickopen()' v-if="isclick==false"><i class="fas fa-list"></i></p>
                 <p v-on:click='clickclose()' v-if="isclick==true"><i class="fas fa-list"></i></p>
              </div>
           <form @submit.prevent="search">
               <p class="search" @click="clicksearch" v-if="ishide==false"><i class="fas fa-search"></i></p>
               <p class="search" @click="closesearch" v-if="ishide==true"><i class="fas fa-search"></i></p>
               <div class="searchbox" id="show">
                   <input class="form-control mr-sm-2" type="search" placeholder="Search" v-model="searchname">
                   <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
               </div>
                
           </form>
       </div>
       

  </div>
</template>

<script>
import axios from 'axios';
import {mapGetters} from 'vuex'
import {eventBus} from './../../app'
export default {
data(){
   return {
       date:'',
       time:'',
       isclick:false,
       ishide:false,
       searchname:''
   }
},
methods:{
   getDate()
   {
        var today=new Date();
        var now=today.getDate()+'-'+
        (today.getMonth()+1)+'-'+
        today.getFullYear();
        
        this.date=now     
   },
   getTime()
   {
        var today=new Date();
        var time=today.getHours()+':'+today.getMinutes()+':'+today.getSeconds();
        this.time=time;
   },
   clickopen()
   {
       this.is
       document.getElementById('hideul').style.display='inline'; 
       this.isclick=true 
   },
   clickclose()
   {
       document.getElementById('hideul').style.display='none';
       this.isclick=false
   },
   async logoutuser()
   {
     await axios.get('/ecommerce/logoutuser')
     .then((resp)=>{
         alert('logout Successfully');
         this.$store.dispatch('user',null)  
     })
   },
   clicksearch()
   {
       this.ishide=true
       document.getElementById('show').style.display='flex';
   },
   closesearch()
   {
       this.ishide=false
       document.getElementById('show').style.display='none';
       this.$store.dispatch('search',null);
   },
    search()
   { 
     var path='/ecommerce/home'
     if(this.$route.path!==path)
     {
          this.$store.dispatch('search',this.searchname);
          this.$router.push(path)
          .then(()=>{  
          eventBus.$emit('searchmethodtwo'); 
         })  
     }
     else{
          this.$store.dispatch('search',this.searchname);
         eventBus.$emit('searchmethod');
     } 
     if(this.searchname=='category')
     {
         this.$router.push('/ecommerce/category')
     }else if(this.searchname=='product')
     {
         this.$router.push('/ecommerce/product')
     }
     else if(this.searchname=='allproducts')
     {
         this.$store.dispatch('search',null)
         var path='/ecommerce/home'
         if(this.$route.path!==path)
         {
             this.$router.push('/ecommerce/home');
         }
     }
     }
},
created()
{
 this.getDate();
 window.setInterval(()=>{
     this.getTime();
 },1000)

},
computed:{
  ...mapGetters(['user'])
}

}
</script>

<style>
.fullpanel{
    position: sticky;
    width: 100%;
}
.navbar{
    background: red;
    height: 50px;
}
.ul{
    list-style: none;
    display: flex;
    
}
.ul li{
    color: white;
    padding-left: 10px;
    cursor: pointer;
    margin-top:5px;
    font-size: 18px;
}
.ul li a{
   color: white;
   text-decoration: none;
}
.ul li a:hover{
    color: brown;
    background-color: none;
}
.ul li:hover{
    background: none;
}
.search{
    position: absolute;
    right:300px;
    bottom: 0px;
    top: 10px;
    font-size: 18px;
    color: white;
}
.searchbox{
    display: flex;
    top: 70px;
    position: absolute;
    right: 150px;
    display: none;
}
.categories ul{
    list-style: none;
    display: flex;
}
.categories ul li{
    color: rgb(250, 4, 4);
    padding-left:10px;
    cursor: pointer;
    margin-top:5px;
    
}
.categories ul li:hover{
  background: none;
  color: rgb(161, 42, 72);
}
.redbox{
    background: red;
    color: white;
    width: 130px;
    padding: 10px;
    
}
.listicon{
    display: none;
}
.tringle{   
    position: absolute;
    left: 180px;
    top: 195px;
    width: 0;
    height: 0;
    border: 30px solid transparent;
    border-top: 0px;
    border-bottom: 46px solid red;
    border-left:50px;
    padding-bottom: 10px;
}
.news{
    padding-left: 50px;
}
.news ul{
    display: flex;
    list-style: none;
    position: absolute;
    padding-left: 190px;
    top: 210px;
}
.list li{
    color: red;
    padding-left:10px;
    font-size: 22px;
}
.list li:hover{
    background: none;
    color: rgb(180, 86, 23);
}
 .marquee{
    
    width: 100%;
    transform: translateX(0s);
}
.ul li font:hover{
    color: brown;
}
@media only screen  and (max-width: 600px){
    .navbar{
        background: blue;
        height: 40px;
    }
    .ul{
        display: none;
        padding-left: 50px; 
        position: absolute;
        left: 220px;
        background: black;
        top: 30px;
        z-index: 1;
        width: 160px;
    }
    .ul li{
        margin-right: 60px;
        right: 60px;
        
    }
    .search{
    position: absolute;
    right: 50px;
    bottom: 5px;
    font-size: 18px;
    color: rgb(253, 10, 10);
    top: 5px;
}
.listicon{
    position: absolute;
    color: rgb(243, 13, 13);
   bottom: 0px;
   display: inline;
   font-size: 25px;
   top: 0;
   left: 280px;
   cursor: pointer;
}
.tringle{
    top:243px;
}

}

</style>