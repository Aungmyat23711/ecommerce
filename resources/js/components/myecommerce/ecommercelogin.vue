<template>
  <div>
      <div class="container contains bg-white">
          <div class="row">
                <div class="col-md-6 offset-md-3">
                     <h4 class="text-center fonth">This is admin login form</h4>
                </div>
           </div>
      </div>
      <div class="container contain bg-white">
          <div class="row">
             <div class="col-md-6 offset-md-3">
                  <form class="font" @submit.prevent='postlogin' method="POST">
                    <div class="form-group ">
                       <label for="email" >Email</label>
                       <input type="email" class="form-control" v-model="logins.email">
                       <span class="text-danger">{{this.usererror}}</span>
                    </div>
                    <div class="form-group">
                         <label for="password" >Password</label>
                         <input type="password" class="form-control" v-model="logins.password">
                         <span class="text-danger">{{this.passworderror}}</span>
                    </div>
                    <div class="form-group" align='end' >
                         <button class="btn btn-info" type="submit">Login</button>
                    </div>
                  </form>
             </div>
          </div>
      </div>
  </div>
</template>

<script>
import axios from 'axios'
import Form from 'vform'
export default {
  data(){
     return {
       logins:new Form({
         email:'',
         password:'',
       }),
       usererror:'',
       passworderror:'',
     }
  },
  methods:{
     async postlogin()
     {
       await axios.post('/ecommerce/postlogin',{
         email:this.logins.email,
         password:this.logins.password
       })
       .then((resp)=>{
         console.warn('user',resp.data.user)
         window.alert('Login Successfully')
         this.$store.dispatch('user',resp.data.user)
         this.$router.push('/ecommerce/home')
        
       })
       .catch((error)=>{
          this.usererror=error.response.data.errors.name;
          this.passworderror=error.response.data.errors.password;
       })
     }
  }
}
</script>

<style>
.contain{
    border: 1px solid rgb(243, 238, 238);
    border-radius: 10px;
    margin-top: 10px;
}
.contains{
    border: 1px solid rgb(243, 238, 238);
    border-radius: 10px;
    margin-top: 50px;
}
form{
    padding: 10px;
}
.font > div > label{
  font-family: fantasy;
}
button{
  font-family: fantasy;
}

</style>