import { defineStore } from 'pinia'
import { useToast } from "vue-toastification";

export const useBasketStore = defineStore({
    id: 'basket',
    state: () => ({
        toast: useToast(),
        basketData: {},
        bonusesData: 0,
    }),
    getters: {
        gettterBasket({ basketData }) {
            return basketData
        },
    },
    actions: {
        getBasket() {
            return axios.get('/local/api/handlers/Order/basket.php?action=getBasket')
                .then(response => {
                    Object.assign(this.basketData, response.data)
                    // if (response.data.success === 1) {
                    //     this.toast.success(response.data.msg);
                    //
                    //     console.log(response.data);
                    // } else {
                    //     this.toast.error(response.data.msg);
                    // }

                    return response.data;
                })
                .catch((error) => {
                    this.toast.error("При получении данных корзины произошла ошибка");
                })
        },
        getBonuses(userId, items) {
            let sum = 0;

            for (let i in items) {
                if(items[i].DISCOUNT_PRICE == 0) {
                    sum += items[i].FULL_PRICE
                }
            }

            return axios.post('/local/api/handlers/Order/basket.php?action=getBonuses', {
                userId: userId,
                price: sum
            })
                .then(response => {
                    this.bonusesData = response.data

                    return response.data;
                })
                .catch((error) => {
                    this.toast.error("При получении данных корзины произошла ошибка");
                })
        },
        productSetQuantity(productData) {
            // this.getBasket();

            if (productData.quantity < 1) {
                this.toast.error("Количество товара в корзине не может быть меньше 1-го.");

                return new Promise((resolve, reject) => {
                    resolve(1);
                });
            }

            if (productData.quantity > parseInt(this.basketData.items[productData.product_id].AVAILABLE_QUANTITY)) {
                this.toast.error(`Максимальное доступное кол-во товара для заказа ${this.basketData.items[productData.product_id].AVAILABLE_QUANTITY} шт.`);

                return new Promise((resolve, reject) => {
                    resolve(this.basketData.items[productData.product_id].AVAILABLE_QUANTITY);
                });
            }

            return axios.post('/local/api/handlers/Order/basket.php?action=setQuantity', productData)
                .then(response => {
                    // Object.assign(this.basketData, response.data)
                    // if (response.data.success === 1) {
                    //     this.toast.success(response.data.msg);
                    //
                    //     console.log(response.data);
                    // } else {
                    //     this.toast.error(response.data.msg);
                    // }

                    return response.data.quantity;
                })
                .catch((error) => {
                    this.toast.error("При изменении корзины произошла ошибка");
                })
                .finally(() => {
                    this.getBasket();
                })
        },
        addToBasket(product_id) {
            // this.getBasket();

            if (this.basketData.items.hasOwnProperty(product_id)) {
                this.toast.info('Данный товар уже добавлен в корзину');
                return;
            }

            return axios.post('/local/api/handlers/Order/basket.php?action=add', {
                'id': parseInt(product_id),
                'quantity': 1,
                'from_list': 'Y'
            })
                .then(response => {
                    Object.assign(this.basketData, response.data);
                    this.toast.success('Товар был добавлен в корзину');
                    // if (response.data.success === 1) {
                    //     this.toast.success(response.data.msg);
                    //
                    //     console.log(response.data);
                    // } else {
                    //     this.toast.error(response.data.msg);
                    // }

                    return response.data;
                })
                .catch((error) => {
                    this.toast.error("При изменении корзины произошла ошибка");
                })
                .finally(() => {
                    this.getBasket();
                })
        },
        deleteFromBasket(product_id) {
            // this.getBasket();

            // if (!this.basketData.items.hasOwnProperty(product_id)) {
            //     this.toast.info('Данный товар уже добавлен в корзину');
            //     return;
            // }

            return axios.post('/local/api/handlers/Order/basket.php?action=delete', {
                'id': parseInt(product_id)
            })
                .then(response => {
                    // Object.assign(this.basketData, response.data)
                    this.toast.success('Товар был удален из корзины');
                    // if (response.data.success === 1) {
                    //     this.toast.success(response.data.msg);
                    //
                    //     console.log(response.data);
                    // } else {
                    //     this.toast.error(response.data.msg);
                    // }

                    return response.data;
                })
                .catch((error) => {
                    this.toast.error("При удалении товара произошла ошибка");
                })
                .finally(() => {
                    this.getBasket();
                })
        },
        clearBasket() {
            this.getBasket();

            return axios.get('/local/api/handlers/Order/basket.php?action=clearBasket')
                .then(response => {
                    // Object.assign(this.basketData, response.data)
                    this.toast.success("Ваша корзина очищена");
                    // if (response.data.success === 1) {
                    //     this.toast.success(response.data.msg);
                    //
                    //     console.log(response.data);
                    // } else {
                    //     this.toast.error(response.data.msg);
                    // }

                    return response.data;
                })
                .catch((error) => {
                    this.toast.error("При очистке корзины произошла ошибка");
                })
                .finally(() => {
                    this.getBasket();
                })
        },
    },
    share: {
        // An array of fields that the plugin will ignore.
        omit: ['toast'],
        // Override global config for this store.
        enable: true,
        initialize: true,
    }
})
