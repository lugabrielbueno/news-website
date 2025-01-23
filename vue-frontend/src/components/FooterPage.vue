<template>
  <div class="container-footer">
    <h5>
      Inscreva-se para receber a nossa newsletter
      <i class="material-icons">coffee</i>
    </h5>
    <form
      @submit.prevent="receberForm"
      action="http://localhost:8001/subscribe.php"
      method="post"
      class="form-inline"
      name="newsletter_form"
    >
      <div class="form-group mr-auto">
        <label for="email" class="sr-only">Email</label>
      </div>
      <div class="form-group mr-auto">
        <div class="col-md-12">
          <input class="form-control" id="email" name="email" type="email" />
        </div>
      </div>
      <button class="btn btn-success btn-sm mr-auto">
        <i class="material-icons">check</i> Cadastrar
      </button>
    </form>
    <hr />
    <p>© {{ year }} All rights reserved</p>
  </div>
</template>
<script>
export default {
  name: "FooterPage",
  data() {
    return {
      year: new Date().getFullYear(),
    };
  },
  methods: {
    receberForm() {
      location.href = "http://localhost:5173/";
      sessionStorage.setItem("subscribed", true);
    },
  },
};
</script>
<style scoped>
@import url("https://fonts.googleapis.com/css2?family=Courier+Prime:ital,wght@0,400;0,700;1,400;1,700&family=Jersey+25&family=Markazi+Text:wght@400..700&family=Roboto+Slab:wght@100..900&family=VT323&display=swap");
hr {
  width: 70%;
  text-align: center;
}
h5 {
  text-align: center;
  width: 100%;
  font-size: 35px;
  font-family: "Markazi Text", serif;
}
p {
  text-align: center;
  font-family: "Markazi Text", serif;
  font-size: 18px;
}
form {
  width: 100%;
  margin-top: 25px;
  display: flex;
  justify-content: center;
  align-items: center;
  align-self: center;
  margin-bottom: 80px;
}
.container-footer {
  width: 100%;
  margin-top: 50px;
}
</style>
