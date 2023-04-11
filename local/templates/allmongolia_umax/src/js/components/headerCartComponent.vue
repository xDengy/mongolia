<template>
  <a class="header__menu-link" href="/cart/">
    <div class="header__icon">
      <div class="header__icon--counter" v-if="showItems"></div>
      <svg
          viewBox="0 0 16 21"
          fill="none"
          xmlns="http://www.w3.org/2000/svg"
      >
        <rect x="0.5" y="6.75" width="15" height="13"
              stroke="white"/>
        <path
            d="M3.5 3.75002C6 -0.249969 9.5 -0.25 12.5 3.75002"
            stroke="white"
            stroke-width="1.5"
        />
      </svg>
    </div>
    <span>корзина</span>
  </a>
</template>

<script>
import { useBasketStore } from "../store/basket";

export default {
  name: "headerCartComponent",
  data() {
    return {
      basketStore: useBasketStore(),
      showItems: false
    }
  },
  mounted() {
    this.basketStore.getBasket()
        .finally(() => {
          this.loading = false;
        });
        
    this.basketStore.$subscribe((mutation, state) => {
      if (_.size(state.basketData.items) > 0) {
        this.showItems = true;
      } else {
        this.showItems = false;
      }
    })
  }
}
</script>
