
<template>
  <form class="blogPage__comment-form" @submit.prevent="submit">
    <p class="blogPage__comment-title">оставить комментарий</p>
    <input type="text" class="blogPage__comment-input" placeholder="Имя*" v-model="formData.NAME" required>
    <textarea class="blogPage__comment-textarea" placeholder="Текст комментария" rows="10" v-model="formData.PREVIEW_TEXT" cols="20" name="text"></textarea>
    <button type="submit" name="submit" class="blogPage__comment-button">Отправить
      <svg width="13" height="16" viewBox="0 0 13 16" fill="none"
        xmlns="http://www.w3.org/2000/svg">
        <path
            d="M12.7071 8.70906C13.0976 8.31854 13.0976 7.68537 12.7071 7.29485L6.34315 0.930885C5.95262 0.540361 5.31946 0.540361 4.92893 0.930885C4.53841 1.32141 4.53841 1.95457 4.92893 2.3451L10.5858 8.00195L4.92893 13.6588C4.53841 14.0493 4.53841 14.6825 4.92893 15.073C5.31946 15.4635 5.95262 15.4635 6.34315 15.073L12.7071 8.70906ZM0 9.00195H12V7.00195H0V9.00195Z"
            fill="black" />
      </svg>
    </button>
  </form>
</template>

<script>
import { useToast } from "vue-toastification";

export default {
  name: "formBlogComponent",
  props: [
    'authUserName',
    'grecaptchaSiteKey',
    'iblock_comment',
    'element',
  ],
  watch: {},
  data() {
    return {
      toast: useToast(),
      formData: {
        NAME: (this.authUserName !== null || this.authUserName !== undefined || this.authUserName.length > 0) ? this.authUserName : '',
        PREVIEW_TEXT: ''
      },
      grecaptchaToken: '',
    }
  },
  methods: {
    submit() {
      let formData = new FormData()

      formData.append('NAME', this.formData.NAME)
      formData.append('PREVIEW_TEXT', this.formData.PREVIEW_TEXT)
      formData.append('iblock_comment', this.iblock_comment)
      formData.append('element', this.element)
      formData.append('grecaptchaToken', this.grecaptchaToken)

      axios.post('/local/api/handlers/BitrixForms/commentFormHandler.php', formData, {
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
  }
}
</script>
