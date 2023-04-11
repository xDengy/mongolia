
<template>
  <div class="product-page__btn product-page__btn--small" :class="{active: favsStore.favsData ? Object.keys(favsStore.favsData).includes(productId) : false}" @click="addToFavs">
      <svg
              width="38"
              height="38"
              viewBox="0 0 38 38"
              fill="none"
              xmlns="http://www.w3.org/2000/svg"
      >
          <path
                  d="M19 32.9531C18.8488 32.9507 18.7006 32.9098 18.5695 32.8343C18.4063 32.7601 14.725 30.6671 10.9844 27.3124C5.86328 22.696 3.26563 18.1093 3.26563 13.6562C3.26428 11.8138 3.85403 10.0195 4.94818 8.53713C6.04233 7.05477 7.58316 5.96251 9.3442 5.42091C11.1052 4.87931 12.9936 4.91693 14.7316 5.52826C16.4697 6.13958 17.9658 7.29236 19 8.81713C20.0342 7.29236 21.5303 6.13958 23.2684 5.52826C25.0064 4.91693 26.8948 4.87931 28.6558 5.42091C30.4168 5.96251 31.9577 7.05477 33.0518 8.53713C34.146 10.0195 34.7357 11.8138 34.7344 13.6562C34.7344 18.1093 32.1367 22.696 27.0156 27.3124C23.275 30.6671 19.5938 32.7601 19.4305 32.8343C19.2994 32.9098 19.1512 32.9507 19 32.9531Z"
                  fill="white"
          />
      </svg>
  </div>
</template>

<script>
import { useToast } from "vue-toastification";
import { useFavsStore } from "../store/favorites";

export default {
  name: "favoritesAddProductDetailComponent",
  props: [
      'userId',
      'productId',
      'ip'
  ],
  data() {
    return {
      toast: useToast(),
      favsStore: useFavsStore(),
      productInFavs: false,
      ufName: null
    }
  },
  methods: {
    addToFavs() {
      this.favsStore.setFavs(this.productId, this.ufName, this.favsStore.favsData ? !Object.keys(this.favsStore.favsData).includes(this.productId) : true);
      this.inFavs();
    },
    inFavs() {
      this.favsStore.inFavs(this.ufName)
    }
  },
  mounted() {
    this.ufName = this.userId;

    if (parseInt(this.userId) === 0) {
      this.ufName = this.ip
    }

    this.inFavs();
  },
}
</script>
