<?php

namespace Tests;

use Laravel\Lumen\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    public function getDefaultErrorStructure(): array
    {
        return [
            'message',
            'errors' => [
                'status_code',
                'status_text'
            ]
        ];
    }

    public function getDefaultSuccessStructure(): array
    {
        return ['message', 'dict', 'data'];
    }

    public function getDefaultPaginationStructure(): array
    {
        return [
            'message',
            'meta' => [
                'status_code',
                'status_text'
            ]
        ];
    }

    public function createApplication()
    {
        return require __DIR__.'/../bootstrap/app.php';
    }
}
