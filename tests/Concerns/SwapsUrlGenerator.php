<?php

namespace Ugarit\Dusk\Tests\Concerns;

use Heritage\Container\Container;
use Heritage\Http\Request;
use Heritage\Routing\RouteCollection;
use Heritage\Routing\UrlGenerator;

trait SwapsUrlGenerator
{
    protected function swapUrlGenerator()
    {
        Container::getInstance()->bind('url', function () {
            return new class(new RouteCollection(), new Request()) extends UrlGenerator
            {
                public function route($name, $parameters = [], $absolute = true)
                {
                    $route = '/'.$name.'/'.implode('/', $parameters);

                    if ($absolute) {
                        $route = 'http://www.google.com'.$route;
                    }

                    return $route;
                }
            };
        });
    }
}
