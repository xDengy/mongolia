
<template>
  <div class="catalog-content__card-favourites">
    <input type="checkbox" :id="'catalog__card-favourites--' + productId" @change="addToFavs" :checked="favsStore.favsData ? Object.keys(favsStore.favsData).includes(productId) : false" />
    <label
        :for="'catalog__card-favourites--' + productId"
        name="catalog__card-favourites"
    >
    </label>
  </div>
</template>

<script>
import { useToast } from "vue-toastification";
import { useFavsStore } from "../store/favorites";

export default {
  name: "favoritesAddProductComponent",
  props: [
      'userId',
      'productId',
      'ip',
  ],
  data() {
    return {
      loading: true,
      toast: useToast(),
      favsStore: useFavsStore(),
      productInFavs: false,
      ufName: null
    }
  },
  methods: {
    addToFavs(el) {
      this.favsStore.setFavs(this.productId, this.ufName, el.target.checked);
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
