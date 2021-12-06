<template>
  <div class="padd">
      <div class="container" style="padding-top:150px;">
          <div class="row">
                <h2 align='center'>User Register Form</h2>
          </div>
          <div class="row">
                <div class="col-md-6 offset-md-3">
                      <form class="font" @submit.prevent='register'>
                          <div align='container'>
                              <div class="row justify-content-center">
                                <h3 class="text-success">{{success}}</h3>
                              </div>
                             
                          </div>
                          <div class="form-group">
                              <label for="name">Name</label>
                              <input type="text" class="form-control" v-model="name" v-on:keydown='nerror=""'>
                              <span class="text-danger">{{nerror}}</span>
                          </div>
                           <div class="form-group">
                              <label for="password">Password</label>
                              <input type="password" class="form-control" v-model="pass" v-on:keydown='perror=""'>
                              <span class="text-danger">{{perror}}</span>
                          </div>
                           <div class="form-group">
                              <label for="cpassword">Confirm-Password</label>
                              <input type="password" class="form-control" v-model="cpass" v-on:keydown='cperror=""'>
                              <span class="text-danger">{{cperror}}</span>
                          </div>
                           <div class="form-group">
                              <label for="email">Email</label>
                              <input type="email" class="form-control" v-model="email" v-on:keydown='eerror=""'>
                              <span class="text-danger">{{eerror}}</span>
                          </div>
                          <div class="form-group">
                              <button class="btn btn-outline-primary">Register</button>
                          </div>
                      </form>
                </div>
          </div>
      </div>
  </div>
</template>

<script>
import axios from 'axios'
export default {
data()
{
    return {
        name:'',
        pass:'',
        cpass:'',
        email:'',
        nerror:'',
        perror:'',
        cperror:'',
        eerror:'',
        success:''
    }
},
methods:{
    async register()
    { 
       await axios.post('/ecommerce/user/addregister',{
           name:this.name,
           password:this.pass,
           cpassword:this.cpass,
           email:this.email
       })
       .then((resp)=>{
           this.cperror=resp.data.message;
           if(resp.data.message)
           {
               this.pass='',
               this.cpass=''
           }
           else{
              this.success='Operation Successfully'
              this.name=''
              this.pass='',
              this.cpass='',
              this.email=''
           }
       })
       .catch((error)=>{
         this.nerror=error.response.data.errors.name;
         this.perror=error.response.data.errors.password;
         this.cperror=error.response.data.errors.cpassword;
         this.eerror=error.response.data.errors.email;
       })
    }
}
}
</script>

<style>
.font{
    font-family: fantasy;
}
@media only screen and (max-width:600px){
    .padd{
        padding-bottom: 200px;
        padding-top:100px;
    }
}

</style>