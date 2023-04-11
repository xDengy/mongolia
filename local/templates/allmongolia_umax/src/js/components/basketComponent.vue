
<template>
  <section class="cart-products">
      <div class="cart-products-left accordion2 is-active">
        <div class="cart-products__top accordion__header2">
          <div class="cart-products__top-title" v-if="!loading">Товары, {{ basketStore.basketData.prod_count }} шт.</div>
          <div class="cart-products__top-button">
            <span
                v-if="!loading && basketStore.basketData.prod_count > 0"
                @click.prevent="basketStore.clearBasket()"
            >
                Очистить корзину
            </span>
            <svg
                width="16"
                height="9"
                viewBox="0 0 16 9"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
            >
              <path
                  d="M8.70711 0.292893C8.31658 -0.0976311 7.68342 -0.0976311 7.29289 0.292893L0.928932 6.65685C0.538408 7.04738 0.538408 7.68054 0.928932 8.07107C1.31946 8.46159 1.95262 8.46159 2.34315 8.07107L8 2.41421L13.6569 8.07107C14.0474 8.46159 14.6805 8.46159 15.0711 8.07107C15.4616 7.68054 15.4616 7.04738 15.0711 6.65685L8.70711 0.292893ZM9 2V1H7V2H9Z"
                  fill="black"
              />
            </svg>
          </div>
        </div>
        <div class="cart-products__cards accordion__description2" :class="{loading: 'is-active'}">
          <template v-if="loading">
            <preloader-component/>
          </template>

          <template v-if="!loading">
            <basket-сard-сomponent
                v-if="parseInt(basketStore.basketData.prod_count) !== 0 && Object.size(basketStore.basketData.items)  !== 0"
                v-for="(product, product_id) in basketStore.basketData.items"
                :key="product_id"
                :product="product"
            />

            <div class="cart-products__empty" v-else>
              В вашей корзине ещё нет товаров
            </div>
          </template>
        </div>
      </div>
      <div class="cart-products-order-wrap cart-products-order-wrap--stock">
        <div class="cart-products-order">
          <div class="cart-products-order__title">Ваш заказ</div>

          <template v-if="loading">
            <preloader-component/>
          </template>

          <template v-if="!loading">
            <div class="cart-products-order__table">
            <div class="cart-products-order__line">
              <div
                  class="cart-products-order__col cart-products-order__col--1 cart-products-order__col--products"
              >
                Товары, {{ basketStore.basketData.prod_count }} шт.
              </div>
              <div
                  class="cart-products-order__col cart-products-order__col--2 cart-products-order__col--productsPrice"
              >
                {{ basketStore.basketData.basket_data.price_without_discount }} руб
              </div>
            </div>

            <div class="cart-products-order__line">
              <div
                  class="cart-products-order__col cart-products-order__col--1 cart-products-order__col--products"
              >
                Скидка
              </div>
              <div
                  class="cart-products-order__col cart-products-order__col--2 cart-products-order__col--productsPrice"
              >
                {{ basketStore.basketData.basket_data.discount_price_all }} руб
              </div>
            </div>

            <div class="cart-products-order__line">
              <div
                  class="cart-products-order__col cart-products-order__col--1 cart-products-order__col--total"
              >
                Итого:
              </div>
              <div
                  class="cart-products-order__col cart-products-order__col--2 cart-products-order__col--totalPrice"
              >
                {{ basketStore.basketData.basket_data.all_sum }} руб
              </div>
            </div>
          </div>
          </template>
        </div>
        <a href="/cart/order" class="cart__button" v-if="basketStore.basketData.items !== undefined && Object.keys(basketStore.basketData.items).length > 0"> перейти к оформлению </a>
      </div>
</section>
</template>

<script>
import { useToast } from "vue-toastification";
import { useBasketStore } from "../store/basket";

export default {
  name: "basketComponent",
  props: [
    // 'grecaptchaSiteKey'
  ],
  data() {
    return {
      loading: true,
      toast: useToast(),
      basketStore: useBasketStore()
    }
  },
  methods: {
    // getBasket() {
    //   this.loading = true;
    //
    // }
  },
  mounted() {
    this.basketStore.getBasket()
        .finally(() => {
          this.loading = false;
        });

    // console.log(this.basketStore.basketData.loading);
  },
  // update() {
  //   this.basketStore.getBasket()
  //       .finally(() => {
  //         this.loading = false;
  //       });
  // }
}
</script>
