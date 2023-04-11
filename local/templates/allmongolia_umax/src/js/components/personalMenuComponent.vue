<template>
<!--  <template v-if="loading">-->
<!--    <preloader-component />-->
<!--  </template>-->

<!--  <template v-if="!loading">-->

<!--  </template>-->

  <tippy
      interactive="true"
      theme="umax_allmongolia"
      delay="2"
  >
    <div class="header__menu-link" href="/personal">
      <box-icon class="header__icon" name='user'></box-icon>
      <span>личный кабинет</span>
    </div>

    <template #content>
      <ul class="personal-list">
<!--        <h3 class="account-list-heading">Личный кабинет</h3>-->
        <li v-for="(row, index) in personalStore.getPersonalMenu" :key="index">
          <a class="account-list-link" :href="row.url">
            <box-icon :name="row.icon"></box-icon>
            {{ row.title }}
          </a>
        </li>
      </ul>
    </template>
  </tippy>
</template>

<script>
import { useToast } from "vue-toastification";
import { usePersonalStore } from "../store/personal";

export default {
  name: "personalMenuComponent",
  data() {
    return {
      loading: false,
      toast: useToast(),
      personalStore: usePersonalStore()
    }
  },
  methods: {
  },
  mounted() {
  }
}
</script>

<style scoped>
.personal-list {
  align-items: start;
  flex-direction: column;
  gap: 12px;
  max-width: 250px;
  margin-top: 0;
}

.personal-list li:last-child {
  display: flex;
}

.account-list-heading {
  font-weight: 500;
  font-size: 1.8rem;
  line-height: 2.2rem;
  margin-top: 5px;
  padding-bottom: 10px;
  border-bottom: 1px dashed #e2e2e2;
}

.account-list-link {
  font-size: 1.4rem;
  line-height: 1.7rem;
  color: #757575;
  margin-top: 0;
  display: flex;
  align-items: center;
  gap: 5px;
  transition: ease-in-out 0.25s;
}

.account-list-link:hover {
  color: #8a9b6e;
}

@media (max-width: 768px) {
  .personal-list {
    max-width: 230px;
  }

  .account-list-heading {
    font-size: 1.4rem;
    line-height: 1.7rem;
  }

  .header .personal-list .account-list-link {
    width: unset;
    height: unset;
    /*font-size: 1.2rem;*/
    /*line-height: 1.4rem;*/
  }
}
</style>
