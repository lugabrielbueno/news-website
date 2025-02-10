<template>
  <div class='container' id='container_nav'>
    <a class="menu" @click="openMenu"><i class="mdi mdi-menu"></i></a>
    <a class="menu" @click="openMenu"><i class="mdi mdi-magnify"></i></a>
    <a class="navbar-brand" href="#"><span>news</span><i class="mdi mdi-newspaper"></i></a>
    <nav class="navbar navbar-expand-lg " :class="{ show: displayMenu }">
      <div class='form-container'>
        <form @submit.prevent="redir" action="/" method="get" class='form-search' name="search" id='search'>
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
    closeMenu() {
      this.displayMenu = false
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
  mounted() {
    document.addEventListener('click',  (e) => {
      let navbar = document.getElementById('container_nav')
      if (!navbar.contains(e.target)) {
        console.log('oi')
        this.closeMenu()
      }
    })
  }
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
  padding: 0px 200px;
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

.form-container {
  margin: 0px;
  padding-right: 120px;
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

@media (max-width: 1024px) {


  .form-container {
    margin: 0px;
    display: flex;
    width: 100%;
    align-items: center;
    padding: 5px;
    align-self: center;
    justify-content: center;
  }

  .container {
    min-width: 100%;
    background-color: rgb(250, 250, 250);
    height: 100px;
    padding: 0;
    margin: 0;
    position: fixed;
    z-index: 50;
  }


  div.container nav.navbar {
    height: 0;
    width: 0;
    position: fixed;
    z-index: 50;
  }


  .navbar-brand {
    background-color: transparent;
    display: flex;
    align-items: center;
    align-self: center;
    flex-direction: row;
    font-size: 24px;
    margin-left: 100px;
    font-family: "Roboto Condensed";
    margin-top: 0px;
  }

  .navbar-brand span {
    display: flex;
    font-weight: bold;
  }

  .container span {

    font-size: 40px;
    margin-right: 15px;
  }

  .container i.mdi {
    font-size: 50px;
  }

  a.menu {
    text-align: left;
    margin: 0;
    padding: 5px;
    margin: 2px 10px;
    z-index: 50;
    cursor: pointer;
  }



  div.container nav.navbar.show {
    display: flex;
    align-items: flex-start;
    align-self: flex-start;
    justify-content: flex-start;
    flex-direction: column;
    width: 100%;
    height: auto;
    text-align: left;
    position: absolute;
    z-index: 100;
    margin-top: 90px;
    padding: 0;
    transition: width 0.5s ease-in-out;
    border-bottom: 5px solid black;
  }

  .navbar .items-navigation {
    width: 100%;
  }

  .navbar .items-navigation ul.navbar-nav li.nav-item {
    border-bottom: 1px solid rgb(0, 0, 0, 0.2);
    width: 100%;
  }


  .navbar ul.navbar-nav li.nav-item .nav-link {
    font-size: 60px;
    text-decoration: underline;
  }

  input.form-control {
    font-size: 20px;
    margin: 0;
    height: 55px;
  }

  div.container nav.navbar ul.navbar-nav {
    display: flex;
    flex-direction: column;
    width: 100%;
  }


  .navbar .btn-sm.search i {
    color: white;
    font-size: 32px;
  }

}

@media (max-width:768px) {
  div.container nav.navbar {
    height: 0;
    width: 0;
  }

  .navbar-brand i.mdi {
    font-size: 30px;
    padding: 2px 10px;
  }

  .container a.navbar-brand {
    background-color: transparent;
    display: inline-flex;
    align-items: center;
    align-self: center;
    flex-direction: row;
    font-size: 24px;
    margin-left: 70px;
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
    width: 100%;
  }

  .container {
    background-color: rgb(250, 250, 250);
    position: fixed;
    padding: 5px 0;
    display: flex;
    z-index: 100;
    border-bottom: 2px solid rgba(0, 0, 0, 0.15);
  }

  .navbar .btn-sm.search i {
    color: white;
    font-size: 23px;
  }
}
</style>
