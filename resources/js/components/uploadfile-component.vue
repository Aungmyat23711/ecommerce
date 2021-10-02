<template>
  <div class="container my-2">
      <div class="card" style="margin:10px;">
                <h3 class='justify-content-md-center text-center'>All Products List</h3>
           </div>
      <div class="row justify-content-md-end">
          <div class="col-4">
              <router-link class="btn btn-info " style="margin-bottom:10px;" to="/createpro">Create</router-link>
          </div>
          <div class="col-4">
             <form class="form-inline my-2 my-lg-0" @submit.prevent='prodata'>
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" v-model="search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
          </div>
      </div>
      <div class="row">
          <div class="col-md-12" style="margin:0 auto;">
              <table class="table striped">
                  <thead>
                      <tr>
                          <th>Id</th>
                          <th>Cateogries</th>
                          <th>Products</th>
                          <th>Photo</th>
                          <th>Price</th>
                          <th>Quantity</th>
                          <th>Action</th>
                      </tr>
                      <tr v-for="item in allproduct.data" :key="item.id">
                          <th>{{item.id}}</th>
                          <th>{{item.category}}</th>
                          <th>{{item.product}}</th>
                          <th>{{item.photo}}</th>
                          <th>{{item.price}}</th>
                          <th>{{item.qty}}</th>
                          <th>
                              <button class="btn btn-info" @click='edit(item)'>Edit</button>
                              <button class="btn btn-danger" @click='deletepro(item.id)'>Delete</button>
                              </th>
                      </tr>
                  </thead>
              </table>
              <pagination :data='allproduct' @pagination-change-page='prodata' 
              class="text-bottom justify-content-md-center" style="padding-bottom:130px;"></pagination>
          </div>
      </div>
      <!-- <Edit :alldata='alldata'></Edit> -->
  </div>
</template>

<script>
import Form from 'vform'
import axios from 'axios'
import Edit from './edit-component.vue'
export default {
    methods:{
        async deletepro(id)
        {
           await axios.delete(`/deletepro/${id}`)
           .then((resp)=>{
               this.prodata();
           })
        },
        async prodata(page)
        {
            await axios.get(`/prodata?search=${this.search} & page=${page}`)
            .then((resp)=>{
                console.log(resp)
                this.allproduct=resp.data
            })
        },
        async edit(item)
        {
         this.alldata=item;
         console.log(this.alldata)  
         this.$router.push({name:'Edit',params:{alldata:item}})
         
        }
    },
data()
{
    return {
        //datalist:[],
        alldata:[],
        allproduct:{},
        search:'',
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
mounted()
{
    this.prodata();
},
components:{
    //Edit,
}
}
</script>

<style>

</style>