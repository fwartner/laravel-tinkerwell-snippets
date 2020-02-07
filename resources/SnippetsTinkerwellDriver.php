<?php

use Tinkerwell\ContextMenu\Label;
use Tinkerwell\ContextMenu\Submenu;
use Tinkerwell\ContextMenu\SetCode;
use Tinkerwell\ContextMenu\OpenURL;
use Fwartner\TinkerwellSnippets\TinkerwellSnippets;

class SnippetsTinkerwellDriver extends TinkerwellDriver
{
    /**
     * @var array
     */
    public $snippets = [];

    /**
     * @param $projectPath
     * @return bool
     */
    public function canBootstrap($projectPath)
    {
        return file_exists($projectPath . '/public/index.php') &&
            file_exists($projectPath . '/artisan');
    }

    /**
     * @param $projectPath
     */
    public function bootstrap($projectPath)
    {
        require_once $projectPath . '/vendor/autoload.php';

        $app = require_once $projectPath . '/bootstrap/app.php';

        $kernel = $app->make(\Illuminate\Contracts\Console\Kernel::class);

        $kernel->bootstrap();

        $this->refreshSnippets();
    }

    /**
     * @return array
     */
    public function contextMenu()
    {
        return [
            Label::create('Detected Laravel v' . app()->version()),

            Submenu::create('Artisan', collect(Artisan::all())->map(function ($command, $key) {
                return SetCode::create($key, "Artisan::call('" . $key . "', []);\nArtisan::output();");
            })->values()->toArray()),

//            OpenURL::create('Refresh Snippets', $this->refreshSnippets()),

            Submenu::create('Snippets', collect($this->snippets)->map(function ($snippet, $key) {
                return SetCode::create($snippet['title'], $snippet['snippet']);
            })->values()->toArray()),

            OpenURL::create('Tinkerwell Snippets Website', 'https://tinkerwell-snippets.com'),
        ];
    }

    /**
     *
     */
    private function refreshSnippets()
    {
        $this->snippets = (new TinkerwellSnippets())->getSnippets();
    }
}
