<?php

namespace App\Controllers;

use App\Models\FileModel;
use App\Models\ProductModel;

class HomeController extends BaseController
{
    public function index(): string
    {
        $productModel = new ProductModel();
        $fileModel = new FileModel();

        $topSelling = $productModel
            ->join('categories', 'categories.category_id = products.category_id')
            ->join("brands", "brands.brand_id = products.brand_id")
            ->where('products.deleted_at', null)
            ->findAll();

        foreach ($topSelling as &$t) {
            $imageTopSelling = $fileModel
                ->where('product_id', $t['product_id'])
                ->where('deleted_at', null)
                ->first();

            $t['file_path'] = $imageTopSelling['file_path'] ?? null;
        }

        $newArrival = $productModel
            ->join('categories', 'categories.category_id = products.category_id')
            ->join("brands", "brands.brand_id = products.brand_id")
            ->where('category_name', 'new_arrival')
            ->where('products.deleted_at', null)
            ->findAll();

        foreach ($newArrival as &$n) {
            $imageNewArrival = $fileModel
                ->where('product_id', $n['product_id'])
                ->where('deleted_at', null)
                ->first();

            $n['file_path'] = $imageNewArrival['file_path'] ?? null;
        }

        // Prepare data for the view
        $data = [
            "topSelling" => $topSelling,
            "newArrival" => $newArrival
        ];

        return view('customer/v_home', $data);
    }

    public function unsupportedView()
    {
        return view('v_unsupported');
    }
}
