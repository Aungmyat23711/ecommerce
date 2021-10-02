<template>
  <div class="container ">
    <span class="cart"> <router-link to='/vue/viewcart'>
    <i class="fas fa-shopping-cart"></i>
    <span class="badge badge-info">{{this.count}}</span></router-link></span>
       <div v-for='item in eachitem' :key='item.id'>
           <div class="row" >
                <div class="col-md-6 " style="box-shadow: cornflowerblue;">
                <img :src="`/image/${item.photo}`" class="img-thumbnail" style="background: linear-gradient(#e66465, #9198e5);">
                </div>
                <div class="col-md-6 bg-light justify-content-center" style="padding-top:10px;border-radius:10px;">
                  <h1 align='center' class="bg-white" style="border-radius:10px;">{{item.product}}</h1><br>
                   <div class="bg-white" style="height:270px;">
                      <h3>price:{{item.price}} KS</h3>
                      <h3>Avaliable qty:{{item.qty}} Units</h3>
                      <span class='badge badge-danger' v-if="item.qty==0">Out of Stock</span>
                      <span class='badge badge-success' v-else>Instock</span>
                      <form @submit.prevent='submitid(item)' >
                        <input type="hidden" name="product_id" v-model="product_id">
                        <label for="qty">QTY</label>
                        <input type="number" value="1" min="1" :max="item.qty" v-model="qty"><br>
                        <button type="submit" class="btn btn-success" :class="item.qty==0 ? 'disabled':''">Submitorder</button>
                      </form>
                   </div>
                </div>
                <div class="row" style="position:absolute;width:88%;bottom:160px;padding-right:133px;">
                  More Items
                    <div class="col-md-12" >
                         <div id="carouselExampleControls" class="carousel slide" data-ride="carousel" >
  <div class="carousel-inner">
    <div class="carousel-item active">
      <router-link :to='`/vue/showinfo/${each.id}`' v-for="(each) in mice" :key='each.id' @click.native='godirect(each.id)'>
        <img class="img-thumbnail" :src="`/image/${each.photo}`" style="max-height:220px;">
      </router-link>
    </div>
    <div class="carousel-item">
      <router-link :to='`/vue/showinfo/${key.id}`' v-for="(key) in keyboard" :key='key.id' @click.native='godirect(key.id)'>
        <img class="img-thumbnail" :src="`/image/${key.photo}`" style="max-height:220px;max-width:300px;">
      </router-link>
    </div>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev" style="left:0;position:absolute;background:black;width:12px;">
    <span class="carousel-control-prev-icon" aria-hidden="false"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next" style="right:0;position:absolute;background:black;width:12px;">
    <span class="carousel-control-next-icon" aria-hidden="false" ></span>
    <span class="sr-only">Next</span>
  </a>
</div>                  
                    </div>
                </div>
           </div>
           
       </div>
  </div>
</template>

<script>
export default {
data()
{
  return {
    eachitem:[],
    qty:'1',
    product_id:'',
    mice:[],
    count:'',
    username:'',
    keyboard:[]
  }
},
methods:
{
    async viewinfo()
    { 
       await axios.get(`/vue/viewinfo/${this.$route.params.id}`)
       .then((resp)=>{
           console.log(resp.data);
           this.eachitem=resp.data;

       }) 
    },
    async getmice()
    {
      await axios.get('/vue/mice/')
      .then((resp)=>{
        this.mice=resp.data
    })
    },
    async getkeyboard()
    {
      await axios.get('/vue/keyboard/')
      .then((resp)=>{
        this.keyboard=resp.data
    })
    },
    async godirect(id)
    {
         this.$router.push({path:'/vue/showinfo/'+id});
         this.$router.go({path:'/vue/showinfo/'+id});
    },
    async submitid(item)
  {
     if(this.username=='')
     {
       Swal.fire({
        title:'Please Sign in to continue'
       })
       this.$router.push({path:'/vue/showlogin'})
     }else
     {
        this.product_id=item.id
      await axios.post('/vue/postid',{
        'product_id':this.product_id,
        'qty':this.qty
      })
      .then((resp)=>{
        this.$router.push({path:'/vue/viewcart'})
        this.getcount()
      })
      .catch((error)=>{
        console.log(error)
        this.error=error
        if(this.error)
        {
          Swal.fire({
          'title':'Already Selected'
        })
        }
      })
     }
  },
   async getcount()
  {
    await axios.get('/vue/count')
    .then((resp)=>{
      console.log(resp.data)
      this.count=resp.data
    })
  },
  async getuserid()
  {
     await axios.get('/vue/getuser')
     .then((resp)=>{
       console.log(resp.data);
       this.username=resp.data;   
     })
  }
},
mounted()
{
    this.viewinfo();
    this.getmice();
    this.getcount();
    this.getuserid();
    this.getkeyboard();
}
}
</script>

<style>
img{
  border-radius: 10px;
  color: aqua;
}
h1{
  color: chartreuse;
}
h2{
  color: rgb(46, 109, 109);
}
.cart{
  position: fixed;
  right: 100px;
}

</style>