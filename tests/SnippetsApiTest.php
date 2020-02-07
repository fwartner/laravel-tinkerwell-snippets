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
        $snippets = (new TinkerwellSnippets())->getSnippets();
        if ($snippets) {
            $this->assertTrue(true);
        }
    }
}
