
<template>
  <form @submit.prevent="subscribe" name="subscribe" method="post" class="footer__top-form">
      <label class="footer__top-label" for="GET-name">
          {{ formLabel }}
      </label>
      <input
              class="footer__top-input"
              id="GET-name"
              type="email"
              name="email"
              v-model="formData.email"
              placeholder="Введите свой email"
      />
      <button class="footer__top-button" type="submit"></button>
  </form>
</template>

<script>
import { useToast } from "vue-toastification";

export default {
  name: "subscribeFormComponent",
  props: [
      'formLabel',
      'userId',
  ],
  data() {
    return {
      toast: useToast(),
      formData: {
        email: null,
        userId: null
      }
    }
  },
  methods: {
    subscribe() {
      if(!this.formData.email) {
        this.toast.error("Введите EMAIL");
        return;
      }
      axios.post('/local/api/handlers/Subscribe/subs.php?action=subscribe', this.formData)
        .then(response => {
            if(response.data.popupStatus) {
              this.toast.success("Успешно");
            } else {
              this.toast.error("Произошла ошибка");
            }
        })
        .catch((error) => {
            this.toast.error("Произошла ошибка");
        })
        .finally(() => {
          this.formData.email = null
        })
    },
  },
  mounted() {
    this.formData.userId = this.userId
  }
}
</script>
