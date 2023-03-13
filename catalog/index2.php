<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");


use Bitrix\Main\Page\Asset;

Asset::getInstance()->addCss(SITE_TEMPLATE_PATH."/assets/css/pages/catalog.css");
Asset::getInstance()->addJs(SITE_TEMPLATE_PATH."/assets/js/pages/catalog.js");
?>
<section class="catalog">
  <div>
    <aside class="catalog-nav">
        <div class="catalog__navwrap">
          <nav aria-label="Breadcrumb" class="breadcrumb breadcrumb--black">
            <ul>
              <li><a href="#">Главная </a></li>
              <li><span aria-current="page">Для женщин</span></li>
            </ul>
          </nav>
          <h1 class="catalog__title">Одежда для женщин</h1>
        </div>
        <form class="catalog-nav__form">
          <div class="catalog-nav__new">новинки</div>
          <div class="catalog-nav__item accordion-catalog">
            <div class="catalog-nav__item-top accordion-catalog__header">
              Категории
              <svg
                width="16"
                height="9"
                viewBox="0 0 16 9"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
              >
                <path
                  d="M7.29289 8.70711C7.68342 9.09763 8.31658 9.09763 8.70711 8.70711L15.0711 2.34315C15.4616 1.95262 15.4616 1.31946 15.0711 0.928932C14.6805 0.538408 14.0474 0.538408 13.6569 0.928932L8 6.58579L2.34315 0.928932C1.95262 0.538408 1.31946 0.538408 0.928933 0.928932C0.538408 1.31946 0.538408 1.95262 0.928932 2.34315L7.29289 8.70711ZM7 7L7 8L9 8L9 7L7 7Z"
                  fill="black"
                />
              </svg>
            </div>
            <div
              class="catalog-nav__item-bottom catalog-nav__item-bottom--categories accordion-catalog__description"
            >
              <div class="catalog-nav__item-categories-input">
                <input
                  type="radio"
                  id="catalog__categories--1"
                  name="catalog__categories"
                />
                <label for="catalog__categories--1">Водолазки</label>
              </div>
              <div class="catalog-nav__item-categories-input">
                <input
                  type="radio"
                  id="catalog__categories--2"
                  name="catalog__categories"
                />
                <label for="catalog__categories--2"
                  >Джемперы и кардиганы</label
                >
              </div>
              <div class="catalog-nav__item-categories-input">
                <input
                  type="radio"
                  id="catalog__categories--3"
                  name="catalog__categories"
                />
                <label for="catalog__categories--3">Жилетки</label>
              </div>
              <div class="catalog-nav__item-categories-input">
                <input
                  type="radio"
                  id="catalog__categories--4"
                  name="catalog__categories"
                />
                <label for="catalog__categories--4">Лосины</label>
              </div>
              <div class="catalog-nav__item-categories-input">
                <input
                  type="radio"
                  id="catalog__categories--5"
                  name="catalog__categories"
                />
                <label for="catalog__categories--5">Пальто</label>
              </div>
              <div class="catalog-nav__item-categories-input">
                <input
                  type="radio"
                  id="catalog__categories--6"
                  name="catalog__categories"
                />
                <label for="catalog__categories--6">Платья</label>
              </div>
              <div class="catalog-nav__item-categories-input">
                <input
                  type="radio"
                  id="catalog__categories--7"
                  name="catalog__categories"
                />
                <label for="catalog__categories--7">Туника</label>
              </div>
              <div class="catalog-nav__item-categories-input">
                <input
                  type="radio"
                  id="catalog__categories--8"
                  name="catalog__categories"
                />
                <label for="catalog__categories--8">Футболки</label>
              </div>
              <div class="catalog-nav__item-categories-input">
                <input
                  type="radio"
                  id="catalog__categories--9"
                  name="catalog__categories"
                />
                <label for="catalog__categories--9">Шорты</label>
              </div>
            </div>
          </div>
          <div class="catalog-nav__item accordion-catalog">
            <div class="catalog-nav__item-top accordion-catalog__header">
              Цена
              <svg
                width="16"
                height="9"
                viewBox="0 0 16 9"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
              >
                <path
                  d="M7.29289 8.70711C7.68342 9.09763 8.31658 9.09763 8.70711 8.70711L15.0711 2.34315C15.4616 1.95262 15.4616 1.31946 15.0711 0.928932C14.6805 0.538408 14.0474 0.538408 13.6569 0.928932L8 6.58579L2.34315 0.928932C1.95262 0.538408 1.31946 0.538408 0.928933 0.928932C0.538408 1.31946 0.538408 1.95262 0.928932 2.34315L7.29289 8.70711ZM7 7L7 8L9 8L9 7L7 7Z"
                  fill="black"
                />
              </svg>
            </div>
            <div
              class="catalog-nav__item-bottom catalog-nav__item-bottom--price accordion-catalog__description"
            >
              <div class="range-slider range-slider__price">
                <input
                  type="text"
                  class="js-range-slider js-range-slider__price"
                  value=""
                  name="range-slider__price"
                />
              </div>
              <div class="extra-controls extra-controls__price">
                <input
                  type="text"
                  name="range-slider__price"
                  id="range-slider__price"
                  class="js-input-from js-input-from__price"
                  value="0"
                />
                <span></span>
                <input
                  type="text"
                  name="range-slider__price"
                  id="range-slider__price2"
                  class="js-input-to js-input-to__price"
                  value="0"
                />
              </div>
            </div>
          </div>
          <div class="catalog-nav__item accordion-catalog">
            <div class="catalog-nav__item-top accordion-catalog__header">
              Размер
              <svg
                width="16"
                height="9"
                viewBox="0 0 16 9"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
              >
                <path
                  d="M7.29289 8.70711C7.68342 9.09763 8.31658 9.09763 8.70711 8.70711L15.0711 2.34315C15.4616 1.95262 15.4616 1.31946 15.0711 0.928932C14.6805 0.538408 14.0474 0.538408 13.6569 0.928932L8 6.58579L2.34315 0.928932C1.95262 0.538408 1.31946 0.538408 0.928933 0.928932C0.538408 1.31946 0.538408 1.95262 0.928932 2.34315L7.29289 8.70711ZM7 7L7 8L9 8L9 7L7 7Z"
                  fill="black"
                />
              </svg>
            </div>
            <div
              class="catalog-nav__item-bottom catalog-nav__item-bottom--size accordion-catalog__description"
            >
              <div class="catalog-nav__item-size-card">
                <input
                  type="radio"
                  id="catalog__size--35"
                  name="catalog__size"
                />
                <label for="catalog__size--35">35 - 37</label>
              </div>
              <div class="catalog-nav__item-size-card">
                <input
                  type="radio"
                  id="catalog__size--38"
                  name="catalog__size"
                />
                <label for="catalog__size--38">38 - 40</label>
              </div>
              <div
                class="catalog-nav__item-size-card catalog-nav__item-size-card--not"
              >
                <input
                  type="radio"
                  id="catalog__size--41"
                  name="catalog__size"
                />
                <label for="catalog__size--41">41 - 43</label>
              </div>
              <div
                class="catalog-nav__item-size-card catalog-nav__item-size-card--not"
              >
                <input
                  type="radio"
                  id="catalog__size--44"
                  name="catalog__size"
                />
                <label for="catalog__size--44">44</label>
              </div>
              <div class="catalog-nav__item-size-card">
                <input
                  type="radio"
                  id="catalog__size--55"
                  name="catalog__size"
                />
                <label for="catalog__size--55">55</label>
              </div>
              <div class="catalog-nav__item-size-card">
                <input
                  type="radio"
                  id="catalog__size--onesize"
                  name="catalog__size"
                />
                <label for="catalog__size--onesize">Один размер</label>
              </div>
            </div>
          </div>
          <div class="catalog-nav__item accordion-catalog">
            <div class="catalog-nav__item-top accordion-catalog__header">
              Цвет
              <svg
                width="16"
                height="9"
                viewBox="0 0 16 9"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
              >
                <path
                  d="M7.29289 8.70711C7.68342 9.09763 8.31658 9.09763 8.70711 8.70711L15.0711 2.34315C15.4616 1.95262 15.4616 1.31946 15.0711 0.928932C14.6805 0.538408 14.0474 0.538408 13.6569 0.928932L8 6.58579L2.34315 0.928932C1.95262 0.538408 1.31946 0.538408 0.928933 0.928932C0.538408 1.31946 0.538408 1.95262 0.928932 2.34315L7.29289 8.70711ZM7 7L7 8L9 8L9 7L7 7Z"
                  fill="black"
                />
              </svg>
            </div>
            <div
              class="catalog-nav__item-bottom catalog-nav__item-bottom--color accordion-catalog__description"
            >
              <div class="catalog-nav__item-color">
                <input
                  type="radio"
                  id="catalog__color-1"
                  name="catalog__color"
                />
                <label for="catalog__color-1"></label>
              </div>
              <div class="catalog-nav__item-color">
                <input
                  type="radio"
                  id="catalog__color-2"
                  name="catalog__color"
                />
                <label for="catalog__color-2"></label>
              </div>
              <div class="catalog-nav__item-color">
                <input
                  type="radio"
                  id="catalog__color-3"
                  name="catalog__color"
                />
                <label for="catalog__color-3"></label>
              </div>
              <div class="catalog-nav__item-color">
                <input
                  type="radio"
                  id="catalog__color-4"
                  name="catalog__color"
                />
                <label for="catalog__color-4"></label>
              </div>
              <div class="catalog-nav__item-color">
                <input
                  type="radio"
                  id="catalog__color-5"
                  name="catalog__color"
                />
                <label for="catalog__color-5"></label>
              </div>
            </div>
          </div>
          <div class="catalog-nav__item accordion-catalog">
            <div class="catalog-nav__item-top accordion-catalog__header">
              вырез
              <svg
                width="16"
                height="9"
                viewBox="0 0 16 9"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
              >
                <path
                  d="M7.29289 8.70711C7.68342 9.09763 8.31658 9.09763 8.70711 8.70711L15.0711 2.34315C15.4616 1.95262 15.4616 1.31946 15.0711 0.928932C14.6805 0.538408 14.0474 0.538408 13.6569 0.928932L8 6.58579L2.34315 0.928932C1.95262 0.538408 1.31946 0.538408 0.928933 0.928932C0.538408 1.31946 0.538408 1.95262 0.928932 2.34315L7.29289 8.70711ZM7 7L7 8L9 8L9 7L7 7Z"
                  fill="black"
                />
              </svg>
            </div>
            <div
              class="catalog-nav__item-bottom catalog-nav__item-bottom--description accordion-catalog__description"
            >
              <div class="catalog-nav__item-description">
                <input
                  type="radio"
                  id="catalog__cutout-1"
                  name="catalog__cutout"
                />
                <label for="catalog__cutout-1">V - образный вырез</label>
              </div>
              <div class="catalog-nav__item-description">
                <input
                  type="radio"
                  id="catalog__cutout-2"
                  name="catalog__cutout"
                />
                <label for="catalog__cutout-2">Воротник-стойка</label>
              </div>
              <div class="catalog-nav__item-description">
                <input
                  type="radio"
                  id="catalog__cutout-3"
                  name="catalog__cutout"
                />
                <label for="catalog__cutout-3">Вырез каре</label>
              </div>
              <div class="catalog-nav__item-description">
                <input
                  type="radio"
                  id="catalog__cutout-4"
                  name="catalog__cutout"
                />
                <label for="catalog__cutout-4">Вырез лодочка</label>
              </div>
              <div class="catalog-nav__item-description">
                <input
                  type="radio"
                  id="catalog__cutout-5"
                  name="catalog__cutout"
                />
                <label for="catalog__cutout-5">Вырез сердечко</label>
              </div>
            </div>
          </div>
          <div class="catalog-nav__item accordion-catalog">
            <div class="catalog-nav__item-top accordion-catalog__header">
              длина
              <svg
                width="16"
                height="9"
                viewBox="0 0 16 9"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
              >
                <path
                  d="M7.29289 8.70711C7.68342 9.09763 8.31658 9.09763 8.70711 8.70711L15.0711 2.34315C15.4616 1.95262 15.4616 1.31946 15.0711 0.928932C14.6805 0.538408 14.0474 0.538408 13.6569 0.928932L8 6.58579L2.34315 0.928932C1.95262 0.538408 1.31946 0.538408 0.928933 0.928932C0.538408 1.31946 0.538408 1.95262 0.928932 2.34315L7.29289 8.70711ZM7 7L7 8L9 8L9 7L7 7Z"
                  fill="black"
                />
              </svg>
            </div>
            <div
              class="catalog-nav__item-bottom catalog-nav__item-bottom--description accordion-catalog__description"
            >
              <div class="catalog-nav__item-description">
                <input
                  type="radio"
                  id="catalog__length-1"
                  name="catalog__length"
                />
                <label for="catalog__length-1">Стандартная длина</label>
              </div>
              <div class="catalog-nav__item-description">
                <input
                  type="radio"
                  id="catalog__length-2"
                  name="catalog__length"
                />
                <label for="catalog__length-2">Удлиненная модель</label>
              </div>
              <div class="catalog-nav__item-description">
                <input
                  type="radio"
                  id="catalog__length-3"
                  name="catalog__length"
                />
                <label for="catalog__length-3">Укороченная модель</label>
              </div>
            </div>
          </div>
          <div class="catalog-nav__item accordion-catalog">
            <div class="catalog-nav__item-top accordion-catalog__header">
              материал
              <svg
                width="16"
                height="9"
                viewBox="0 0 16 9"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
              >
                <path
                  d="M7.29289 8.70711C7.68342 9.09763 8.31658 9.09763 8.70711 8.70711L15.0711 2.34315C15.4616 1.95262 15.4616 1.31946 15.0711 0.928932C14.6805 0.538408 14.0474 0.538408 13.6569 0.928932L8 6.58579L2.34315 0.928932C1.95262 0.538408 1.31946 0.538408 0.928933 0.928932C0.538408 1.31946 0.538408 1.95262 0.928932 2.34315L7.29289 8.70711ZM7 7L7 8L9 8L9 7L7 7Z"
                  fill="black"
                />
              </svg>
            </div>
            <div
              class="catalog-nav__item-bottom catalog-nav__item-bottom--description accordion-catalog__description"
            >
              <div class="catalog-nav__item-description">
                <input
                  type="radio"
                  id="catalog__material-1"
                  name="catalog__material"
                />
                <label for="catalog__material-1">Кашемир</label>
              </div>
              <div class="catalog-nav__item-description">
                <input
                  type="radio"
                  id="catalog__material-2"
                  name="catalog__material"
                />
                <label for="catalog__material-2">Шерсть Яка</label>
              </div>
              <div class="catalog-nav__item-description">
                <input
                  type="radio"
                  id="catalog__material-3"
                  name="catalog__material"
                />
                <label for="catalog__material-3">Шерсть верблюда</label>
              </div>
            </div>
          </div>
          <div class="catalog-nav__item accordion-catalog">
            <div class="catalog-nav__item-top accordion-catalog__header">
              производитель
              <svg
                width="16"
                height="9"
                viewBox="0 0 16 9"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
              >
                <path
                  d="M7.29289 8.70711C7.68342 9.09763 8.31658 9.09763 8.70711 8.70711L15.0711 2.34315C15.4616 1.95262 15.4616 1.31946 15.0711 0.928932C14.6805 0.538408 14.0474 0.538408 13.6569 0.928932L8 6.58579L2.34315 0.928932C1.95262 0.538408 1.31946 0.538408 0.928933 0.928932C0.538408 1.31946 0.538408 1.95262 0.928932 2.34315L7.29289 8.70711ZM7 7L7 8L9 8L9 7L7 7Z"
                  fill="black"
                />
              </svg>
            </div>
            <div
              class="catalog-nav__item-bottom catalog-nav__item-bottom--description accordion-catalog__description"
            >
              <div class="catalog-nav__item-description">
                <input
                  type="radio"
                  id="catalog__maker-1"
                  name="catalog__maker"
                />
                <label for="catalog__maker-1">Кашемир</label>
              </div>
              <div class="catalog-nav__item-description">
                <input
                  type="radio"
                  id="catalog__maker-2"
                  name="catalog__maker"
                />
                <label for="catalog__maker-2">Шерсть Яка</label>
              </div>
              <div class="catalog-nav__item-description">
                <input
                  type="radio"
                  id="catalog__maker-3"
                  name="catalog__maker"
                />
                <label for="catalog__maker-3">Шерсть верблюда</label>
              </div>
            </div>
          </div>
        </form>
      </aside>
      <div class="catalog-content">
        <div class="catalog-content-top">
          <form class="catalog-content-top__search">
            <input type="text" placeholder="Поиск..." />
            <button>НАЙТИ</button>
          </form>
          <div class="catalog-content-top__sort">
            <div class="catalog-content-top__sort-top">
              <div class="catalog-content-top__sort-top-text">
                СОРтировать по
              </div>
              <svg
                width="16"
                height="9"
                viewBox="0 0 16 9"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
              >
                <path
                  d="M7.29289 8.70711C7.68342 9.09763 8.31658 9.09763 8.70711 8.70711L15.0711 2.34315C15.4616 1.95262 15.4616 1.31946 15.0711 0.928932C14.6805 0.538408 14.0474 0.538408 13.6569 0.928932L8 6.58579L2.34315 0.928932C1.95262 0.538408 1.31946 0.538408 0.928932 0.928932C0.538408 1.31946 0.538408 1.95262 0.928932 2.34315L7.29289 8.70711ZM7 7L7 8L9 8L9 7L7 7Z"
                  fill="black"
                />
              </svg>
            </div>
            <div class="catalog-content-top__sort-bottom">
              <div class="catalog-content-top__sort-item">Рекомендуемые</div>
              <div class="catalog-content-top__sort-item">
                Цена по убыванию
              </div>
              <div class="catalog-content-top__sort-item">
                Цена по возрастанию
              </div>
              <div class="catalog-content-top__sort-item">
                Новые поступления
              </div>
              <div class="catalog-content-top__sort-item">В наличии</div>
            </div>
          </div>
        </div>
        <div class="catalog-content-cards">
          <div class="catalog-content__card catalog-content__card--new">
            <div
              class="catalog-content__card-mark catalog-content__card-mark--new"
            >
              новинка
            </div>
            <form class="catalog-content__card-favourites">
              <input type="checkbox" id="catalog__card-favourites--1" />
              <label
                for="catalog__card-favourites--1"
                name="catalog__card-favourites"
              >
              </label>
            </form>
            <a href="/" class="catalog-content__card-img">
              <img
                src="/local/templates/allmongolia_umax/assets/images/catalog-image-3.jpg"
                alt=""
              />
            </a>
            <div class="catalog-content__card-info">
              <a href="/" class="catalog-content__card-title">
                Безрукавка Удлинённая Из Шерсти Яка
              </a>
              <div class="catalog-content__card-subtitle">100% шерсть</div>
              <div class="catalog-content__card-availability">
                Есть в наличии
              </div>
              <div class="catalog-content__card-info-bottom">
                <div class="catalog-content__card-price-wrap">
                  <div class="catalog-content__card-price">6 210 руб.</div>
                  <div class="catalog-content__card-price--discount">
                    6 210 руб.
                  </div>
                </div>
                <div class="catalog-content__card-basket">
                  <div class="catalog-content__card-basket-icon">
                    <svg
                      width="25"
                      height="25"
                      viewBox="0 0 25 25"
                      fill="none"
                      xmlns="http://www.w3.org/2000/svg"
                    >
                      <path
                        d="M4.31475 4.16673L6.26058 16.8084C6.29559 17.0603 6.42139 17.2908 6.61436 17.4566C6.80732 17.6223 7.05416 17.7118 7.3085 17.7084H18.7502C18.9743 17.7084 19.1924 17.6362 19.3722 17.5024C19.5519 17.3686 19.6838 17.1804 19.7481 16.9657L22.8731 6.54903C22.9197 6.3935 22.9293 6.22922 22.9011 6.06932C22.8729 5.90943 22.8078 5.75833 22.7108 5.62808C22.6139 5.49784 22.4878 5.39207 22.3427 5.3192C22.1976 5.24633 22.0375 5.20839 21.8752 5.2084H6.5835L6.23975 2.98132C6.20502 2.72636 6.07652 2.49349 5.87933 2.32819C5.68732 2.16611 5.44306 2.07914 5.19183 2.0834H3.12516C2.98837 2.0834 2.85291 2.11034 2.72653 2.16269C2.60015 2.21504 2.48532 2.29177 2.38859 2.3885C2.29187 2.48523 2.21514 2.60006 2.16279 2.72644C2.11044 2.85282 2.0835 2.98827 2.0835 3.12507C2.0835 3.26186 2.11044 3.39732 2.16279 3.5237C2.21514 3.65008 2.29187 3.76491 2.38859 3.86164C2.48532 3.95837 2.60015 4.03509 2.72653 4.08744C2.85291 4.13979 2.98837 4.16673 3.12516 4.16673H4.31475ZM8.18558 15.6251L6.90433 7.29173H20.4752L17.9752 15.6251H8.18558ZM10.4168 20.8334C10.4168 21.3859 10.1973 21.9158 9.80663 22.3065C9.41593 22.6972 8.88603 22.9167 8.3335 22.9167C7.78096 22.9167 7.25106 22.6972 6.86036 22.3065C6.46966 21.9158 6.25016 21.3859 6.25016 20.8334C6.25016 20.2809 6.46966 19.751 6.86036 19.3603C7.25106 18.9696 7.78096 18.7501 8.3335 18.7501C8.88603 18.7501 9.41593 18.9696 9.80663 19.3603C10.1973 19.751 10.4168 20.2809 10.4168 20.8334ZM19.7918 20.8334C19.7918 21.3859 19.5723 21.9158 19.1816 22.3065C18.7909 22.6972 18.261 22.9167 17.7085 22.9167C17.156 22.9167 16.6261 22.6972 16.2354 22.3065C15.8447 21.9158 15.6252 21.3859 15.6252 20.8334C15.6252 20.2809 15.8447 19.751 16.2354 19.3603C16.6261 18.9696 17.156 18.7501 17.7085 18.7501C18.261 18.7501 18.7909 18.9696 19.1816 19.3603C19.5723 19.751 19.7918 20.2809 19.7918 20.8334Z"
                        fill="white"
                      />
                    </svg>
                  </div>
                  <div class="catalog-content__card-basket-counter">123</div>
                </div>
              </div>
            </div>
          </div>
          <div class="catalog-content__card catalog-content__card--not">
            <div
              class="catalog-content__card-mark catalog-content__card-mark--new"
            >
              новинка
            </div>
            <form class="catalog-content__card-favourites">
              <input type="checkbox" id="catalog__card-favourites--2" />
              <label
                for="catalog__card-favourites--2"
                name="catalog__card-favourites"
              >
              </label>
            </form>
            <a href="/" class="catalog-content__card-img">
              <img
                src="/local/templates/allmongolia_umax/assets/images/catalog-image-3.jpg"
                alt=""
              />
            </a>
            <div class="catalog-content__card-info">
              <a href="/" class="catalog-content__card-title">
                Безрукавка Удлинённая Из Шерсти Яка
              </a>
              <div class="catalog-content__card-subtitle">100% шерсть</div>
              <div class="catalog-content__card-availability">
                Есть в наличии
              </div>
              <div class="catalog-content__card-info-bottom">
                <div class="catalog-content__card-price-wrap">
                  <div class="catalog-content__card-price">6 210 руб.</div>
                  <div class="catalog-content__card-price--discount">
                    6 210 руб.
                  </div>
                </div>
                <div class="catalog-content__card-basket">
                  <div class="catalog-content__card-basket-icon">
                    <svg
                      width="25"
                      height="25"
                      viewBox="0 0 25 25"
                      fill="none"
                      xmlns="http://www.w3.org/2000/svg"
                    >
                      <path
                        d="M4.31475 4.16673L6.26058 16.8084C6.29559 17.0603 6.42139 17.2908 6.61436 17.4566C6.80732 17.6223 7.05416 17.7118 7.3085 17.7084H18.7502C18.9743 17.7084 19.1924 17.6362 19.3722 17.5024C19.5519 17.3686 19.6838 17.1804 19.7481 16.9657L22.8731 6.54903C22.9197 6.3935 22.9293 6.22922 22.9011 6.06932C22.8729 5.90943 22.8078 5.75833 22.7108 5.62808C22.6139 5.49784 22.4878 5.39207 22.3427 5.3192C22.1976 5.24633 22.0375 5.20839 21.8752 5.2084H6.5835L6.23975 2.98132C6.20502 2.72636 6.07652 2.49349 5.87933 2.32819C5.68732 2.16611 5.44306 2.07914 5.19183 2.0834H3.12516C2.98837 2.0834 2.85291 2.11034 2.72653 2.16269C2.60015 2.21504 2.48532 2.29177 2.38859 2.3885C2.29187 2.48523 2.21514 2.60006 2.16279 2.72644C2.11044 2.85282 2.0835 2.98827 2.0835 3.12507C2.0835 3.26186 2.11044 3.39732 2.16279 3.5237C2.21514 3.65008 2.29187 3.76491 2.38859 3.86164C2.48532 3.95837 2.60015 4.03509 2.72653 4.08744C2.85291 4.13979 2.98837 4.16673 3.12516 4.16673H4.31475ZM8.18558 15.6251L6.90433 7.29173H20.4752L17.9752 15.6251H8.18558ZM10.4168 20.8334C10.4168 21.3859 10.1973 21.9158 9.80663 22.3065C9.41593 22.6972 8.88603 22.9167 8.3335 22.9167C7.78096 22.9167 7.25106 22.6972 6.86036 22.3065C6.46966 21.9158 6.25016 21.3859 6.25016 20.8334C6.25016 20.2809 6.46966 19.751 6.86036 19.3603C7.25106 18.9696 7.78096 18.7501 8.3335 18.7501C8.88603 18.7501 9.41593 18.9696 9.80663 19.3603C10.1973 19.751 10.4168 20.2809 10.4168 20.8334ZM19.7918 20.8334C19.7918 21.3859 19.5723 21.9158 19.1816 22.3065C18.7909 22.6972 18.261 22.9167 17.7085 22.9167C17.156 22.9167 16.6261 22.6972 16.2354 22.3065C15.8447 21.9158 15.6252 21.3859 15.6252 20.8334C15.6252 20.2809 15.8447 19.751 16.2354 19.3603C16.6261 18.9696 17.156 18.7501 17.7085 18.7501C18.261 18.7501 18.7909 18.9696 19.1816 19.3603C19.5723 19.751 19.7918 20.2809 19.7918 20.8334Z"
                        fill="white"
                      />
                    </svg>
                  </div>
                  <div class="catalog-content__card-basket-counter">123</div>
                </div>
              </div>
            </div>
          </div>
          <div class="catalog-content__card catalog-content__card--discount">
            <div
              class="catalog-content__card-mark catalog-content__card-mark--new"
            >
              -50%
            </div>
            <form class="catalog-content__card-favourites">
              <input type="checkbox" id="catalog__card-favourites--3" />
              <label
                for="catalog__card-favourites--3"
                name="catalog__card-favourites"
              >
              </label>
            </form>
            <a href="/" class="catalog-content__card-img">
              <img
                src="/local/templates/allmongolia_umax/assets/images/catalog-image-3.jpg"
                alt=""
              />
            </a>
            <div class="catalog-content__card-info">
              <a href="/" class="catalog-content__card-title">
                Безрукавка Удлинённая Из Шерсти Яка
              </a>
              <div class="catalog-content__card-subtitle">100% шерсть</div>
              <div class="catalog-content__card-availability">
                Есть в наличии
              </div>
              <div class="catalog-content__card-info-bottom">
                <div class="catalog-content__card-price-wrap">
                  <div class="catalog-content__card-price">6 210 руб.</div>
                  <div class="catalog-content__card-price--discount">
                    6 210 руб.
                  </div>
                </div>
                <div class="catalog-content__card-basket">
                  <div class="catalog-content__card-basket-icon">
                    <svg
                      width="25"
                      height="25"
                      viewBox="0 0 25 25"
                      fill="none"
                      xmlns="http://www.w3.org/2000/svg"
                    >
                      <path
                        d="M4.31475 4.16673L6.26058 16.8084C6.29559 17.0603 6.42139 17.2908 6.61436 17.4566C6.80732 17.6223 7.05416 17.7118 7.3085 17.7084H18.7502C18.9743 17.7084 19.1924 17.6362 19.3722 17.5024C19.5519 17.3686 19.6838 17.1804 19.7481 16.9657L22.8731 6.54903C22.9197 6.3935 22.9293 6.22922 22.9011 6.06932C22.8729 5.90943 22.8078 5.75833 22.7108 5.62808C22.6139 5.49784 22.4878 5.39207 22.3427 5.3192C22.1976 5.24633 22.0375 5.20839 21.8752 5.2084H6.5835L6.23975 2.98132C6.20502 2.72636 6.07652 2.49349 5.87933 2.32819C5.68732 2.16611 5.44306 2.07914 5.19183 2.0834H3.12516C2.98837 2.0834 2.85291 2.11034 2.72653 2.16269C2.60015 2.21504 2.48532 2.29177 2.38859 2.3885C2.29187 2.48523 2.21514 2.60006 2.16279 2.72644C2.11044 2.85282 2.0835 2.98827 2.0835 3.12507C2.0835 3.26186 2.11044 3.39732 2.16279 3.5237C2.21514 3.65008 2.29187 3.76491 2.38859 3.86164C2.48532 3.95837 2.60015 4.03509 2.72653 4.08744C2.85291 4.13979 2.98837 4.16673 3.12516 4.16673H4.31475ZM8.18558 15.6251L6.90433 7.29173H20.4752L17.9752 15.6251H8.18558ZM10.4168 20.8334C10.4168 21.3859 10.1973 21.9158 9.80663 22.3065C9.41593 22.6972 8.88603 22.9167 8.3335 22.9167C7.78096 22.9167 7.25106 22.6972 6.86036 22.3065C6.46966 21.9158 6.25016 21.3859 6.25016 20.8334C6.25016 20.2809 6.46966 19.751 6.86036 19.3603C7.25106 18.9696 7.78096 18.7501 8.3335 18.7501C8.88603 18.7501 9.41593 18.9696 9.80663 19.3603C10.1973 19.751 10.4168 20.2809 10.4168 20.8334ZM19.7918 20.8334C19.7918 21.3859 19.5723 21.9158 19.1816 22.3065C18.7909 22.6972 18.261 22.9167 17.7085 22.9167C17.156 22.9167 16.6261 22.6972 16.2354 22.3065C15.8447 21.9158 15.6252 21.3859 15.6252 20.8334C15.6252 20.2809 15.8447 19.751 16.2354 19.3603C16.6261 18.9696 17.156 18.7501 17.7085 18.7501C18.261 18.7501 18.7909 18.9696 19.1816 19.3603C19.5723 19.751 19.7918 20.2809 19.7918 20.8334Z"
                        fill="white"
                      />
                    </svg>
                  </div>
                  <div class="catalog-content__card-basket-counter">123</div>
                </div>
              </div>
            </div>
          </div>
          <div class="catalog-content__card">
            <div
              class="catalog-content__card-mark catalog-content__card-mark--new"
            >
              новинка
            </div>
            <form class="catalog-content__card-favourites">
              <input type="checkbox" id="catalog__card-favourites--4" />
              <label
                for="catalog__card-favourites--4"
                name="catalog__card-favourites"
              >
              </label>
            </form>
            <a href="/" class="catalog-content__card-img">
              <img
                src="/local/templates/allmongolia_umax/assets/images/catalog-image-3.jpg"
                alt=""
              />
            </a>
            <div class="catalog-content__card-info">
              <a href="/" class="catalog-content__card-title">
                Безрукавка Удлинённая Из Шерсти Яка
              </a>
              <div class="catalog-content__card-subtitle">100% шерсть</div>
              <div class="catalog-content__card-availability">
                Есть в наличии
              </div>
              <div class="catalog-content__card-info-bottom">
                <div class="catalog-content__card-price-wrap">
                  <div class="catalog-content__card-price">6 210 руб.</div>
                  <div class="catalog-content__card-price--discount">
                    6 210 руб.
                  </div>
                </div>
                <div class="catalog-content__card-basket">
                  <div class="catalog-content__card-basket-icon">
                    <svg
                      width="25"
                      height="25"
                      viewBox="0 0 25 25"
                      fill="none"
                      xmlns="http://www.w3.org/2000/svg"
                    >
                      <path
                        d="M4.31475 4.16673L6.26058 16.8084C6.29559 17.0603 6.42139 17.2908 6.61436 17.4566C6.80732 17.6223 7.05416 17.7118 7.3085 17.7084H18.7502C18.9743 17.7084 19.1924 17.6362 19.3722 17.5024C19.5519 17.3686 19.6838 17.1804 19.7481 16.9657L22.8731 6.54903C22.9197 6.3935 22.9293 6.22922 22.9011 6.06932C22.8729 5.90943 22.8078 5.75833 22.7108 5.62808C22.6139 5.49784 22.4878 5.39207 22.3427 5.3192C22.1976 5.24633 22.0375 5.20839 21.8752 5.2084H6.5835L6.23975 2.98132C6.20502 2.72636 6.07652 2.49349 5.87933 2.32819C5.68732 2.16611 5.44306 2.07914 5.19183 2.0834H3.12516C2.98837 2.0834 2.85291 2.11034 2.72653 2.16269C2.60015 2.21504 2.48532 2.29177 2.38859 2.3885C2.29187 2.48523 2.21514 2.60006 2.16279 2.72644C2.11044 2.85282 2.0835 2.98827 2.0835 3.12507C2.0835 3.26186 2.11044 3.39732 2.16279 3.5237C2.21514 3.65008 2.29187 3.76491 2.38859 3.86164C2.48532 3.95837 2.60015 4.03509 2.72653 4.08744C2.85291 4.13979 2.98837 4.16673 3.12516 4.16673H4.31475ZM8.18558 15.6251L6.90433 7.29173H20.4752L17.9752 15.6251H8.18558ZM10.4168 20.8334C10.4168 21.3859 10.1973 21.9158 9.80663 22.3065C9.41593 22.6972 8.88603 22.9167 8.3335 22.9167C7.78096 22.9167 7.25106 22.6972 6.86036 22.3065C6.46966 21.9158 6.25016 21.3859 6.25016 20.8334C6.25016 20.2809 6.46966 19.751 6.86036 19.3603C7.25106 18.9696 7.78096 18.7501 8.3335 18.7501C8.88603 18.7501 9.41593 18.9696 9.80663 19.3603C10.1973 19.751 10.4168 20.2809 10.4168 20.8334ZM19.7918 20.8334C19.7918 21.3859 19.5723 21.9158 19.1816 22.3065C18.7909 22.6972 18.261 22.9167 17.7085 22.9167C17.156 22.9167 16.6261 22.6972 16.2354 22.3065C15.8447 21.9158 15.6252 21.3859 15.6252 20.8334C15.6252 20.2809 15.8447 19.751 16.2354 19.3603C16.6261 18.9696 17.156 18.7501 17.7085 18.7501C18.261 18.7501 18.7909 18.9696 19.1816 19.3603C19.5723 19.751 19.7918 20.2809 19.7918 20.8334Z"
                        fill="white"
                      />
                    </svg>
                  </div>
                  <div class="catalog-content__card-basket-counter">123</div>
                </div>
              </div>
            </div>
          </div>
          <div class="catalog-content__card">
            <div
              class="catalog-content__card-mark catalog-content__card-mark--new"
            >
              новинка
            </div>
            <form class="catalog-content__card-favourites">
              <input type="checkbox" id="catalog__card-favourites--5" />
              <label
                for="catalog__card-favourites--5"
                name="catalog__card-favourites"
              >
              </label>
            </form>
            <a href="/" class="catalog-content__card-img">
              <img
                src="/local/templates/allmongolia_umax/assets/images/catalog-image-3.jpg"
                alt=""
              />
            </a>
            <div class="catalog-content__card-info">
              <a href="/" class="catalog-content__card-title">
                Безрукавка Удлинённая Из Шерсти Яка
              </a>
              <div class="catalog-content__card-subtitle">100% шерсть</div>
              <div class="catalog-content__card-availability">
                Есть в наличии
              </div>
              <div class="catalog-content__card-info-bottom">
                <div class="catalog-content__card-price-wrap">
                  <div class="catalog-content__card-price">6 210 руб.</div>
                  <div class="catalog-content__card-price--discount">
                    6 210 руб.
                  </div>
                </div>
                <div class="catalog-content__card-basket">
                  <div class="catalog-content__card-basket-icon">
                    <svg
                      width="25"
                      height="25"
                      viewBox="0 0 25 25"
                      fill="none"
                      xmlns="http://www.w3.org/2000/svg"
                    >
                      <path
                        d="M4.31475 4.16673L6.26058 16.8084C6.29559 17.0603 6.42139 17.2908 6.61436 17.4566C6.80732 17.6223 7.05416 17.7118 7.3085 17.7084H18.7502C18.9743 17.7084 19.1924 17.6362 19.3722 17.5024C19.5519 17.3686 19.6838 17.1804 19.7481 16.9657L22.8731 6.54903C22.9197 6.3935 22.9293 6.22922 22.9011 6.06932C22.8729 5.90943 22.8078 5.75833 22.7108 5.62808C22.6139 5.49784 22.4878 5.39207 22.3427 5.3192C22.1976 5.24633 22.0375 5.20839 21.8752 5.2084H6.5835L6.23975 2.98132C6.20502 2.72636 6.07652 2.49349 5.87933 2.32819C5.68732 2.16611 5.44306 2.07914 5.19183 2.0834H3.12516C2.98837 2.0834 2.85291 2.11034 2.72653 2.16269C2.60015 2.21504 2.48532 2.29177 2.38859 2.3885C2.29187 2.48523 2.21514 2.60006 2.16279 2.72644C2.11044 2.85282 2.0835 2.98827 2.0835 3.12507C2.0835 3.26186 2.11044 3.39732 2.16279 3.5237C2.21514 3.65008 2.29187 3.76491 2.38859 3.86164C2.48532 3.95837 2.60015 4.03509 2.72653 4.08744C2.85291 4.13979 2.98837 4.16673 3.12516 4.16673H4.31475ZM8.18558 15.6251L6.90433 7.29173H20.4752L17.9752 15.6251H8.18558ZM10.4168 20.8334C10.4168 21.3859 10.1973 21.9158 9.80663 22.3065C9.41593 22.6972 8.88603 22.9167 8.3335 22.9167C7.78096 22.9167 7.25106 22.6972 6.86036 22.3065C6.46966 21.9158 6.25016 21.3859 6.25016 20.8334C6.25016 20.2809 6.46966 19.751 6.86036 19.3603C7.25106 18.9696 7.78096 18.7501 8.3335 18.7501C8.88603 18.7501 9.41593 18.9696 9.80663 19.3603C10.1973 19.751 10.4168 20.2809 10.4168 20.8334ZM19.7918 20.8334C19.7918 21.3859 19.5723 21.9158 19.1816 22.3065C18.7909 22.6972 18.261 22.9167 17.7085 22.9167C17.156 22.9167 16.6261 22.6972 16.2354 22.3065C15.8447 21.9158 15.6252 21.3859 15.6252 20.8334C15.6252 20.2809 15.8447 19.751 16.2354 19.3603C16.6261 18.9696 17.156 18.7501 17.7085 18.7501C18.261 18.7501 18.7909 18.9696 19.1816 19.3603C19.5723 19.751 19.7918 20.2809 19.7918 20.8334Z"
                        fill="white"
                      />
                    </svg>
                  </div>
                  <div class="catalog-content__card-basket-counter">123</div>
                </div>
              </div>
            </div>
          </div>
          <div class="catalog-content__card">
            <div
              class="catalog-content__card-mark catalog-content__card-mark--new"
            >
              новинка
            </div>
            <form class="catalog-content__card-favourites">
              <input type="checkbox" id="catalog__card-favourites--6" />
              <label
                for="catalog__card-favourites--6"
                name="catalog__card-favourites"
              >
              </label>
            </form>
            <a href="/" class="catalog-content__card-img">
              <img
                src="/local/templates/allmongolia_umax/assets/images/catalog-image-3.jpg"
                alt=""
              />
            </a>
            <div class="catalog-content__card-info">
              <a href="/" class="catalog-content__card-title">
                Безрукавка Удлинённая Из Шерсти Яка
              </a>
              <div class="catalog-content__card-subtitle">100% шерсть</div>
              <div class="catalog-content__card-availability">
                Есть в наличии
              </div>
              <div class="catalog-content__card-info-bottom">
                <div class="catalog-content__card-price-wrap">
                  <div class="catalog-content__card-price">6 210 руб.</div>
                  <div class="catalog-content__card-price--discount">
                    6 210 руб.
                  </div>
                </div>
                <div class="catalog-content__card-basket">
                  <div class="catalog-content__card-basket-icon">
                    <svg
                      width="25"
                      height="25"
                      viewBox="0 0 25 25"
                      fill="none"
                      xmlns="http://www.w3.org/2000/svg"
                    >
                      <path
                        d="M4.31475 4.16673L6.26058 16.8084C6.29559 17.0603 6.42139 17.2908 6.61436 17.4566C6.80732 17.6223 7.05416 17.7118 7.3085 17.7084H18.7502C18.9743 17.7084 19.1924 17.6362 19.3722 17.5024C19.5519 17.3686 19.6838 17.1804 19.7481 16.9657L22.8731 6.54903C22.9197 6.3935 22.9293 6.22922 22.9011 6.06932C22.8729 5.90943 22.8078 5.75833 22.7108 5.62808C22.6139 5.49784 22.4878 5.39207 22.3427 5.3192C22.1976 5.24633 22.0375 5.20839 21.8752 5.2084H6.5835L6.23975 2.98132C6.20502 2.72636 6.07652 2.49349 5.87933 2.32819C5.68732 2.16611 5.44306 2.07914 5.19183 2.0834H3.12516C2.98837 2.0834 2.85291 2.11034 2.72653 2.16269C2.60015 2.21504 2.48532 2.29177 2.38859 2.3885C2.29187 2.48523 2.21514 2.60006 2.16279 2.72644C2.11044 2.85282 2.0835 2.98827 2.0835 3.12507C2.0835 3.26186 2.11044 3.39732 2.16279 3.5237C2.21514 3.65008 2.29187 3.76491 2.38859 3.86164C2.48532 3.95837 2.60015 4.03509 2.72653 4.08744C2.85291 4.13979 2.98837 4.16673 3.12516 4.16673H4.31475ZM8.18558 15.6251L6.90433 7.29173H20.4752L17.9752 15.6251H8.18558ZM10.4168 20.8334C10.4168 21.3859 10.1973 21.9158 9.80663 22.3065C9.41593 22.6972 8.88603 22.9167 8.3335 22.9167C7.78096 22.9167 7.25106 22.6972 6.86036 22.3065C6.46966 21.9158 6.25016 21.3859 6.25016 20.8334C6.25016 20.2809 6.46966 19.751 6.86036 19.3603C7.25106 18.9696 7.78096 18.7501 8.3335 18.7501C8.88603 18.7501 9.41593 18.9696 9.80663 19.3603C10.1973 19.751 10.4168 20.2809 10.4168 20.8334ZM19.7918 20.8334C19.7918 21.3859 19.5723 21.9158 19.1816 22.3065C18.7909 22.6972 18.261 22.9167 17.7085 22.9167C17.156 22.9167 16.6261 22.6972 16.2354 22.3065C15.8447 21.9158 15.6252 21.3859 15.6252 20.8334C15.6252 20.2809 15.8447 19.751 16.2354 19.3603C16.6261 18.9696 17.156 18.7501 17.7085 18.7501C18.261 18.7501 18.7909 18.9696 19.1816 19.3603C19.5723 19.751 19.7918 20.2809 19.7918 20.8334Z"
                        fill="white"
                      />
                    </svg>
                  </div>
                  <div class="catalog-content__card-basket-counter">123</div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="catalog-content-pagination">
          <div
            class="catalog-content-pagination__item-nav catalog-content-pagination__item-nav--prev"
          >
            <svg
              width="20"
              height="12"
              viewBox="0 0 20 12"
              fill="none"
              xmlns="http://www.w3.org/2000/svg"
            >
              <path
                d="M0.469669 5.46967C0.176777 5.76256 0.176777 6.23744 0.469669 6.53033L5.24264 11.3033C5.53553 11.5962 6.01041 11.5962 6.3033 11.3033C6.59619 11.0104 6.59619 10.5355 6.3033 10.2426L2.06066 6L6.3033 1.75736C6.59619 1.46447 6.59619 0.989593 6.3033 0.696699C6.01041 0.403806 5.53553 0.403806 5.24264 0.696699L0.469669 5.46967ZM20 5.25H1V6.75H20V5.25Z"
                fill="#838383"
              />
            </svg>
            Назад
          </div>
          <div class="catalog-content-pagination__item-wrap">
            <div class="catalog-content-pagination__item">1</div>
            <div class="catalog-content-pagination__item">2</div>
            <div class="catalog-content-pagination__item active">3</div>
            <div class="catalog-content-pagination__item">4</div>
          </div>
          <div class="catalog-content-pagination__item-nav">
            Далее<svg
              width="20"
              height="12"
              viewBox="0 0 20 12"
              fill="none"
              xmlns="http://www.w3.org/2000/svg"
            >
              <path
                d="M19.5303 5.46967C19.8232 5.76256 19.8232 6.23744 19.5303 6.53033L14.7574 11.3033C14.4645 11.5962 13.9896 11.5962 13.6967 11.3033C13.4038 11.0104 13.4038 10.5355 13.6967 10.2426L17.9393 6L13.6967 1.75736C13.4038 1.46447 13.4038 0.989593 13.6967 0.696699C13.9896 0.403806 14.4645 0.403806 14.7574 0.696699L19.5303 5.46967ZM0 5.25H19V6.75H0V5.25Z"
                fill="#838383"
              />
            </svg>
          </div>
        </div>
      </div>
  </div>
</section>

      
<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");
?>
