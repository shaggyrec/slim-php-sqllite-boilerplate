<?php


namespace tests\unit;

use PHPUnit\Framework\TestCase;

class EnvironmentTest extends TestCase
{
    public function testPHPUnitIsSetUpRight(): void
    {
        $this->assertTrue(defined('UNIT_TESTS_IN_PROGRESS'));
    }
}

