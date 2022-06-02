<template>
  <div class="absolute bottom-0 left-0 right-0 z-40 w-full">
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
      <h4 class="-mt-1 text-center">Version : 0.1</h4>
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
        <div class="m-auto mt-12 md:mt-0 font-default">
          <h4 class="text-xl font-bold">Prix du GST sur la BNC</h4>
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
    <div
      class="mt-12 text-xl animate__animated animate__fadeIn animate__delay-2s"
    >
      <button
        v-if="!modal"
        @click="alert('dd')"
        class="px-4 py-2 m-auto rounded  bg-neutral-700 animate__animated animate__fadeIn"
      >
        Se sd
      </button>
      <div v-if="modal" class="animate__animated animate__slideInLeft">
        <div class="flex justify-center gap-4">
          <div
            class="inline-block p-2 rounded cursor-pointer h-9 bg-neutral-700"
          >
            <button v-on:click="alert('')">
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
          <div class="inline-block p-2 rounded font-default bg-neutral-700">
            <h1>Connexion</h1>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>


<script>
export default {
  name: "MainPage",
  data() {
    return {
      modal: false,
      gstBNCPrice: null,
      gstSOLPrice: null,
      bncResult: "00.00",
      solResult: "00.00",
    };
  },
  methods: {
    gstBnc: function () {
      this.bncResult = this.bncInput * this.gstBNCPrice;
    },
    gstSol: function () {
      this.solResult = this.solInput * this.gstSOLPrice;
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