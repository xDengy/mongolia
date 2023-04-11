
<template>
  <div
      class="catalog-content__card-basket"
      :class="{'active': productInBasket}"
      v-if="(parseInt(quantity.QUANTITY) - parseInt(quantity.QUANTITY_RESERVED)) > 0"
      @click.prevent="!isOffer ? basketStore.addToBasket(parseInt(productId)) : redirectToProduct()"
  >
    <div class="catalog-content__card-basket-icon">
      <svg
          width="25"
          height="25"
          viewBox="0 0 25 25"
          fill="none"
          xmlns="http://www.w3.org/2000/svg"
      >
        <path
            d="M4.31475 4.16673L6.26058 16.8084C6.29559 17.0603 6.42139 17.2908 6.61436 17.4566C6.80732 17.6223 7.05416 17.7118 7.3085 17.7084H18.7502C18.9743 17.7084 19.1924 17.6362 19.3722 17.5024C19.5519 17.3686 19.6838 17.1804 19.7481 16.9657L22.8731 6.54903C22.9197 6.3935 22.9293 6.22922 22.9011 6.06932C22.8729 5.90943 22.8078 5.75833 22.7108 5.62808C22.6139 5.49784 22.4878 5.39207 22.3427 5.3192C22.1976 5.24633 22.0375 5.20839 21.8752 5.2084H6.5835L6.23975 2.98132C6.20502 2.72636 6.07652 2.49349 5.87933 2.32819C5.68732 2.16611 5.44306 2.07914 5.19183 2.0834H3.12516C2.98837 2.0834 2.85291 2.11034 2.72653 2.16269C2.60015 2.21504 2.48532 2.29177 2.38859 2.3885C2.29187 2.48523 2.21514 2.60006 2.16279 2.72644C2.11044 2.85282 2.0835 2.98827 2.0835 3.12507C2.0835 3.26186 2.11044 3.39732 2.16279 3.5237C2.21514 3.65008 2.29187 3.76491 2.38859 3.86164C2.48532 3.95837 2.60015 4.03509 2.72653 4.08744C2.85291 4.13979 2.98837 4.16673 3.12516 4.16673H4.31475ZM8.18558 15.6251L6.90433 7.29173H20.4752L17.9752 15.6251H8.18558ZM10.4168 20.8334C10.4168 21.3859 10.1973 21.9158 9.80663 22.3065C9.41593 22.6972 8.88603 22.9167 8.3335 22.9167C7.78096 22.9167 7.25106 22.6972 6.86036 22.3065C6.46966 21.9158 6.25016 21.3859 6.25016 20.8334C6.25016 20.2809 6.46966 19.751 6.86036 19.3603C7.25106 18.9696 7.78096 18.7501 8.3335 18.7501C8.88603 18.7501 9.41593 18.9696 9.80663 19.3603C10.1973 19.751 10.4168 20.2809 10.4168 20.8334ZM19.7918 20.8334C19.7918 21.3859 19.5723 21.9158 19.1816 22.3065C18.7909 22.6972 18.261 22.9167 17.7085 22.9167C17.156 22.9167 16.6261 22.6972 16.2354 22.3065C15.8447 21.9158 15.6252 21.3859 15.6252 20.8334C15.6252 20.2809 15.8447 19.751 16.2354 19.3603C16.6261 18.9696 17.156 18.7501 17.7085 18.7501C18.261 18.7501 18.7909 18.9696 19.1816 19.3603C19.5723 19.751 19.7918 20.2809 19.7918 20.8334Z"
            fill="white"
        />
      </svg>
    </div>
    <div class="catalog-content__card-basket-counter">
      {{ productInBasket ? basketStore.basketData?.items[parseInt(productId)]['QUANTITY'] : 0 }}
    </div>
  </div>
</template>

<script>
import { useToast } from "vue-toastification";
import { useBasketStore } from "../store/basket";

export default {
  name: "basketAddProductComponent",
  props: [
      'productId',
      'quantity',
      'isOffer',
      'detailPage',
  ],
  data() {
    return {
      loading: true,
      toast: useToast(),
      basketStore: useBasketStore(),
      productInBasket: false,
    }
  },
  watch: {
    'basketStore.basketData.prod_count'() {
      this.productInBasket = this.basketStore.basketData.items.hasOwnProperty(this.productId);
    }
  },
  methods: {
    redirectToProduct() {
      window.location.href = this.detailPage
    }
  },
  mounted() {
    this.basketStore.getBasket()
        .finally(() => {
          this.loading = false;
          this.productInBasket = this.basketStore.basketData.items.hasOwnProperty(this.productId);
        });
  },
}
</script>
