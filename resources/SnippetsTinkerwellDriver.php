<?php

use Tinkerwell\ContextMenu\Label;
use Tinkerwell\ContextMenu\Submenu;
use Tinkerwell\ContextMenu\SetCode;
use Tinkerwell\ContextMenu\OpenURL;
use Fwartner\TinkerwellSnippets\TinkerwellSnippets;

class SnippetsTinkerwellDriver extends TinkerwellDriver
{
    public function canBootstrap($projectPath)
    {
        return file_exists($projectPath . '/public/index.php') &&
            file_exists($projectPath . '/artisan');
    }

    public function bootstrap($projectPath)
    {
        require_once $projectPath . '/vendor/autoload.php';

        $app = require_once $projectPath . '/bootstrap/app.php';

        $kernel = $app->make(\Illuminate\Contracts\Console\Kernel::class);

        $kernel->bootstrap();
    }

    public function contextMenu()
    {
        return [
            Label::create('Detected Laravel v' . app()->version()),

            Submenu::create('Artisan', collect(Artisan::all())->map(function ($command, $key) {
                return SetCode::create($key, "Artisan::call('" . $key . "', []);\nArtisan::output();");
            })->values()->toArray()),

            Submenu::create('Snippets', collect((new TinkerwellSnippets())->getSnippets())->map(function ($snippet, $key) {
                return SetCode::create($snippet->title, $snippet->snippet);
            })->values()->toArray()),

            OpenURL::create('Documentation', 'https://tinkerwell-snippets.xyz'),
        ];
    }
}
