<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BrandModel;

class BrandController extends BaseController
{
    public function getBrands()
    {
        $brandModel = new BrandModel();
        $brands = $brandModel
            ->where('deleted_at', null)
            ->findAll();

        return $this->response->setJSON($brands);
    }
}
