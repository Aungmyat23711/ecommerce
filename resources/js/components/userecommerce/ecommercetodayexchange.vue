<template>
  <div class="responsive2">
 <div v-if="myorders==0" style="padding-top:250px;" class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                 <div class="exc">
                        <h2 align='center'>There is no any order now</h2>
                 <router-link to="/ecommerce/user/home"><button style="margin-left:230px;" class="btn btn-primary">Go Shop</button></router-link>
                 </div>
            </div>
        </div>
    </div>
      <div v-else class="container" style="padding-top:150px;">
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
                         <p class="text" style="margin-bottom:40px;padding-left:100px;">Qty</p>
                     </div>
                  </div>
                  <div class="view3">
                  <p  class="text" style="padding-right:70px;">User Status</p>
                  </div>
                  <div class="view4">
                  <p  class="text">Date/Time</p>
                  </div>
                </div>
            </div>
          </div>
        <hr>
        <div class="row" v-for="order in myorders" :key='order.id' style="padding:20px;">
            <div class="col-md-12">
                <div class="view">
                  <div class="view1">
                     <div class="view1-1">
                        <img :src="`/images/${order.photo}`" alt="" class="imgc">
                     </div>
                     <div class="view1-2 text2" >
                         <p>{{order.product}}</p>
                         <p>{{order.cart_qty}}</p>
                         <p>{{order.datetime}}</p>
                     </div>
                  </div>
                  <div class="view2">
                    <p class="text" style="margin-right:50px;">{{order.cart_qty}}</p>
                  </div>
                  <div class="view3">
                    <p class="text text-warning">{{order.user_status}}</p>
                  </div>
                  <div class="view4">
                    <div>
                <p class="text">{{order.datetime}}</p>
               </div>
                  </div>
                </div>
            </div>
          </div><hr>
          </div>
      </div>
</template>

<script> 
import axios from 'axios'
import {mapGetters} from 'vuex'
export default {
data()
{
  return {
    myorders:[]
  }
},
methods:{
   async getmyorder()
   {
     await axios.get('/ecommerce/user/getmyorder/'+this.euser.id)
     .then((resp)=>{
       this.myorders=resp.data;
      console.warn('resp',resp)
     })
   }
},
created()
{
  this.getmyorder();
},
computed:{
  ...mapGetters(['euser'])
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
   padding-top:20px;
   padding-bottom:150px;
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
}
</style>