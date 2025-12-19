<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        // Simple data for the Accountant to analyze
        $totalProducts = Product::count();
        $totalValue = Product::sum('price');
        $products = Product::all();

        return view('reports.index', compact('totalProducts', 'totalValue', 'products'));
    }
}