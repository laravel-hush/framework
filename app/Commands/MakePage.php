<?php

namespace ScaryLayer\Hush\Commands;

use File;
use Illuminate\Console\Command;

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
    protected $description = 'Creates new admin page';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $templates = __DIR__ . '/../../resources/templates/';
        $destination = config_path('hush/pages/' . $this->argument('path')) . '/';

        File::makeDirectory($destination);

        switch ($this->option('type')) {
            case 'edit':
                File::copy($templates . 'form.php', $destination . 'edit.php');
                break;
            case 'index':
                File::copy($templates . 'table.php', $destination . 'index.php');
                break;
            default:
                File::copy($templates . 'table.php', $destination . 'index.php');
                File::copy($templates . 'form.php', $destination . 'edit.php');
                break;
        }
    }
}
