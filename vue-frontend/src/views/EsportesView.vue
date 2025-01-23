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
      const access_key = "0bf6de60d92291b9d920869970e3d21e";
      const response = await fetch(
        `https://api.mediastack.com/v1/news?access_key=${access_key}&languages=pt&categories=sports`,
      );
      const datas = await response.json();
      if (datas) {
        console.log(datas);
      }
    },
  },
  data() {
    return {
      news: "HELLLLLLLLLLLLLOOOOOOOOO",
    };
  },
};
//  https://api.mediastack.com/v1/news
//   ? access_key = YOUR_ACCESS_KEY
</script>
<style scoped></style>
