window.addEventListener('DOMContentLoaded', () => {

    /* Accordion*/
    const accordionRow = document.querySelectorAll('.footer__information-item');
    const accordionTop = document.querySelectorAll('.footer__information-top');
    const accordionContent = document.querySelectorAll('.footer__information-list');

    accordionRow.forEach((btn, index) => {
        btn.addEventListener('click', (e) => {
            if(window.innerWidth <= 1024) {
                e.preventDefault();
                accordionTop[index].classList.toggle("footer__information-top--active");
                accordionContent[index].classList.toggle("footer__information-list--active");
            }
        });
    });

    /* Mobile Menu*/
    const menu = document.querySelector(".menu");
    const navigation = document.querySelector(".header__nav");
    const header = document.querySelector(".header");
    const body = document.querySelector("body");

    menu.addEventListener("click", (e) => {
        if(window.innerWidth <= 1024) {
            e.preventDefault();
            navigation.classList.toggle("header__nav--active");
            header.classList.toggle("header--active");
            body.classList.toggle("body--hidden");

            closeInfoCategory(); ///Reset
        }
    });

    /*Reset*/
    function closeInfoCategory() {
        //сбрасываю все открытые пункты
        infoCategory.forEach(item => {
            item.classList.remove("header__nav-additionally--active");
        });
        //сбрасываю активные ссылки
        linkCategory.forEach(item => {
            item.classList.remove("header__nav-link--active");
        });
        ///возвращаю скролл
        navigation.scrollTop = 0;
    }

    /* Open category*/
    const linkCategory = document.querySelectorAll(".header__nav-link");
    const infoCategory = document.querySelectorAll(".header__nav-additionally");

    linkCategory.forEach((el, index) => {
        el.addEventListener("click", (e) => {
            if(window.innerWidth <= 1024 && !el.classList.contains('header__nav-link--news') && !el.classList.contains('header__nav-link--contact')) {
                e.preventDefault();
                el.classList.toggle("header__nav-link--active");
                infoCategory[index].classList.toggle("header__nav-additionally--active");
            }
        });
    });

    /* Scroll*/
    window.onscroll = function () { functionScroll(); };

    var sticky = header.offsetTop;

    function functionScroll() {
        if (window.pageYOffset > sticky) {
            header.classList.add("header--sticky");
        } else {
            header.classList.remove("header--sticky");
        }

    }
});