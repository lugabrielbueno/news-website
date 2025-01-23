<template>
  <h2>{{ news }}</h2>
</template>
<script>
export default {
  name: "EsportesView",
  mounted() {
    this.searchNews();
  },
  methods: {
    async searchNews() {
      const response = await fetch(
        `http://localhost:8001/api/get-news.php?keywords=${keywords}&categories=${category}`,
      );
      const datas = await response.json();
      if (datas) {
        console.log(datas);
      }
    },
  },
  data() {
    return {
      news: "",
    };
  },
};
//  https://api.mediastack.com/v1/news
//   ? access_key = YOUR_ACCESS_KEY
</script>
<style scoped></style>
