<?php

namespace App\Http\Controllers;

use App\Models\{
    Employee,
    CarenderiaItem,
    UploadedFile,
};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

use App\Imports\CarenderiaItemImport;
use Maatwebsite\Excel\Facades\Excel;

class CarenderiaController extends Controller
{
    /**
     * Display the file list with search and filters.
     */
    public function index(Request $request)
    {
        $query = UploadedFile::with('admin')->ofModule('carenderia');

        // Filter by Hashed/Original Filename Search
        if ($request->filled('search')) {
            $query->search($request->input('search'));
        }

        // Filter by Status (completed, processing, failed)
        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }

        // Filter by Date Range
        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->input('date_from'));
        }
        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->input('date_to'));
        }

        $files = $query->latest()->paginate(10)->withQueryString();

        return view('pages.carenderia.index', compact('files'));
    }

    /**
     * Handle the Excel batch upload and process rows.
     */
    public function upload(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'excel_file' => 'required|file|mimes:xlsx,xls,csv|max:10240',
        ]);

        if ($validator->fails()) {
            // Your custom logic when validation fails
            return back()->with('notification', [
                'status' => 'error',
                'title' => 'Validation Error',
                'messages' => $validator->errors()->messages(),
            ])->withInput();
        }

        $file = $request->file('excel_file');
        
        // 1. Store the file securely
        $path = $file->store('uploads/carenderia');

        // 2. Create the master Upload registry record
        $upload = UploadedFile::create([
            'original_filename' => $file->getClientOriginalName(),
            'storage_path' => $path,
            'module_type' => 'carenderia',
            'status' => 'processing', // Ideal state if using queues
            'row_count' => 0,
            'uploaded_by' => auth()->id() ?? 1, // Fallback to ID 1 for testing if auth isn't setup
        ]);

       try {
            // This pushes the import logic to the queue automatically!
            Excel::queueImport(new CarenderiaItemImport($upload->id), storage_path('app/' . $path));

            return redirect()->back()->with('success', 'Excel file uploaded and is processing in the background!');

        } catch (\Exception $e) {
            $upload->update(['status' => 'failed']);
            return redirect()->back()->with('error', 'Could not queue the spreadsheet: ' . $e->getMessage());
        }
    }
}