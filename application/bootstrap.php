<?php

// подключаем файлы ядра
require_once 'core/model.php';
require_once 'core/view.php';
require_once 'core/controller.php';
require_once 'libs/Session.php';
require_once 'config/config.php';
require_once 'libs/Database.php';


require_once 'core/route.php';
Route::start(); // запускаем маршрутизатор
