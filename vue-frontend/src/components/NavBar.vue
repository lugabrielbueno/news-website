<template>
  <div class='container'>
    <a class="menu" @click="openMenu"><i class="mdi mdi-menu"></i></a>
    <a class="menu" @click="openMenu"><i class="mdi mdi-magnify"></i></a>
    <a class="navbar-brand" href="#"><span>news</span><i class="mdi mdi-newspaper"></i></a>
    <nav class="navbar navbar-expand-lg " :class="{ show: displayMenu }">
      <div class="mx-auto">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <form @submit.prevent="redir" action="/" method="get" name="search" id='search'>
              <div class="row">
                <div class="col-auto">
                  <input placeholder="Pesquisar" type="text" id="pesquisa_noticia" class="form-control " />
                </div>
                <div class="col-auto">
                  <button type="submit" class="btn btn-sm search">
                    <i class="mdi mdi-magnify"></i>
                  </button>
                </div>
              </div>
            </form>
          </li>
        </ul>
      </div>

      <div class='items-navigation'>
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
    redir() {
      const querySearch = document.getElementById('pesquisa_noticia').value

      document.getElementById('pesquisa_noticia').value = ""
      try {
        sessionStorage.setItem("nodata", true);
        this.$router.push(

          {
            path: '/search',
            query: { q: querySearch }
          }
        )
      } catch (error) {
        console.error(error)
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
  margin-top: 26px;
  display: flex;
}

.navbar-brand span {
  display: none;
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
  margin-top: -12px;
  padding: 0;
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

.navbar .btn-sm.search i {
  color: white;
  font-size: 20px;
}

.navbar .btn-sm.search {
  background-color: rgb(0, 0, 0, 0.3);
  border-radius: 3px;
  padding: 0 8px;
}

input.form-control {
  font-family: "Roboto Condensed";
  font-size: 13px;
}

input.form-control:focus {
  box-shadow: none;
  border-color: black;
}

.navbar-brand i.mdi {
  font-size: 22px;
}

.menu i.mdi {
  font-size: 30px;
}

@media (max-width:768px) {
  div.container nav.navbar {
    height: 0;
    width: 0;
  }

  .navbar-brand i.mdi {
    font-size: 30px;
    padding: 2px 25px;
  }

  .navbar-brand {
    background-color: transparent;
    display: inline-flex;
    align-items: center;
    align-self: center;
    flex-direction: row;
    font-size: 24px;
    margin-left: 100px;
    font-family: "Roboto Condensed";
    margin-top: 0px;
  }

  .navbar-brand span {
    display: inline-flex;
    font-weight: bold;
  }


  a.menu {
    text-align: left;
    margin: 0;
    padding: 5px;
    margin: 2px 10px;
    cursor: pointer;
  }

  div.container nav.navbar div.mx-auto,
  div.container nav.navbar div.mx-auto ul.navbar-nav {
    width: 100%;
  }

  nav.navbar .navbar-nav form#search .row .col-auto {
    float: left;
    width: 44%;
    margin: 15px 10px;
  }


  .navbar .items-navigation {
    width: 100%;
    position: relative;
  }

  div.container nav.navbar.show {
    align-items: flex-start;
    align-self: flex-start;
    justify-content: flex-start;
    flex-direction: column;
    width: 100%;
    height: 700px;
    text-align: left;
    position: absolute;
    z-index: 100;
    margin-top: 7px;
    padding: 0;
    transition: width 0.5s ease-in-out;
    border-bottom: 5px solid black;
  }

  .navbar .items-navigation ul.navbar-nav li.nav-item {
    border-bottom: 1px solid rgb(0, 0, 0, 0.1);
  }

  .navbar ul.navbar-nav li.nav-item .nav-link {
    font-size: 28px;
    text-decoration: underline;
  }

  input.form-control {
    height: 40px;
    width: 120%;
  }

  .container {
    background-color: rgb(250, 250, 250);
    position: fixed;
    padding: 5px 0;
    display: flex;
    z-index: 100;
    border-bottom: 2px solid rgba(0, 0, 0, 0.15);
  }
}
</style>
