@extends('admin.layouts.adminlayout')

@section('title')
    Manage Seasons
@endsection

@section('content')
    <div class="card shadow">

        <div class="card-header border-bottom d-sm-flex justify-content-between align-items-center">
            <h5 class="card-header-title mb-0">Manage Seasons Page</h5>
            <a href="{{ route('admin.seasons') }}" class="btn btn-danger mb-0">Back</a>
        </div>

        <!-- Card body START -->
        <div class="card-body">
            <form class="row g-4" action="{{ route('admin.savefeedback') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id"
                    @if (isset($seasons)) value="{{ $seasons->id }}" @else value="0" @endif>
                <!-- Input item -->
                <div class="col-12">
                    <label class="form-label">Season</label><span class="asktrick_label"> *</span>
                    <input type="text" class="form-control" placeholder="Season Name" name="season"
                        @if (isset($seasons)) value="{{ $seasons->season }}" @endif>
                </div>
                <div class="col-12">
                    <label class="form-label">Crops</label><span class="asktrick_label"> *</span>
                    <input type="text" class="form-control" placeholder="Crops" name="crops"
                        @if (isset($seasons)) @php $crops = json_decode($seasons->crops); @endphp value="@foreach ($crops as $item1) {{ $item1 . ', ' }} @endforeach" @endif>
                        <span class="mx-1">Use comma to seprate two crops</span>
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
