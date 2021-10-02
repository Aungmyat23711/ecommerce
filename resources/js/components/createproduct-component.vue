<template>
  <div class="container my-2">
      <form @submit.prevent='postpro' enctype="multipart/form-data" @keydown="allproductlist.onKeydown($event)">
       <div class="row">       
               <div class="col-md-6">
                <div class="form-group">
                     <label for="product">Product</label>
                     <input type="text" name="product" class="form-control" v-model="allproductlist.product" >
                     <div class="text-danger" v-if='allproductlist.errors.has("product")' v-html="allproductlist.errors.get('product')"></div>
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
                      <img :src="'image/image-not-found.png'" alt="img" id="img" style="max-height:220px;">
                      <div class="text-danger" v-if='allproductlist.errors.has("photo")' v-html="allproductlist.errors.get('photo')"></div>
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
                    <div class="text-danger" v-if='allproductlist.errors.has("qty")' 
                    v-html="allproductlist.errors.get('qty')"></div>
                   </div>
                  <button type="submit" class="btn btn-info">Save</button>
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
        })
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
 showimg($event)
 {
     var input=$event.target.files[0];
     var reader=new FileReader();
     this.allproductlist.photo=input;
     reader.onload=()=>{
         var result=reader.result
         var img=document.getElementById('img')
         img.src=result;
 
         
     }
     reader.readAsDataURL(input)    

 },
 async postpro($event)
 {
     
     let formdata=new FormData();
    formdata.append('photo',this.allproductlist.photo)
     $event.preventDefault();
     await this.allproductlist.post('/postpro')
     .then((resp)=>{
         this.allproductlist.clear();
         this.allproductlist.reset();
         this.$router.push({path:'/upload'});
         Swal.fire({
             title:'Create Successfully'
         })
         
     })
 },
 
},
mounted()
{
    this.getprocat(); 
  
}

 
}
</script>

<style>

</style>