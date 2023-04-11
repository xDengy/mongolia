
<template>
  <form class="contacts-bottom__feedback" @submit.prevent="submit">
    <div class="contacts-bottom__feedback-title">
      Форма обратной связи
    </div>
    <input
        type="text"
        id="contacts-bottom__feedback--name"
        name="firstname"
        placeholder="ФИО*"
        v-model="formData.firstname"
        required
    />
    <input
        type="text"
        id="contacts-bottom__feedback--phone"
        name="phone"
        placeholder="Телефон*"
        v-model="formData.phone"
        required
    />
    <textarea
        id="contacts-bottom__feedback--text"
        name="message"
        v-model="formData.message"
        placeholder="Введите текст"
    />
    <button class="contacts-bottom__feedback-btn" type="submit">
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
// import { defineComponent } from "vue";
import { useToast } from "vue-toastification";

export default {
  name: "formFeedbackComponent",
  props: [
    'authUserName',
    'grecaptchaSiteKey'
  ],
  watch: {},
  data() {
    return {
      toast: useToast(),
      formData: {
        firstname: (this.authUserName !== null || this.authUserName !== undefined || this.authUserName.length > 0) ? this.authUserName : '',
        phone: '',
        message: ''
      },
      grecaptchaToken: ''
    }
  },
  methods: {
    submit() {
      let formData = new FormData()

      formData.append('firstname', this.formData.firstname)
      formData.append('phone', this.formData.phone)
      formData.append('message', this.formData.message)
      formData.append('grecaptchaToken', this.grecaptchaToken)

      axios.post('/local/api/handlers/BitrixForms/feedbackFormHandler.php', formData)
        .then((response) => {
          if (response.data.success === 1) {
            this.toast.success(response.data.msg);
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
          document.querySelector('.contacts-bottom__feedback').reset();
        })
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
