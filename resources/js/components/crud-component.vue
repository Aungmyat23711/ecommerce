<template>
  <div class="container-fluid">
      <div class="row justify-content-end" style="margin-top:50px;margin-bottom:10px;" >
          <div class="col-6">
            <button class="btn btn-info" @click='create'><span><i class="fas fa-plus"></i>Create</span></button>
          </div>
          <div class="col-2">
   <form class="form-inline" @submit.prevent='getapi'>
    <div class="input-group">
      <div class="input-group-prepend">
        <button class="btn btn-info" type="submit"><i class="fas fa-search"></i></button>
      </div>
      <input type="text" class="form-control" placeholder="Search" aria-label="Username" aria-describedby="basic-addon1" v-model='search'>
    </div>
  </form>
          </div>
      </div>

      <div class="row" >
          <div class="col-3">
              <div class="card" >
                  
                  <div class="card-header">
                      <h3>{{isclickedit ? 'Edit': 'Product-list'}}</h3>
                      <AlertError :form="newproducts" :message="message" class="text-danger"/>
                  </div>
                  <form action="#" @submit.prevent='isclickedit ? update():addapi()' @keydown="newproducts.onKeydown($event)">
                  <div class="card-body">
                      <div class="form-group">
                             <label for="category">Category</label>
                             <select class='form-control' v-model="newproducts.categorypro">
                                 <option v-for="(category , id) in categorylist" v-bind:key="id" :value='category.category'>{{category.category}}</option>
                            </select>
                      </div>
                  
                      <div class="form-group">
                          <label for="product"><h4>Product</h4></label>
                          <input type="text" class="form-control" name="product" v-model="newproducts.product">
                          <div class="text-danger" v-if="newproducts.errors.has('product')" v-html="newproducts.errors.get('product')"></div>
                      </div>
                      <div class="form-group">
                          <label for="price"><h4>Price</h4></label>
                          <input type="text" class="form-control" name="price" v-model="newproducts.price">
                          <div class="text-danger" v-if="newproducts.errors.has('price')" v-html="newproducts.errors.get('price')"></div>
                      </div>
                  
                  </div>
                  
                  <div class="card-footer">
                     <button class="btn btn-info" type="submit"><span><i class="fas fa-save"></i>{{isclickedit ? 'Update':'Save'}}</span></button>
                  </div>
                  </form>
              </div>
          </div>
          <div class="col-9" style="padding-right:90px;">
           <table class="table table-striped">
               <tr style="background:skyblue;">
                <th>ID</th>
                <th>Category</th>
               <th>Products</th>
               
               <th>Price</th>
               <th>Action</th>
               </tr>
               <tr v-for="item in products.data" v-bind:key="item.product">
                <th>{{item.id}}</th>
                <th>{{item.category}}</th>
               <th>{{item.product}}</th>
               <th>{{item.price}}</th>
               <th>
                   <button class="btn btn-success btn-sm" @click='edit(item)'>Edit</button>
                   <button class="btn btn-danger btn-sm" v-on:click='deleteapi(item.id)'>Delete</button>
               </th>
               </tr>
           </table>
           <pagination :data='products' @pagination-change-page='getapi' style="padding-left:100px;"></pagination>
          </div>
      </div>
  </div>
</template>

<script>
import axios from 'axios'
import Form from 'vform'


export default {
 name:'crud-component',
 data()
 {
     return { 
         message:'',
         isclickedit:false,
         products:{},
         search:'',
         newproducts:new Form({
             id:'',
             categorypro:'',
             product:'',
             price:'',         
         }),
         categorylist:{},
         errors:[],
        
     }
 },
 methods:
  {
    async getapi(page=1)
     {
        
        const result=await this.newproducts.get(`getfrombase?page=${page}&search=${this.search}`)
        this.products=result.data
     },
     async getcatfrompro()
     {
       const result=await axios.get('getcatfrompro')
       this.categorylist=result.data;
     },
     async deleteapi(id)
     {
        await axios.delete("deletebase/"+id)
        .then((res)=>{
            this.getapi()
            alert('Delete successfully')
        })
     },
     async addapi()
     {
         await this.newproducts.post("addtobase")
         .then((resp)=>{ 
             Swal.fire({
                 title:'Hello World'
             })
             console.warn(resp.data)
             this.getapi()
             this.newproducts.reset();
              
              
            
         }).catch((error)=>{
            this.message=error.response.data.message; 
         })
     },
     async edit(item)
     {
         this.isclickedit=true;
         this.newproducts.fill(item);
     },
     create()
     {
         this.newproducts.clear();
          this.isclickedit=false;
        this.newproducts.reset();
     },
     async update()
     {
        const result=await axios.put(`updatebase/${this.newproducts.id}`,
        {
            'category':this.newproducts.categorypro,
            'product':this.newproducts.product,
            'price':this.newproducts.price,
        })
        .then((result)=>{
            Swal.fire({
                title:'Update Successfully'
            })
            this.newproducts.reset();
            this.isclickedit=false;
            this.getapi()
            
            
        })
     }

     
  },async mounted()
  {
      this.getapi()
     this.getcatfrompro()
  }
}
</script>

<style>
.card
{
    
    margin-left: 50px;

}
table
{
    margin-left: 90px;
    
}
</style>