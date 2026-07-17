<?php

namespace App\Http\Controllers;

use App\Models\Level;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class LevelController extends Controller
{
    /**
     * Display a listing of the levels.
     */
    public function index(Request $request)
    {
        $query = Level::orderBy('sort_order', 'asc')->orderBy('name', 'asc');

        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('name', 'like', "%{$searchTerm}%")
                  ->orWhere('code', 'like', "%{$searchTerm}%");
            });
        }

        $levels = $query->paginate(15)->withQueryString();

        return view('pages.levels.index', compact('levels'));
    }

    /**
     * Store a newly created level in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'code'        => 'required|string|max:50|unique:levels,code',
            'sort_order'  => 'nullable|integer|min:0',
            'description' => 'nullable|string',
        ]);

        // Default sort_order to 0 if not provided
        $validated['sort_order'] = $validated['sort_order'] ?? 0;

        Level::create($validated);

        return redirect()->back()->with('success', 'Level created successfully.');
    }

    /**
     * Update the specified level in storage.
     */
    public function update(Request $request, Level $level)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'code'        => ['required', 'string', 'max:50', Rule::unique('levels')->ignore($level->id)],
            'sort_order'  => 'nullable|integer|min:0',
            'description' => 'nullable|string',
            'is_active'   => 'nullable|boolean',
        ]);

        $validated['sort_order'] = $validated['sort_order'] ?? 0;
        $validated['is_active'] = $request->has('is_active'); // checkbox evaluation helper

        $level->update($validated);

        return redirect()->back()->with('success', 'Level updated successfully.');
    }

    /**
     * Remove the specified level from storage.
     */
    public function destroy(Level $level)
    {
        // Add safety check if levels are attached to inventory spaces later
        $level->delete();

        return redirect()->back()->with('success', 'Level deleted successfully.');
    }
}