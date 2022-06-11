<template>
  <div v-if="!logged" class="absolute bottom-0 left-0 right-0 z-0 w-screen">
    <div class="wave"></div>
    <div class="wave"></div>
  </div>
  <div class="z-0 h-screen text-white bg-zinc-800">
    <div
      id="version"
      class="font-default animate__animated animate__fadeIn animate__delay-1s"
    >
      <div class="flex justify-center">
        <img
          src="/assets/jogger.png"
          class="w-16 -mt-1"
          alt="nftIcon"
          style="transform: scaleX(-1) rotate(-12deg)"
        />

        <h1 class="pt-2 text-4xl font-bold">Step-tool</h1>
        <img
          src="/assets/jogger.png"
          class="w-16 -mt-1 -rotate-12"
          alt="nftIcon"
        />
      </div>
      <h4 class="-mt-1 text-center">
        Version : 1.0 -
        <a href="https://github.com/Coroxx/step-tool" target="_blank">
          Github</a
        >
      </h4>
      <div v-if="logged" class="mt-2 text-center">
        <button
          v-on:click="logout"
          class="p-1 m-auto text-base bg-red-500 rounded"
        >
          Se déconnecter
        </button>
      </div>
    </div>

    <div
      class="w-11/12 m-auto mt-6  animate__animated animate__fadeIn animate__delay-1s"
    >
      <div class="justify-center w-full text-center lg:flex">
        <div class="m-auto font-default">
          <h4 class="text-xl font-bold">Prix du GST sur la BNC</h4>
          <div class="flex justify-center mt-1">
            <p>{{ gstBNCPrice }}$</p>
            <img
              src="/assets/gst.png"
              class="w-5 h-5 ml-1 mt-0.5"
              alt="gstCoin"
            />
          </div>
          <div class="flex items-center justify-center gap-x-4">
            <input
              class="p-1.5 mt-2 rounded bg-neutral-700 focus:outline-none"
              placeholder="Montant à convertir"
              v-model="bncInput"
              type="text"
              v-on:input="gstBnc"
            />
            <div class="p-1.5 mt-2 rounded bg-neutral-700">
              {{ bncResult }} $
            </div>
          </div>
        </div>
        <div class="m-auto mt-12 lg:mt-0 font-default">
          <h4 class="text-xl font-bold">Prix du GST sur SOL</h4>
          <div class="flex justify-center mt-1">
            <p>{{ gstSOLPrice }}$</p>
            <img
              src="/assets/gst.png"
              class="w-5 h-5 ml-1 mt-0.5"
              alt="gstCoin"
            />
          </div>
          <div class="flex items-center justify-center gap-x-4">
            <input
              class="p-1.5 mt-2 rounded bg-neutral-700 focus:outline-none"
              placeholder="Montant à convertir"
              v-model="solInput"
              type="text"
              v-on:input="gstSol"
            />
            <div class="p-1.5 mt-2 rounded bg-neutral-700">
              {{ solResult }} $
            </div>
          </div>
        </div>
      </div>
    </div>
    <div v-if="logged" class="text-center font-default"></div>
    <div
      v-if="!logged"
      class="mt-12 text-xl animate__animated animate__fadeIn animate__delay-2s"
    >
      <div class="text-center font-default">
        <button
          v-if="!modal"
          v-on:click="modal = !modal"
          class="px-4 py-2 rounded  bg-neutral-700 animate__animated animate__fadeIn"
        >
          Se connecter
        </button>
      </div>
      <div
        v-if="modal"
        id="modal"
        class="m-auto text-center animate__animated animate__slideInLeft"
      >
        <div
          class="w-2/3 p-2 m-auto text-center rounded  z-80 lg:w-1/2 font-default"
        >
          <div
            class="inline-block p-2 mb-2 rounded cursor-pointer  h-9 bg-neutral-700"
          >
            <button v-on:click="modal = !modal">
              <svg
                xmlns="http://www.w3.org/2000/svg"
                class="w-5 h-5"
                viewBox="0 0 20 20"
                fill="currentColor"
              >
                <path
                  fill-rule="evenodd"
                  d="M7.707 14.707a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l2.293 2.293a1 1 0 010 1.414z"
                  clip-rule="evenodd"
                />
              </svg>
            </button>
          </div>
          <h1>Connexion</h1>
          <div class="mt-2 text-lg">
            <div class="p-2">
              <input
                v-model="data.name"
                type="text"
                class="px-2 py-1 rounded focus:outline-none bg-neutral-700"
                placeholder="Nom d'utilisateur"
                name="user"
              />
            </div>
            <div class="p-2">
              <input
                v-model="data.password"
                type="password"
                class="px-2 py-1 rounded focus:outline-none bg-neutral-700"
                placeholder="Mot de passe"
                name="password"
              />
            </div>
          </div>
          <button class="p-2 mt-1 text-base font-bold" v-on:click="login">
            Se connecter
          </button>
        </div>
      </div>
    </div>
    <div
      v-if="logged"
      class="w-11/12 m-auto mt-12  md:w-10/12 animate__animated animate__fadeIn animate__delay-1s"
    >
      <div class="mb-1 md:text-center">
        Nombre de GST gagnés
        <span class="text-green-500"
          >{{ gstAmount }} ≈
          {{ Number((gstAmount * gstSOLPrice).toFixed(2)) }}$</span
        >
      </div>
      <line-chart :data="runs" style="z-index: 9999"></line-chart>
      <div class="pt-2">
        <div class="font-bold lg:inline">
          ROI atteint dans :
          <span
            v-bind:class="
              Number(((700 / gstSOLPrice - gstAmount) / 8.3).toFixed(0)) > 45
                ? 'text-red-500'
                : 'text-green-500'
            "
          >
            {{ Number(((700 / gstSOLPrice - gstAmount) / 8.3).toFixed(0)) }}
            jours
          </span>
        </div>
        <div class="mt-3 lg:inline lg:mt-0 lg:float-right">
          <div class="flex">
            <div>
              <input
                type="text"
                v-model="form.earnedAmount"
                id="earnedAmount"
                class="p-1 rounded focus:outline-none bg-neutral-700"
                placeholder="Montant gagné aujourd'hui"
                style="width: 250px"
              />
            </div>
            <div class="ml-2" style="margin-top: 2.3px">
              <button v-on:click="addRun">Valider</button>
            </div>
          </div>
        </div>
      </div>
      <div class="py-8"></div>
    </div>
  </div>
