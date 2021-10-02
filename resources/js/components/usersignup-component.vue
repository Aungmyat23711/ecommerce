<template>
  <div class="container">
       <div class="row">
            
           <div class="col-md-6 offset-md-3">
                  <div class="">
                   <form @submit.prevent="submit">
                       <div class="form-group">
                            <label for="name">User</label>
                            <input type="text" class="form-control" name="name" v-model='signupform.name'>
                            <div class="text-danger" v-if="signupform.errors.has('name')" v-html="signupform.errors.get('name')"></div>
                       </div>
                       <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" name="password" v-model='signupform.password'>
                             <div class="text-danger" v-if="signupform.errors.has('password')" 
                             v-html="signupform.errors.get('password')"></div>
                             <div class="text-danger">{{this.message}}</div>
                       </div>
                       <div class="form-group"> 
                            <label for="confirm-password">Confrim_Password</label>
                            <input type="password" class="form-control" name="confirm-password" v-model='signupform.confirmpassword'>
                             <div class="text-danger" v-if="signupform.errors.has('confirm-password')" v-html="signupform.errors.get('confirm-password')"></div>
                             
                       </div>
                       <div class="form-group"> 
                            <label for="email">Email</label>
                            <input type="email" class="form-control" name="email" v-model='signupform.email'>
                             <div class="text-danger" v-if="signupform.errors.has('email')" v-html="signupform.errors.get('email')"></div>
                       </div>
                       <div class="form-group">
                             <label for="role">Role</label>
                             <select name="role" class="form-control" v-model='signupform.role'>
                                  <option  value="User">User</option>
                                  <option value="Admin">Admin</option>
                             </select>
                              <div class="text-danger" v-if="signupform.errors.has('role')" v-html="signupform.errors.get('role')"></div>
                       </div>
                       <button class="btn btn-info" type="submit">Sign Up</button>
                       <!-- <button class="btn btn-danger" @click='test'>Test</button>
                       <button class="btn btn-warning" @click="forget">Forget</button> -->
                   </form>
                  </div>
           </div>
           
       </div>
  </div>
</template>

<script>
import Form from 'vform'
import axios from 'axios'
export default {
     data(){
          return {
               signupform:new Form({
                 id:'',
                 name:'',
                 password:'',
                 confirmpassword:'',
                 email:'',
                 role:'',
               }),
               session:'',
                message:''
               
               
          }
     },
methods:{
    async submit()
     {
          
        await this.signupform.post('/signin')
        .then((resp)=>{
             console.log(resp.data)
             this.$router.push({path:'/upload'})
             this.$router.go({path:'/upload'})
        })
     },
     getinterface()
     {
          axios.get('/showsign')
     },
},
mounted()
{
     this.$session.start();
//     this.$session.set('message',this.sessiondata)
       this.message=this.sessiondata


     
},
props:['sessiondata']
}
</script>

<style>

</style>