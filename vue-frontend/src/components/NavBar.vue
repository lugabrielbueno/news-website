<template>
  <nav class="navbar navbar-expand-lg container-fluid d-flex">
    <div class="me-auto">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item">
          <div class="row align-items-center">
            <div class="col-auto">
              <input
                placeholder="Pesquisar"
                type="text"
                id="pesquisa_noticia"
                class="form-control form-control-sm"
              />
            </div>
            <div class="col-md-2">
              <button type="submit" class="btn btn-sm">
                <i class="material-icons">search</i>
              </button>
            </div>
          </div>
        </li>
      </ul>
    </div>

    <a class="navbar-brand" href="#"><i class="material-icons">newspaper</i></a>
    <div>
      <ul class="navbar-nav mr-auto">
        <li class="nav-item">
          <RouterLink class="nav-link" to="/">Início</RouterLink>
        </li>
        <li class="nav-item">
          <RouterLink class="nav-link" to="/Geral">Geral</RouterLink>
        </li>
        <li class="nav-item">
          <RouterLink class="nav-link" to="/entretenimento"
            >Entretenimento</RouterLink
          >
        </li>
        <li class="nav-item">
          <RouterLink class="nav-link" to="/esportes">Esportes</RouterLink>
        </li>
        <li class="nav-item">
          <RouterLink class="nav-link" to="/tecnologia">Tecnologia</RouterLink>
        </li>
        <li class="nav-item">
          <RouterLink class="nav-link" to="/ciencia">Ciência</RouterLink>
        </li>
        <li class="nav-item">
          <RouterLink class="nav-link" to="/negocios">Negócios</RouterLink>
        </li>
        <li class="nav-item">
          <RouterLink class="nav-link" to="/saude">Saúde</RouterLink>
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
@import url("https://fonts.googleapis.com/css2?family=Courier+Prime:ital,wght@0,400;0,700;1,400;1,700&family=Jersey+25&family=Markazi+Text:wght@400..700&family=Roboto+Slab:wght@100..900&family=VT323&display=swap");
nav.navbar {
  width: 65%;
  background-color: transparent;
  color: rgb(10, 10, 10);
  font-family: "Markazi Text", serif;
}
i {
  color: rgb(10, 10, 10);
}
.navbar ul.navbar-nav li.nav-item .nav-link {
  color: rgb(10, 10, 10);
  margin-left: 10px;
  font-size: 22px;
}
.navbar ul.navbar-nav li.nav-item .nav-link:hover {
  text-decoration: underline;
}
</style>
