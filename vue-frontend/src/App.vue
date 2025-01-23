<template>
  <header class="header">
    <NavBar />
  </header>
  <hr class="divider" />
  <div class="messages">
    <div class="alert alert-success" v-if="alertaInscrito" role="alert">
      <i class="material-icons">check</i>
      Você receberá noticias toda manhã, obrigado por se inscrever!
    </div>
  </div>
  <div class="container">
    <RouterView />
  </div>
  <div class="footer">
    <FooterPage />
  </div>
</template>
<script>
import NavBar from "./components/NavBar.vue";
import FooterPage from "./components/FooterPage.vue";
export default {
  name: "App",
  data() {
    return {
      alertaInscrito: "",
    };
  },
  created() {
    document.title = "News Website";
  },
  mounted() {
    this.alertaInscrito = sessionStorage.getItem("subscribed");
    sessionStorage.removeItem("subscribed");
  },

  components: {
    NavBar,
    FooterPage,
  },
};
</script>

<style scoped>
@import url("https://fonts.googleapis.com/css2?family=Courier+Prime:ital,wght@0,400;0,700;1,400;1,700&family=Jersey+25&family=Markazi+Text:wght@400..700&family=Roboto+Slab:wght@100..900&family=VT323&display=swap");
.header {
  width: 100%;
  max-height: 100px;
  display: flex;
  justify-content: center;
  align-items: flex-start;
  align-self: flex-start;
}
.divider {
  color: rgb(30, 30, 30, 0.9);
  display: flex;
  justify-content: center;
  align-items: center;
  align-self: center;
  width: 50%;
  padding: 10px 0px;
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
  font-size:20px;
  padding: 4px 80px;
}
</style>
