import { defineStore } from 'pinia'
import { useToast } from "vue-toastification";

export const useFavsStore = defineStore({
    id: 'favorites',
    state: () => ({
        toast: useToast(),
        favsData: {},
        displayFavorites: [],
        favorites: [],
    }),
    getters: {
    },
    actions: {
        inFavs(userId) {
            return axios.post('/local/api/handlers/Favorites/favs.php?action=inFavs', {
                'userId': userId,
            })
                .then(response => {
                    this.favsData = response.data
                    return response.data;
                })
                .catch((error) => {
                    this.toast.error("При получении данных произошла ошибка");
                })
                .finally(() => {
                    this.getFavs(userId);
                })
        },
        setFavs(product_id, userId, checked) {
            return axios.post('/local/api/handlers/Favorites/favs.php?action=setFavs', {
                'product_id': parseInt(product_id),
                'userId': userId,
                'checked': checked,
            })
                .then(response => {
                    // this.favsData = response.data;

                    let message = 'Товар был добавлен в избранное';
                    if(checked == false)
                        message = 'Товар был удален из избранного'

                    this.toast.success(message);

                    return response.data;
                })
                .catch((error) => {
                    this.toast.error("При изменении произошла ошибка");
                })
                .finally(() => {
                    this.getFavs(userId);
                })
        },
        getFavs(userId, avaliable = false, sort = false, order = false) {
            return axios.post('/local/api/handlers/Favorites/favs.php?action=getFavs', {
                'userId': userId,
                'avaliable': avaliable,
                'sort': sort,
                'order': order,
            })
                .then(response => {
                    this.favorites = response.data.chunks;
                    this.favsData = response.data.favorites
                    this.displayFavorites = this.favorites[0]

                    return response.data;
                })
                .catch((error) => {
                    this.toast.error("При получении списка товаров произошла ошибка");
                })
        },
        setDisplayFavs(page) {
            this.displayFavorites = [...this.displayFavorites, ...this.favorites[page]];
        }
    },
    share: {
        // An array of fields that the plugin will ignore.
        omit: ['toast'],
        // Override global config for this store.
        enable: true,
        initialize: true,
    }
})
