<?php

class PageTest extends \InsteadSite\Test\ApplicationTestCase {
    public function testRootRoute(): void
    {
        $response = $this->get('/');
        $this->assertSame(200, $response->getStatusCode());
        $this->assertStringStartsWith('<!DOCTYPE html>', (string)$response->getBody());
    }
}
