document.addEventListener('DOMContentLoaded', function () {
    if ($("div").is("#map")) {

        ymaps
            .load()
            .then(maps => {
                const coord = [51.835955, 107.632463],
                    myMap = new maps.Map("map", {
                        center: coord,
                        zoom: 16,
                        controls: ["zoomControl"],
                    }),
                    myPlacemarkWithContent = new maps.Placemark(
                        [51.835955, 107.632463],
                        {
                            hintContent: "г. Улан-Удэ, ул. Моховая, д. 8А, помещ. I.",
                        },
                        {
                            iconLayout: "default#imageWithContent",
                            iconImageHref: "/local/templates/allmongolia_umax/assets/images/point.svg",
                            iconImageSize: [137, 156],
                            iconImageOffset: [-60, -107],
                        }
                    );
                myMap.geoObjects.add(myPlacemarkWithContent);
                myMap.behaviors.disable("scrollZoom");
                if (device.mobile()) {
                    myMap.behaviors.disable("drag");
                }
            })
            .catch(error => console.log('Ошибка при загрузке Yandex Maps', error));
    }

    $("#contacts-bottom__feedback--phone").mask("+7 (000)-000-00-00", {});
})
