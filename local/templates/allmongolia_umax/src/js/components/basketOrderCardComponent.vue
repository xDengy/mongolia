
<template>
  <div class="cart-products__card">
    <div class="cart-products__card-img">
      <img :data-src="product.picture.src" class="lozad" />
    </div>
    <div class="cart-products__card-wrap">
      <div class="cart-products__card-info">
        <div class="cart-products__card-info-top">
          <a :href="product.DETAIL_PAGE_URL" class="cart-products__card-name">
            {{ product.NAME }}
          </a>
          <div class="cart-products__card-model">Модель: kf30</div>
        </div>
        <div class="cart-products__card-parameters">
          Цвет: Коричневый | Размер: 52
          <!-- <div class="cart-products__card-color">Цвет: Коричневый </div>
          <div class="cart-products__card-size">| Размер: 52</div> -->
        </div>
      </div>
      <div class="cart-products__card-cont">
        <div class="cart-products__card-counter">
          <input
              type="number"
              class="cart-products__card-number"
              v-model.number="productData.quantity"
              @change="basketStore.productSetQuantity(productData)"
          />
        </div>
        <div class="cart-products__card-right">
          <div class="cart-products__card-price">{{ calcPrice }} руб</div>
          <div class="cart-products__card-delete" @click.prevent="basketStore.deleteFromBasket(product.ID)">
            <svg
                width="17"
                height="20"
                viewBox="0 0 17 20"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
            >
              <path
                  fill-rule="evenodd"
                  clip-rule="evenodd"
                  d="M6.42995 0.0382218C6.1316 0.0967502 5.72108 0.319807 5.49416 0.546731C5.11509 0.925837 4.94568 1.40864 4.94384 2.11524L4.94306 2.41804L3.76116 2.41882C2.4313 2.41968 2.13882 2.44855 1.78515 2.61378C1.46801 2.76194 1.09113 3.13554 0.945824 3.44572C0.619776 4.14189 0.759534 4.94711 1.29934 5.48261C1.48586 5.66765 1.92678 5.93443 2.0461 5.93443C2.07759 5.93443 2.09229 7.58143 2.09994 11.9611L2.11041 17.9878L2.21684 18.3004C2.3643 18.7333 2.57352 19.068 2.87292 19.35C3.17991 19.6391 3.50658 19.8193 3.91143 19.9228C4.20372 19.9976 4.36048 20 8.88924 20C13.418 20 13.5748 19.9976 13.867 19.9228C14.8174 19.6797 15.499 18.8911 15.6477 17.8622C15.6714 17.6985 15.6863 15.3681 15.6868 11.7688L15.6876 5.94049L15.8341 5.89266C16.3933 5.71012 16.8793 5.11417 16.9803 4.48693C17.0866 3.8269 16.7567 3.09068 16.1924 2.72857C15.7665 2.45531 15.6993 2.44515 14.1989 2.4273L12.8471 2.41124L12.8225 1.95415C12.7952 1.44771 12.7151 1.15483 12.5211 0.852423C12.2597 0.445147 11.7873 0.12492 11.3159 0.0355259C11.0576 -0.0134692 6.68126 -0.0110468 6.42995 0.0382218ZM11.3711 1.01762C11.7212 1.20973 11.861 1.47932 11.8884 2.01522L11.9089 2.41804H8.89053H5.87213L5.88651 1.99802C5.89933 1.6249 5.91288 1.55758 6.00822 1.39496C6.06721 1.29432 6.17056 1.17273 6.23784 1.12483C6.50551 0.934238 6.49434 0.93498 8.94784 0.944201C11.0101 0.951976 11.2655 0.959712 11.3711 1.01762ZM15.5899 3.4594C15.7891 3.56657 15.9015 3.68781 15.9833 3.88351C16.1337 4.24359 16.0099 4.67521 15.6919 4.8987L15.5246 5.01626L8.97379 5.02775C4.40044 5.0358 2.3793 5.02665 2.27822 4.99743C1.88908 4.8849 1.63961 4.43528 1.73822 4.02413C1.81238 3.715 2.0613 3.47131 2.38391 3.392C2.44838 3.37614 5.41094 3.3659 8.96738 3.36922L15.4336 3.37528L15.5899 3.4594ZM14.7409 11.7365C14.7481 15.655 14.7383 17.5668 14.7099 17.7534C14.6276 18.2937 14.3488 18.6928 13.8989 18.9143L13.638 19.0428L8.99176 19.0533C3.95113 19.0648 4.08417 19.0698 3.74225 18.854C3.42234 18.652 3.1572 18.2581 3.0725 17.8589C3.04113 17.7109 3.02858 15.9873 3.02858 11.8126V5.97323L8.87947 5.98315L14.7304 5.99304L14.7409 11.7365ZM5.81099 7.37771C5.74781 7.44089 5.6849 7.54857 5.67123 7.61702C5.65756 7.68548 5.64634 9.73538 5.64634 12.1724C5.64634 16.8966 5.64083 16.7552 5.83146 16.9248C5.94942 17.0298 6.15911 17.0505 6.32192 16.9732C6.60108 16.8408 6.58405 17.1558 6.58405 12.1291C6.58405 7.22342 6.59503 7.47305 6.37252 7.32723C6.31836 7.29176 6.19603 7.26285 6.10003 7.26285C5.95938 7.26285 5.90374 7.28496 5.81099 7.37771ZM8.60964 7.35095C8.5526 7.3992 8.48665 7.47707 8.46313 7.524C8.43293 7.58432 8.42038 8.93438 8.42038 12.1285C8.42038 17.1559 8.40335 16.8408 8.68251 16.9732C8.84532 17.0505 9.05501 17.0298 9.17297 16.9248C9.3636 16.7552 9.35809 16.8966 9.35809 12.1724C9.35809 9.73538 9.34688 7.68548 9.3332 7.61702C9.31953 7.54857 9.25662 7.44089 9.19344 7.37771C9.04368 7.22795 8.76999 7.21537 8.60964 7.35095ZM11.3273 7.39569L11.1944 7.52853V12.1057C11.1944 16.0363 11.2025 16.6984 11.2513 16.7929C11.3135 16.913 11.522 17.0306 11.6732 17.0306C11.8192 17.0306 12.0284 16.8696 12.0811 16.7167C12.1425 16.5384 12.1526 7.8266 12.0917 7.60722C12.0334 7.39717 11.8559 7.26285 11.6368 7.26285C11.4879 7.26285 11.4392 7.28379 11.3273 7.39569Z"
                  fill="black"
              />
            </svg>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { useToast } from "vue-toastification";
