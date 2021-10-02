<template>
  
  <div>
       <header>
           <nav class="navbar navbar-expand-lg navbar-secondary bg-dark fixed-top"> 
           
  <a class="navbar-brand" href="#">Navbar</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <router-link class="nav-link" to='/upload'>Upload File</router-link>
      </li>
      <li class="nav-item">
        <router-link class="nav-link" to="/createcat">Category</router-link>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Dropdown
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#">Action</a>
          <a class="dropdown-item" href="#">Another action</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Something else here</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link disabled" href="#">Disabled</a>
      </li>
    </ul>
  </div>
           <a class="nav-link" href='/signup'>Sign Up</a>
           <router-link class="nav-link" to='/login'>Login</router-link>
           <div class="card">
             <span align='center'><h3>Welcome</h3></span>
           </div>
           </nav>
       </header>
       <main style="margin-top:70px;"><router-view></router-view></main>
       <footer></footer>
  </div>
</template>

<script>
export default {

}
</script>

<style>
a{
    color:#86dcef;
}
</style>