<?php

namespace AutoCatalog;

require __DIR__ . '/Controllers/ControllerBase.php';

use AutoCatalog\Controllers\ControllerBase;

// общие настройки
set_time_limit(0);
header('Content-type: text/html; charset=utf-8');
date_default_timezone_set("Europe/Moscow");

$time_start = time();
echo '###НАЧАЛО!###<br><br>';

// Проверяем передан ли путь к xml файлу через параметр
// $pathxml = 'C:\OpenServer\domains\test_smart_business\XML\data.xml';
// $pathxml = null;
$pathxml = null;
if (isset($argv[1])) $pathxml = $argv[1];

// Запуск контроллера
$controller = new ControllerBase($pathxml);
$controller->processing();
unset($controller);

// Конец
echo '<br>###КОНЕЦ!###<br>Потраченное время на скрпт: - ' . (time() - $time_start) . ' сек.<br>';
echo __FILE__, " - Done<br>";
