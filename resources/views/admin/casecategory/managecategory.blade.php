@extends('admin.layouts.adminlayout')

@section('title')
    Admin Officer View Page
@endsection

@section('content')
    <div class="card shadow">

        <div class="card-header border-bottom d-sm-flex justify-content-between align-items-center">
            <h5 class="card-header-title mb-0">Station Officer Page</h5>
            <a href="{{ route('admin.officers') }}" class="btn btn-danger mb-0">Back</a>
        </div>

        <!-- Card body START -->
        <div class="card-body">
            <form class="row g-4" action="{{ route('admin.savecasecate') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id"
                    @if (isset($category_details)) value="{{ $category_details->id }}" @else value="0" @endif>
                <!-- Input item -->
                <div class="col-12">
                    <label class="form-label">Case Category Name</label><span class="asktrick_label"> *</span>
                    <input type="text" class="form-control" placeholder="Case Category Name" name="cate_name"
                        @if (isset($category_details)) value="{{ $category_details->cate_name }}" @endif>
                </div>

                <!-- Save button -->
                <div class="d-sm-flex justify-content-end">
                    <button type="submit" class="btn btn-primary mb-0">Save</button>
                </div>
            </form>
        </div>
        <!-- Card body END -->

    </div>
@endsection
