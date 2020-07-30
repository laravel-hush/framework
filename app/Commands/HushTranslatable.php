<?php

namespace ScaryLayer\Hush\Commands;

use File;
use Illuminate\Console\Command;

class HushTranslatable extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'hush:translatable {path}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new translatable model';

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
        $this->destinationPath = app_path('Models/Translatable/');
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        if (!File::exists($this->destinationPath)) {
            File::makeDirectory($this->destinationPath);
        }

        $content = $this->generateModel($this->templatesPath . 'models/translation.pivot');
        File::put($this->destinationPath . "{$this->argument('path')}Translation.php", $content);

        $this->info('Translatable model created successfully.');
    }

    private function generateModel($path)
    {
        $content = File::get($path);

        $variables = $this->variables();
        foreach ($variables as $variable => $value) {
            $content = str_replace($variable, $value, $content);
        }

        return $content;
    }

    private function variables()
    {
        return [
            '{{ path }}' => $this->argument('path')
        ];
    }
}
