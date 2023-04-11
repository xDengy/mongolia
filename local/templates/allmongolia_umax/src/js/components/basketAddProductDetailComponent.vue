
<template>
  <div
      class="product-page__btn product-page__btn--big"
      :class="{'active': productInBasket}"
      v-if="(parseInt(quantityVal.QUANTITY) - parseInt(quantityVal.QUANTITY_RESERVED)) > 0 && priceVal > 0"
      @click.prevent="basketStore.addToBasket(parseInt(productIdVal))"
  >
    <svg
      width="39"
      height="39"
      viewBox="0 0 39 39"
      fill="none"
      xmlns="http://www.w3.org/2000/svg"
    >
        <path
            d="M6.73075 6.49999L9.76625 26.221C9.82086 26.614 10.0171 26.9736 10.3181 27.2321C10.6192 27.4906 11.0042 27.6303 11.401 27.625H29.25C29.5996 27.625 29.9399 27.5123 30.2203 27.3036C30.5008 27.0948 30.7064 26.8012 30.8068 26.4664L35.6818 10.2164C35.7544 9.97374 35.7694 9.71747 35.7255 9.46803C35.6815 9.21859 35.5799 8.98287 35.4286 8.77969C35.2774 8.57652 35.0808 8.41151 34.8544 8.29784C34.6281 8.18416 34.3783 8.12497 34.125 8.12499H10.27L9.73375 4.65074C9.67958 4.253 9.47912 3.88973 9.1715 3.63186C8.87197 3.37902 8.49093 3.24335 8.099 3.24999H4.875C4.6616 3.24999 4.45029 3.29202 4.25314 3.37368C4.05599 3.45535 3.87685 3.57504 3.72595 3.72594C3.57506 3.87684 3.45536 4.05597 3.3737 4.25313C3.29203 4.45028 3.25 4.66159 3.25 4.87499C3.25 5.08839 3.29203 5.2997 3.3737 5.49685C3.45536 5.694 3.57506 5.87314 3.72595 6.02404C3.87685 6.17493 4.05599 6.29463 4.25314 6.37629C4.45029 6.45796 4.6616 6.49999 4.875 6.49999H6.73075V6.49999ZM12.7692 24.375L10.7705 11.375H31.941L28.041 24.375H12.7692V24.375ZM16.25 32.5C16.25 33.3619 15.9076 34.1886 15.2981 34.7981C14.6886 35.4076 13.862 35.75 13 35.75C12.138 35.75 11.3114 35.4076 10.7019 34.7981C10.0924 34.1886 9.75 33.3619 9.75 32.5C9.75 31.638 10.0924 30.8114 10.7019 30.2019C11.3114 29.5924 12.138 29.25 13 29.25C13.862 29.25 14.6886 29.5924 15.2981 30.2019C15.9076 30.8114 16.25 31.638 16.25 32.5V32.5ZM30.875 32.5C30.875 33.3619 30.5326 34.1886 29.9231 34.7981C29.3136 35.4076 28.487 35.75 27.625 35.75C26.763 35.75 25.9364 35.4076 25.3269 34.7981C24.7174 34.1886 24.375 33.3619 24.375 32.5C24.375 31.638 24.7174 30.8114 25.3269 30.2019C25.9364 29.5924 26.763 29.25 27.625 29.25C28.487 29.25 29.3136 29.5924 29.9231 30.2019C30.5326 30.8114 30.875 31.638 30.875 32.5V32.5Z"
            fill="white"
        />
    </svg>
    Добавить в корзину
  </div>
</template>

<script>
import { useToast } from "vue-toastification";
import { useBasketStore } from "../store/basket";

export default {
  name: "basketAddProductDetailComponent",
  props: [
      'productId',
      'quantity',
      'price',
      'size'
  ],
  data() {
    return {
      loading: true,
      toast: useToast(),
      basketStore: useBasketStore(),
      productInBasket: false,
      sizeVal: null,
      quantityVal: {
        QUANTITY: 0,
        QUANTITY_RESERVED: 0
      },
      productIdVal: 0,
      priceVal: 0,
    }
  },
  watch: {
    'basketStore.basketData.prod_count'() {
      this.productInBasket = this.basketStore.basketData.items.hasOwnProperty(this.productId);
    }
  },
  methods: {
    addToBasket() {
    }
  },
  mounted() {
    this.quantityVal = JSON.parse(this.quantity)
    this.productIdVal = this.productId
    this.priceVal = parseInt(this.price)
    this.sizeVal = this.size;

    this.basketStore.getBasket()
        .finally(() => {
          this.loading = false;
          this.productInBasket = this.basketStore.basketData.items.hasOwnProperty(this.productId);
        });

    document.addEventListener("product_set_size", (event) => {
      this.sizeVal = event.detail.size;
      if(event.detail.element.ITEM_PRICES.length > 0) {
        this.priceVal = event.detail.element.ITEM_PRICES[0].BASE_PRICE
      }
      this.quantityVal = event.detail.element.QUANTITY
      this.productIdVal = event.detail.element.ID
    });
  },
}
</script>
