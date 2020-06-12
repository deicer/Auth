<?php

namespace Auth;

use RuntimeException;

class View
{
    /**
     * @param string $view
     * @param array  $vars
     */
    public static function render(string $view, array $vars = [])
    {
        extract($vars, EXTR_SKIP);

        $file = __DIR__."/Views/$view.php";

        if (is_readable($file)) {
            require $file;
        } else {
            throw new RuntimeException("$file не существует");
        }
    }
}
