<?php

namespace Auth;

class Router
{
    // массив с маршрутами
    private $routes;
    private $uri;

    /**
     * Router constructor.
     *
     * @param string $uri
     */
    public function __construct(string $uri)
    {
        $this->routes = (require __DIR__.'/Configs/routes.php')['routes'];
        $this->uri = $uri;
    }

    public function run()
    {
        // Проверяем есть ли у нас такой маршрут, если нет то выводим стартовую страницу
        if (!$this->isFoundRoute()) {
            $this->uri = '/';
        }

        $this->runController();
    }

    /**
     * @return bool
     */
    private function isFoundRoute(): bool
    {
        return array_key_exists($this->uri, $this->routes);
    }

    public function runController(): void
    {
        // Получаем имя контроллера и экшена
        $handler = explode('@', $this->routes[$this->uri]);
        $controller = '\Auth\\Controllers\\'.$handler[0];
        $action = $handler[1];

        // Запускаем соответствующий входящему пути контроллер и метод
        $controllerObject = new $controller();
        $controllerObject->$action();
    }
}
