Я разрабатывал на локальном сервере OpenServer: PHP_7.2, MySQL-8.0, Apache_2.4-PHP7.2-7.4

Порядок развертывания:
1. Склонировать в папку localhost (важно именно localhost, чтоб facebook не ругался)
2. Запустить composer install
3. Запустить команду php init (Выбрать Development mode)
4. Создать БД с нужным Вам именем, заполнить данные для подключения в файле common/config/main-local.php
5. Запустить команду php yii migrate

Данные для входа в админку - логин: admin , пароль: qqqqqq .
Токен для api можно посмотреть в api/config/params.php