<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use App\Models\{
    DailyReportHeader,
    InventoryItem, 
    Level,
    Location};
use Illuminate\Support\Facades\Validator;

class DailyReportController extends Controller
{
    private const TYPES = ['total', 'sinug-ang', 'l03', 'l7', 'l8', 'l9', 'l10', 'l11', 'l12', 'l425', 'l460', 'summary'];

    private const MONTHS = [
        1 => 'January',
        2 => 'February',
        3 => 'March',
        4 => 'April',
        5 => 'May',
        6 => 'June',
        7 => 'July',
        8 => 'August',
        9 => 'September',
        10 => 'October',
        11 => 'November',
        12 => 'December',
    ];

    public function daily(Request $request)
    {
        $reportRelations = [
            'level',
            'details.items.item',
            'details.directions',
            'owner'
        ];

        $reports = DailyReportHeader::with($reportRelations)
            ->when($request->filled('date'), fn ($query) =>
                $query->whereDate('report_date', $request->input('date')))
            ->when($request->filled('month'), fn ($query) =>
                $query->whereMonth('report_date', $request->integer('month')))
            ->when($request->filled('level_id'), fn ($query) =>
                $query->where('level_id', $request->integer('level_id')))
            ->latest('report_date')
            ->latest('id')
            ->paginate(10)
            ->withQueryString();

        $selectedReport = $request->filled('report_id')
            ? DailyReportHeader::with($reportRelations)->find($request->integer('report_id'))
            : null;
            
        return view('pages.reports.daily.index', [
            'months' => self::MONTHS,
            'types' => self::TYPES,
            'levels' => Level::where('is_active', true)->orderBy('sort_order')->orderBy('name')->get(),
            'reports' => $reports,
            'selectedReport' => $selectedReport,
        ]);
    }

    public function create(Request $request)
    {
        // $locations = ['total', 'sinug-ang', 'l03', 'l7', 'l8', 'l9', 'l10', 'l11', 'l12', 'l425', 'l460', 'summary'];
        $locations = Level::get();

        $materials = ['neogel','pulsar','anfo','safety_fuse','obc','exel','cordtex','fuse_lighter','ebc','bill_wire'];
      
        $materials = InventoryItem::with(['unit', 'variants'])
            ->get()
            ->groupBy('name');
            
        $directions = ['stope','robbing','horizontal','raise','winze','shaft_chamber_orepass'];
        $sub_direction = ['PB', 'SB'];

        return view('pages.reports.daily.forms.daily', [
            'locations' => $locations,
            'materials' => $materials,
            'directions' => $directions,
            'sub_direction' => $sub_direction,
            'months' => self::MONTHS,
            'types' => self::TYPES,
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'report_date' => [
                'required',
                'date',
                Rule::unique('daily_report_headers', 'report_date')
                    ->where(fn ($query) => $query->where('level_id', $request->input('location_id'))),
            ],
            'location_id' => ['required', 'exists:levels,id'],
            'shifts' => ['required', 'array'],
            'shifts.*.no_blast' => ['nullable', 'boolean'],
            'shifts.*.rows' => ['nullable', 'array'],
            'shifts.*.rows.*.contractor_name' => ['required', 'string', 'max:255'],
            'shifts.*.rows.*.support' => ['nullable', 'string', 'max:255'],
            'shifts.*.rows.*.drill_steel' => ['nullable', 'integer', 'min:0'],
            'shifts.*.rows.*.working_place' => ['required', 'string', 'max:255'],
            'shifts.*.rows.*.materials.*' => ['nullable', 'numeric', 'min:0'],
            'shifts.*.rows.*.directions.*.pb' => ['nullable', 'integer', 'min:0'],
            'shifts.*.rows.*.directions.*.sb' => ['nullable', 'integer', 'min:0'],
        ]);

        if ($validator->fails()) {
            return back()
                ->with('error', 'Failed to save daily report.')
                ->withErrors($validator)
                ->withInput();
        }

        $validated = $validator->validated();

        DB::transaction(function () use ($validated) {
            if (DailyReportHeader::where('report_date', $validated['report_date'])
                ->where('level_id', $validated['location_id'])
                ->exists()) {
                throw \Illuminate\Validation\ValidationException::withMessages([
                    'report_date' => 'A daily report already exists for this date and level.',
                ]);
            }

            $header = DailyReportHeader::create([
                'report_date' => $validated['report_date'],
                'level_id' => $validated['location_id'],
                'prepared_by' => auth()->user()->id
            ]);

            foreach ($validated['shifts'] as $shift) {
                if (!empty($shift['no_blast'])) continue;

                foreach ($shift['rows'] ?? [] as $row) {
                    $detail = $header->details()->create([
                        'contractor_name' => $row['contractor_name'],
                        'support' => $row['support'] ?? '',
                        'drill_steel' => $row['drill_steel'] ?? 0,
                        'working_place' => $row['working_place'],
                    ]);

                    foreach ($row['materials'] ?? [] as $itemId => $quantity) {
                        if ($quantity !== null && $quantity !== '') {
                            $detail->items()->create(['item_id' => $itemId, 'quantity' => $quantity]);
                        }
                    }

                    foreach ($row['directions'] ?? [] as $direction => $types) {
                        foreach ($types as $type => $distance) {
                            if ($distance !== null && $distance !== '') {
                                $detail->directions()->create([
                                    'direction' => $direction, 'type' => $type, 'distance' => $distance,
                                ]);
                            }
                        }
                    }
                }
            }
        });

        return redirect()->route('reports.daily.index')
            ->with('success', 'Daily report saved successfully.');
    }
}
