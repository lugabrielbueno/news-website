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
  max-height: 100px;
}

.container {
  width: 100%;
  color: white;
  display: flex;
  justify-content: center;
  align-items: flex-start;
  align-self: flex-start;
}
</style>
