<template>
  <div class="wrap">
    <div class="favourites-top">
      <div class="favourites__subtitle">Ваш список товаров</div>
      <div class="favourites-top-sort" v-if="favsStore.favorites.length > 0">
          <div class="favourites-top__availability">
              <input
                      type="checkbox"
                      id="favourites-top__availability"
                      name="favourites-top__availability"
                      @change="setFilter"
              />
              <label for="favourites-top__availability">Снова в наличии</label>
          </div>
          <div class="favourites-top__selector" :class="selectorTop ? 'is-active' : ''">
              <div class="favourites-top__selector-top" @click="selectorTop = !selectorTop">
                  <div class="favourites-top__selector-text">
                      СОРтировать по
                  </div>
                  <svg
                          width="16"
                          height="9"
                          viewBox="0 0 16 9"
                          fill="none"
                          xmlns="http://www.w3.org/2000/svg"
                  >
                      <path
                              d="M7.29289 0.292893C7.68342 -0.097631 8.31658 -0.097631 8.70711 0.292893L15.0711 6.65685C15.4616 7.04738 15.4616 7.68054 15.0711 8.07107C14.6805 8.46159 14.0474 8.46159 13.6569 8.07107L8 2.41421L2.34315 8.07107C1.95262 8.46159 1.31946 8.46159 0.928932 8.07107C0.538408 7.68054 0.538408 7.04738 0.928932 6.65685L7.29289 0.292893ZM7 2L7 1L9 1L9 2L7 2Z"
                              fill="black"
                      />
                  </svg>
              </div>
              <div class="favourites-top__selector-bottom">
                  <div class="favourites-top__selector-item" @click="setSort('date', 'asc')">
                      По дате добавления
                  </div>
                  <div class="favourites-top__selector-item" @click="setSort('price', 'asc')">
                      По возрастанию цены
                  </div>
                  <div class="favourites-top__selector-item" @click="setSort('price', 'desc')">
                      По убыванию цены
                  </div>
                  <div class="favourites-top__selector-item" @click="setSort('avaliable', 'asc')">
                      Сначала в наличии
                  </div>
                  <div class="favourites-top__selector-item" @click="setSort('avaliable', 'desc')">
                      Сначала не в наличии
                  </div>
              </div>
          </div>
      </div>
    </div>
    <div class="favourites-cards" v-if="favsStore.favorites.length > 0">
      <div v-for="(item, index) in favsStore.displayFavorites" :key="index" :class="[
          'catalog-content__card',
          item.PRICE.RESULT_PRICE.DISCOUNT_PRICE < item.PRICE.RESULT_PRICE.BASE_PRICE ? 'catalog-content__card--discount' : '',
          item.QUANTITY.QUANTITY == 0 ? 'catalog-content__card--not' : '',
          item.PROPERTIES.NOVINKA.VALUE_XML_ID == 'YES' ? 'catalog-content__card--new' : '']">

          <div class="catalog-content__card-mark-wrapper">
            <div class="catalog-content__card-mark catalog-content__card-mark--discount" v-if="item.PRICE.RESULT_PRICE.DISCOUNT_PRICE < item.PRICE.RESULT_PRICE.BASE_PRICE">
              {{item.PRICE.DISCOUNT_DIFF}}%
            </div>
            <div class="catalog-content__card-mark catalog-content__card-mark--new" v-if="item.PROPERTIES.NOVINKA.VALUE_XML_ID == 'YES'">
              новинка
            </div>
          </div>

          <div class="catalog-content__card-close" @click="removeFromFavs(item.ID)">
              <svg
                      width="27"
                      height="27"
                      viewBox="0 0 27 27"
                      fill="none"
                      xmlns="http://www.w3.org/2000/svg"
              >
                  <g clip-path="url(#clip0_683_747)">
                      <path
                              d="M0.677734 27.0771L26.6826 0.873593"
                              stroke="black"
                              stroke-width="2"
                      />
                      <path
                              d="M26.6992 27.0771L0.677379 0.873595"
                              stroke="black"
                              stroke-width="2"
                      />
                  </g>
                  <defs>
                      <clipPath id="clip0_683_747">
                          <rect
                                  width="26"
                                  height="27"
                                  fill="white"
                                  transform="translate(0.462891)"
                          />
                      </clipPath>
                  </defs>
              </svg>
          </div>

          <a :href="item.DETAIL_PAGE_URL" class="catalog-content__card-img" >
            <img
                :src="item.PREVIEW_PICTURE.SRC"
                :data-src="item.PREVIEW_PICTURE.SRC"
                class="lozad"
            />
          </a>
          <div class="catalog-content__card-info">
            <a :href="item.DETAIL_PAGE_URL" class="catalog-content__card-title" >
              {{ item.NAME }}
            </a>
            <div class="catalog-content__card-subtitle">100% шерсть</div>

            <div class="catalog-content__card-availability">
                <span style="color: #8a9b6e" v-if="item.QUANTITY.QUANTITY > 0">Есть в наличии</span>
                <span style="color: #E49B9B" v-else>Нет в наличии</span>
            </div>
            <div class="catalog-content__card-info-bottom">
              <div class="catalog-content__card-price-wrap">
                <div class="catalog-content__card-price"> {{ item.PRICE.FORMATED_DISCOUNT_PRICE }} руб.</div>
                <div class="catalog-content__card-price--discount">
                  {{ item.PRICE.FORMATED_PRICE }} руб.
                </div>
              </div>

              <basket-add-product-component :product-id="item.ID" :quantity="JSON.stringify(item.QUANTITY)" />
            </div>
          </div>
      </div>
    </div>
    <div class="empty-favourites-cards" v-else>
        <div class="card__title">
            Ваш список товаров пуст
        </div>
        <div class="card__img">
            <img src="/local/templates/allmongolia_umax/assets/images/empty-favs.jpg">
        </div>
        <div class="card__info">
            Жмите на
            <svg width="40" height="36" viewBox="0 0 40 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M20.1916 30.5542L19.9999 30.7458L19.7891 30.5542C10.6849 22.2933 4.66659 16.8308 4.66659 11.2917C4.66659 7.45833 7.54159 4.58333 11.3749 4.58333C14.3266 4.58333 17.2016 6.5 18.2174 9.10667H21.7824C22.7983 6.5 25.6733 4.58333 28.6249 4.58333C32.4583 4.58333 35.3333 7.45833 35.3333 11.2917C35.3333 16.8308 29.3149 22.2933 20.1916 30.5542ZM28.6249 0.75C25.2899 0.75 22.0891 2.3025 19.9999 4.73667C17.9108 2.3025 14.7099 0.75 11.3749 0.75C5.47159 0.75 0.833252 5.36917 0.833252 11.2917C0.833252 18.5175 7.34992 24.44 17.2208 33.3908L19.9999 35.9208L22.7791 33.3908C32.6499 24.44 39.1666 18.5175 39.1666 11.2917C39.1666 5.36917 34.5283 0.75 28.6249 0.75Z" fill="black"/>
            </svg>
            на странице товара и добавляйте сюда то, что нравится.
        </div>
        <div class="card__link">
            <a href="/" class="product-items__bottom-item-content-form-btn">
                На главную <svg width="13" height="16" viewBox="0 0 13 16" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12.7071 8.70711C13.0976 8.31658 13.0976 7.68342 12.7071 7.29289L6.34315 0.928932C5.95262 0.538408 5.31946 0.538408 4.92893 0.928932C4.53841 1.31946 4.53841 1.95262 4.92893 2.34315L10.5858 8L4.92893 13.6569C4.53841 14.0474 4.53841 14.6805 4.92893 15.0711C5.31946 15.4616 5.95262 15.4616 6.34315 15.0711L12.7071 8.70711ZM0 9H12V7H0V9Z" fill="black"></path></svg>
            </a>
        </div>
    </div>
  </div>
