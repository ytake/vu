<?php
declare(strict_types = 1);

namespace Vu\Router;

/**
 * Class Route
 *
 * @method void get($route, $action)
 * @method void post($route, $action)
 * @method void put($route, $action)
 * @method void patch($route, $action)
 * @method void delete($route, $action)
 * @method void options($route, $action)
 */
class Route implements RouteInterface
{
    /** @var array */
    protected $collection = [];

    /** @var array */
    protected $methods = [
        'GET',
        'POST',
        'PUT',
        'PATCH',
        'DELETE',
        'OPTIONS',
    ];

    /**
     * @return array
     */
    public function getCollection() : array
    {
        return $this->collection;
    }

    /**
     * @param string $name
     * @param array  $arguments
     */
    public function __call(string $name, array $arguments)
    {
        foreach ($this->methods as $method) {
            if ($method === strtoupper($name)) {
                $this->collection[] = [
                    $method,
                    $arguments[0],
                    $arguments[1],
                ];
            }
        }
    }
}
