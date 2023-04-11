document.addEventListener('DOMContentLoaded', function () {
    /* Swiper Article*/
    let swiperArticle = new Swiper(".article__swiper", {
        slidesPerView: 1,
        speed: 500,
        spaceBetween: 0,
        loop: true,
        mousewhell: true,
        keyboard: true,
        navigation: {
            prevEl: '.swiper-button-prev',
            nextEl: '.swiper-button-next',
        },
        breakpoints: {
            768: {
                slidesPerView: 2,
                spaceBetween: 10
            },
            1024: {
                slidesPerView: 3,
                spaceBetween: 40
            },
            1400: {
                slidesPerView: 4,
                spaceBetween: 26,
            }
        }
    });

    /*Scroll для блока с навигацией*/
    const  descLink = document.querySelectorAll('.blogPage__description-link');

    document.querySelectorAll('a[href^="#"').forEach(link => {

        link.addEventListener('click', function(e) {
            e.preventDefault();

            descLink.forEach(item => {
                item.classList.remove('blogPage__description-link--active');
            });

            link.classList.add('blogPage__description-link--active');

            let href = this.getAttribute('href').substring(1);

            const scrollTarget = document.getElementById(href);

            const topOffset = 85;
            const elementPosition = scrollTarget.getBoundingClientRect().top;
            const offsetPosition = elementPosition - topOffset;

            window.scrollBy({
                top: offsetPosition,
                behavior: 'smooth'
            });
        });
    });


    $(document).on('click', '.load_more', function(){

        var targetContainer = $('.blogPage__comment-block'),          //  Контейнер, в котором хранятся элементы
            url =  $('.load_more').attr('data-url');    //  URL, из которого будем брать элементы

        if (url !== undefined) {
            $.ajax({
                type: 'GET',
                url: url,
                dataType: 'html',
                success: function(data){

                    //  Удаляем старую навигацию
                    $('.load_more').remove();

                    var elements = $(data).find('.blogPage__comment-item'),  //  Ищем элементы
                        pagination = $(data).find('.load_more');//  Ищем навигацию

                    targetContainer.append(elements);   //  Добавляем посты в конец контейнера
                    targetContainer.append(pagination); //  добавляем навигацию следом

                }
            })
        }
    });
})
