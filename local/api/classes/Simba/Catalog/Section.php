<?php
/**
 * Created by PhpStorm.
 * User: maksim
 * Date: 2019-04-03
 * Time: 16:37
 */

namespace Simba\Catalog;

use Bitrix\Main\Context;

class Section
{

    private $sort_params = [];
    private $per_page = [];
    private $view_modes = [];

    public function __construct()
    {

        // Настройки сортировок
        $this->sort_params = config('section.sort_params', [
            'name' => [
                'code' => 'name',
                'component_param' => 'NAME',
                'name' => 'Наименованию',
            ],
        ]);

        // Количество товаров на страницу
        $this->per_page = config('section.per_page', [20, 50]);

        // Режим просмотра
        $this->view_modes = config('section.view_modes', [
            'list' => [
                'name' => 'Список',
            ],
        ]);

    }


    /**
     * Собираем настройки списка товаров
     *
     * @return array
     */
    public function listParams()
    {
        return [
            'sort' => $this->getSortParams(),
            'nav' => $this->getNavParams(),
            'mode' => $this->getViewParams(),
        ];
    }


    /**
     * Метод получает параметры сортировки и возвращает подготовленный массив со ссылками и параметрами для компонента
     *
     * @return array
     */
    private function getSortParams()
    {
        // Возможные варианты сортировок
        $sort_params = $this->sort_params;

        // Получаем данные запроса
        $request = Context::getCurrent()->getRequest();
        $sort = $request->get("sort");
        $sort_order = $request->get("sort_order");

        // Инициализация настроек сессии
        if (empty($_SESSION['catalog_sort_params'])) {
            $_SESSION['catalog_sort_params'] = [];
        }


        if (!empty($sort)) {

            // Устанавливаем настройки сортировки если они заданы в запросе
            $sort_order = ($sort_order == 'asc' ? 'asc' : 'desc');
            $sort = (array_key_exists($sort, $sort_params) ? $sort : array_key_first($sort_params));
            $_SESSION['catalog_sort_params']['sort_order'] = $sort_order;
            $_SESSION['catalog_sort_params']['sort'] = $sort;

        } elseif (
            !empty($_SESSION['catalog_sort_params']) &&
            !empty($_SESSION['catalog_sort_params']['sort_order']) &&
            !empty($_SESSION['catalog_sort_params']['sort'])
        ) {
            // Устанавливаем параметры из сессии
            $session_sort_order = $_SESSION['catalog_sort_params']['sort_order'];
            $session_sort = $_SESSION['catalog_sort_params']['sort'];

            // На всякий случай проверяем корректность данных в сессии
            $sort_order = ($session_sort_order == 'asc' ? 'asc' : 'desc');
            $sort = (array_key_exists($session_sort, $sort_params) ? $session_sort : array_key_first($sort_params));
        } else {
            // Устанавливаем параметры поумолчанию
            $sort_order = 'asc';
            $sort = array_key_first($sort_params);
        }
        $sort_order = $sort_params[$sort]['sort_order'];
        // Готовим результирующий массив
        $return = [
            'sort_param' => $this->getComponentSortParams($sort),
            'sort_order' => strtoupper($sort_order),
            'sort_urls' => $this->getSortUrls($sort, $sort_order),
        ];

        return $return;
    }


    /**
     * Метод получает параметр сортировки для компонента каталога
     *
     * @param $sort - Название параметра в URL
     * @return mixed - Название параметра для передачи в компонент
     */
    private function getComponentSortParams($sort)
    {

        if (array_key_exists($sort, $this->sort_params)) {
            return $this->sort_params[$sort]['component_param'];
        }

        return $this->sort_params[array_key_first($this->sort_params)]['component_param'];
    }


    /**
     * Подготовка массива с ссылками для сортировки
     *
     * @param $current_sort - Текущий параметр сортировки
     * @param $current_sort_order - Текущее направление сортировки
     * @return array
     */
    private function getSortUrls($current_sort, $current_sort_order)
    {
        global $APPLICATION;

        if (!is_array($this->sort_params)) {
            return [];
        }

        $sorts = [];
        foreach ($this->sort_params as $key => $sort) {
            if ($key == $current_sort) {
                $sort_order = ($current_sort_order == 'asc' ? 'desc' : 'asc');
            } else {
                $sort_order = $current_sort_order;
            }
            $sort_url = $APPLICATION->GetCurPageParam('sort='.$key, ['sort_order', 'sort']);

            $sorts[] = [
                'active' => ($key == $current_sort),
                'url' => $sort_url,
                'name' => $sort['name'],
                'component_param' => $sort['component_param'],
                'code' => $key,
                'order' => $current_sort_order,
            ];
        }

        return $sorts;
    }


    /**
     * Собираем параметры для установки количества товаров на страницу
     *
     * @return array
     */
    private function getNavParams()
    {
        global $APPLICATION;


        // Получаем данные запроса
        $request = Context::getCurrent()->getRequest();
        $per_page = intval($request->get("per_page"));

        if (!empty($per_page) && in_array($per_page, $this->per_page)) {
            $_SESSION['catalog_per_page'] = $per_page;
        } elseif (
            !empty($_SESSION['catalog_per_page']) &&
            in_array($_SESSION['catalog_per_page'], $this->per_page)
        ) {
            $per_page = $_SESSION['catalog_per_page'];
        } else {
            $per_page = $this->per_page[0];
        }

        $per_page_urls = [];

        // Собираем массив ссылок на установку количества элементов на страницу
        foreach ($this->per_page as $num) {
            $per_page_urls[] = [
                'active' => ($per_page == $num),
                'name' => $num,
                'url' => $APPLICATION->GetCurPageParam('per_page='.$num, ['per_page']),
            ];
        }

        return [
            'per_page_param' => $per_page,
            'urls' => $per_page_urls,
        ];

    }


    /**
     * Метод получает параметры представления списка товаров
     *
     * @return array
     */
    private function getViewParams()
    {
        global $APPLICATION;


        // Получаем данные запроса
        $request = Context::getCurrent()->getRequest();
        $view_mode = $request->get("view_mode");

        if (!empty($view_mode) && array_key_exists($view_mode, $this->view_modes)) {
            $_SESSION['catalog_view_mode'] = $view_mode;
        } elseif (
            !empty($_SESSION['catalog_view_mode']) &&
            array_key_exists($_SESSION['catalog_view_mode'], $this->view_modes)
        ) {
            $view_mode = $_SESSION['catalog_view_mode'];
        } else {
            $view_mode = array_keys($this->view_modes)[count($this->view_modes)-1];
        }

        $urls = [];

        // Собираем массив ссылок на установку количества элементов на страницу
        foreach ($this->view_modes as $key => $mode) {
            $urls[] = [
                'active' => ($key == $view_mode),
                'name' => $mode['name'],
                'url' => $APPLICATION->GetCurPageParam('view_mode='.$key, ['view_mode']),
                'code' => $key,
            ];
        }
        return [
            'view_mode_param' => $view_mode,
            'urls' => $urls,
        ];

    }


}