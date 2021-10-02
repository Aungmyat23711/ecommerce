<template>
  <div class="container-fluid">
       <div class="row">
           <div class="col-md-6" id="printarea">
               <table class="table"  border='1px solid black;' margin='0'>
                   <tr>
                       <!-- <td class="hide">photo</td> -->
                       <td>product</td>
                       <td>category</td>
                       <td>Select Units</td>
                       <td>Unit Price</td>
                       
                   </tr>
                   <tr v-for="item in selectitem" :key='item.id'>
                    <!-- <td class='hide'><img :src="`/image/${item.photo}`" class="img-thumnail img-fluid" style="max-height:120px;"></td> -->
                    <td>{{item.product}}</td>
                    <td>{{item.category}}</td>
                    <td>{{item.cartqty}}</td>
                    <td>{{item.price}} KS</td>
 
                   </tr>
                   <tr v-for="(total,id) in totalprice" :key='id'>
                       <th>Total Amount</th>
                       <td colspan="4" align='end'>{{total.total}} KS</td>
                   </tr>
               </table>
           </div>

           <div class="col-md-6">
               
             <form @submit.prevent='postaddress()' style="margin-left:100px;position:fixed;width:30%;">
                 <div class="form-group">
                       <label for="name">Customer Name:</label>
                       <input type="name" name="customer"  v-model="form.customer_name" class="form-control">
                       <div class="text-danger" v-if="this.form.errors.has('customer_name')" v-html="this.form.errors.get('customer_name')"></div>
                 </div>
                 <div class="form-group">
                       <label for="payment_method">Payment_Method:</label>
                       <select name="payment_method" v-model="form.payment_method" class="form-control">
                           <option value="Online Payment">Online Payment</option>
                           <option value="Pay On Delivery">Pay On Delivery</option>
                       </select>
                       <div class="text-danger" v-if="this.form.errors.has('payment_method')" v-html="this.form.errors.get('payment_method')"></div>
                 </div>
                 <div class="form-group">
                       <label for="phone">Phone:</label>
                       <input type="name" name="phone"  v-model="form.phone" class="form-control">
                       <div class="text-danger" v-if="this.form.errors.has('phone')" v-html="this.form.errors.get('phone')"></div>
                 </div>
                 <div class="form-group">
                       <label for="address">Address:</label>
                       <textarea name="address" class="form-control" v-model="form.address"></textarea>
                       <div class="text-danger" v-if="this.form.errors.has('address')" v-html="this.form.errors.get('address')"></div>
                 </div>
                 <div class="form-group">
                       
                       <button class="btn btn-info" type="submit" @click="window()">Order Now</button>
 
                 </div>
             </form>
             
             
           </div>
       </div>
       <div class="row">
            <button class="btn btn-danger" style="margin-left:50px;"><router-link to="/vue/viewcart">Go Back</router-link></button>
       </div>
  </div>
</template>

<script>
import axios from 'axios'
import Form from 'vform'
export default {
data()
{
    return {
      selectitem:[],
      totalprice:'',
      form:new Form({
          customer_name:'',
          payment_method:'',
          phone:'',
          address:'',
          
      }),
      condition:false,
    }
},
methods:
{
    async getamount()
    { 
      await axios.get('/vue/totalprice')
      .then((resp)=>{
          this.totalprice=resp.data
      })
    },
    async getitem()
    {
        await axios.get('/vue/getitem')
        .then((resp)=>{
           this.selectitem=resp.data
        })
    },
    async postaddress()
    {
        await this.form.post('/vue/postaddress')
        .then((resp)=>{
            this.condition=true
            Swal.fire({
                title:'Now your order is submit'
            })
            this.$router.push({path:'/vue/showproduct'});
        })
    },
    window()
    {
        var printarea=document.getElementById('printarea').outerHTML
        var mywindow=window.open('','Window1','resizeable,height:400,width:600')
        mywindow.document.write('<htm><head><title>Window Open</title></head><body>')
        mywindow.document.write(printarea)
        mywindow.document.write('</body></html>')
        mywindow.print(printarea)
        mywindow.close()
    }
    
},
mounted()
    {
        this.getamount()
        this.getitem()
    }
}
</script>

<style>
@media print
{
       td{
          display: none;
          visibility: hidden;
      }
  } 
</style>