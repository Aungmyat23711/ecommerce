<template>
  <div class="container my-2" style="">
       <span class="cart">
         <router-link to='/vue/viewcart'>
         <i class="fas fa-shopping-cart"></i><span class="badge badge-info">
           {{this.count}}</span></router-link></span>
   <div class="row">
     <div class="col-md-12">
            <h1 class="list" v-on:click="openpanel"><i class="fas fa-list"></i></h1>
    <div class="sidepanel" id="showpanel">
        <h3 class="hoverli bg-danger" v-on:click="closepanel"><i class="fas fa-times"></i></h3><br>
       <ul style="text-decoration: none;list-style:none;">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown">
              Categories
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown" style="list-style:none;">
              <ul style="list-style:none;">
                <li>
                  <a href="#" style="text-decoration:none;" class="text-dark"><span @click="getproducts">All</span></a>
                </li>
              </ul>
              <ul v-for="cat in allcates" :key='cat.id' style="list-style:none;">
                <li><span @click="getfilter(cat.id)"><a href="#" style="text-decoration:none;" class="text-dark">{{cat.category}}</a></span></li>
              </ul>
             
            </div>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link">Something</a>
        </li>
       </ul>
       <div class="row">
             <div class="col-md-12">
                  <form class="form-inline my-2 ml-2" @submit.prevent='getproducts' style="padding-left:26px;">
                <div class="input-group mb-3">
               <input type="text" v-model="search" class="form-control" placeholder="search item">
             </div>
        </form>
             </div>
       </div>
    </div>
     </div>
   </div>
   <div class="row" v-if="this.allproducts.data==0">
             <div class="col-md-6 offset-md-3">
                   <div class="card">
                       <h3>Search Result is not found!Please <a href="#"><span @click='getproducts'>go back</span></a></h3>
                   </div>
             </div>
   </div>
       <div class="row" v-else>
          <div class="col-md-3" v-for='(item) in allproducts.data' :key='item.id' style="margin-bottom:50px;">
                <div class="card">
             <div class="card-header">
                   <img :src="`/image/${item.photo}`" style="max-height:120px;">  
             </div>
             <div class="card-body">
                    <span class="badge badge-info">{{item.category}}</span>
                    <h6>{{item.product}}</h6>
                    <h6>{{item.price}} KS</h6>
                    <span>{{item.qty}} Units</span><br>
                   
             </div>
             <div class="card-footer" align='center'>     
                     <button class="btn btn-success" @click='showinfo(item)'>View info</button>
             </div>
           </div>
          </div>  
           
       </div>
       <pagination :data='allproducts' @pagination-change-page='getproducts' 
       class="text-bottom justify-content-md-center" style="padding-bottom:0px;"></pagination>
  </div>
</template>

<script>
export default {
 data()
{
  return{
     allproducts:{},
     product_id:'',
     allcates:[],
     search:'',
     error:[],
     qty:'',
     count:''
  }
},
methods:
{
  async getproducts(page)
   {
     await axios.get(`/vue/getproduct?page=${page} & search=${this.search}`)
     .then((resp)=>{
        this.allproducts=resp.data;
        this.search='';
     })
   },
   async getcates()
   {
     await axios.get('/vue/getcates')
     .then((resp)=>{
        this.allcates=resp.data;
     })
   },
   async getfilter(id)
   {
     await axios.get('/vue/ft/'+id)
     .then((resp)=>{
        console.log(resp.data)
        this.allproducts=resp.data;
     })
   },
  
    async showinfo(item)
  {
      await axios.get('/vue/showinfo/'+item.id)
      .then((resp)=>{
        this.$router.push({path:'/vue/showinfo/'+item.id})
      })
  },
 openpanel()
  {
    document.getElementById('showpanel').style.width='250px';
  },
  closepanel()
  {
    document.getElementById('showpanel').style.width=0;

  },
   async getcount()
  {
    await axios.get('/vue/count')
    .then((resp)=>{
      console.log(resp.data)
      this.count=resp.data
    })
  }
},
mounted()
{
  this.getproducts();
  this.getcates();
  this.getcount(); 
}
}
</script>

<style>
  .sidepanel{
        width: 0%;
  position: fixed;
  z-index: 1;
  height: 250px;
  top: 0;
  left: 0;
  background-color: rgb(43, 41, 41);
  overflow-x: hidden;
  transition: 0.5s;
  padding-top: 10px;
  margin-top: 55px;
    }
     .hoverli{
      margin-left: 150px;
      top: 0;
      position: absolute;
    }
    .list
    {
      left:50px;
      position: fixed;
    }
    li:hover{
      color:black ;
    }
    .cart{
      position:fixed;
      right:100px;
    }
</style>