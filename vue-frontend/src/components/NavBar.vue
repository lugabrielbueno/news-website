<template>
  <div class='container'>
    <a class="menu" @click="openMenu"><i class="material-icons">menu</i></a>
    <a class="navbar-brand" :class="{ show: displayMenu }" href="#"><i class="material-icons">newspaper</i></a>
    <nav class="navbar navbar-expand-lg " :class="{ show: displayMenu }">
      <div class="me-auto">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <form @submit.prevent="searchNews" action="/" method="get" name="search">
              <div class="row align-items-center">
                <div class="col-auto">
                  <input placeholder="Pesquisar" type="text" id="pesquisa_noticia"
                    class="form-control form-control-sm" />
                </div>
                <div class="col-md-2">
                  <button type="submit" class="btn btn-sm">
                    <i class="material-icons">search</i>
                  </button>
                </div>
              </div>
            </form>
          </li>
        </ul>
      </div>

      <div>
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <RouterLink class="nav-link" to="/">Início</RouterLink>
          </li>
          <li class="nav-item">
            <RouterLink class="nav-link" to="/">Geral</RouterLink>
          </li>
          <li class="nav-item">
            <RouterLink class="nav-link" to="/entertainment">Entretenimento</RouterLink>
          </li>
          <li class="nav-item">
            <RouterLink class="nav-link" to="/sports">Esportes</RouterLink>
          </li>
          <li class="nav-item">
            <RouterLink class="nav-link" to="/technology">Tecnologia</RouterLink>
          </li>
          <li class="nav-item">
            <RouterLink class="nav-link" to="/science">Ciência</RouterLink>
          </li>
          <li class="nav-item">
            <RouterLink class="nav-link" to="/business">Negócios</RouterLink>
          </li>
          <li class="nav-item">
            <RouterLink class="nav-link" to="/politics">Política</RouterLink>
          </li>
          <li class="nav-item">
            <RouterLink class="nav-link" to="/health">Saúde</RouterLink>
          </li>
        </ul>
      </div>
    </nav>
  </div>
</template>
<script>
export default {
  name: "NavBar",
  data() {
    return {
      languages: "pt,en,es",
      displayMenu: false
    };
  },
  methods: {
    openMenu() {
      this.displayMenu = !this.displayMenu

    },
    async searchNews() {
      const keywords = document.getElementById("pesquisa_noticia").value;
      document.getElementById("pesquisa_noticia").value = '';
      const language = this.languages;
      const response = await fetch(
        `http://localhost:8001/api/get-news.php?languages=${language}&keywords=${keywords}`,
        {
          method: "GET",
          credentials: "include",
        },
      );
      const datas = await response.json();
      if (!datas) {
        sessionStorage.setItem("nodata", true);
        location.href = "http://localhost:5173/";
      } else {
        var noticias = datas.data.filter((item) => item.image);
        this.news_slide = noticias.slice(0, 3);
        this.news = noticias.slice(3, 18);
        this.news_left = noticias.slice(18, 35);
        return;
      }
    },
  },
};
</script>

<style scoped>
@import url("https://fonts.googleapis.com/css2?family=Courier+Prime:ital,wght@0,400;0,700;1,400;1,700&family=Jersey+25&family=Markazi+Text:wght@400..700&family=Roboto+Slab:wght@100..900&family=VT323&display=swap");


nav.navbar {
  width: 100%;
  background-color: rgb(250, 250, 250);
  color: rgb(10, 10, 10);
  font-family: "Markazi Text", serif;
  position: fixed;
  overflow: hidden;
  z-index: 10;
  padding: 0px 300px;
  margin-top: 25px;
  display:flex;
}

.navbar-brand {
  width: 100%;
  background-color: rgb(250, 250, 250);
  color: rgb(10, 10, 10);
  display: flex;
  position: fixed;
  flex-direction: column;
  align-items: center;
  align-self: center;
  z-index: 10;
  overflow: hidden;
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

@media (max-width:768px) {
  nav.navbar {
    height: 0;
    width: 0;
    display: none;
  }

  .material-icons {
    font-size: 35px;
  }

  .navbar-brand {
    height: 0;
    width: 0;
    display: none;
    background-color: transparent;
  }

  a.menu {
    display: block;
    width: 100%;
    height: 100%;
    text-align: left;
    margin: 0;
    padding: 10px;
    border-style: ridge;
    border-color: rgba(0, 0, 0, 0.8);
    cursor: pointer;

  }

  .show {
    display: flex;
    width: auto;
    height: auto;
    position:absolute;
    align-items:center;
    text-align:center;
    z-index:50;

  }
  .container {
    width:100%;
    padding:0;
    display:flex;
  }
}
</style>
