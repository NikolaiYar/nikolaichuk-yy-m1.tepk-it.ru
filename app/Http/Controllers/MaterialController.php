<?php

namespace App\Http\Controllers;

use App\Http\Requests\MaterialRequest;
use App\Models\Material;
use App\Models\MaterialProduct;
use App\Models\MaterialType;
use App\Models\Unit;
use Illuminate\Http\Request;


class MaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $materials = Material::all();
        //подсчёт количества материала
        $sumMaterialProducts = [];
        foreach ($materials as $material) {
            $sumMaterialProducts[$material->id] = MaterialProduct::where('material_id', $material->id)->sum('quantity');
        }

        return view('materials.index', compact('materials', 'sumMaterialProducts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $units = Unit::all();
        $materialTypes = MaterialType::all();
        return view('materials.create', compact('units', 'materialTypes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MaterialRequest $request)
    {
        //создаем материал
        Material::create($request->validated());
        //отправляем обратно со статусом успеха
        return redirect()->route('materials.index')->with('success', 'Материал успешно добавлен');
    }

    /**
     * Display the specified resource.
     */
    public function show(Material $material)
    {
        //загружаем продукты с информацией о кол-ве материала
        $products = $material->productMaterials()
            ->with('product')
            ->get();
        return view('materials.show', compact('material', 'products'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Material $material)
    {
        $units = Unit::all();
        $materialTypes = MaterialType::all();
        return view('materials.edit', compact('material', 'units', 'materialTypes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MaterialRequest $request, Material $material)
    {
        $material->update($request->validated());
        //отправляем на страницу списка материалов с сообщением об успехе
        return redirect()->route('materials.index')->with('success', 'Материал успешно обновлён');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

