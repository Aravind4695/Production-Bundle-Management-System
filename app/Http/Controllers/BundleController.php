<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buyer;
use App\Models\Style;
use App\Models\SewingLine;
use App\Models\ProductionBundle;

use App\Http\Requests\BundleRequest;

class BundleController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    // only for show data
    // public function index()
    // {
    //     $bundles = ProductionBundle::with([
    //         'buyer',
    //         'style',
    //         'line'
    //     ])
    //     ->latest()
    //     ->paginate(20);

    //     return view('bundles.index', compact('bundles'));
    // }

    // show data with search & filters
    public function index(Request $request)
    {
        $query = ProductionBundle::with(['buyer', 'style', 'line']);

        // Search
        if ($request->filled('search')) {

            $search = $request->search;

            $query->where(function ($q) use ($search) {

                $q->where('bundle_no', 'like', "%{$search}%")
                ->orWhere('operator_name', 'like', "%{$search}%")
                ->orWhere('color', 'like', "%{$search}%")

                ->orWhereHas('buyer', function ($buyer) use ($search) {
                    $buyer->where('buyer_name', 'like', "%{$search}%");
                })

                ->orWhereHas('style', function ($style) use ($search) {
                    $style->where('style_no', 'like', "%{$search}%");
                });

            });
        }

        // Buyer Filter
        if ($request->filled('buyer_id')) {
            $query->where('buyer_id', $request->buyer_id);
        }

        // Style Filter
        if ($request->filled('style_id')) {
            $query->where('style_id', $request->style_id);
        }

        // Sewing Line Filter
        if ($request->filled('line_id')) {
            $query->where('line_id', $request->line_id);
        }

        // Date Filter
        if ($request->filled('date_from')) {
            $query->whereDate('production_date', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->whereDate('production_date', '<=', $request->date_to);
        }

        $bundles = $query
            ->latest()
            ->paginate(20)
            ->withQueryString();

        $buyers = Buyer::orderBy('buyer_name')->get();
        $styles = Style::orderBy('style_no')->get();
        $lines = SewingLine::orderBy('line_name')->get();

        return view('bundles.index', compact(
            'bundles',
            'buyers',
            'styles',
            'lines'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $buyers = Buyer::orderBy('buyer_name')->get();

        $styles = Style::orderBy('style_no')->get();

        $lines = SewingLine::orderBy('line_name')->get();

        return view('bundles.create', compact(
            'buyers',
            'styles',
            'lines'
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BundleRequest $request)
    {
        $bundle = ProductionBundle::create($request->validated());

        return response()->json([
            'status' => true,
            'message' => 'Bundle saved successfully.'
        ]);
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $bundle = ProductionBundle::with([
            'buyer',
            'style',
            'line'
        ])->findOrFail($id);

        return view('bundles.show', compact('bundle'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $bundle = ProductionBundle::findOrFail($id);

        $buyers = Buyer::all();
        $styles = Style::all();
        $lines = SewingLine::all();

        return view('bundles.edit', compact(
            'bundle',
            'buyers',
            'styles',
            'lines'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BundleRequest $request, $id)
    {
        $bundle = ProductionBundle::findOrFail($id);

        $bundle->update($request->validated());

        return redirect()
            ->route('bundles.index')
            ->with('success', 'Bundle updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $bundle = ProductionBundle::findOrFail($id);

        $bundle->delete();

        return redirect()
            ->route('bundles.index')
            ->with('success', 'Bundle deleted successfully.');
    }

    public function getStyles($buyerId)
    {
        $styles = Style::where('buyer_id', $buyerId)
            ->orderBy('style_no')
            ->get();

        return response()->json($styles);
    }
}
