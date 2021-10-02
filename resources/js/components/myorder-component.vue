<template>
  <div class="container">
       <div class="row" v-if='this.order'>
        <div class="col-md-6 offset-3 text-center">
            <h1>There is no order today</h1>
            <button class="btn btn-info" align='center'><router-link to="/vue/showproduct">Go Shop</router-link></button>
        </div>
      </div>
      <div class="row" v-for='(item) in allmyorders' :key='item.id' style="margin:50px;" v-else>
            <div class="col-md-4">
                 <img :src="`/image/${item.photo}`" style="max-height:150px;">
            </div>
            <div class="col-md-4">
                  <span class="badge badge-primary">{{item.category}}</span>
                  <h6>Product: {{item.product}}</h6>
                  <h6>Price: {{item.price}} KS</h6>
                  <h6>Payment_Method: {{item.payment_method}}</h6>
                  <h6>Payment_Status: 
                      <span class="badge badge-warning" v-if="item.payment_status=='pending'">{{item.payment_status}}</span>
                      <span class="badge badge-success" v-else>{{item.payment_status}}</span>
                  </h6>
                  <h6>User_Status: 
                      <span class="badge badge-warning" v-if="item.user_status=='pending'">{{item.user_status}}</span>
                      <span class="badge badge-success" v-else>{{item.user_status}}</span>
                      
                      </h6>
                  <span v-if="item.cartqty==1">Quantity: {{item.cartqty}} Unit</span>
                  <span v-else>Quantity: {{item.cartqty}} Units</span><br>
                  <span>Date: {{item.datetime}}</span>
                 </div>
            <div class="col-md-4">
                <router-link :to='`/vue/showinfo/${item.product_id}`' class="btn btn-info" style="margin-top:50px;">View info</router-link>
            </div>
      </div>
  </div>
</template>
<script>
export default {
data()
{
    return {
        allmyorders:[],
        order:true
    }
},
methods:
{
   async getmyorders()
   {
       await axios.get('/vue/getmyorders')
       .then((resp)=>{
           this.allmyorders=resp.data;
           if(this.allmyorders==0)
           {
             this.order=true;
           }else
           {
               this.order=false;
           }
       })
   }
},
mounted()
{
  this.getmyorders();
//   if(this.allmyorders)
//   { 
//      this.getmyorders()
//   }
}
}
</script>

<style>

</style>