<?php

namespace Fwartner\TinkerwellSnippets;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Fwartner\TinkerwellSnippets\Skeleton\SkeletonClass
 */
class TinkerwellSnippetsFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'tinkerwell-snippets';
    }
}
