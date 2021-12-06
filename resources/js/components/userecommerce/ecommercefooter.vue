<template>
<div class="footer">
    <div v-if="!euser" class="bg-dark">
       <div class="container bg-dark text-white" style="padding:50px;">
           <div class="row">
                <div class="col-md-8 offset-md-2">
                    <h2 align='center'>Please Sign in to continue!</h2>
                </div>
           </div>
       </div>
    </div>
  <div v-if='euser' class="bg-dark">
      <div class="container bg-dark text-white" style="padding:50px;">
            <div class="row">
               <div class="col-md-8 offset-md-2">
                   <h3 align='center' class="text-primary">Computer Accessories Sale And Service</h3>
                   <h5 align='center'>Copyright@2021 amgpop23711</h5>
                   <div class="row justify-content-center">
                       <div class="col-md-3" align='center'>
                            <p>Contact</p>
                            <p>09254973900</p>
                       </div>
                        <div class="col-md-3" align='center'>
                            <p>Email</p>
                            <p>ammgyi@gmail.com</p>
                       </div>
                        <div class="col-md-3" align='center'>
                            <img src="/images/fblogo.png" alt="" width="50px;" height="50px;">
                       </div>
                   </div>
               </div>
            </div>
      </div>
  </div>
</div>
</template>

<script>
import {mapGetters} from 'vuex'
export default {
computed:{
    ...mapGetters(['euser'])
}
}
</script>

<style lang="scss" scoped>
@media only screen and (max-width:600px){
    .footer{
        position:absolute;
    width:100%;
    bottom: -1300px;
    }
}
</style>