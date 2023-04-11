
<template>
  <template v-if="loading">
    <preloader-component/>
  </template>

  <template v-if="!loading">
    <section class="entrance">
    <div class="wrap">
      <div class="entrance__registration">
        <div class="entrance__registration-title">
          У ВАС ЕЩЕ НЕТ АККАУНТА? ЗАРЕГИСТРИРУЙТЕСЬ СЕЙЧАС
        </div>
        <div class="entrance__registration-item">
          <div
              class="entrance__registration-item-icon entrance__registration-item-icon--1"
          >
            <svg
                width="50"
                height="31"
                viewBox="0 0 50 31"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
            >
              <path
                  d="M16.5386 29.0001C18.8327 29.0001 20.6925 27.1404 20.6925 24.8462C20.6925 22.5521 18.8327 20.6924 16.5386 20.6924C14.2445 20.6924 12.3848 22.5521 12.3848 24.8462C12.3848 27.1404 14.2445 29.0001 16.5386 29.0001Z"
                  stroke="black"
                  stroke-width="3"
                  stroke-miterlimit="1.5"
                  stroke-linecap="round"
                  stroke-linejoin="round"
              />
              <path
                  d="M37.3072 29.0001C39.6013 29.0001 41.461 27.1404 41.461 24.8462C41.461 22.5521 39.6013 20.6924 37.3072 20.6924C35.013 20.6924 33.1533 22.5521 33.1533 24.8462C33.1533 27.1404 35.013 29.0001 37.3072 29.0001Z"
                  stroke="black"
                  stroke-width="3"
                  stroke-miterlimit="1.5"
                  stroke-linecap="round"
                  stroke-linejoin="round"
              />
              <path
                  d="M20.7962 24.8462H31.0769V3.24615C31.0769 2.55792 30.5191 2 29.8308 2H2"
                  stroke="black"
                  stroke-width="3"
                  stroke-linecap="round"
              />
              <path
                  d="M11.6581 24.8459H7.40045C6.71222 24.8459 6.1543 24.2881 6.1543 23.5998V13.4229"
                  stroke="black"
                  stroke-width="3"
                  stroke-linecap="round"
              />
              <path
                  d="M4.07715 8.23047H12.3848"
                  stroke="black"
                  stroke-width="3"
                  stroke-linecap="round"
                  stroke-linejoin="round"
              />
              <path
                  d="M31.0771 8.23047H42.7289C43.2213 8.23047 43.6677 8.52049 43.8677 8.97052L47.5852 17.3349C47.656 17.4944 47.6925 17.6668 47.6925 17.841V23.5997C47.6925 24.288 47.1347 24.8459 46.4464 24.8459H42.5002"
                  stroke="black"
                  stroke-width="3"
                  stroke-linecap="round"
              />
              <path
                  d="M31.0771 24.8457H33.1541"
                  stroke="black"
                  stroke-width="3"
                  stroke-linecap="round"
              />
            </svg>
          </div>
          <div class="entrance__registration-item-text">
            Вы сможете контролировать состояние заказа, а также
            просматривать заказы сделанные ранее.
          </div>
        </div>
        <div class="entrance__registration-item">
          <div
              class="entrance__registration-item-icon entrance__registration-item-icon--2"
          >
            '<svg
              width="48"
              height="45"
              viewBox="0 0 48 45"
              fill="none"
              xmlns="http://www.w3.org/2000/svg"
          >
            <path
                d="M16.4922 14.2939L22.2068 2.78308C22.9403 1.30538 25.0597 1.30538 25.7932 2.78308L31.5077 14.2939L44.2873 16.1512C45.9269 16.3895 46.5803 18.3935 45.3934 19.543L36.1477 28.4968L38.3297 41.1459C38.61 42.7703 36.8951 44.0089 35.4279 43.2418L24 37.2664L12.572 43.2418C11.1049 44.0089 9.39 42.7703 9.67019 41.1459L11.8521 28.4968L2.60665 19.543C1.41958 18.3935 2.07309 16.3895 3.71275 16.1512L16.4922 14.2939Z"
                stroke="black"
                stroke-width="3"
                stroke-linecap="round"
                stroke-linejoin="round"
            />
          </svg>
          </div>
          <div class="entrance__registration-item-text">
            Вы сможете накапливать призовые баллы и получать скидочные
            купоны.
          </div>
        </div>
        <div class="entrance__registration-item">
          <div
              class="entrance__registration-item-icon entrance__registration-item-icon--3"
          >
            <svg
                width="50"
                height="49"
                viewBox="0 0 50 49"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
            >
              <path
                  d="M43.3996 24.5V46.12C43.3996 46.8822 42.7818 47.5 42.0196 47.5H7.97961C7.21746 47.5 6.59961 46.8822 6.59961 46.12V24.5"
                  stroke="black"
                  stroke-width="3"
                  stroke-linecap="round"
                  stroke-linejoin="round"
              />
              <path
                  d="M46.62 13H3.38C2.61785 13 2 13.6178 2 14.38V23.12C2 23.8822 2.61785 24.5 3.38 24.5H46.62C47.3822 24.5 48 23.8822 48 23.12V14.38C48 13.6178 47.3822 13 46.62 13Z"
                  stroke="black"
                  stroke-width="3"
                  stroke-linecap="round"
                  stroke-linejoin="round"
              />
              <path
                  d="M25 47.5V13"
                  stroke="black"
                  stroke-width="3"
                  stroke-linecap="round"
                  stroke-linejoin="round"
              />
              <path
                  d="M25.0004 13H14.6504C13.1254 13 11.6629 12.3942 10.5845 11.3159C9.50619 10.2375 8.90039 8.77499 8.90039 7.25C8.90039 5.72501 9.50619 4.26246 10.5845 3.18413C11.6629 2.1058 13.1254 1.5 14.6504 1.5C22.7004 1.5 25.0004 13 25.0004 13Z"
                  stroke="black"
                  stroke-width="3"
                  stroke-linecap="round"
                  stroke-linejoin="round"
              />
              <path
                  d="M25 13H35.35C36.8749 13 38.3375 12.3942 39.4159 11.3159C40.4942 10.2375 41.1 8.77499 41.1 7.25C41.1 5.72501 40.4942 4.26246 39.4159 3.18413C38.3375 2.1058 36.8749 1.5 35.35 1.5C27.3 1.5 25 13 25 13Z"
                  stroke="black"
                  stroke-width="3"
                  stroke-linecap="round"
                  stroke-linejoin="round"
              />
            </svg>
          </div>
          <div class="entrance__registration-item-text">
            Постоянным покупателям мы предлагаем гибкую систему скидок и
            персональное обслуживание.
          </div>
        </div>
        <a href="/signup/" class="entrance__registration-btn">
          Регистрация
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
        </a>
      </div>
      <form class="entrance__form" @submit.prevent="submit">
        <div class="entrance__form-title">
          У ВАС УЖЕ ЕСТЬ АККАУНТ? АВТОРИЗОВАТЬСЯ
        </div>
        <div class="entrance__form-subtitle">Войти в Личный Кабинет</div>
        <input
            type="text"
            name="entrance__form"
            placeholder="Телефон"
            v-model="userData.phone"
            v-mask="'+7 (###)-###-##-##'"
            required
        />
        <input
            type="password"
            id="entrance__form-password"
            name="entrance__form"
            placeholder="Пароль"
            v-model="userData.password"
            required
        />
        <div class="entrance__form-bottom">
          <button class="entrance__form-btn">
            Войти
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

          <a href="/signin/reset-password/" class="entrance__form-link">Забыли пароль?</a>
        </div>
      </form>
    </div>
  </section>
  </template>
</template>

<script>
// import { defineComponent } from "vue";
import { useToast } from "vue-toastification";

export default {
  name: "signinComponent",
  props: [
    'grecaptchaSiteKey'
  ],
  watch: {},
  data() {
    return {
      loading: true,
      toast: useToast(),
      userData: {
        phone: '',
        password: ''
      },
      grecaptchaToken: ''
    }
  },
  methods: {
    submit() {
      this.loading = true;
      let formData = new FormData()

      formData.append('phone', this.userData.phone)
      formData.append('password', this.userData.password)
      formData.append('grecaptchaToken', this.grecaptchaToken)


      axios.post('/local/api/handlers/Auth/singinHandler.php', formData)
        .then((response) => {
          if (response.data.success === 1) {
            this.toast.success(response.data.msg);

            window.location.href = '/personal/';
          } else {
            this.grecaptchaInit();
            this.toast.error(response.data.msg);
          }
        })
        .catch((error) => {
          this.toast.error("При авторизации возникла ошибка, перезагрузите страницу и повторите попытку");
          this.grecaptchaInit();
        })
        .finally(() => {
          this.loading = false;
        });
    },
    grecaptchaInit() {
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