</template>

<script>
import { useToast } from "vue-toastification";
import { useFavsStore } from "../store/favorites";
import basketAddProductComponent from './basketAddProductComponent';

export default {
  name: "favoritesProductComponent",
  props: [
    'userId',
    'ip',
  ],
  components: {
    basketAddProductComponent
  },
  data() {
    return {
      toast: useToast(),
      favsStore: useFavsStore(),
      favorites: [],
      page: 0,
      prodAvaliable: false,
      sort: false,
      order: false,
      ufName: null,
      selectorTop: false
    }
  },
  methods: {
    removeFromFavs(id) {
      this.favsStore.setFavs(id, this.ufName, false).then(() => {
        this.fetch()
      })
    },
    fetch() {
      this.favsStore.getFavs(this.ufName, this.prodAvaliable, this.sort, this.order)
    },
    setFilter(el) {
      this.prodAvaliable = el.target.checked
      this.fetch()
    },
    setSort(sort, order) {
      this.sort = sort
      this.order = order
      this.selectorTop = false
      this.fetch()
    }
  },
  watch: {
    'favsStore.displayFavorites': {
      handler: function () {
        // this.page++;
      }
    }
  },
  mounted() {
    this.ufName = this.userId;

    if (this.userId == 0) {
      this.ufName = this.ip
    }

    this.favsStore.getFavs(this.ufName, this.prodAvaliable, this.sort, this.order)

    $(window).scroll((el) => {
      var offset = $('.favourites-cards .catalog-content__card:last-child').offset();
      if(offset) {
        if ($(el.target).scrollTop() > offset.top && typeof this.favsStore.favorites[this.page + 1] !== 'undefined') {
          this.page++;
          this.favsStore.setDisplayFavs(this.page)
        }
      }
    });
  },
  beforeMount() {
  }
}
</script>
