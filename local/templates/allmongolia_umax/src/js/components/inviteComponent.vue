
<template>
  <div class="invite">
      <span>
          Пригласи друга
      </span>
      <div @click="sendInvite">
          Пригласить
      </div>
  </div>
</template>

<script>
import { useToast } from "vue-toastification";

export default {
  name: "inviteComponent",
  props: [
    'userId',
  ],
  data() {
    return {
      loading: true,
      toast: useToast(),
    }
  },
  methods: {
    sendInvite() {
      let input = document.createElement('input');
      let str = 'userId=' + this.userId;
      input.value = 'http://allmongolia.umax.agency/signup/?' + btoa(str);
      input.style.position = "fixed";
      input.style.visibility = "-10000%";
      document.body.appendChild(input);
      input.focus();
      input.select();
      return new Promise((res, rej) => {
          document.execCommand('copy') ? res() : rej();
          input.remove();
          this.toast.success('Приглашение добавлено в буфер обмена');
      });
    }
  },
}
</script>
