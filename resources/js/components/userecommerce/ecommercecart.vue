<template>
  <div>
    <div v-if="cartitems==0" style="padding-top:250px;" class="container paddtwo">
        <div class="row">
            <div class="col-sm-6 offset-sm-3" align='center'>
                 <h2>There is no item in the cart!</h2>
                 <router-link to="/ecommerce/user/home"><button class="btn btn-primary">Go Shop</button></router-link>
            </div>
        </div>
    </div>
      <div v-else class="container paddtwo" style="padding-top:150px;">
        <div class="row">
              <div class="col-md-12">
                <div class="view">
                  <div class="view1">
                     <div class="view1-1">
                       <h4></h4>
                     </div>
                     <div class="view1-2">
                         <p class="text">Items</p>
                     </div>
                  </div>
                  <div class="view2">
                   <div class="view1-1">
                       <h4></h4>
                     </div>
                     <div class="view1-2">
                         <p class="text" style="margin-bottom:40px;">Qty</p>
                     </div>
                  </div>
                  <div class="view3">
                  <p  class="text">Price</p>
                  </div>
                  <div class="view4">
                  <p  class="text">Remove</p>
                  </div>
                </div>
            </div>
          </div>
        <hr>
          <div class="row" v-for="cart in cartitems" :key='cart.id' style="padding:20px;">
            <div class="col-md-12">
                <div class="view">
                  <div class="view1">
                     <div class="view1-1">
                        <img :src="`/images/${cart.photo}`" alt="" class="imgc">
                     </div>
                     <div class="view1-2 text2">
                         <p>{{cart.product}}</p>
                         <p>{{cart.category}}</p>
                         <p>{{cart.price}} MMK</p>
                     </div>
                  </div>
                  <div class="view2">
                    <p class="text">{{cart.cartqty}}</p>
                  </div>
                  <div class="view3">
                    <p class="text">({{cart.price}}x{{cart.cartqty}}) {{cart.price*cart.cartqty}} MMK</p>
                  </div>
                  <div class="view4">
                    <div>
                 <button class="btn btn-danger" @click="removecart(cart.cartid)">Remove</button>
               </div>
                  </div>
                </div>
            </div>
          </div><hr>
          <div class="row">
               <div class="col-md-12" align='end'>
                  <router-link to="/ecommerce/user/home"><button class="btn btn-outline-danger">Back</button></router-link>
                 <router-link to="/ecommerce/user/submitorder"><button class="btn btn-outline-primary">Submit Order</button></router-link>
               </div>
          </div>
      </div>
  </div>
</template>

<script>
import {mapGetters} from 'vuex'
import axios from 'axios'
import {eventBus} from './../../app'
export default {
computed:{
  ...mapGetters(['euser'])
},
data()
{
  return {
    cartitems:[]
  }
},
methods:{
  async getcartitem()
  {
    await axios.get(`/ecommerce/user/cartitem/${this.euser.id}`)
    .then((resp)=>{
       this.cartitems=resp.data;
       console.warn(this.cartitems.photo)
    })
  },
  async removecart(id)
  {

   if(confirm('Are you sure'))
   {
      var formdata=new FormData();
      formdata.append('_method','DELETE');
     await axios.post(`/ecommerce/user/deletecart/${id}`,formdata)
     .then((resp)=>{
       eventBus.$emit('countcart');
       this.getcartitem();
       
     })
   }
   else{
     alert('Cancle');
   }
  }
},
created()
{
 this.getcartitem();
}
}
</script>

<style lang="scss" scoped>
.fix{
  position: fixed;
  bottom: 20px;
  padding-left:1000px ;
}
.imgc{
  max-height: 70px;
  border: 1px solid silver;
}
.view{
  flex: 1;
  background:white;
  flex-direction: row;
  display: flex;
  align-items: center;
  justify-content: space-around;
}
.view1{
  flex-direction: row;
  display: flex;
  align-items: center;
  justify-content: space-around; 
}
.view1-1{
  padding: 10px;
}

.text{
  font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
  font-size: 20px;
  text-align: left;
  margin: 10px;
  margin-right:10px ;

}
@media only screen and (max-width:600px){

 .responsive2{
   flex: 1;
   flex-direction: row;
 }
 .text{
  font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
  font-size: 10px;
  text-align: left;
  margin: 10px;
  margin-right:10px ;
}
.text2{
  font-size: 10px;
}
.paddtwo{
  padding-bottom:220px;
}
}
</style>