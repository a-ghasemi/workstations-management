<?php

use App\Models\Workstation;
use App\services\ImportData\ImportExecutor;
use \App\services\ImportData\ExcelImportStrategy;
use \Maatwebsite\Excel\Facades\Excel;
use \App\Imports\SimpleImport;

it('can read excel file', function(){
    $testFilePath = \Pest\testDirectory(
        str_replace('/',DIRECTORY_SEPARATOR,'Feature/ImportManagement/SampleData/sample_excel_01.xlsx')
    );

    $arrayData = Excel::toCollection(new SimpleImport(), $testFilePath);

    expect($arrayData)->not->toBeEmpty();
    expect($arrayData[0][1][0])->toBe('Flexplek 1');
});

it('can read excel file with header', function(){
    $testFilePath = \Pest\testDirectory(
        str_replace('/',DIRECTORY_SEPARATOR,'Feature/ImportManagement/SampleData/sample_excel_01.xlsx')
    );

    $importer = new ImportExecutor(new ExcelImportStrategy());
    $importer->execute($testFilePath);

    $workstation = Workstation::where('name', 'Flexplek 1');
    expect($workstation)->not->toBeEmpty();
});
