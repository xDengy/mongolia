# Webpack Umax



### Перед началом использования необходимо установить все пакеты командой:
```
npm i
```
### Сборка включает в себя:

- vue js - version (^3.2.38)
- axios - version (^0.27.2)
- jquery - version (^3.6.1)
- lodash - version (^4.17.21)
- sass - version (^1.54.8)
- swiper - version (^8.3.2)
- vue-final-modal - version (^3.4.4)
- vue-toastification - version (^2.0.0-rc.5)

### Файловая структура

- dist - содержит скомпилированные css и js бандлы
- src - содержит все исходники
- src/components - содержит vue js компоненты
- src/helpers - тут могут располагаться ваши js файлы с хелперами
- src/scripts - тут могут располагаться ваши js файлы
- src/scss - тут располагаются scss файлы

### Использование
Запуск в режиме разработке, при любом изменение файлов сборка будет пересобираться
```
npm run watch
```
Запуск в режиме продакшена, выполняется минификация css и js файлов
```
npm run prod
```

### Автор
Стариков Александр - Backend Middle Developer (UMAX)
