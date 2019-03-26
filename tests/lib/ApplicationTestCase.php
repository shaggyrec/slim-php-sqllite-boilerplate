<?php


namespace InsteadSite\Test;

use InsteadSite\Application;
use PHPUnit\Framework\TestCase;
use Slim\Http;
use \Psr\Http\Message\ResponseInterface as Response;


abstract class ApplicationTestCase extends TestCase
{
    use FixtureIntegration;

    /**
     * @var Application
     */
    protected $app;

    protected function setUp(): void
    {
        $this->app = new Application([]);
        $this->app->container()['db'] = function () { return self::$dbConnection; };
        unset(
            $this->app->container()['errorHandler'],
            $this->app->container()['phpErrorHandler']
        );
    }

    protected function tearDown(): void
    {
        unset($this->app);
    }

    protected function get(string $uri, array $params = []): Response
    {
        $req = Http\Request::createFromEnvironment(
            Http\Environment::mock([
                'REQUEST_METHOD' => 'GET',
                'REQUEST_URI'    => $uri,
                'QUERY_STRING' => http_build_query($params)
            ])
        );

        $this->app->mockRequest($req);

        return $this->app->run(true);
    }
}

