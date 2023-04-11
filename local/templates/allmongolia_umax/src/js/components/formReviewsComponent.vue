
<template>
  <form class="product-items__bottom-item-content-form" enctype="multipart/form-data" @submit.prevent="submit">
    <div class="product-items__bottom-item-content-form-title">
        Оставить отзыв
    </div>
    <input
        type="text"
        id="product-items__form-input--name"
        name="NAME"
        v-model="formData.NAME"
        placeholder="Имя*"
        required
    />
    <input
        type="text"
        id="product-items__form-input--phone"
        name="PHONE"
        v-model="formData.PHONE"
        placeholder="Телефон"
    />
    <div class="product-items__bottom-item-content-form-add">
        <input
            type="file"
            id="product-items__form-file"
            name="file[]" ref="files" @change="handleFiles" multiple accept=".webp"
        />
        <label for="product-items__form-file"> Добавить фото </label>
    </div>
    <textarea
        name="PREVIEW_TEXT"
        v-model="formData.PREVIEW_TEXT"
        id="product-items__form-text"
        placeholder="Введите текст"
    ></textarea>

    <div class="rating-area">
        <input type="radio" @change="formData.rating = 5" id="star-5" name="rating" value="5" />
        <label for="star-5" title="Оценка «5»"></label>
        <input type="radio" @change="formData.rating = 4" id="star-4" name="rating" value="4" />
        <label for="star-4" title="Оценка «4»"></label>
        <input type="radio" @change="formData.rating = 3" id="star-3" name="rating" value="3" />
        <label for="star-3" title="Оценка «3»"></label>
        <input type="radio" @change="formData.rating = 2" id="star-2" name="rating" value="2" />
        <label for="star-2" title="Оценка «2»"></label>
        <input type="radio" @change="formData.rating = 1" id="star-1" name="rating" value="1" checked/>
        <label for="star-1" title="Оценка «1»"></label>
    </div>

    <button type="submit" name="submit" class="product-items__bottom-item-content-form-btn">
        Отправить
        <svg
            width="13"
            height="16"
            viewBox="0 0 13 16"
            fill="none"
            xmlns="http://www.w3.org/2000/svg"
        >
          <path
              d="M12.7071 8.70711C13.0976 8.31658 13.0976 7.68342 12.7071 7.29289L6.34315 0.928932C5.95262 0.538408 5.31946 0.538408 4.92893 0.928932C4.53841 1.31946 4.53841 1.95262 4.92893 2.34315L10.5858 8L4.92893 13.6569C4.53841 14.0474 4.53841 14.6805 4.92893 15.0711C5.31946 15.4616 5.95262 15.4616 6.34315 15.0711L12.7071 8.70711ZM0 9H12V7H0V9Z"
              fill="black"
          />
        </svg>
    </button>
</form>
</template>

<script>
import { useToast } from "vue-toastification";

export default {
  name: "formReviewsComponent",
  props: [
    'authUserName',
    'grecaptchaSiteKey',
    'iblock_review',
    'element',
  ],
  watch: {},
  data() {
    return {
      toast: useToast(),
      formData: {
        NAME: (this.authUserName !== null || this.authUserName !== undefined || this.authUserName.length > 0) ? this.authUserName : '',
        rating: 1
      },
      grecaptchaToken: '',
      size: null,
      files: []
    }
  },
  methods: {
    submit() {
      // 'group',
      let formData = new FormData()

      formData.append('NAME', this.formData.NAME)
      formData.append('PHONE', this.formData.PHONE)
      formData.append('PREVIEW_TEXT', this.formData.PREVIEW_TEXT)
      formData.append('rating', this.formData.rating)
      formData.append('size', this.size)
      formData.append('iblock_review', this.iblock_review)
      formData.append('element', this.element)
      formData.append('grecaptchaToken', this.grecaptchaToken)

      for (let i = 0; i < this.files.length; i++) {
        let file = this.files[i];
        formData.append('file[' + i + ']', file);
      }

      axios.post('/local/api/handlers/BitrixForms/reviewsFormHandler.php', formData, {
          headers: {
            'Content-Type': 'multipart/form-data'
          }
        })
        .then((response) => {
          if (response.data.success) {
            this.toast.success(response.data.success);
          } else {
            this.grecaptchaInit();
            this.toast.error(response.data.msg);
          }
        })
        .catch((error) => {
          this.grecaptchaInit();
          this.toast.error("При отправки формы произошла ошибка");
        })
        .finally(() => {
          this.$el.reset();
        })
    },
    handleFiles(event) {
      this.files = event.target.files;
    },
    grecaptchaInit() {
      grecaptcha.ready(() => {
        grecaptcha.execute(this.grecaptchaSiteKey, { action: 'homepage' })
            .then((token) => {
              this.grecaptchaToken = token;
            });
      });
    }
  },
  mounted() {
    this.grecaptchaInit();
    document.addEventListener("product_set_size", (event) => {
      this.size = event.detail.sizeText;
    });
  }
}
</script>
