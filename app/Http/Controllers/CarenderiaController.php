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
            // dd($validator);
            // Your custom logic when validation fails
            return back()->with('notification', [
                'status' => 'error',
                'message' => $validator->errors(),

            ])->withInput();
        }

        dd($validator);

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
            // Use a Database Transaction for safe batch imports
            DB::transaction(function () use ($upload, $path) {
                
                // Note: In production, you would pass this to Maatwebsite Laravel Excel:
                // Excel::import(new CarenderiaImport($upload->id), storage_path('app/' . $path));
                
                // --- MOCK READING EXCEL ROWS FOR DEMONSTRATION ---
                $mockExcelRows = [
                    ['empid' => 'EMP-001', 'total' => 150.00, 'date' => '2026-05-20'],
                    ['empid' => 'EMP-002', 'total' => 85.50,  'date' => '2026-05-21'],
                    ['empid' => 'EMP-003', 'total' => 210.00, 'date' => '2026-05-21'],
                ];

                $insertedCount = 0;

                foreach ($mockExcelRows as $row) {
                    // Match or gracefully initialize the employee profile
                    $employee = Employee::firstOrCreate(
                        ['employee_code' => $row['empid']],
                        ['name' => 'Employee ' . $row['empid']] // Placeholder name
                    );

                    // Insert the item linked to the upload and employee
                    CarenderiaItem::create([
                        'upload_id' => $upload->id,
                        'employee_id' => $employee->id,
                        'total' => $row['total'],
                        'date' => $row['date'],
                    ]);

                    $insertedCount++;
                }
                // -------------------------------------------------

                // Update registry with complete stats
                $upload->update([
                    'status' => 'completed',
                    'row_count' => $insertedCount
                ]);
            });

            return redirect()->back()->with('success', 'Excel batch processed successfully!');

        } catch (\Exception $e) {
            // Fail safely without corrupting data state
            $upload->update(['status' => 'failed']);
            return redirect()->back()->with('error', 'Error reading spreadsheet data: ' . $e->getMessage());
        }
    }
}