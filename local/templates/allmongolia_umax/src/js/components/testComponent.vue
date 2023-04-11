<template>
  <div>{{ name }}</div>
</template>

<script>
import { defineComponent } from "vue";

export default defineComponent ({
  name: "testComponent",
  watch: {},
  data()
  {
    return {
      name: 'Я vue компонент',
    }
  }
})
</script>
