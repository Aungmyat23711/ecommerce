<template>
  <div class="logpad">
      <div class="container" style="padding-top:100px;">
          <div class="row justify-content-center">
             <h2>Login Form</h2>
          </div>
          <div class="row">
             <div class="col-md-6 offset-md-3">
                 <form @submit.prevent='userlogin'>
                     <span class="text-danger">{{loginerror}}</span>
                     <div class="form-group">
                         <label for="email">Email</label>
                        <input type="email" class="form-control" v-model="email" v-on:keydown='emailerror=""'>
                        <span class="text-danger">{{emailerror}}</span>
                     </div>
                     <div class="form-group">
                          <label for="password">Password</label>
                          <input type="password" class="form-control" v-model="password"  v-on:keydown='passworderror=""'>
                          <span class="text-danger">{{passworderror}}</span>
                     </div>
                     <div class="form-group">
                          <button class="btn btn-info" type="submit" v-on:click='loginerror=""'>Login</button>
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
        email:'',
        password:'',
        emailerror:'',
        passworderror:'',
        loginerror:''
    }
},
methods:{
async userlogin()
{
    await axios.post('/ecommerce/user/addlogin',{
        email:this.email,
        password:this.password
    })
    .then((resp)=>{
        this.$store.dispatch('euser',resp.data.oneuser)
        this.loginerror=resp.data.loginerror
        if(resp.data.oneuser)
        {
            this.$router.push('/ecommerce/user/home');
        }
    })
    .catch((error)=>{
     this.emailerror=error.response.data.errors.email;
     this.passworderror=error.response.data.errors.password;
    })
}
},
created()
{

}
}
</script>

<style lang="scss" scoped>
@media only screen and (max-width:600px)
{
  .logpad{
      padding-top:200px;
  }
}
</style>