@extends('users.layouts.userlayout')

@section('title')
    User Crop Details
@endsection

@section('content')
    <div class="container-fluid">
        <form action="{{route('user.seasoncrop')}}" method="post" class="mt-3" style="color: black">
            @csrf
            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
            <div class="mb-3">
                <label for="season" class="form-label">Season Name</label>
                <input type="text" name="season" id="season" value="{{ $season[0]->season }}" class="form-control">
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Select Crop</label>
                <select class="form-select" name="crops" id="crops">
                    @foreach (json_decode($season[0]->crops) as $item)
                        <option value="{{ $item }}">{{ $item }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="area" class="form-label">Area</label>
                <input type="text" name="area" id="area" class="form-control" placeholder="Expected area in which crop is grown (in acres)">
            </div>
            {{-- <div class="mb-3">
                <label for="fertilizer" class="form-label">Expected amount of Fertilizers</label>
                <input type="text" name="fertilizer" id="fertilizer" class="form-control" placeholder="Expected amount of Fertilizer required (in Kgs)">
            </div> --}}
            <div class="mb-3">
                <label for="cropamount" class="form-label">Expected Crop Production</label>
                <input type="text" name="cropamount" id="cropamount" class="form-control" placeholder="Expected amount of Crop produced (in quintals)">
            </div>
            {{-- <div class="mb-3">
                <label for="expense" class="form-label">Expected Expense</label>
                <input type="text" name="expense" id="expense" class="form-control" placeholder="Expected expense in Crop Production (in Rupees)">
            </div> --}}
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
