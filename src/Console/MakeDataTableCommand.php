<?php

namespace Crushjs\MiniDataTables\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class MakeDataTableCommand extends Command
{
    protected $signature = 'make:datatable {name}';

    protected $description = 'Create a new DataTable class';

    public function handle()
    {
        $name = $this->argument('name');

        $path = app_path("DataTables/{$name}.php");

        // create folder if not exists
        File::ensureDirectoryExists(
            app_path('DataTables')
        );

        // template
        $stub = <<<PHP
<?php

namespace App\DataTables;

use Crushjs\MiniDataTables\MiniDataTable;
use App\Models\User;

class {$name} extends MiniDataTable
{
    public function query()
    {
        return User::query();
    }

    public function columns()
    {
        return [
            [
                'data' => 'id',
                'title' => 'ID',
            ],
            [
                'data' => 'name',
                'title' => 'Name',
            ],
        ];
    }
}
PHP;

        File::put($path, $stub);

        $this->info("DataTable created: {$path}");
    }
}
