<?php

use App\Models\Workstation;
use App\services\ImportData\ImportExecutor;
use \App\services\ImportData\ExcelImportStrategy;
use App\services\ImportData\Validators\ValidationException;
use \Maatwebsite\Excel\Facades\Excel;
use \App\Imports\SimpleImport;

it('can read excel file', function () {
    $testFilePath = \Pest\testDirectory(
        str_replace('/', DIRECTORY_SEPARATOR, 'Feature/ImportManagement/SampleData/sample_excel_01.xlsx')
    );

    $arrayData = Excel::toCollection(new SimpleImport(), $testFilePath);

    expect($arrayData)->not->toBeEmpty();
    expect($arrayData[0][1][0])->toBe('Flexplek 1');
});

it('can read excel file with header', function () {
    $testFilePath = \Pest\testDirectory(
        str_replace('/', DIRECTORY_SEPARATOR, 'Feature/ImportManagement/SampleData/sample_excel_01.xlsx')
    );

    $importer = new ImportExecutor(new ExcelImportStrategy());
    $importer->execute($testFilePath);

    $workstation = Workstation::where('name', 'Flexplek 1');
    expect($workstation)->not->toBeEmpty();
});

it('fails when read excel file with validation issues', function () {
    $testFilePath = \Pest\testDirectory(
        str_replace('/', DIRECTORY_SEPARATOR, 'Feature/ImportManagement/SampleData/sample_excel_02_fail.xlsx')
    );

    try {
        $importer = new ImportExecutor(new ExcelImportStrategy());
        $importer->execute($testFilePath);
        expect()->fail('No ValidationException was thrown!');
    } catch (ValidationException $e) {
        foreach ($e->getErrors() as $error) {
            switch($error['row_number']) {
                case 3:
                    expect($error['message'])
                        ->toContain('Each workstation must have either a unique name or a user');
                break;
                case 4:
                    expect($error['message'])
                        ->toContain('User email is required if a user is provided');
                break;
            }
        }
    }

});
