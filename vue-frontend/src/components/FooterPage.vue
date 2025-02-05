<template>
  <div class="container container-footer">
    <h5>
      Inscreva-se para receber a nossa newsletter
      <i class="mdi mdi-coffee"></i>
    </h5>
    <form @submit.prevent="receberForm" action="http://localhost:8001/subscribe.php" method="post"
      name="newsletter_form" id='newsletter_form'>
      <div class="container content">
        <div class="row">
          <div class='col-md-7 mx-auto'>
            <div class='form-group'>
              <label class='form-label'>Email
              </label>
              <input class="form-control" id="email" name="email" type="email" />
            </div>
          </div>
          <div class='row'>
            <div class='col-md-2 mx-auto'>
              <button class="btn cadastrar_news btn-sm" type='submit'>
                <i class="mdi mdi-check"></i><span class='btn-span'> Cadastrar</span>
              </button>
            </div>
          </div>
        </div>
      </div>
    </form>
  </div>
  <p class='rights'>© {{ year }} All rights reserved</p>
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
  align-items: center;
  align-self: center;
  justify-content: center;
}

h5 {
  text-align: center;
  width: 100%;
  font-size: 35px;
  font-family: "Markazi Text", serif;
}

p {
  text-align: center;
  align-items: center;
  align-self: center;
  justify-content: center;
  font-family: "Markazi Text", serif;
  font-size: 18px;
}

.container-footer #newsletter_form .col-md-7 {
  text-align: left;
}

.container-footer i.mdi {
  font-size: 20px;
}

.container-footer #newsletter_form {
  width: 100%;
  margin-top: 25px;
  margin-bottom: 80px;
  border: 1px solid rgb(0, 0, 0, 0.2);
  border-radius: 10px;
  padding: 20px;
}

.rights {
  width: 100%;
  background-color: rgba(0, 0, 0, 0.8);
  color: white;
  margin: 0;
  padding: 30px;
}

.container-footer {
  width: 100%;
  margin-top: 50px;
  flex-direction: column;

}

.btn-span {
  font-weight: bold;
}

.btn.cadastrar_news:hover {
  background-color: rgb(0, 0, 0, 0.8);
  color: white;
}

.btn.cadastrar_news {
  border: 3px solid rgb(0, 0, 0, 0.8);
  border-radius: 0;
  display: flex;
  align-items: center;


}

.row {
  margin-top: 10px;
}

input.form-control:focus {
  box-shadow:none;
}

input.form-control {
  border: 1px solid black;
}


@media (max-width:768px) {
  .container .container-footer {
    display: block;
  }

  .container .container-footer #newsletter_form {
    display: block;
  }
}
</style>
