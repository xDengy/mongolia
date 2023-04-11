<template>
  <template v-if="loading">
    <preloader-component />
  </template>

  <template v-if="!loading">
    <div class="personal-wrap fastregistration-form-wrap">
      <form class="fastregistration-form" @submit.prevent="submit">
        <input
            type="text"
            name="name"
            placeholder="Имя"
            v-model="data.name"
        />
        <input
            type="text"
            name="lastname"
            placeholder="Фамилия"
            v-model="data.lastname"
        />
        <input
            type="text"
            name="phone"
            placeholder="Телефон"
            v-mask="'+7 (###)-###-##-##'"
            v-model="data.phone"
        />
        <input
            type="email"
            id="fastregistration-form__mail"
            name="EMAIL"
            placeholder="E-mail"
            v-model="data.email"
        />
        <input
            type="password"
            id="fastregistration-form__password"
            placeholder="Пароль"
            v-model="data.password"
        />
        <input
            type="password"
            placeholder="Подтвердите пароль"
            v-model="data.passwordConfirm"
        />
        <button class="fastregistration-form__btn" type="submit">
          Сохранить
          <svg
              width="13"
              height="16"
              viewBox="0 0 13 16"
              fill="none"
              xmlns="http://www.w3.org/2000/svg"
          >
            <path
                d="M12.7071 8.70711C13.0976 8.31658 13.0976 7.68342 12.7071 7.29289L6.34315 0.928932C5.95262 0.538408 5.31946 0.538408 4.92893 0.928932C4.53841 1.31946 4.53841 1.95262 4.92893 2.34315L10.5858 8L4.92893 13.6569C4.53841 14.0474 4.53841 14.6805 4.92893 15.0711C5.31946 15.4616 5.95262 15.4616 6.34315 15.0711L12.7071 8.70711ZM0 9H12V7H0V9Z"
                fill="white"
            />
          </svg>
        </button>
      </form>
    </div>
  </template>
</template>

<script>
import { useToast } from "vue-toastification";

import { usePersonalStore } from "../store/personal";

export default {
  name: "personalComponent",
  props: [
    'grecaptchaSiteKey',
    'userData'
  ],
  watch: {},
  data() {
    return {
      loading: false,
      toast: useToast(),
      data: {
        id: this.userData.ID ?? '',
        name: this.userData.NAME ?? '',
        lastname: this.userData.LAST_NAME ?? '',
        phone: this.userData.PHONE_NUMBER ?? '',
        email: this.userData.EMAIL ?? '',
        password: '',
        passwordConfirm: ''
      },
      grecaptchaToken: '',
      personalStore: usePersonalStore()
    }
  },
  methods: {
    submit() {
      let formData = new FormData()

      formData.append('id', this.data.id)
      formData.append('name', this.data.name)
      formData.append('lastname', this.data.lastname)
      formData.append('phone', this.data.phone)
      formData.append('email', this.data.email)
      formData.append('password', this.data.password)
      formData.append('passwordConfirm', this.data.passwordConfirm)
      formData.append('grecaptchaToken', this.grecaptchaToken)


      axios.post('/local/api/handlers/Personal/personalHandler.php', formData)
        .then((response) => {
          if (response.data.success === 1) {
            this.toast.success(response.data.msg);
          } else {
            this.grecaptchaInit();
            this.toast.error(response.data.msg);
          }
        })
        .catch((error) => {
          this.toast.error("При авторизации возникла ошибка, перезагрузите страницу и повторите попытку");
          this.grecaptchaInit();
        });
    },
    grecaptchaInit() {
      this.loading = true;
      grecaptcha.ready(() => {
        grecaptcha.execute(this.grecaptchaSiteKey, { action: 'homepage' })
            .then((token) => {
              this.grecaptchaToken = token;
              this.loading = false;
            });
      });
    }
  },
  mounted() {
    this.grecaptchaInit();

    // this.personalStore.getPersonalMenu.forEach((e, i) => {
    //   console.log(e, i);
    // })
    // console.log(this.personalStore.$getters.personalMenu)
  }
}
</script>
