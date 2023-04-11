require('./bootstrap');

import '../scss/app.scss';

import { createApp } from 'vue';
import { createPinia } from 'pinia';
import { PiniaSharedState } from 'pinia-shared-state';

import { useBasketStore } from "./store/basket";
import { usePersonalStore } from "./store/personal";
import { useFavsStore } from "./store/favorites";

import Swiper, {Navigation, Pagination, Autoplay, Thumbs, EffectFade, Scrollbar, Manipulation} from 'swiper';
import Toast, { POSITION } from "vue-toastification";
import vfmPlugin from 'vue-final-modal';
import ymaps from 'ymaps';
import LazyLoad from "vanilla-lazyload";
import VueTheMask from 'vue-the-mask';

import { VueFinalModal } from 'vue-final-modal';

import { plugin as VueTippy } from 'vue-tippy';
import 'tippy.js/dist/tippy.css'; // optional for styling

// Импорт css
import "vue-toastification/dist/index.css";
// import 'vue-final-modal/style.css';

// Импорт компонентов
// import testComponent from './components/testComponent';
import signinComponent from './components/signinComponent';
import signupComponent from './components/signupComponent';
import formFeedbackComponent from './components/formFeedbackComponent';
import formReviewsComponent from './components/formReviewsComponent';
import formBlogComponent from './components/formBlogComponent';
import resetPasswordComponent from './components/resetPasswordComponent';
import preloaderComponent from './components/preloaderComponent';
import personalComponent from './components/personalComponent';
import personalMenuComponent from './components/personalMenuComponent';
import basketComponent from './components/basketComponent';
import basketCardComponent from './components/basketCardComponent';
import basketAddProductComponent from './components/basketAddProductComponent';
import basketAddProductDetailComponent from './components/basketAddProductDetailComponent';
import orderComponent from './components/orderComponent';
import favoritesAddProductComponent from './components/favoritesAddProductComponent';
import favoritesProductComponent from './components/favoritesProductComponent';
import favoritesAddProductDetailComponent from './components/favoritesAddProductDetailComponent';
import headerCartComponent from './components/headerCartComponent';
import inviteComponent from './components/inviteComponent';
import subscribeFormComponent from './components/subscribeFormComponent';

// import ModalConfirmPlainCss from './components/ModalConfirmPlainCss';
// import Preview from './components/Preview';

Swiper.use([Navigation, Pagination, Autoplay, Thumbs, EffectFade, Scrollbar, Manipulation]);
window.Swiper = Swiper;
window.ymaps = ymaps;
// window.LazyLoad = LazyLoad;

const pinia = createPinia();

pinia.use(
    PiniaSharedState({
        // Enables the plugin for all stores. Defaults to true.
        enable: true,
        // If set to true this tab tries to immediately recover the shared state from another tab. Defaults to true.
        initialize: false,
        // Enforce a type. One of native, idb, localstorage or node. Defaults to native.
        type: 'localstorage',
    }),
);

// const vfm = createVfm();

const app = createApp({});

const toastOptions = {
    // You can set your default options here
    position: POSITION.TOP_RIGHT,
    timeout: 2000
};

app.use(pinia);
app.use(Toast, toastOptions);
app.use(vfmPlugin);
app.use(VueTheMask);
app.use(
    VueTippy,
    {
        directive: 'tippy', // => v-tippy
        component: 'tippy', // => <tippy/>
        componentSingleton: 'tippy-singleton', // => <tippy-singleton/>,
        defaultProps: {
            placement: 'bottom',
            allowHTML: true,
        }, // => Global default options * see all props
    }
);

app.use(VueFinalModal)

require("jquery-mask-plugin/dist/jquery.mask.min.js");
require("ion-rangeslider/js/ion.rangeSlider.min.js");

require("boxicons/dist/boxicons.js");

require("suggestions-jquery");
require("suggestions-jquery/dist/css/suggestions.min.css");

require("./helpers");
require("./main");

require("./scripts/index_big_top_slider");
require("./scripts/index_big_bottom_slider");

// require("suggestions-jquery/dist/js/jquery.suggestions");

const basketStore = useBasketStore();
const personalStore = usePersonalStore();
const favsStore = useFavsStore();

// app.component('test-component', testComponent);
app.component('signin-component', signinComponent);
app.component('signup-component', signupComponent);
app.component('form-feedback-component', formFeedbackComponent);
app.component('form-reviews-component', formReviewsComponent);
app.component('form-blog-component', formBlogComponent);
app.component('reset-password-component', resetPasswordComponent);
app.component('preloader-component', preloaderComponent);
app.component('personal-component', personalComponent);
app.component('personal-menu-component', personalMenuComponent);
app.component('basket-component', basketComponent);
app.component('basket-сard-сomponent', basketCardComponent);
app.component('basket-add-product-component', basketAddProductComponent);
app.component('basket-add-product-detail-component', basketAddProductDetailComponent);
app.component('order-component', orderComponent);
app.component('favorites-add-product-component', favoritesAddProductComponent);
app.component('favorites-product-component', favoritesProductComponent);
app.component('favorites-add-product-detail-component', favoritesAddProductDetailComponent);
app.component('header-cart-component', headerCartComponent);
app.component('invite-component', inviteComponent);
app.component('subscribe-form-component', subscribeFormComponent);

// app.component('modal-confirm-component', ModalConfirmPlainCss);
// app.component('preview-component', Preview);

app.mount('#root');

// Tell Puppeteer the page is ready to be saved
// document.dispatchEvent(new Event('render-event'))
