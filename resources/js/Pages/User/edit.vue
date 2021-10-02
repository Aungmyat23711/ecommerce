<template>
  <div>
      <h1 class="text-center">Hello Welcome</h1>
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <form @submit.prevent='update'>
          <div class="form-group">
                <label for="Category">Category</label>
                <select v-model="productlist.category" class="form-control">
                    <option v-for='(name,id) in category' :key='id' :value="name.category">{{name.category}}</option>
                </select>
          </div>
          <div class="form-group">
               <label for="product">Product</label>
               <input type="text" name="product" v-model="productlist.product" class="form-control">
          </div>
          <div class="form-group">
               <label for="price">Price</label>
               <input type="text" name="price" v-model="productlist.price" class="form-control">
          </div>
          <button type="submit" class="btn btn-info">Update</button>
          <Link href="/user/index" class="btn btn-danger">Back</Link>
      </form>
              </div>
              
          </div>
      </div>
      
  </div>
</template>

<script>
import {Link} from '@inertiajs/inertia-vue'
export default {
     props:['product','category'],
     data()
     {
         return {
             productlist:{
                 category:this.product.category,
                 product:this.product.product,
                 price:this.product.price
             }
         }
     },
      components:{
      Link
    },
     methods:
     {
         update()
         {
            this.$inertia.put(`/user/update/${this.product.id}`,this.productlist)
         }
     }
}
</script>

<style>

</style>