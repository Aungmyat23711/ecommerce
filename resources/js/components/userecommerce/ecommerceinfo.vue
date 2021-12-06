<template>
  <div>
      <div class="container" style="padding-top:150px;">
        <div class="row red">
            <div class="col-md-5 just">
              <div>
                <img id="imgPhoto" :src='"/images/"+eachproduct.photo' 
                class="img-thumbnail" style="padding:10px;height:300px;max-width:350px;"><br>
              </div>
               
               <div id="photoshow">
                    <img  @click="swapMain(eachproduct.photo,eachproduct.product)" :src='"/images/"+eachproduct.photo' alt="" style="max-height:120px;padding:10px;">
                    <img v-for="pho in photos" 
                    :key='pho.id' 
                    :src="`/images/${pho.photo}`" 
                    @click="swapPhoto(pho.photo,pho.id)"
                    style="max-height:120px;padding:10px;cursor:pointer;">
               </div>
              <br>
              
            </div>
            <div class="col-md-1">

            </div>
            <div class="col-md-5">
               <div class="row responsive1">
                   <div class="col-sm-12">
                     <div class="tablepadd">
                       <table>
                       <tbody>
                         <tr align='center'>
                           <td colspan="3"><h4>Product Details</h4></td>
                         </tr>
                         <tr  align='center'>
                        <th>
                         <tr><p>Product-Name</p></tr>
                         <tr><p>Category-Name</p></tr>
                         <tr><p>Price</p></tr>
                         <tr><p>Qty</p></tr>
                        </th>
                          <th style="width:110px;">
                            <tr><p>:</p></tr>
                            <tr><p>:</p></tr>
                            <tr><p>:</p></tr>
                            <tr><p>:</p></tr>
                          </th>
                        <th>
                           <tr><p>{{eachproduct.product}}</p></tr>
                           <tr><p>{{eachproduct.category}}</p></tr>
                           <tr><p>{{eachproduct.price}} MMK</p></tr>
                           <tr><p>{{eachproduct.qty}}</p></tr>
                        </th>
                         </tr>
                       </tbody>
                     </table>
                     </div>
                     
                   </div>                 
               </div>
               <div class="row">
                       <div class="col-md-12">
                         <p>Quantity</p>
                            <form @submit.prevent="postdetails">
                              <input type="hidden" name="product_id" v-model="product_id">
                              <div class="form-group">
                                 <input type="number" value="1" min="1" :max="eachproduct.qty" v-model="itemqty">
                              </div>
                              <div class="form-group">
                                <button v-if="eachproduct.qty==0" class="form-control btn btn-outline-primary" disabled>Submit</button>
                               <button v-if="eachproduct.qty!=0" class="form-control btn btn-outline-primary">Submit</button>
                              </div> 
                               <div class="form-group">
                               <router-link to="/ecommerce/user/home"><button class="form-control btn btn-outline-danger">Cancle</button></router-link>
                              </div> 
                            </form>
                       </div>
                   </div>
            </div>
        </div>
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
        proid:'',
        eachproduct:[],
        product_id:'',
        itemqty:'1',
        user_id:'',
        photos:[],
    }
},
methods:{
async getinfo()
{
    await axios.get(`/ecommerce/user/getinfo/${this.proid}`)
    .then((resp)=>{
      this.eachproduct=resp.data;
      this.product_id=JSON.stringify(resp.data.id)
      this.user_id=this.euser.id;
      
    })
},
async postdetails()
{
  await axios.post('/ecommerce/user/postdetails',{
    product_id:this.product_id,
    qty:this.itemqty,
    user_id:JSON.stringify(this.user_id)
  })
  .then((resp)=>{
    eventBus.$emit('countcart');
    this.$router.push('/ecommerce/user/home');
  })
},
async getphoto()
{
   await axios.get(`/ecommerce/user/getphoto/${this.$route.params.id}`)
   .then((resp)=>{
    this.photos=resp.data;
   })
},
swapPhoto(photoSrc,photoid)
{
   var display=document.getElementById('photoshow');
   display.firstChild.nodeValue=photoid;
   document.images.imgPhoto.src="/images/"+photoSrc;
},
swapMain(src,product)
{
  var displaymain=document.getElementById('photoshow');
  displaymain.firstChild.nodeValue=product;
  document.images.imgPhoto.src="/images/"+src;
}
},
created()
{
    this.proid=this.$route.params.id
    this.getinfo();
    this.getphoto();
},
computed:{
  ...mapGetters(['euser'])
}
}
</script>

<style lang="scss" scoped>
@media only screen and (max-width:600px) {
  .responsive1{
     flex: 1;
     flex-direction: column;
     justify-content: center;
     align-items: stretch;
    }
    .red{
      padding-bottom:200px;
      padding-top:140px;
       background-image: linear-gradient(rgb(16, 140, 212), rgb(46, 209, 250));
    }
    .just{
      padding-left:90px ;
    }
    .img-thumbnail {
    padding: 0.25rem;
    background-color: white;
    max-width: 100%;
    height: auto;
}
.tablepadd{
  padding-right:100px;
}

}
</style>