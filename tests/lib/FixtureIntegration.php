<?php


namespace InsteadSite\Test;


use Doctrine\DBAL;

trait FixtureIntegration
{
    /**
     * @var DBAL\Connection
     */
    private static $dbConnection;

    public static function setUpBeforeClass(): void
    {
        parent::setUpBeforeClass();

        self::$dbConnection = dbConnectionSingleton();
    }

    protected function setUp(): void
    {
        parent::setUp();

        self::$dbConnection->beginTransaction();
    }

    protected function tearDown(): void
    {
        parent::tearDown();

        self::$dbConnection->rollBack();
    }
}

function dbConnectionSingleton()
{
    static $connection;

    if ($connection === null) {
        $connection = DBAL\DriverManager::getConnection(
               (require __DIR__ . '/../../.settings.php')['settings']['dbTest']
        );
    }

    return $connection;
}

