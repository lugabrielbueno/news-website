<template>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">Navbar</a>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <RouterLink class="nav-link" to="/">Home</RouterLink>
        </li>
        <li class="nav-item active">
          <RouterLink class="nav-link" to="/">Noticias</RouterLink>
        </li>
        <li class="nav-item active">
          <RouterLink class="nav-link" to="/">Pesquisar</RouterLink>
        </li>
      </ul>
    </div>
  </nav>
</template>
<script>
export default {
  name: "NavBar",
  data() {
    return {};
  },
};
</script>

<style scoped>
nav.navbar {
  width: 100%;
}
</style>
