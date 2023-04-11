<template>
  <button @click="open">
    Open Modal
  </button>
  <ModalsContainer />
</template>

<script>
import { ModalsContainer, useModal } from 'vue-final-modal';
import ModalConfirmPlainCss from './ModalConfirmPlainCss.vue';

const { open, close } = useModal({
  component: ModalConfirmPlainCss,
  attrs: {
    title: 'Hello World!',
    onConfirm() {
      close()
    },
  },
  slots: {
    default: '<p>The content of the modal</p>',
  },
})

export default {
  name: "Preview",
  components: {
    ModalsContainer
  },
  watch: {},
  data()
  {
    return {
      name: 'Я vue компонент',
    }
  },
  methods: {

  }
}
</script>
