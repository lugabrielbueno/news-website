<template>
  <section>
    <div id="carouselExampleCaptions" class="carousel slide">
      <div class="carousel-inner">
        <div v-for="(noticia, index) in news_slide" :key="index" :class="['carousel-item', { active: index === 0 }]">
          <a :href="noticia.link" class="link-rounded">
            <img :src="noticia.image_url" class="slide_image" alt="..." />
          </a>
          <div class="text-center">
            <h5>{{ noticia.title }}</h5>
          </div>
        </div>
      </div>
      <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active"
          aria-current="true" aria-label="Noticia 1"></button>
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1"
          aria-label="Noticia 2"></button>
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2"
          aria-label="Noticia 3"></button>
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions"
        data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions"
        data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>
    <div class="container-geral">
      <div class="left-news no-images">
        <h4 class='leia'>Leia também:</h4>
        <ul>
          <li class="list-notice" v-for="(noticia_lista, index) in news" :key="index">
            <a class="link_url" :href="noticia_lista.link">
              {{ noticia_lista.title }}</a>
          </li>
        </ul>
        <div class='conteudo-extra'>
          <hr>
          <h4 class='ciberseguranca'>Cibersegurança</h4>
          <img class='img_extra'
            src='https://www.psafe.com/blog/wp-content/uploads/2021/10/aviso-de-perigo-seguranca-digital-1.jpg'
            width='300'>
          <h5 class='title-extra'>O que é segurança digital? Entenda</h5>
          <article>
            <p>
              <span class='subtitle'>Descubra a importância da segurança digital pessoal como empresarial, quais são as
                principais ameaças e as
                melhores dicas de como se proteger.
              </span><br>
              Segurança digital é o nome para a prática de proteger dispositivos pessoais ou de armazenamento, sistemas,
              redes, servidores, programas e Internet das Coisas (IoT) contra ataques cibernéticos. Nos dias de hoje
              quase tudo pode ser feito virtualmente, por exemplo, ir pessoalmente a bancos e supermercados já não é
              mais necessário, é possível fazer tudo isso através da internet.
            </p>
            <a href='https://www.psafe.com/blog/o-que-e-seguranca-digital/' target='_blank' class='btn  leia_mais'><i
                class='mdi mdi-plus'></i>Leia
              mais</a>
          </article>

        </div>
      </div>
      <div class="right-news with-images">
        <ul>
          <h4 class='destaques'>Destaques</h4>
          <li class="list-notice-img" v-for="(noticia_lista_img, index) in news_left" :key="index">
            <a class="link_url" :href="noticia_lista_img.link">
              <img :src="noticia_lista_img.image_url" />
              <p class="data_info">
                Fonte: {{ noticia_lista_img.source_name }}<br>
                {{ formatDate(noticia_lista_img.pubDate) }}
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
      api_url: import.meta.env.VITE_API_URL,
      news_left: [],
      category: "top",
      language: "pt",
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

      document.getElementById('loading').style.display = "flex";
      const category = this.$route.name;
      const keywords = this.$route.query.q;
      const language = this.language;
      try {
        const response = await fetch(
          `${this.api_url}/get-news.php?languages=${language}&keywords=${keywords}&categories=${category}`,
          {
            method: "GET",
            credentials: "include",

          },
        );
        const datas = await response.json();
        if (datas) {
          if (datas.status == 'error') {
            throw new Error(datas.message)
          }
          var noticias = datas.results;
          this.news_slide = noticias.slice(0, 3);
          this.news = noticias.slice(3, 14);
          this.news_left = noticias.slice(14, 18);
        }

      } catch (error) {
        console.error(error)
      } finally {
        document.getElementById('loading').style.display = "none";
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
  width: 100%;
  font-family: "Markazi Text", serif;
  min-height: 100vh;
}

section {
  width: 80%;
  height: 100%;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-self: center;
  align-items: center;
  float: left;

}

.conteudo-extra {
  margin-top: 70px;
  width: 95%;
  margin-left: 20px;
}

.conteudo-extra p .subtitle {
  font-size: 13px;
  line-height: 1.0em;
  font-family: "Roboto Condensed";
  color: rgba(0, 0, 0, 0.6);
}

.conteudo-extra p {
  font-size: 20px;
  line-height: 1.3em;

}

.img_extra {
  border-radius: 5px;
}

