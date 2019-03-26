<?php


namespace InsteadSite\Services;

use Psr\Container;

class View
{
    public function __invoke(Container\ContainerInterface $container)
    {
        return new \Slim\Views\PhpRenderer(__DIR__ . '/../templates');
    }
}
