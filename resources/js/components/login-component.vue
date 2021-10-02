<template>
  <div class="container">
       <div class="row">
          <div class="col-md-6 offset-md-3">
             <form @submit.prevent='login'>
               <div class="form-group">
                  <label for="name">Name</label>
                  <input type="text" name="name" class="form-control" v-model="form.name">
               </div>
               <div class="form-group">
                  <label for="password">Password</label>
                  <input type="password" name="pass" class="form-control" v-model="form.password">
               </div>
               <button type="submit" name="btn" class="btn btn-info">login</button>
             </form>
          </div>
       </div>
  </div>
</template>

<script>
export default {
  data()
  {
    return {
      form:{
        name:'',
        password:'',
      }
    }
  },
methods:
{
  async login()
  {
    await axios.post('/vue/login',{
      'name':this.form.name,
      'password':this.form.password,
    })
    .then((resp)=>{
      Swal.fire({
        'title':'Successfully Sign in'
      })
      this.$router.push({path:'/vue/showproduct'})
      this.$router.go({path:'/vue/showproduct'})
    })
  }
}
}
</script>

<style>

</style>