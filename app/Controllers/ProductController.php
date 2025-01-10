<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BrandModel;
use App\Models\CategoryModel;
use App\Models\FileModel;
use App\Models\ProductModel;
use App\Models\SizeModel;
use Config\Services;

class ProductController extends BaseController
{
    public function index(): string
    {
        $productModel = new ProductModel();
        $fileModel = new FileModel();

        // Get query parameters
        $brand = $this->request->getGet('brand');
        $search = $this->request->getGet('search'); // Search query

        // Build query with filters
        $query = $productModel
            ->join("brands", "brands.brand_id = products.brand_id")
            ->where('products.deleted_at', null);

        // Filter by brand
        if ($brand) {
            $query->where('brand_name', $brand);
        }

        // Filter by product_name or brand_name
        if ($search) {
            $query->groupStart() // Start grouping OR conditions
                ->like('product_name', $search) // Match product_name
                ->orLike('brand_name', $search) // Match brand_name
                ->groupEnd(); // End grouping
        }

        // Fetch filtered products
        $products = $query->findAll();

        // Attach file path to each product
        foreach ($products as &$product) {
            $image = $fileModel
                ->where('product_id', $product['product_id'])
                ->first();

            $product['file_path'] = $image['file_path'] ?? null; // Handle missing images
        }

        // Prepare data for the view
        $data = [
            "products" => $products
        ];

        return view('customer/product/v_product', $data);
    }

    public function detail($productId): string
    {
        $productModel = new ProductModel();
        $product = $productModel
            ->join("brands", "brands.brand_id = products.brand_id")
            ->where("products.product_id", $productId)
            ->first();

        $fileModel = new FileModel();
        $images = $fileModel
            ->where('product_id', $productId)
            ->findAll();

        $product['images'] = array_column($images, 'file_path');

        $sizeModel = new SizeModel();
        $sizes = $sizeModel->findAll();

        $data = [
            "product" => $product,
            "sizes" => $sizes
        ];
        return view('customer/product/v_product_detail', $data);
    }

    public function topSelling(): string
    {
        $productModel = new ProductModel();
        $fileModel = new FileModel();

        // Get 'brand' and 'search' parameters from query string
        $brand = $this->request->getGet('brand');
        $search = $this->request->getGet('search'); // Get search query

        // Build query with filters
        $query = $productModel
            ->join('categories', 'categories.category_id = products.category_id')
            ->join("brands", "brands.brand_id = products.brand_id")
            ->where('category_name', 'top_selling')
            ->where('products.deleted_at', null);

        // Filter by brand
        if ($brand) {
            $query->where('brand_name', $brand);
        }

        // Filter by product_name or brand_name
        if ($search) {
            $query->groupStart() // Start grouping OR conditions
                ->like('product_name', $search) // Match product_name
                ->orLike('brand_name', $search) // Match brand_name
                ->groupEnd(); // End grouping
        }

        // Fetch filtered products
        $products = $query->findAll();

        // Attach file path to each product
        foreach ($products as &$product) {
            $image = $fileModel
                ->where('product_id', $product['product_id'])
                ->first();

            $product['file_path'] = $image['file_path'] ?? null; // Handle missing images
        }

        // Prepare data for the view
        $data = [
            "products" => $products
        ];

        return view('customer/v_top_selling', $data);
    }

    public function newArrival(): string
    {
        $productModel = new ProductModel();
        $fileModel = new FileModel();

        // Get 'brand' and 'search' parameters from query string
        $brand = $this->request->getGet('brand');
        $search = $this->request->getGet('search'); // Get search query

        // Build query with filters
        $query = $productModel
            ->join('categories', 'categories.category_id = products.category_id')
            ->join("brands", "brands.brand_id = products.brand_id")
            ->where('category_name', 'new_arrival')
            ->where('products.deleted_at', null);

        // Filter by brand
        if ($brand) {
            $query->where('brand_name', $brand);
        }

        // Filter by product_name or brand_name
        if ($search) {
            $query->groupStart() // Start grouping OR conditions
                ->like('product_name', $search) // Match product_name
                ->orLike('brand_name', $search) // Match brand_name
                ->groupEnd(); // End grouping
        }

        // Fetch filtered products
        $products = $query->findAll();

        // Attach file path to each product
        foreach ($products as &$product) {
            $image = $fileModel
                ->where('product_id', $product['product_id'])
                ->first();

            $product['file_path'] = $image['file_path'] ?? null; // Handle missing images
        }

        // Prepare data for the view
        $data = [
            "products" => $products
        ];

        return view('customer/v_new_arrival', $data);
    }


    public function manageProduct(): string
    {
        $productModel = new ProductModel();
        $product = $productModel
            ->join('categories', 'categories.category_id = products.category_id')
            ->where('products.deleted_at', null)
            ->findAll();

        $data = [
            "products" => $product,
        ];
        return view('admin/product/v_manage_product', $data);
    }

    public function createProduct(): string
    {
        $categoryModel = new CategoryModel();
        $categories = $categoryModel->findAll();

        $brandModel = new BrandModel();
        $brands = $brandModel->findAll();

        $data = [
            "categories" => $categories,
            "brands" => $brands
        ];

        return view('admin/product/v_create_product', $data);
    }

    public function submitCreateProduct()
    {
        helper(['form']);
        $productModel = new ProductModel();
        $rules = [
            'brand_id' => 'required',
            'product_name' => 'required|min_length[4]|max_length[100]',
            'description' => 'required',
            'rating' => 'required',
            'price' => 'required'
        ];

        if ($this->validate($rules)) {
            // Simpan data produk
            $data = [
                'category_id' => $this->request->getVar('category_id'),
                'brand_id' => $this->request->getVar('brand_id'),
                'product_name' => $this->request->getVar('product_name'),
                'description' =>  $this->request->getVar('description'),
                'rating' => $this->request->getVar('rating'),
                'price' => $this->request->getVar('price'),
                'deleted_at' => null,
            ];

            $productModel->save($data);

            // Ambil product_id yang baru saja disimpan
            $productId = $productModel->getInsertID();

            $filesUploaded = 0;

            // Proses file yang diunggah
            $files = $this->request->getFileMultiple('files');
            if ($files) {
                foreach ($files as $file) {
                    if ($file->isValid() && !$file->hasMoved()) {
                        $newName = $file->getRandomName();
                        $file->move('assets/images/', $newName);

                        // Simpan data file dengan product_id
                        $data = [
                            'product_id' => $productId, // Menggunakan product_id yang benar
                            'file_name' => $file->getClientName(),
                            'file_path' => '/assets/images/' . $newName,
                            'type' => $file->getClientExtension(),
                            'deleted_at' => null,
                        ];
                        $imageModel = new FileModel();
                        $imageModel->save($data);
                        $filesUploaded++;
                    }
                }
            }

            session()->setFlashdata('success', 'Create Product Successfully.');
            return redirect()->to(base_url("/admin/manage-product"));
        } else {
            $validation = Services::validation();
            return redirect()->to(base_url('/admin/product/create'))->withInput()->with('validation', $validation);
        }
    }
}
