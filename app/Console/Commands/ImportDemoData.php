<?php

namespace App\Console\Commands;

use App\services\ImportData\ExcelImportStrategy;
use App\services\ImportData\ImportExecutor;
use Illuminate\Console\Command;

class ImportDemoData extends Command
{
    protected $signature = 'import:demo';

    protected $description = 'Imports demo data from demo excel file';

    public function handle()
    {
        try {
            $demo_file = base_path('tests/Feature/ImportManagement/SampleData/sample_excel_01.xlsx');

            $importer = new ImportExecutor(new ExcelImportStrategy());
            $importer->execute($demo_file);

        } catch (\Exception $e) {
            $this->error('Import failed: ' . $e->getMessage());
        }

        $this->comment('Import finished successfully');
    }
}
