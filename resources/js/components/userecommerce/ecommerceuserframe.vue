<template>
  <div>
      <header>
            <Header/>
      </header>
      <main class="main">
          <router-view></router-view>
      </main>
      <footer class="footerone">
          <Footer/>
      </footer>
  </div>
</template>

<script>
import Header from './ecommerceheader.vue'
import Footer from './ecommercefooter.vue'
export default {
components:{
    Header,
    Footer,
}
}
</script>

<style lang="scss" scoped>
body{
    background: white;
}
.footerone{
    position: absolute;
    width: 100%;
    bottom: -600px;
     
}
.main{
    padding-bottom:50px;
}
@media only screen and (max-width:600px){
.main{
    padding-bottom:50px;
}
.footerone{
    
}
}

</style>
