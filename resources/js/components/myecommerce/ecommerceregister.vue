<template>
  <div>
      <div class="container contains bg-white">
           <div class="row">
                <div class="col-md-6 offset-md-3">
                     <h4 class="text-center fonth">This Page is for admin</h4>
                </div>
           </div>
      </div>
      <div class="container bg-white contain">
          <div class="row">
              <div class="col-md-6 offset-md-3">
                  <form class="font" @submit.prevent='postadmin()'>
                      <div class="form-group">
                          <label for="username">UserName</label>
                          <input type="text" class='form-control' v-model="fields.name" v-on:keydown='namemessage=""'>
                          <span class="text-danger">{{namemessage}}</span>
                      </div>
                      <div class="form-group">
                          <label for="password">Password</label>
                          <input type="password" class="form-control" v-model="fields.password" v-on:keydown='passwordmessage=""'>
                          <span class="text-danger">{{passwordmessage}}</span>
                          <span class="text-danger">{{notmatchpass}}</span>
                      </div>
                      <div class="form-group">
                          <label for="cpassword">Confirm_Password</label>
                          <input type="password" class="form-control" v-model="fields.confirm_password" v-on:keydown='cpasswordmessage=""'>
                          <span class="text-danger">{{cpasswordmessage}}</span>
                      </div>
                      <div class="form-group">
                           <label for="email">Email</label>
                           <input type="email" class="form-control" v-model="fields.email" v-on:keydown='emailmessage=""'>
                           <span class="text-danger">{{emailmessage}}</span>
                      </div>
                      <div>
                          <button type="submit" class="btn btn-info">Register</button>
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
data()
{
  return{
      fields:new Form({
          name:'',
          password:'',
          confirm_password:'',
          email:''
      }),
      namemessage:'',
      passwordmessage:'',
      cpasswordmessage:'',
      emailmessage:'',
      notmatchpass:''
  }
},
methods:{
async postadmin()
  {
      await axios.post('/ecommerce/postadmin',this.fields)
      .then((resp)=>{
          console.warn(resp.data)
          this.notmatchpass=resp.data.message
          if(this.notmatchpass!='')
          {
              alert('Password did not match')
              this.fields.password=''
              this.fields.confirm_password=''
          }
          else{
              alert('You have registered!')
              this.fields.clear();
              this.fields.reset();
          }
          
      })
      .catch((error)=>{
          console.warn('error',error.response.data)
          this.namemessage=error.response.data.errors.name;
          this.passwordmessage=error.response.data.errors.password;
          this.emailmessage=error.response.data.errors.email;
          this.cpasswordmessage=error.response.data.errors.confirm_password;
      })
  }
},

}
</script>

<style>
.contain{
    border: 1px solid rgb(243, 238, 238);
    border-radius: 10px;
    margin-top: 10px;
    padding-bottom: 100px;
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
.fonth{
    font-family: monospace;
}
button{
  font-family: fantasy;
}

</style>