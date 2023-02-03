@extends('layouts.mainAdmin')
@include('layouts.navadmin')

<form method="post" action="{{ route('products.store') }}" class="p-5 " enctype="multipart/form-data" >
    @csrf
    <div class="form-group">
        <label for="name">Name</label>
        <input id="name" type="text" class="form-control" name="name" required>
    </div>
    <div class="form-group">
        <label for="price">Price</label>
        <input id="price" type="number" class="form-control" name="price" required>
    </div>
    <div class="form-group">
        <label for="description">Description</label>
        <input id="description" type="text" class="form-control" name="description" required>
    </div>
    <div class="form-group">
        <label for="image">Image</label>
        <input id="image" type="file" class="form-control" name="image" required>
    </div>
    {{-- dropdoqn category --}}
    <div class="form-group">
        <label for="category">Category</label>
        <select name="category_id" id="category_id" class="form-control">
            @foreach ($categories as $ctg)
                <option value="{{ $ctg->id }}">{{ $ctg->name }}</option>
            @endforeach
        </select>
    </div>
    {{-- end dropdown category --}}
    <div class="form-group">
        <label for="stock">Stock</label>
        <input id="stock" type="number" class="form-control" name="stock" required>
    </div>
    <div class="form-group pt-5 ">
        <button type="submit" class="btn btn-primary">
            Add
        </button>
    </div>
</form>

</form>
