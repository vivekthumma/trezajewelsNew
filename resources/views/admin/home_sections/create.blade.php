@extends('layouts.admin')

@section('title', 'Add New Best  Collection')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-8 offset-2">
                <div class="card card-dark">
                    <div class="card-header">
                        <h3 class="card-title">Add to Best a Collection</h3>
                    </div>
                    <form action="{{ route('home-sections.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            @if($errors->any())
                                <div class="alert alert-danger">
                                    <ul class="mb-0">
                                        @foreach($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <div class="form-group">
                                <label for="category_id">Select Category <span class="text-danger">*</span></label>
                                <select name="category_id" id="category_id" class="form-control" required>
                                    <option value="">-- Select Category --</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group mt-3">
                                <label for="title">Custom Title (Optional)</label>
                                <input type="text" name="title" id="title" class="form-control"
                                    placeholder="e.g. Rings, Earrings">
                            </div>

                            <div class="form-group mt-3">
                                <label for="icon">Icon Image (Optional)</label>
                                <input type="file" name="icon" id="icon" class="form-control-file">
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mt-3">
                                        <label for="subtitle">Subtitle (e.g. Only up to 60% off)</label>
                                        <input type="text" name="subtitle" id="subtitle" class="form-control"
                                            placeholder="Promotional text">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mt-3">
                                        <label for="product_count_text">Count Text (e.g. 15+)</label>
                                        <input type="text" name="product_count_text" id="product_count_text"
                                            class="form-control" placeholder="9+">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group mt-3">
                                <label for="sort_order">Sort Order <span class="text-danger">*</span></label>
                                <input type="number" name="sort_order" id="sort_order" class="form-control" placeholder="0"
                                    required>
                            </div>

                            <div class="form-group mt-3">
                                <label>Status</label>
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" name="status" class="custom-control-input" id="status" checked>
                                    <label class="custom-control-label" for="status">Active</label>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer d-flex justify-content-between">
                            <a href="{{ route('home-sections.index') }}" class="btn btn-secondary">Back</a>
                            <button type="submit" class="btn btn-primary">Create Section</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection