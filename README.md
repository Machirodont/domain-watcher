Сервис проверки доменов на доступность

Локальное развертывание и запуск
---
  - Окружение, на котором проверялось: Ubuntu 22.04, docker v27.0, docker-compose v1.29
  - Порт 8080 должен быть свободен
  - Скопировать ./laravel/.env.exapmle в ./laravel/.env 
```cp ./laravel/.env.example ./laravel/.env```
  - Запустить команду ```make install``` (на Linux, понадобится пароль для sudo) или соответствущую последовательность команд из Makefile (Windows/Mac)
  - npm install
  - npm build (npm run dev)

Схема смены статусов доменов
---
 - UNCHECKED\
   - Дается при создании/сбросе(Reset) домена
   - проверка SUCCESS -> ONLINE
   - проверка FAIL -> OFFLINE

- ONLINE
   - проверка FAIL ->
      - если количество FAIL подряд больше GO_OFFLINE_THRESHOLD \
        ИЛИ доля FAIL больше OFFLINE_STABILITY_THRESHOLD за STABILITY_PERIOD \
        -> OFFLINE
- 
- OFFLINE
   - проверка SUCCESS ->
      - если количество SUCCESS подряд больше GO_ONLINE_THRESHOLD \
        И доля SUCCESS больше ONLINE_STABILITY_THRESHOLD за STABILITY_PERIOD \
        -> ONLINE
