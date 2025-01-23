<template>
  <section>
    <div id="carouselExampleCaptions" class="carousel slide">
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
    <div class="container-geral">
      <h4>Leia também:</h4>
      <div class="right-news no-images">
        <ul>
          <li
            class="list-notice"
            v-for="(noticia_lista, index) in news"
            :key="index"
          >
            <a class="link_url" href="{{ noticia_lista.url }}">
              {{ noticia_lista.title }}</a
            >
          </li>
        </ul>
      </div>
      <div class="left-news with-images">
        <ul>
          <li
            class="list-notice-img"
            v-for="(noticia_lista_img, index) in visibleItems"
            :key="index"
          >
            <a class="link_url" href="{{ noticia_lista_img.url }}">
              <img
                width="200px"
                height="120px"
                :src="noticia_lista_img.image"
              />
              <br />
              {{ noticia_lista_img.title }}
            </a>
          </li>
        </ul>
      </div>
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
      news: [],
      news_left: [],
      category: "general",
      keywords: "",
      news_slide: [],
    };
  },
  methods: {
    async searchNews() {
      const category = this.$route.query.name;
      console.log(category)
      const keywords = this.keywords;
      const response = await fetch(
        `http://localhost:8001/api/get-news.php?keywords=${keywords}&categories=${category}`,
        {
          method: "GET",
          credentials: "include",
        },
      );
      const datas = await response.json();
      if (datas) {
        this.news = datas.data.slice(3, 18);
        this.news_left = datas.data.slice(18, 30);
        this.news_slide = datas.data.slice(0, 3);
      }
    },
  },
  computed: {
    visibleItems() {
      return this.news_left.filter((item) => item.image);
    },
  },
};
</script>
<style scoped>
@import url("https://fonts.googleapis.com/css2?family=Courier+Prime:ital,wght@0,400;0,700;1,400;1,700&family=Jersey+25&family=Markazi+Text:wght@400..700&family=Roboto+Slab:wght@100..900&family=VT323&display=swap");
.container-geral {
  font-family: "Markazi Text", serif;
}
section {
  width: 80%;
  height: 100%;
}
h4 {
  font-size: 35px;
}
h5 {
  font-family: "Markazi Text", serif;
  font-size: 25px;
  padding: 0px 60px;
  color: rgb(30, 30, 30, 0.9);
}

.container-geral .left-news {
  width: 40%;
  float: right;
}
.container-geral .right-news {
  width: 55%;
  float: left;
}
.list-notice-img:hover {
  text-decoration: underline;
}
.list-notice-img a {
  list-style-type: none;
  text-decoration: none;
  color: rgb(30, 30, 30, 0.9);
  padding: 2px 0;
  font-size: 18px;
}
.list-notice-img img {
  border-radius: 3px;
}
.list-notice-img {
  list-style-type: none;
  text-decoration: none;
  color: rgb(30, 30, 30, 0.9);
  padding: 5px 0;
}
.list-notice .link_url:hover {
  text-decoration: underline;
}
.list-notice .link_url {
  color: rgb(30, 30, 30, 0.9);
  text-decoration: none;
}
.list-notice {
  list-style-type: none;
  text-align: left;
  font-size: 20px;
  padding: 3px 0px;
}
#carouselExampleCaptions {
  width: 100%;
  font-size: 45px;
}
.slide_image {
  height: 300px;
  margin-bottom: 20px;
}
.carousel-inner {
  text-align: center;
}
.link-rounded img {
  border: 3px solid transparent;
  border-radius: 5px;
}
div.carousel-indicators {
  position: relative;
}
div.carousel-indicators button.active {
  background-color: rgb(60, 60, 60, 0.9);
}
div.carousel-indicators button {
  background-color: rgb(120, 120, 120, 0.9);
}
div.carousel button.carousel-control-prev span.carousel-control-prev-icon,
div.carousel button.carousel-control-next span.carousel-control-next-icon {
  background-color: rgba(20, 20, 20, 0.2);
}
</style>
