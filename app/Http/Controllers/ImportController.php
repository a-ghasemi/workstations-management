<?php

namespace App\Http\Controllers;

use App\Models\Workstation;
use App\services\ImportData\ExcelImportStrategy;
use App\services\ImportData\ImportExecutor;
use Illuminate\Http\Request;
use Matrix\Exception;

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

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Import failed: ' . $e->getMessage());
        }

        return redirect()->route('home')->with('success', 'Import successful!');
    }
}
