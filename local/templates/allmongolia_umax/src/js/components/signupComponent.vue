
<template>
  <template v-if="loading">
    <preloader-component/>
  </template>

  <template v-if="!loading">
    <section class="fastregistration">
    <div class="wrap">
      <div class="fastregistration-form-wrap">
        <h2 class="fastregistration-form__title">
          Заполните поля регистрации
        </h2>
        <div class="fastregistration-form__subtitle">
          При самовывозе оплата возможна только наличными
        </div>
        <form class="fastregistration-form" @submit.prevent="submit">
          <input
              type="text"
              name="firstname"
              placeholder="Имя"
              v-model="userData.firstname"
              required
          />
          <input
              type="text"
              name="lastname"
              placeholder="Фамилия"
              v-model="userData.lastname"
              required
          />
          <input
              type="text"
              name="phone"
              placeholder="Телефон"
              v-model="userData.phone"
              v-mask="'+7 (###)-###-##-##'"
              required
          />
          <input
              type="email"
              id="fastregistration-form__mail"
              name="email"
              placeholder="E-mail"
              v-model="userData.email"
              required
          />
          <input
              type="password"
              id="fastregistration-form__password"
              name="password"
              placeholder="Пароль"
              v-model="userData.password"
              autocomplete="off"
              required
          />
          <input
              type="password"
              id="fastregistration-form__password2"
              name="passwordConfirm"
              placeholder="Подтвердите пароль"
              v-model="userData.passwordConfirm"
              autocomplete="off"
              required
          />
          <button class="fastregistration-form__btn" type="submit">
            Зарегистрироваться
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
    </div>
  </section>
  </template>
</template>

<script>
import { useToast } from "vue-toastification";

export default {
  name: "signupComponent",
  props: [
    'grecaptchaSiteKey',
    'userId'
  ],
  watch: {},
  data() {
    return {
      loading: false,
      toast: useToast(),
      userData: {
        firstname: '',
        lastname: '',
        phone: '',
        email: '',
        password: '',
        passwordConfirm: ''
      },
      grecaptchaToken: '',
    }
  },
  methods: {
    submit() {
      this.loading = true;
      let formData = new FormData()

      formData.append('firstname', this.userData.firstname)
      formData.append('lastname', this.userData.lastname)
      formData.append('phone', this.userData.phone)
      formData.append('email', this.userData.email)
      formData.append('password', this.userData.password)
      formData.append('passwordConfirm', this.userData.passwordConfirm)
      formData.append('grecaptchaToken', this.grecaptchaToken)

      formData.append('userId', this.userId)

      axios.post('/local/api/handlers/Auth/singupHandler.php', formData)
        .then((response) => {
          if (response.data.success === 1) {
            this.toast.success(response.data.msg);

            window.location.href = '/signup/success/';
          } else {
            this.grecaptchaInit();
            this.toast.error(response.data.msg);
          }
        })
        .catch((error) => {
          this.grecaptchaInit();
          this.toast.error("При регистрации возникла ошибка, перезагрузите страницу и повторите попытку");
        })
        .finally(() => {
          this.loading = false;
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
  }
}
</script>
