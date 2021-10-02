<template>
  <div class='box'>
    <header id='appheader'><ul style="display:flex;float:left;list-style:none;background:blue;width:100%;border:1px solid greenyellow">
      <router-link to='/vuejs/crud' style='text-decoration: none;  color: greenyellow;'><li style="padding:20px;margin:30px;border:1px solid;">Crud</li></router-link>
      <router-link to='/vuejs/category' style="text-decoration: none;  color: greenyellow;"><li style="padding:20px;margin:30px;border:1px solid;">Category</li></router-link>
      <router-link to='/vuejs/about' style='text-decoration: none;  color: greenyellow;'><li style="padding:20px;margin:30px;border:1px solid;">About</li></router-link>
    </ul></header>
    <main id='appmain'>
      <router-view></router-view>
    </main>
    <footer style="padding-top:60px;" id='appfooter'>
             <footer-component></footer-component>
        </footer>
    </div>
</template>

<script>

export default {
  name:'home',

}
</script>

<style>
li:hover{
  background: darkorange; 
}
body{
  position: relative;
  padding-bottom: 58px;
  min-height:calc(110vh);
}
#appfooter{
  position: absolute;
  width: 100%;
  bottom: 0;
}
</style>