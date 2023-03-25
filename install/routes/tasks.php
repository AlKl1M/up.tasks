<?php

use Bitrix\Main\Routing\Controllers\PublicPageController;
use Bitrix\Main\Routing\RoutingConfigurator;

return function (RoutingConfigurator $routes) {
	$routes->get('/', new PublicPageController('/local/modules/up.tasks/views/tasks-list.php'));
	$routes->get('/delete/{id}/', new PublicPageController('/local/modules/up.tasks/views/tasks-delete.php'))->where('id', '[0-9]+');
};