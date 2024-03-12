<?php

namespace App\Http\Controllers;

use App\services\ImportData\ExcelImportStrategy;
use App\services\ImportData\ImportExecutor;
use App\services\ImportData\Validators\ValidationException;
use Illuminate\Http\Request;

class ImportController extends Controller
{
    public function create()
    {
        return view('import');
    }

    public function store(Request $request)
    {
        $request->validate([
            'excel_file' => 'required|file',
        ]);

        try {
            $uploadedFile = $request->file('excel_file');

            $importer = new ImportExecutor(new ExcelImportStrategy());
            $importer->execute($uploadedFile);

        } catch (ValidationException $e) {
            return redirect()->back()->with('error', nl2br($e->getErrorMessages()));
        }

        return redirect()->route('home')->with('success', 'Import successful!');
    }
}
