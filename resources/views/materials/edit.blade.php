@extends('layouts.layout')

@section('title', 'Редактирование материала')

@section('content')

    <div>
        <a class="btn" href="{{route('materials.index')}}">Назад</a>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="" method="post">
        @csrf
        <div class="form">
            <p>Наименование материала</p>
            <input type="text" name="name" value="{{ $material->name }}" required>
        </div>
        <div class="form">
            <p>Тип материала</p>
            <select name="material_type_id" required>
                @foreach($materialTypes as $materialType)
                    <option value="{{ $materialType->id }}"
                        {{ old('material_type_id', $material->material_type_id) == $materialType->id ? 'selected' : '' }}>
                        {{ $materialType->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form">
            <p>Цена единицы материала</p>
            <input type="number" min="0" step="0.01" name="price" value="{{ $material->price }}" required>
        </div>
        <div class="form">
            <p>Количество на складе</p>
            <input type="number" min="0" step="1" name="quantity" value="{{ $material->quantity }}" required>
        </div>
        <div class="form">
            <p>Минимальное количество</p>
            <input type="number" min="0" step="1" name="quantityM" value="{{ $material->minQuantity }}" required>
        </div>
        <div class="form">
            <p>Количество в упаковке</p>
            <input type="number" min="0" step="0.01" name="quantityP" value="{{ $material->packageQuantity }}" required>
        </div>
        <div class="form">
            <p>Единица измерения</p>
            <select name="unit_id" required>
                @foreach($units as $unit)
                    <option value="{{ $unit->id }}"
                        {{ old('unit_id', $material->unit_id) == $unit->id ? 'selected' : '' }}>
                        {{ $unit->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form">
            <button type="submit" class="btn">Сохранить</button>
        </div>
    </form>

@endsection