h4.destaques {
  font-size: 30px;
  margin-left: 20px;
  padding-left: 10px;
  border-left: 5px solid rgba(0, 0, 0, 0.8);
  color: rgba(0, 0, 0, 0.8);
  height: 20px;
  display: flex;
  align-items: center;
  align-self: center;
}

h4.ciberseguranca {
  font-size: 28px;
  margin-left: 5px;
  padding-left: 10px;
  border-left: 5px solid rgba(0, 0, 0, 0.8);
  color: rgba(0, 0, 0, 0.8);
  height: 20px;
  display: flex;
  align-items: center;
  align-self: center;
}


h4.leia {
  font-size: 35px;
  margin-left: 20px;
  padding-left: 10px;
  border-left: 5px solid rgba(0, 0, 0, 0.8);
  color: rgba(0, 0, 0, 0.8);
  height: 25px;
  display: flex;
  align-items: center;
  align-self: center;
}

h5.title-extra {
  font-size: 25px;
  text-align: left;
  color: rgb(30, 30, 30, 0.9);
  margin-left: 0;
  padding-left: 10px;
}

h5 {
  font-family: "Markazi Text", serif;
  font-size: 25px;
  padding: 0px 60px;
  text-align: left;
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
  margin-top: -10px;
}

p.data_info {
  float: left;
  margin-left: 2px;
  max-width: 90px;
  color: rgba(50, 50, 50, 0.5);
  font-family: "Roboto Condensed";
  font-size: 12px;
}

.container-geral .left-news {
  width: 64%;
  float: left;
}

.right-news ul li {
  overflow: hidden;
  padding: 10px;
  border-right: 1px solid black;
}

.right-news ul {
  height: 100%;
  overflow: hidden;



}

.container-geral .right-news {
  width: 36%;
  display: block;
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

.list-notice-img .link_url {

  border-bottom: 1px solid rgba(10, 10, 10, 0.4);
}

.list-notice .link_url:hover {
  text-decoration: underline;
}

a.leia_mais:hover {
  background-color: rgb(0, 0, 0, 0.8);
  color: white;
}

a.leia_mais {
  font-size: 16px;
  font-family: "Roboto Condensed";
  font-weight: 500;
  border: 3px solid rgb(0, 0, 0, 0.8);
  border-radius: 0;
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


#carouselExampleCaptions .slide_image {
  height: 230px;
  margin-bottom: 20px;
  border-radius: 8px;
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

#carouselExampleCaptions {
  width: 60%;
  float: left;
}

div.carousel-indicators button {
  background-color: rgb(120, 120, 120, 0.9);
}

div.carousel button.carousel-control-prev span.carousel-control-prev-icon,
div.carousel button.carousel-control-next span.carousel-control-next-icon {
  background-color: rgba(20, 20, 20, 0.2);
}

section .container-geral i.mdi {
  font-size: 20px;
}


@media (max-width:768px) {
  section {
    width: 100%;
    margin: 0px;
    padding: 0px;
    display: flex;
    flex-direction: column;
  }

  .container-geral {
    width: 90%;
    margin: 0;
    padding: 0;
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    align-self: flex-start;
  }

  #carouselExampleCaptions .slide_image {
    width: 95%;
    height: auto;
  }

  .container-geral .left-news li {
    margin-left: 15px;
    line-height: 1.2em;
    list-style-type: disc;

  }

  .container-geral .left-news {
    width: 100%;
    margin: 5px;
    padding: 0;
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    align-self: flex-start;
  }

  .container-geral .right-news li {
    border: none;
    margin: 10px 10px;
    padding: 0;
  }

  .container-geral .right-news ul {
    display: block;
    padding: 0;
    margin: 0;
  }

  .container-geral .left-news ul {
    display: block;
    padding: 0;
    margin: 0;
  }

  .container-geral .right-news {
    width: 100%;
    margin: 0;
    margin-top: 40px;
    padding: 0;
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    align-self: flex-start;

  }

  p.data_info_title {
    margin-top: 0;
  }

  #carouselExampleCaptions {
    width: 90%;
    display: block;
  }

  div.carousel .text-center h5 {
    width: 100%;
    display: block;
    padding: 5px 20px;
  }

  h4.leia {
    font-size: 35px;
    border-left: 5px solid rgba(0, 0, 0, 0.8);
    color: rgba(0, 0, 0, 0.8);
    height: 25px;
    margin: 0;
    display: relative;
    margin-top: 20px;
    width: 100%;
  }


  .conteudo-extra {
    width: 100%;
    display: block;
    padding: 0;
    margin: 20px 10px;
  }
}
</style>
