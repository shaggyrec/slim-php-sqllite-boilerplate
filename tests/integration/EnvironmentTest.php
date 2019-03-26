<?php

namespace tests\integration;

use InsteadSite\Test\FixtureIntegration;
use PHPUnit\Framework\TestCase;

class EnvironmentTest extends TestCase
{
    use FixtureIntegration;

    public function testPHPUnitIsSetUpRight(): void
    {
        $this->assertTrue(defined('INTEGRATION_TESTS_IN_PROGRESS'));
    }

    public function testFixtureIsLoaded(): int
    {
        $countOfRowsInFixture = self::$dbConnection->fetchColumn('SELECT count(1) FROM page');

        $this->assertGreaterThan(0, $countOfRowsInFixture);

        // preparation for the next test
        self::$dbConnection->executeQuery('DELETE FROM page');
        $this->assertCount(0, self::$dbConnection->fetchAll('SELECT * FROM page'));

        return $countOfRowsInFixture;
    }

    /**
     * @depends testFixtureIsLoaded
     * @param int $countOfRowsInFixture
     * @throws \Doctrine\DBAL\DBALException
     */
    public function testFixtureIsTheSameForEachTest(int $countOfRowsInFixture): void
    {
        $this->assertSame(
            (string)$countOfRowsInFixture,
            self::$dbConnection->fetchColumn('SELECT count(1) FROM page')
        );
    }
}
