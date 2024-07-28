# User Management API

Этот проект предоставляет RESTful API для управления пользователями, включая функции регистрации, входа, получения информации о пользователе, обновления и удаления пользователей. Проект построен с использованием PHP и JWT для аутентификации.

## Установка

1. Склонируйте репозиторий:
    ```sh
    git clone https://github.com/GmftG/TestTask.git
    ```
2. Перейдите в директорию проекта:
    ```sh
    cd yourworkdir
    ```
3. Установите зависимости (если есть):
    ```sh
    composer require firebase/php-jwt
    ```

## Использование

### Конфигурация

Убедитесь, что ваш веб-сервер настроен для обработки PHP файлов и у вас настроен доступ к базе данных.

### Запуск докер файлов

Запустите сервер, чтобы обработать запросы к API (например, используя встроенный сервер PHP):
```sh
docker compose up

Endpoints

Вход пользователя
URL: /login
Метод: POST
Тело запроса: JSON с полями username и password
Ответ: JWT токен и имя пользователя

Создание пользователя
URL: /create
Метод: POST
Тело запроса: JSON с полями username и password
Ответ: Сообщение о создании пользователя

Получение информации о пользователе
URL: /about
Метод: GET
Заголовок: Авторизация с использованием JWT токена
Ответ: Информация о пользователе (имя пользователя и ID)

Обновление информации о пользователе
URL: /edit
Метод: PUT
Тело запроса: JSON с полем username
Заголовок: Авторизация с использованием JWT токена
Ответ: Сообщение о обновлении пользователя

Удаление пользователя
URL: /delete
Метод: GET
Заголовок: Авторизация с использованием JWT токена
Ответ: Сообщение о удалении пользователя
Обработка ошибок