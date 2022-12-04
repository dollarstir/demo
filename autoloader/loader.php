
<?php

spl_autoload_register(function ($class) {
    $path = __DIR__.'/../core/'.strtolower(str_replace('\\', '/', $class)).'.php';

    require $path;
});
