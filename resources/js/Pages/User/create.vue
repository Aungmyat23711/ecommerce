<template>
  <div>
      <h1 class="text-center">Hello Welcome</h1>
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <form @submit.prevent='create'>
          <div class="form-group">
                <label for="Category">Category</label>
                <select v-model="form.category" class="form-control">
                    <option v-for='(name,id) in category' :key='id' :value="name.category">{{name.category}}</option>
                </select>
          </div>
          <div class="form-group">
               <label for="product">Product</label>
               <input type="text" name="product" v-model="form.product" class="form-control">
               <div class="text-danger">{{$page.props.errors.product}}</div>
          </div>
          <div class="form-group">
               <label for="price">Price</label>
               <input type="text" name="price" v-model="form.price" class="form-control" :class="{'is-invalid': $page.props.errors.price}">
               <div class="text-danger">{{$page.props.errors.price}}</div>
          </div>
          <button type="submit" class="btn btn-info">Save</button>
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
    data(){
        return {
           form:{
               category:'',
               product:'',
               price:''
           }
      }
    },
    components:{
      Link
    },
props:['category','errors'],
methods:{
   create()
    {
       this.$inertia.post('/user/create',this.form)
       
    }
}

}
</script>

<style>

</style>