import { useBasketStore } from "../store/basket";

export default {
  name: "basketOrderCardComponent",
  props: [
    'product'
  ],
  watch: {
    'productData.quantity'(newQuantity) {
      if (newQuantity >= this.minProductQuantity) {
        this.basketStore.productSetQuantity(this.productData);
      }
    }
  },
  data() {
    return {
      loading: false,
      toast: useToast(),
      minProductQuantity: 1,
      basketStore: useBasketStore(),
      productData: {
        'id': this.product.ID,
        'product_id': this.product.PRODUCT_ID,
        'quantity': this.product.QUANTITY
      }
    }
  },
  computed: {
    calcPrice() {
      return Math.round(this.product.BASE_PRICE * this.product.QUANTITY, 2);
    }
  },
  methods: {
    productIncrement() {
      this.productData.quantity++;
    },
    productDecrement() {
      if (this.productData.quantity > this.minProductQuantity) {
        this.productData.quantity--;
      }
    },
    numbersOnly(evt) {
      evt = (evt) ? evt : window.event;
      let charCode = (evt.which) ? evt.which : evt.keyCode;
      if ((charCode > 31 && (charCode < 48 || charCode > 57)) && charCode !== 46) {
        evt.preventDefault();
      } else {
        return true;
      }
    }
  },
  mounted() {
    // Инициализация lazy-load
    lozadInit();
  }
}
</script>
