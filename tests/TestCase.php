<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use SebastianBergmann\Type\VoidType;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function setUp(): void{
        parent::setUp();
        $this->withoutVite();
    }
}
