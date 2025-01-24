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
      <div class="left-news no-images">
        <h4>Leia também:</h4>
        <ul>
          <li
            class="list-notice"
            v-for="(noticia_lista, index) in news"
            :key="index"
          >
            <a class="link_url" :href="noticia_lista.url">
              {{ noticia_lista.title }}</a
            >
          </li>
        </ul>
      </div>
      <div class="right-news with-images">
        <ul>
          <li
            class="list-notice-img"
            v-for="(noticia_lista_img, index) in news_left"
            :key="index"
          >
            <a class="link_url" :href="noticia_lista_img.url">
              <img :src="noticia_lista_img.image" />
              <p class="data_info">
                Fonte: {{ noticia_lista_img.source }}<br />
                {{ formatDate(noticia_lista_img.published_at) }}
              </p>
              <br />
              <p class="data_info_title">{{ noticia_lista_img.title }}</p>
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
      language: "pt",
      keywords: "",
      news_slide: [],
    };
  },
  methods: {
    formatDate(date) {
      const options = {
        day: "2-digit",
        month: "2-digit",
        year: "numeric",
        hour: "2-digit",
        minute: "2-digit",
      };
      return new Intl.DateTimeFormat("en-GB", options).format(new Date(date));
    },
    async searchNews() {
      const category = this.$route.name;
      const keywords = this.keywords;
      const language = this.language;
      const response = await fetch(
        `http://localhost:8001/api/get-news.php?languages=${language}&keywords=${keywords}&categories=${category}`,
        {
          method: "GET",
          credentials: "include",
        },
      );
      const datas = await response.json();
      if (datas) {
        var noticias = datas.data.filter((item) => item.image);
        this.news_slide = noticias.slice(0, 3);
        this.news = noticias.slice(3, 18);
        this.news_left = noticias.slice(18, 35);
      }
    },
  },
  watch: {
    $route: {
      immediate: false,
      handler() {
        this.searchNews();
      },
    },
  },
};
</script>
<style scoped>
@import url("https://fonts.googleapis.com/css2?family=Courier+Prime:ital,wght@0,400;0,700;1,400;1,700&family=Jersey+25&family=Markazi+Text:wght@400..700&family=Roboto+Slab:wght@100..900&family=VT323&display=swap");
@import url("https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&display=swap");

.container-geral {
  font-family: "Markazi Text", serif;
  display: flex;
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

p.data_info_title:hover {
  text-decoration: underline;
}
p.data_info_title {
  line-height: 1.1em;
  float: left;
  margin-left: 3px;
  max-width: 200px;
  font-family: "Markazi Text", serif;
  font-size: 18px;
  width: 100%;
}
p.data_info {
  float: left;
  margin-left: 3px;
  max-width: 200px;
  color: rgba(50, 50, 50, 0.5);
  font-family: "Roboto Condensed";
  font-size: 12px;
}
.container-geral .left-news {
  width: 55%;
  float: left;
}
.right-news ul li {
  overflow: hidden;
}
.right-news ul {
  height: 100%;
  overflow: hidden;
}
.container-geral .right-news {
  width: 40%;
  float: left;
}
.list-notice-img:hover {
  text-decoration: underline;
}
.list-notice-img a.link_url {
  display: block;
  text-decoration: none;
  color: rgb(30, 30, 30, 0.9);
  padding: 2px 0;
  font-size: 18px;
  overflow: hidden;
}
.list-notice-img img {
  border-radius: 3px;
  float: left;
  width: 200px;
}
.list-notice-img {
  list-style-type: none;
  text-decoration: none;
  color: rgb(30, 30, 30, 0.9);
  padding: 5px 0;
  width: 100%;
}
.list-notice .link_url:hover {
  text-decoration: underline;
}
.list-notice .link_url {
  color: rgb(30, 30, 30, 0.9);
  text-decoration: none;
  width: 100%;
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
