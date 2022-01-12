<?php

use App\Kernel;

require_once dirname(__DIR__).'/vendor/autoload_runtime.php';

return function (array $context) {
    //echo '<pre>';
    //var_dump($context);
    //echo '</pre>';
    //echo '<b>FATAL ERROR : </b> you are running php 1.';
    return new Kernel($context['APP_ENV'], (bool) $context['APP_DEBUG']);
};
