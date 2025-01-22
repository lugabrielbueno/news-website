<template>
  <header class="header">
    <NavBar />
  </header>

  <div class="container">
    <RouterView />
  </div>
</template>
<script>
import NavBar from "./components/NavBar.vue";
export default {
  name: "App",

  created() {
    document.title = "News Website";
  },

  components: {
    NavBar,
  },
};
</script>

<style scoped>
.header {
  width: 100%;
}

.container {
  width: 100%;
}
</style>
