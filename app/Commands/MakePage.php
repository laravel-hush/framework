<?php

namespace ScaryLayer\Hush\Commands;

use File;
use Illuminate\Console\Command;
use Str;

class MakePage extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:page {path} {--type=default}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new admin page';

    /**
     * Path to templates folder.
     *
     * @var string
     */
    private $templatesPath;

    /**
     * Destination path.
     *
     * @var string
     */
    private $destinationPath;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        $this->templatesPath = __DIR__ . '/../../resources/templates/';
        $this->destinationPath = config_path('hush/pages/');
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->destinationPath .= "/{$this->argument('path')}/";
        File::makeDirectory($this->destinationPath);

        switch ($this->option('type')) {
            case 'edit':
                $this->makeForm();
                break;
            case 'index':
                $this->makeTable();
                break;
            default:
                $this->makeTable();
                $this->makeForm();
                break;
        }
    }

    private function generatePage($path)
    {
        $content = File::get($path);

        $variables = $this->variables();
        foreach ($variables as $variable => $value) {
            $content = str_replace($variable, $value, $content);
        }

        return $content;
    }

    private function makeForm()
    {
        $content = $this->generatePage($this->templatesPath . 'form.pivot');
        File::put($this->destinationPath . 'edit.php', $content);
    }

    private function makeTable()
    {
        $content = $this->generatePage($this->templatesPath . 'table.pivot');
        File::put($this->destinationPath . 'index.php', $content);
    }

    private function variables()
    {
        return [
            '{{ singular }}' => Str::singular($this->argument('path')),
            '{{ plural }}' => $this->argument('path')
        ];
    }
}
