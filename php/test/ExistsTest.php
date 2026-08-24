<?php
declare(strict_types=1);

// Ovationincentives SDK exists test

require_once __DIR__ . '/../ovationincentives_sdk.php';

use PHPUnit\Framework\TestCase;

class ExistsTest extends TestCase
{
    public function test_create_test_sdk(): void
    {
        $testsdk = OvationincentivesSDK::test(null, null);
        $this->assertNotNull($testsdk);
    }
}