</template>



<script>
export default {
  name: "MainPage",
  data() {
    return {
      data: {
        name: "",
        password: "",
      },
      modal: false,
      gstBNCPrice: null,
      gstSOLPrice: null,
      bncResult: "00.00",
      solResult: "00.00",
      logged: window.Laravel.logged,
      runs: [],
      gstAmount: null,
      form: {
        earnedAmount: "",
      },
    };
  },
  methods: {
    successNotification(message, delay) {
      this.$toast.open({
        message: message,
        type: "success",
        duration: delay,
        dismissible: true,
      });
    },
    errorNotification(message, delay) {
      this.$toast.open({
        message: message,
        type: "error",
        duration: delay,
        dismissible: true,
      });
    },
    gstBnc: function () {
      this.bncResult = this.bncInput * this.gstBNCPrice;
    },
    gstSol: function () {
      this.solResult = this.solInput * this.gstSOLPrice;
    },
    addRun: function () {
      axios
        .post("/new/run", this.form)
        .then((response) => {
          this.successNotification("Valeur ajoutée avec succès !", 4000);
          this.gstAmount += parseInt(this.form.earnedAmount);
          this.getRuns();
        })
        .catch((error) => {
          if (error.toJSON().status == 403) {
            this.errorNotification("Valeur déjà renseignée aujourd'hui", 5000);
          } else {
            console.log(error);
            this.errorNotification("Une erreur est survenue", 5000);
          }
        });
    },
    getRuns: function () {
      axios.get("/runs").then((response) => {
        this.gstAmount = response.data[0];
        this.runs = response.data[1].map((run) => [
          run.created_at.split("T")[0],
          run.amount,
        ]);
      });
    },
    login: function () {
      axios
        .post("/login", this.data)
        .then((response) => {
          this.successNotification("Connexion réussie ! Redirection...", 2500);
          reload();
        })
        .catch((error) => {
          this.errorNotification("Identifiants incorrects", 2500);
        });
    },
    logout: function () {
      axios.post("/logout").then((response) => {
        this.successNotification("Deconnexion réussie ! Redirection...", 2500);
        reload();
      });
    },
  },
  mounted() {
    axios
      .get("https://api.coingecko.com/api/v3/coins/green-satoshi-token-bsc")
      .then(
        (response) =>
          (this.gstBNCPrice = Number(
            response.data.market_data.current_price.usd.toFixed(3)
          ))
      );
    axios
      .get("https://api.coingecko.com/api/v3/coins/green-satoshi-token")
      .then(
        (response) =>
          (this.gstSOLPrice = Number(
            response.data.market_data.current_price.usd.toFixed(3)
          ))
      );
    this.getRuns();
  },
};
</script>


<style scoped>
@import url(https://fonts.googleapis.com/css2?family=Roboto&display=swap);
.wave {
  background: url(/assets/wave.svg) repeat-x;
  position: absolute;
  top: -168px;
  width: 6400px;
  height: 168px;
  -webkit-animation: wave 12s cubic-bezier(0.36, 0.45, 0.63, 0.53) infinite;
  animation: wave 12s cubic-bezier(0.36, 0.45, 0.63, 0.53) infinite;
  transform: translateZ(0);
}
.wave:nth-of-type(2) {
  top: -145px;
  -webkit-animation: wave 12s cubic-bezier(0.36, 0.45, 0.63, 0.53) -0.725s infinite,
    swell 7s ease -1.25s infinite;
  animation: wave 12s cubic-bezier(0.36, 0.45, 0.63, 0.53) -0.725s infinite,
    swell 7s ease -1.25s infinite;
  opacity: 1;
}
@-webkit-keyframes wave {
  0% {
    margin-left: 0;
  }
  to {
    margin-left: -1600px;
  }
}
@keyframes wave {
  0% {
    margin-left: 0;
  }
  to {
    margin-left: -1600px;
  }
}
@-webkit-keyframes swell {
  0%,
  to {
    transform: translate3d(0, -25px, 0);
  }
  50% {
    transform: translate3d(0, 5px, 0);
  }
}
@keyframes swell {
  0%,
  to {
    transform: translate3d(0, -25px, 0);
  }
  50% {
    transform: translate3d(0, 5px, 0);
  }
}
.spin {
  -webkit-animation: spin 3s linear 0s infinite;
  animation: spin 3s linear 0s infinite;
}
@-webkit-keyframes spin {
  0% {
    transform: rotate(0);
  }
  to {
    transform: rotate(1turn);
  }
}
@keyframes spin {
  0% {
    transform: rotate(0);
  }
  to {
    transform: rotate(1turn);
  }
}
</style>