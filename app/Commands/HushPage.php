<?php

namespace ScaryLayer\Hush\Commands;

use File;
use Illuminate\Console\Command;
use Str;

class HushPage extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'hush:page {path} {--type=default}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new hush page';

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
     * @return void
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

        $this->info('Hush page created successfully.');
    }

    /**
     * Generate page's content
     *
     * @param string $path
     * @return string
     */
    private function generatePage(string $path): string
    {
        $content = File::get($path);

        $variables = $this->variables();
        foreach ($variables as $variable => $value) {
            $content = str_replace($variable, $value, $content);
        }

        return $content;
    }

    /**
     * Create new form page
     *
     * @return void
     */
    private function makeForm(): void
    {
        $content = $this->generatePage($this->templatesPath . 'form.pivot');
        File::put($this->destinationPath . 'edit.php', $content);
    }

    /**
     * Create new table page
     *
     * @return void
     */
    private function makeTable(): void
    {
        $content = $this->generatePage($this->templatesPath . 'table.pivot');
        File::put($this->destinationPath . 'index.php', $content);
    }

    /**
     * Get list of pivot variables
     *
     * @return array
     */
    private function variables(): array
    {
        $singular = Str::singular($this->argument('path'));

        return [
            '{{ singular }}' => $singular,
            '{{ plural }}' => $this->argument('path'),
            '{{ studly }}' => Str::studly($singular),
            '{{ prefix }}' => config('hush.app.prefix', 'admin')
        ];
    }
}
