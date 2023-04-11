import { defineStore } from 'pinia'

export const usePersonalStore = defineStore({
    id: 'personal',
    state: () => ({
        personalMenu: [
            {
                url: "/personal/",
                title: "Профиль",
                icon: 'user'
            },
            {
                url: "/favorite/",
                title: "Избранное",
                icon: 'heart'
            },
            {
                url: "/personal/orders/",
                title: "Мои заказы",
                icon: 'list-ul'
            },
            // {url: "/personal/files/", title: "Файлы для скачивания"},
            // {url: "/personal/recurring/", title: "Регулярные платежи"},
            {
                url: "/personal/bonuses/",
                title: "Бонусные баллы",
                icon: 'diamond'
            },
            {
                url: "/personal/logout/",
                title: "Выход",
                icon: 'log-out'
            }
        ]
    }),
    getters: {
        getPersonalMenu: (state) => state.personalMenu
    },
    actions: {

    },
    share: {
        // An array of fields that the plugin will ignore.
        omit: [],
        // Override global config for this store.
        enable: true,
        initialize: true,
    }
})
