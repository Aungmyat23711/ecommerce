<template>
<div class="subpadd">
  <div class="bg-primary">
      <div class="container" style="padding-top:120px;color:white;">
          <div class="row">
              <div class="col-md-6 offset-md-3 bg-white">
                  <h2 align='center' class="text-primary">Customer Address</h2>
              </div>
          </div>
        <div class="row bg-primary">
            <div class="col-md-4">
              <div class="form-group">
                  <label for="email">Email</label>
                  <input type="email" class="form-control" v-model="email" v-on:keydown='emailerror=""'>
                  <span class="text-danger">{{emailerror}}</span>
              </div>
            </div>
            <div class="col-md-4">
               <div class="form-group">
                  <label for="payment">Payment_Method</label>
                  <select name="payment" class="form-control" v-model="payment_method" v-on:change='paymenterror=""' >
                      <option value="onlinepay">Online Payment</option>
                      <option value="cash" >Payon Delivery</option>
                  </select>
                  <span class="text-danger">{{paymenterror}}</span>
              </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                  <label for="phone">Phone</label>
                  <input type="text" class="form-control" v-model="phone"  v-on:keydown='phonerror=""'>
                  <span class="text-danger">{{phonerror}}</span>
              </div>
            </div>
        </div>
        <div class="row bg-primary">
           <div class="col-md-6 offset-md-3">
               <div class="form-group">
                  <label for="address">Address</label>
                  <textarea name="address" class="form-control" v-model="address"  v-on:keydown='addresserror=""'></textarea>
                  <span class="text-danger">{{addresserror}}</span>
              </div>
           </div>
        </div>
      </div>
  </div>
  <div class="container fle view" style="padding-top:50px;padding-bottom:100px;">
          <div class="view1">
             <table cellpadding='20px;'>
                     <tr class="font">
                         <th>Item_Name</th>
                         <th>Rate</th>
                         <th>Qty</th>
                         <th style="text-align:right;">Line Total</th>
                     </tr>
                     <tr class="font" v-for="item in allcartitem" :key='item.id'>
                         <td>{{item.product}}</td>
                         <td>{{item.price}} </td>
                         <td>{{item.eqty}}</td>
                         <td style="text-align:right;">{{item.eqty*item.price}} MMK</td>
                     </tr>
                 </table>
            
          </div><hr>
          <div class="view2" align='center'>
              <h4 class="text-primary font">Total Amount</h4>
                         <h2 class="font">{{total.total}} MMK</h2><br><br>

                         <h4 class="text-primary font">Date</h4>
                         <h4 class='font'>{{date}}</h4>
          </div>
      </div>
       <div class="view3" align='end' style="padding-right:100px;">
              <router-link to="/ecommerce/user/cart"><button class="btn btn-outline-danger">Back</button></router-link>
                 <button class="btn btn-outline-primary" @click='ordernow()'>Order Now</button>
          </div>
  </div>
</template>

<script>
import {mapGetters} from 'vuex'
import axios from 'axios'
export default {
data()
{
    return {
     allcartitem:[],
     total:[],
     email:'',
     emailerror:'',
     addresserror:'',
     paymenterror:'',
     phonerror:'',
     phone:'',
     address:'',
     payment_method:'',
     phone:'',
     cart_qty:'',
     date:'',
    }
},
methods:{
async getcartitem()
{
  await axios.get('/ecommerce/user/getcartitem/'+this.euser.id)
  .then((resp)=>{
      this.allcartitem=resp.data[1];
      this.total=resp.data[0][0];
  })
},
async ordernow()
{
    var today=new Date();
    var todaydate=today.getHours()+':'+today.getMinutes()+':'+today.getSeconds()+' '+
    today.getDate()+'/'+(today.getMonth()+1)+'/'+today.getFullYear();
    await axios.post('/ecommerce/user/ordernow',{
        email:this.email,
        address:this.address,
        payment_method:this.payment_method,
        user_name:this.euser.name,
        user_id:this.euser.id,
        datetime:todaydate,
        phone:this.phone
    })
    .then((resp)=>{
        this.$router.push('/ecommerce/user/home');
    })
    .catch((error)=>{
        this.emailerror=error.response.data.errors.email;
        this.addresserror=error.response.data.errors.address;
        this.emailerror=error.response.data.errors.email;
        this.paymenterror=error.response.data.errors.payment_method;
        this.phonerror=error.response.data.errors.phone;
    })
},
getdate()
{
    var today=new Date();
    this.date=today.getDate()+'/'+(today.getMonth()+1)+'/'+today.getFullYear();
}
},
computed:{
    ...mapGetters(['euser'])
},
created()
{
    this.getcartitem();
    window.setInterval(()=>{this.getdate(),1000});
}
}
</script>

<style lang="scss" scoped>
.align{
    position: absolute;
    right: 0;
    width: 100%;
}
.font{
    font-family:monospace;    
}
.view{
    flex:1;
    justify-content: center;
    align-items: stretch;
    flex-direction: row;
}
.view1{
    flex:3;
    background:white;
    justify-content: center;
    align-items: center;
}
.view2{
    flex:1;
    background: white;
}
@media only screen and (max-width:600px) {
    .subpadd{
        padding-bottom: 220px;
        padding-top:120px;
    }
    .view{
    flex:1;
    justify-content: center;
    align-items: stretch;
    flex-direction: column;
}
}
</style>