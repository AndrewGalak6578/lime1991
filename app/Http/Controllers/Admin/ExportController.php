<?php

namespace App\Http\Controllers\Admin;

use App\Exports\Admin\ProductBrandCollectionExport;
use App\Exports\Admin\ProductBrandExport;
use App\Exports\Admin\ProductCategoryExport;
use App\Exports\Admin\ProductExport;
use App\Exports\Admin\ProductTagExport;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{
    public function index()
    {
        return view('admin.products.exports.index');
    }

    public function categories()
    {
        return Excel::download(new ProductCategoryExport, 'categories.xlsx');
    }

    public function tags()
    {
        return Excel::download(new ProductTagExport, 'tags.xlsx');
    }

    public function brands()
    {
        return Excel::download(new ProductBrandExport, 'brands.xlsx');
    }

    public function collections()
    {
        return Excel::download(new ProductBrandCollectionExport, 'collections.xlsx');
    }

    public function products()
    {
        return Excel::download(new ProductExport, 'products.xlsx');
    }
}
