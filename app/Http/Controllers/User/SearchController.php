<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = trim($request->input('query', ''));

        if (empty($query)) {
            return response()->json(['html' => '', 'status' => 'empty'], 200);
        }

        $products = Product::where('name', 'LIKE', "%{$query}%")
            ->orWhere('description', 'LIKE', "%{$query}%")
            ->with('images')
            ->limit(8)
            ->get();

        if ($products->isEmpty()) {
            return response()->json([
                'html' => '<div class="p-4 text-center text-gray-500">No products found</div>',
                'status' => 'no_results'
            ], 200);
        }

        $html = '';
        foreach ($products as $product) {
            $html .= view('components.search-result-item', compact('product'))->render();
        }

        return response()->json([
            'html' => $html,
            'status' => 'success'
        ], 200);
    }
}