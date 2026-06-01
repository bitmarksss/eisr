<?php

namespace App\Http\Controllers;

use App\Models\UploadedFile;
use App\Models\Employee;
use App\Models\LoanItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LoanController extends Controller
{
    /**
     * Display the loan files list with search and filters.
     */
    public function index(Request $request)
    {
        $query = UploadedFile::with('admin')->ofModule('loan');

        // Filter by Filename Search
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

        return view('pages.loan.index', compact('files'));
    }

    /**
     * Handle the Loan Excel batch upload.
     */
    public function upload(Request $request)
    {
        $request->validate([
            'excel_file' => 'required|file|mimes:xlsx,xls,csv|max:10240',
        ]);

        $file = $request->file('excel_file');
        $path = $file->store('uploads/loans');

        // Create the master Upload record linked to 'loan'
        $upload = UploadedFile::create([
            'original_filename' => $file->getClientOriginalName(),
            'storage_path' => $path,
            'module_type' => 'loan',
            'status' => 'processing',
            'row_count' => 0,
            'uploaded_by' => auth()->id() ?? 1,
        ]);

        try {
            DB::transaction(function () use ($upload) {
                
                // --- MOCK READING EXCEL ROWS FOR DEMONSTRATION ---
                // (In production, replace with your Laravel Excel Import class)
                $mockExcelRows = [
                    ['empid' => 'EMP-002', 'total' => 5000.00, 'date' => '2026-05-01'],
                    ['empid' => 'EMP-004', 'total' => 12000.00, 'date' => '2026-05-15'],
                ];

                $insertedCount = 0;

                foreach ($mockExcelRows as $row) {
                    $employee = Employee::firstOrCreate(
                        ['employee_code' => $row['empid']],
                        ['name' => 'Employee ' . $row['empid']]
                    );

                    // Insert specifically into loan_items
                    LoanItem::create([
                        'upload_id' => $upload->id,
                        'employee_id' => $employee->id,
                        'total' => $row['total'],
                        'date' => $row['date'],
                    ]);

                    $insertedCount++;
                }
                // -------------------------------------------------

                $upload->update([
                    'status' => 'completed',
                    'row_count' => $insertedCount
                ]);
            });

            return redirect()->back()->with('success', 'Loan spreadsheet processed successfully!');

        } catch (\Exception $e) {
            $upload->update(['status' => 'failed']);
            return redirect()->back()->with('error', 'Error processing loan file: ' . $e->getMessage());
        }
    }
}