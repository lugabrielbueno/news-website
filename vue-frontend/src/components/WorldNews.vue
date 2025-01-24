<template>
  <section>
    <div class="right-news with-images">
      <ul>
        <li class="list-notice-img" v-for="(noticia_lista_img, index) in news" :key="index">
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
  </section>
</template>
<script>
export default {
  name: "WorldNews",
  mounted() {
    this.searchNewsWorld();
  },
  data() {
    return {
      news: [],
      category: "world",
      language: "en,es",
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
    async searchNewsWorld() {
      const category = this.category;
      const language = this.language;
      const response = await fetch(
        `http://localhost:8001/api/get-news.php?languages=${language}&categories=${category}`,
        {
          method: "GET",
          credentials: "include",
        },
      );
      const datas = await response.json();
      if (datas) {
        var noticias = datas.data.filter((item) => item.image);
        this.news = noticias.slice(0, 5);
      }
    },
  },
};
</script>
<style scoped>
@import url("https://fonts.googleapis.com/css2?family=Courier+Prime:ital,wght@0,400;0,700;1,400;1,700&family=Jersey+25&family=Markazi+Text:wght@400..700&family=Roboto+Slab:wght@100..900&family=VT323&display=swap");
@import url("https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&display=swap");

section {
  position: absolute;
  width: 12.5%;
  display: flex;
  justify-content: flex-start;
  margin-left: -220px;
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
  font-size: 17px;
  width: 100%;
  margin-top: -15px;
}

p.data_info {
  float: left;
  margin-left: 3px;
  max-width: 200px;
  color: rgba(50, 50, 50, 0.5);
  font-family: "Roboto Condensed";
  font-size: 11px;
}

.right-news ul li {
  overflow: hidden;
}

.right-news ul {
  height: 100%;
  overflow: hidden;
}

.right-news {
  font-family: "Markazi Text", serif;
  width: 100%;
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
  width: 150px;
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

.link-rounded img {
  border: 3px solid transparent;
  border-radius: 5px;
}
</style>
