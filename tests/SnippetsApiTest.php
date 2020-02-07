<?php

namespace Fwartner\TinkerwellSnippets\Tests;

use Fwartner\TinkerwellSnippets\TinkerwellSnippets;
use Orchestra\Testbench\TestCase;
use Fwartner\TinkerwellSnippets\TinkerwellSnippetsServiceProvider;

class SnippetsApiTest extends TestCase
{
    /**
     * @param \Illuminate\Foundation\Application $app
     * @return array
     */
    protected function getPackageProviders($app)
    {
        return [TinkerwellSnippetsServiceProvider::class];
    }

    /** @test */
    public function test_can_create_new_token()
    {
        $apiLayer = new TinkerwellSnippets();
        $token = $apiLayer->generateNewToken();

        if ($token) {
            $this->assertTrue(true);
        }
    }


}
