
<template>
  <template v-if="loading">
    <preloader-component/>
  </template>

  <template v-if="!loading">
    <section class="fastregistration">
      <div class="wrap">
        <div class="fastregistration-form-wrap">

          <h2 class="fastregistration-form__title" v-if="step === 2">
            Введите код из письма
          </h2>

          <form class="fastregistration-form" @submit.prevent="submit">

            <template v-if="step === 1">
              <input
                  type="text"
                  name="phone"
                  placeholder="Телефон*"
                  v-model="userData.phone"
                  v-mask="'+7 (###)-###-##-##'"
                  required
              />
            </template>

            <template v-if="step === 2">
              <div class="code-wrapper">
                <v-otp-input
                    ref="otpInput"
                    input-classes="otp-input"
                    separator=""
                    :num-inputs="5"
                    :should-auto-focus="true"
                    :is-input-num="true"
                    :conditionalClass="['one', 'two', 'three', 'four']"
                    :placeholder="['*', '*', '*', '*', '*']"
                    @on-complete="handleOnCompleteCode"
                />
              </div>
            </template>

            <template v-if="step === 3">
              <input
                  type="password"
                  name="resetCode"
                  placeholder="Новый пароль*"
                  v-model="userData.password"
                  required
              />

              <input
                  type="password"
                  name="resetCode"
                  placeholder="Повторите новый пароль*"
                  v-model="userData.passwordConfirm"
                  required
              />
            </template>

            <button class="fastregistration-form__btn" type="submit" v-if="step !== 2">

              <template v-if="step === 1">
                Продолжить
              </template>

              <template v-if="step === 3">
                Восстановить пароль
              </template>

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
import VOtpInput from 'vue3-otp-input';

export default {
  name: "resetPasswordComponent",
  props: [
    'grecaptchaSiteKey'
  ],
  components: {
    VOtpInput,
  },
  watch: {},
  data() {
    return {
      loading: true,
      toast: useToast(),
      userData: {
        phone: '',
        password: '',
        passwordConfirm: ''
      },
      grecaptchaToken: '',
      hash_code: '',
      step: 1
    }
  },
  methods: {
    submit() {
      this.loading = true;
      let formData = new FormData();

      formData.append('phone', this.userData.phone);
      formData.append('step', this.step);
      formData.append('grecaptchaToken', this.grecaptchaToken);
      formData.append('password', this.userData.password);
      formData.append('passwordConfirm', this.userData.passwordConfirm);

      if (this.step === 1) {
        axios.post('/local/api/handlers/Auth/resetPasswordHandler.php', formData)
          .then((response) => {
            if (response.data.success === 1) {
              if (response.data.msg !== null) {
                this.toast.success(response.data.msg);
              }

              this.hash_code = response.data.hash_code;
              this.step = response.data.step;
              this.grecaptchaInit();
            } else {
              this.grecaptchaInit();
              this.toast.error(response.data.msg);
            }
          })
          .catch((error) => {
            this.grecaptchaInit();
            this.toast.error("При восстановлении пароля возникла ошибка, перезагрузите страницу и повторите попытку");
          })
          .finally(() => {
            this.loading = false;
          });
      }

      if (this.step === 3) {
        axios.post('/local/api/handlers/Auth/resetPasswordHandler.php', formData)
            .then((response) => {
              if (response.data.success === 1) {
                if (response.data.msg !== null) {
                  this.toast.success(response.data.msg);
                }

                this.hash_code = '';
                this.grecaptchaInit();

                if (parseInt(response.data.step) === 4) {
                  window.location.href = "/signin/";
                }
              } else {
                this.grecaptchaInit();
                this.toast.error(response.data.msg);
              }
            })
            .catch((error) => {
              this.grecaptchaInit();
              this.toast.error("При восстановлении пароля возникла ошибка, перезагрузите страницу и повторите попытку");
            })
            .finally(() => {
              this.loading = false;
            });
      }
    },
    handleOnCompleteCode(code) {
      this.loading = true;
      let formData = new FormData();

      formData.append('phone', this.userData.phone);
      formData.append('code', code);
      formData.append('hash_code', this.hash_code);
      formData.append('step', this.step);
      formData.append('grecaptchaToken', this.grecaptchaToken);

      if (this.step === 2) {
        axios.post('/local/api/handlers/Auth/resetPasswordHandler.php', formData)
            .then((response) => {
              if (response.data.success === 1) {
                if (response.data.msg !== null) {
                  this.toast.success(response.data.msg);
                }

                this.step = response.data.step;
                this.grecaptchaInit();
              } else {
                this.grecaptchaInit();
                this.toast.error(response.data.msg);
              }
            })
            .catch((error) => {
              this.grecaptchaInit();
              this.toast.error("При восстановлении пароля возникла ошибка, перезагрузите страницу и повторите попытку");
            })
            .finally(() => {
              this.loading = false;
            });
      }
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
