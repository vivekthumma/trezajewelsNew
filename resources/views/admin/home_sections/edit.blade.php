@extends('layouts.admin')

@section('title', 'Edit Best a Collection')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-8 offset-2">
            <div class="card card-dark">
                <div class="card-header border-bottom">
                    <h3 class="card-title">Edit Best a Collection</h3>
                </div>
                <form action="{{ route('home-sections.update', $section->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
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

                        <div class="form-group mb-3">
                            <label for="category_id">Select Category <span class="text-danger">*</span></label>
                            <select name="category_id" id="category_id" class="form-control" required disabled>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ $section->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                            <input type="hidden" name="category_id" value="{{ $section->category_id }}">
                            <small class="text-info">Note: Category cannot be changed. Delete and create new instead.</small>
                        </div>

                        <div class="form-group mb-3">
                            <label for="title">Custom Title (Optional)</label>
                            <input type="text" name="title" id="title" class="form-control" placeholder="e.g. Rings, Earrings" value="{{ $section->title }}">
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="subtitle">Subtitle (e.g. Only up to 60% off)</label>
                                <input type="text" name="subtitle" id="subtitle" class="form-control" placeholder="Promotional text" value="{{ $section->subtitle }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="product_count_text">Count Text (e.g. 15+)</label>
                                <input type="text" name="product_count_text" id="product_count_text" class="form-control" placeholder="9+" value="{{ $section->product_count_text }}">
                            </div>
                        </div>

                        <div class="form-group mb-3 d-flex flex-column gap-2">
                            <label for="icon">Icon Image (Optional)</label>
                            @if($section->icon)
                                <div class="mb-2">
                                    <p class="small text-muted mb-1">Current Icon:</p>
                                    <img id="icon-preview" src="{{ $section->icon ? imgPath($section->icon) : asset('assets/images/index2/collection-tab1.png') }}" alt="Current Icon" style="max-width: 100%; max-height: 100%; object-fit: contain;">
                                </div>
                            @endif
                            <input type="file" name="icon" id="icon" class="form-control-file">
                        </div>

                        <div class="form-group mb-3">
                            <label for="sort_order">Sort Order <span class="text-danger">*</span></label>
                            <input type="number" name="sort_order" id="sort_order" class="form-control" placeholder="0" required value="{{ $section->sort_order }}">
                        </div>

                        <div class="form-group mb-3">
                            <label>Status</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" name="status" class="custom-control-input" id="status" {{ $section->status ? 'checked' : '' }}>
                                <label class="custom-control-label" for="status">Active</label>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-between">
                        <a href="{{ route('home-sections.index') }}" class="btn btn-secondary">Back</a>
                        <button type="submit" class="btn btn-primary px-4">Update Section</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
