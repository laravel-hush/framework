<?php

namespace ScaryLayer\Hush\Commands;

use File;
use Illuminate\Console\Command;

class HushImagable extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'hush:imagable {path}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new imagable model';

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
        $this->destinationPath = app_path('Models/Imagable/');
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle(): void
    {
        if (!File::exists($this->destinationPath)) {
            File::makeDirectory($this->destinationPath);
        }

        $content = $this->generateModel($this->templatesPath . 'models/image.pivot');
        File::put($this->destinationPath . "{$this->argument('path')}Image.php", $content);

        $this->info('Imagable model created successfully.');
    }

    /**
     * Generate model's content
     *
     * @param string $path
     * @return string
     */
    private function generateModel(string $path): string
    {
        $content = File::get($path);

        $variables = $this->variables();
        foreach ($variables as $variable => $value) {
            $content = str_replace($variable, $value, $content);
        }

        return $content;
    }

    /**
     * Get list of pivot variables
     *
     * @return array
     */
    private function variables(): array
    {
        return [
            '{{ path }}' => $this->argument('path')
        ];
    }
}
