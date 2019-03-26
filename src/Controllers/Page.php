<?php

namespace InsteadSite\Controllers;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

class Page
{
    private $container;

    public function __construct(\Slim\Container $container) {
        $this->container = $container;
    }
    public function index(Request $request, Response $response): Response
    {
        return $this->container->view->render($response, 'index.html');
    }
}
