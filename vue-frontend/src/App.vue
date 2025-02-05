<template>
  <header class="header">
    <NavBar />
  </header>
  <h1>Portal de notícias</h1>
  <hr class="divider" />
  <div class="messages">
    <div class="alert alert-success" v-if="alertaInscrito" role="alert">
      <i class="mdi mdi-check"></i>
      Você receberá noticias toda manhã, obrigado por se inscrever!
    </div>
    <div class="alert alert-danger" v-if="alertaNoData" role="alert">
      <i class="mdi mdi-info"></i>
      Não foi possível encontrar dados com a pesquisa.
    </div>
  </div>
  <div class="container">
    <div class="blur-overlay" id="loading">
      <div class="spinner"></div>
    </div>
    <div class='world_news'>
      <WorldNews />
    </div>
    <transition name="fade" mode="out-in">
      <RouterView />
    </transition>
    <div class='live_iframe'>
      <LiveNews />
    </div>

  </div>
  <div class="footer">
    <FooterPage />
  </div>
</template>
<script>
import NavBar from "./components/NavBar.vue";
import FooterPage from "./components/FooterPage.vue";
import WorldNews from "./components/WorldNews.vue";
import LiveNews from "./components/LiveNews.vue";
export default {
  name: "App",
  data() {
    return {
      alertaInscrito: "",
      alertaNoData: "",
    };
  },
  created() {
    document.title = "News Website";
  },
  mounted() {
    this.alertaInscrito = sessionStorage.getItem("subscribed");
    this.alertaNoData = sessionStorage.getItem("nodata");
    sessionStorage.removeItem("subscribed");
  },
  methods: {
    beforeEnter(el) {
      el.style.opacity = 0;
    },
    enter(el, done) {
      setTimeout(() => {
        el.style.opacity = 1;
        done();
      }, 500);
    },
    leave(el, done) {
      el.style.opacity = 0;
      setTimeout(done, 500);
    },
  },
  components: {
    NavBar,
    FooterPage,
    WorldNews,
    LiveNews
  },
};
</script>

<style scoped>
@import url("https://fonts.googleapis.com/css2?family=Courier+Prime:ital,wght@0,400;0,700;1,400;1,700&family=Jersey+25&family=Markazi+Text:wght@400..700&family=Roboto+Slab:wght@100..900&family=VT323&display=swap");


.blur-overlay {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: rgba(255, 255, 255, 0.6);
  backdrop-filter: blur(8px);
  display: none;
  justify-content: center;
  align-items: center;
  z-index: 1000;
}

.footer {
  margin: 0;
  padding: 0;
}

.spinner {
  width: 50px;
  height: 50px;
  border: 6px solid rgba(0, 0, 0, 0.2);
  border-top: 6px solid black;
  border-radius: 50%;
  animation: spin 1s linear infinite;
}

@keyframes spin {
  0% {
    transform: rotate(0deg);
  }

  100% {
    transform: rotate(360deg);
  }
}
h1 {
  display:none;
}

.header {
  width: 100%;
  margin-bottom: 20px;
  display: flex;
  justify-content: center;
  align-items: flex-start;
  align-self: flex-start;
}

.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.8s ease;
}

.fade-enter-from,
.fade-leave-to {
  opacity: 0;
}

.divider {
  color: rgb(30, 30, 30, 0.9);
  display: flex;
  justify-content: center;
  align-items: center;
  align-self: center;
  width: 50%;
  padding: 10px 0px;
  margin-top: 70px;
}

.messages {
  width: 80%;
  text-align: center;
  display: flex;
  justify-content: center;
  align-items: center;
  align-self: center;
}

.container {
  width: 100%;
  color: rgb(30, 30, 30, 0.9);
  display: flex;
  justify-content: center;
  align-items: flex-start;
  align-self: flex-start;
}

.messages .alert {
  font-family: "Markazi Text", serif;
  font-size: 20px;
  padding: 4px 80px;
}

@media (max-width:768px) {
  .world_news {
    display: none;
  }
  header.header {
    margin-bottom:50px;
  }

  .container {
    width: 100%;
    display: block;
  }

  h1 {
    display: block;
    width: 100%;
    text-align: center;
    margin-top: 40px;
    font-family: "Roboto Condensed";
    font-size:35px;
  }

  .divider {
    margin-top: 30px;
  }
}
</style>
