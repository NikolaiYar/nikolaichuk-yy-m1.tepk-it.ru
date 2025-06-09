<?php

namespace App\Http\Controllers;

use App\Models\MaterialType;
use App\Models\ProductType;
use Illuminate\Http\Request;
use App\Http\Requests;

class FuncController extends Controller
{
    public function calculate(ProductType $productType,
                              MaterialType $materialType,
                              int $availableMaterial,
                              float $param1, float $param2): int {
        try {
            if ($availableMaterial <= 0 || $param1 <= 0 || $param2 <= 0) {
                return -1;
            }
            $productType = ProductType::findOrFail($productTypeId);
            $materialType = MaterialType::findOrFail($materialTypeId);
            //расчёт необходимого сырья на одну единицу продукции
            $rawPerProduct = $param1 * $param2 * $productType->coefficient;
            //учет потерь
            $lossPercent = $materialType->loss;
            $rawWithLoss = $rawPerProduct * (1 + $lossPercent / 100);
            //вычисление числа продукции
            $productionCount = floor($availableMaterial / $rawWithLoss);
            return $productionCount >= 0 ? (int)$productionCount : 0;

        } catch (\Exception $e) {
            return -1;
        }
    }
}

