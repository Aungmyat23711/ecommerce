<template>
    <div class="container my-2">
      <form @submit.prevent='updatepro' enctype="multipart/form-data">
       <div class="row">       
               <div class="col-md-6">
                <div class="form-group">
                     <label for="product">Product</label>
                     <input type="text" name="product" class="form-control" v-model="allproductlist.product" >
                     <!-- <div class="text-danger" v-if='allproductlist.errors.has("product")' v-html="allproductlist.errors.get('product')"></div> -->
                </div>
                <div class="form-group">
                      <label for="category">Category</label>
                       <select class="form-control" v-model="allproductlist.category">
                            <option v-for='(index,id) in categoryall' :key='id' :value="index.category">{{index.category}}</option>
                       </select>
                       <div class="text-danger" v-if='allproductlist.errors.has("category")' v-html="allproductlist.errors.get('category')"></div>
                </div>
                <div class="form-group">
                      <label for="photo">Photo</label>
                      <input type="file" class="form-control"  v-on:change='showimg($event)'><br>
                      <img :src="'image/image-not-found.png'" id="img" style="max-height:220px;" title="New Image">
                      <div class="text-danger" v-if='allproductlist.errors.has("photo")' v-html="allproductlist.errors.get('photo')"></div>
                      <img :src="`image/${alldata.photo}`" style="max-height:220px;" title="Old Image">
                </div>
               </div>  
               <div class="col-md-6">
                   <div class="form-group">
                    <label for="price">Price</label>
                    <input type="text" class="form-control" v-model="allproductlist.price">
                    <div class="text-danger" v-if='allproductlist.errors.has("price")' v-html="allproductlist.errors.get('price')"></div>
                   </div>
                   <div class="form-group">
                    <label for="qty">Quantity</label>
                    <input type="text" class="form-control" v-model="allproductlist.qty">
                    <div class="text-danger" v-if='allproductlist.errors.has("qty")' v-html="allproductlist.errors.get('qty')"></div>
                   </div>
                  <button type="submit" class="btn btn-info">Update</button>
               </div>
       </div>
       </form>
       
  </div>
</template>

<script>
import Form from 'vform'
export default {
     data()
{
    return {
        categoryall:[],
        allproductlist:new Form({
            id:'',
          category:'',
          product:'',
          photo:'',
          price:'',
          qty:''
        }),
        iscallshow:false
    }
},
methods:
{
async getprocat()
    {
        await axios.get('/getprocat')
        .then((resp)=>{
            console.log(resp)
            this.categoryall=resp.data
        })
    },
    async showimg($event)
    {
      var input=$event.target.files[0];
      var reader=new FileReader();
      this.allproductlist.photo=input
      reader.onload=()=>{
        var result=reader.result
        var img=document.getElementById('img');
        img.src=result;
        console.log(this.allproductlist.photo)
        this.iscallshow=true
      }
      reader.readAsDataURL(input);
    },
    async updatepro($event)
    {
      let formdata=new FormData();
      formdata.append('product',this.allproductlist.product)
      formdata.append('category',this.allproductlist.category)
      formdata.append('photo',this.allproductlist.photo)
      formdata.append('price',this.allproductlist.price)
      formdata.append('qty',this.allproductlist.qty)
      formdata.append('_method','PUT')
      $event.preventDefault();
      await axios.post(`/updatepro/${this.allproductlist.id}`,formdata)
      .then((resp)=>{
        console.log(resp.data)
        Swal.fire({
          title:'Update Successfully'
        })
        this.$router.push({path:'/upload'})

      })
    },
},
watch:{
  alldata:{
    handler()
    {

    },
    immediate: true
  }
},
props:['alldata'],
mounted()
{
  this.allproductlist.id=this.alldata.id;
  this.allproductlist.product=this.alldata.product;
  this.allproductlist.category=this.alldata.category;
  this.allproductlist.photo='';
  this.allproductlist.price=this.alldata.price;
  this.allproductlist.qty=this.alldata.qty;
  this.getprocat();
}
}
</script>

<style>

</style>