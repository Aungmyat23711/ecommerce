<template>
  <div>
      <div class="container">
         <div class="row" style='padding:20px;'>
            <div class="col-md-4">
             <img :src="`/images/${eachproduct.photo}`" alt="" class="img-thumbnail" style="max-height:100px;">
            </div>
            <div class="col-md-4">
              <h4 style="padding-top:30px;">{{eachproduct.product}}</h4>
            </div>
            <div class="col-md-4">
               <h4 style="padding-top:30px;">Number of photo : <span class="badge badge-primary">{{countphoto}}</span></h4>

            </div>
         </div> 
         <div class="row">
              <h4 class="text-success">{{success}}</h4>
         </div>
         <div class="row">
             <div class="col-md-6">
                <form @submit.prevent="uploadphoto">
                     <div class="form-group">
                         <label for="photo">Upload Photo</label>
                         <input type="file" class="form-control" v-on:change='showimg'>
                         <img src="#" alt="" id="img" class="img-thumbnail" style="max-height:300px;">
                     </div>
                     <div class="form-group">
                          <button class="btn btn-success" type="submit">Add</button>
                          <router-link to="/ecommerce/photo"><button class="btn btn-danger" type="submit">Back</button></router-link>
                     </div>
                </form>
             </div>
             <div class="col-md-6">
                 <div class="row">
                      <div class="col-md-6">
                          <h4>Relative Photos</h4>
                      </div>
                 </div>
                  <div class="row" >
                      <div class="col-md-6" v-for="pho in allphoto" :key='pho.id' style="padding-bottom:20px;">
                           <img :src="`/images/${pho.photo}`" alt="" class="img-thumbnail" style="max-height:100px;">
                           <button class="btn btn-danger" @click='deletephoto(pho.id)'>X</button>
                      </div>
                  </div>
             </div>
         </div>
      </div>
  </div>
</template>

<script>
export default {
data()
{
    return {
        eachproduct:[],
        countphoto:'',
        photo:'',
        success:'',
        allphoto:[]
    }
},
methods:{
    async geteachproduct()
    {
       var id=this.$route.params.id;
       await axios.get('/ecommerce/eachproduct/'+id)
       .then((resp)=>{
           this.eachproduct=resp.data[0];
       })
    },
    async count()
    {
        var id=this.$route.params.id;
        await axios.get('/ecommerce/countphoto/'+id)
        .then((resp)=>{
            this.countphoto=resp.data;
        })
    },
    showimg(e)
    {
        var input=e.target.files[0];
        this.photo=input;
        var reader=new FileReader();
        reader.onload=()=>{
            var result=reader.result;
            var image=document.getElementById('img');
            image.src=result
        }
        reader.readAsDataURL(input);
    },
    async uploadphoto()
    {
        var formdata=new FormData();
        formdata.append('photo',this.photo);
        formdata.append('product_id',this.$route.params.id)
        await axios.post('/ecommerce/uploadphoto',formdata)
        .then((resp)=>{
          this.success=resp.data.success;
          this.count();
          this.getphoto();
        })
    },
    async getphoto()
    {
        var id=this.$route.params.id;
        await axios.get('/ecommerce/getphoto/'+id)
        .then((resp)=>{
            this.allphoto=resp.data;
        })
       
    },
    async deletephoto(id)
    {
        if(confirm('Are you sure want to delete'))
        {
            var formdata=new FormData();
        formdata.append('_method','DELETE');
        await axios.post(`/ecommerce/deletephoto/${id}`,formdata)
        .then((resp)=>{
            this.count();
            this.getphoto();
        })

        }
        
    }
},
created()
{
    this.geteachproduct();
    this.count();
    this.getphoto();
}
}
</script>

<style>

</style>