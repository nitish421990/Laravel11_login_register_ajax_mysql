<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Models\product;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{


    public function screenOne()
    {
        $result = DB::table('products')
            ->select('products.product_id', 'products.product_name', 'categories.category_name', 'suppliers.supplier_name')
            ->join('categories', 'categories.category_id', '=', 'products.category_id')
            ->join('suppliers', 'suppliers.supplier_id', '=', 'products.supplier_id')
            ->paginate(5);
        return view('screenone', ["data" => $result]);
    }

    public function screenTwo()
    {
        $query = "SELECT products.product_name, prices.price from products  LEFT JOIN prices on prices.product_id=products.product_id";
        $result = DB::table('products')
            ->select('products.product_name', 'prices.price')
            ->leftJoin('prices', 'prices.product_id', '=', 'products.product_id')
            ->paginate(5);
        return view('screentwo', ["data" => $result]);
    }
    public function screenThree()
    {
        $result = DB::table('products')
            ->select('products.product_id', 'products.product_name', 'categories.category_name', 'suppliers.supplier_name', 'prices.price')
            ->join('categories', 'categories.category_id', '=', 'products.category_id')
            ->join('suppliers', 'suppliers.supplier_id', '=', 'products.supplier_id')
            ->join('prices', 'prices.product_id', '=', 'products.product_id')
            ->paginate(5);
        // print_r($result); die;
        return view('screenthree', ["data" => $result]);
    }
    public function screenFour()
    {
        // DB::enableQueryLog();
        $result = DB::table('products')
            ->select('suppliers.supplier_name', DB::raw('count(products.product_id) as product_count'), 'products.supplier_id', DB::raw('sum(prices.price)'), DB::raw('ROUND((sum(prices.price))/(count(products.product_id)),2) as avg_price'))
            ->join('prices', 'prices.product_id', '=', 'products.product_id')
            ->join('suppliers', 'suppliers.supplier_id', '=', 'products.supplier_id')
            ->groupBy('products.supplier_id', 'suppliers.supplier_name')
            ->paginate(5);
        // dd(DB::getQueryLog());
        return view('screenfour', ["data" => $result]);
    }
}
