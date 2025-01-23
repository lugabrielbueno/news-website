<template>
  <section>
    <div id="carouselExampleCaptions" class="carousel slide">
      <div class="carousel-indicators">
        <button
          type="button"
          data-bs-target="#carouselExampleCaptions"
          data-bs-slide-to="0"
          class="active"
          aria-current="true"
          aria-label="Noticia 1"
        ></button>
        <button
          type="button"
          data-bs-target="#carouselExampleCaptions"
          data-bs-slide-to="1"
          aria-label="Noticia 2"
        ></button>
        <button
          type="button"
          data-bs-target="#carouselExampleCaptions"
          data-bs-slide-to="2"
          aria-label="Noticia 3"
        ></button>
      </div>
      <div class="carousel-inner">
        <div
          v-for="(noticia, index) in news_slide"
          :key="index"
          :class="['carousel-item', { active: index === 0 }]"
        >
          <a :href="noticia.url" class="link-rounded">
            <img :src="noticia.image" class="slide_image" alt="..." />
          </a>
          <div class="text-center">
            <h5>{{ noticia.title }}</h5>
          </div>
        </div>
      </div>
      <button
        class="carousel-control-prev"
        type="button"
        data-bs-target="#carouselExampleCaptions"
        data-bs-slide="prev"
      >
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button
        class="carousel-control-next"
        type="button"
        data-bs-target="#carouselExampleCaptions"
        data-bs-slide="next"
      >
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>
  </section>
</template>
<script>
export default {
  name: "HomeView",
  mounted() {
    this.searchNews();
  },

  data() {
    return {
      news: "",
      category: "general",
      keywords: "",
      news_slide: "",
    };
  },
  methods: {
    async searchNews() {
      const category = this.category;
      const keywords = this.keywords;
      const response = await fetch(
        `http://localhost:8000/api/get-news.php?keywords=${keywords}&categories=${category}`,
        {
          method: "GET",
          credentials: "include",
        },
      );
      const datas = await response.json();
      if (datas) {
        this.news = datas.data.slice(3, 25);
        this.news_slide = datas.data.slice(0, 3);
      }
    },
  },
};
</script>
<style scoped>
section {
  width: 60%;
  height: 100%;
  display:flex;
  justify-content:center;
  align-items:flex-start;
  align-self:flex-start;
}
#carouselExampleCaptions {
  width: 100%;
}
.slide_image {
  height: 300px;
}
.carousel-inner {
  text-align: center;
}
.link-rounded img {
  border: 3px solid white;
  border-radius:5px;
}
</style>
