<?php

declare(strict_types=1);

namespace App\Router;

use Nette;
use Nette\Application\Routers\RouteList;
use Nette\Routing\Route;


final class RouterFactory
{
	use Nette\StaticClass;

	public static function createRouter(): RouteList
	{
		$router = new RouteList;
		$router->addRoute('<presenter>/<action>[/<id>]', 'Front:Article:default');
        $router->addRoute('/backoffice<presenter>/<action>[/<id>]', 'Backoffice:Article:default');

        $router[] = new Route('http://%host%/%basePath%/<module>/</presenter>/<action>', [
            'module' => 'Front',
            'presenter' => 'Article',
            'action' => 'default',
        ]);

		return $router;
	}
}
