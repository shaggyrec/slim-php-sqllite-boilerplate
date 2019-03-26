<?php


namespace InsteadSite;

use Psr\Container\ContainerInterface;
use Slim\App;
use Slim\Container;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;


class Application
{
    /**
     * @var App
     */
    private $app;

    public function __construct(array $settings)
    {
        $this->app = new App(
            self::registerServices(new Container(['settings' => $settings]))
        );

        self::setupRoutes($this->app);
    }


    /**
     * @param bool $silent
     * @return Response
     * @throws \Slim\Exception\MethodNotAllowedException
     * @throws \Slim\Exception\NotFoundException
     */
    public function run(bool $silent = false): Response
    {
        return $this->app->run($silent);
    }

    /**
     * @return ContainerInterface
     */
    public function container(): ContainerInterface
    {
        return $this->app->getContainer();
    }


    /**
     * @param Request $req
     */
    public function mockRequest(Request $req): void
    {
        $this->app->getContainer()['request'] = $req;
    }

    private static function registerServices(ContainerInterface $container): ContainerInterface
    {
        $container['db'] = new Services\DoctrineDbal;
        $container['view'] = new Services\View;

        return $container;
    }

    private static function setupRoutes(App $app): void
    {
        $app->get('/', Controllers\Page::class . ':index');
    }
}
