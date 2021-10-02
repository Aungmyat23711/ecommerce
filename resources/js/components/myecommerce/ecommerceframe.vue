<template>
  <div id='frame'>
       <header>
            <Eheader/>
       </header>
       <main id="main">
           <router-view></router-view>
       </main>
       <footer id="footer">
           <Efooter/>
       </footer>
  </div>
</template>

<script>
import Eheader from './ecommerceheader.vue'
import Efooter from './ecommercefooter.vue'
import axios from 'axios'
import {mapGetters} from 'vuex'
export default {
components:{
    Eheader,
    Efooter,
},
// async created()
// {
//     await axios.get('/ecommerce/getusername')
//     .then((resp)=>{
//         this.$store.dispatch('user',resp.data);
//     })
// },
// computed:{
//     ...mapGetters(['user'])
// }
}
</script>

<style>
#footer{
    position: absolute;
    width: 100%;
    bottom: 0;
    height: 60px;
    background: red;
    
}
body{
     background: rgb(219, 217, 217);
}
</style>