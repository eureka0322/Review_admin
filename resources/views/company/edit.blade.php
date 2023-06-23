@extends('layouts.app')

@section('title', 'Edit Company')

@section('content')

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Company</h1>
        <a href="{{route('company.index')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-arrow-left fa-sm text-white-50"></i> Back</a>
    </div>

    {{-- Alert Messages --}}
    @include('common.alert')
   
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Edit Company</h6>
        </div>
        <form method="POST" action="{{route('company.update', ['company' => $company->id])}}">
            @csrf
            @method('PUT')

            <div class="card-body">
                <div class="form-group row">

                    {{-- Name --}}
                    <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                        <span style="color:red;">*</span>Name</label>
                        <input 
                            type="text" 
                            class="form-control form-control-user @error('name') is-invalid @enderror" 
                            id="exampleName"
                            placeholder="Name" 
                            name="name" 
                            value="{{ old('name') ? old('name') : $company->name }}">

                        @error('name')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                    {{-- Address --}}
                    <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                        <span style="color:red;">*</span>Address</label>
                        <input 
                            type="text" 
                            class="form-control form-control-user @error('address') is-invalid @enderror" 
                            id="exampleAddress"
                            placeholder="Address" 
                            name="address" 
                            value="{{ old('address') ? old('address') : $company->address }}">

                        @error('address')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                    {{-- Prefecture --}}
                    <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                        <span style="color:red;">*</span>Prefecture</label>
                        <select class="form-control form-control-user @error('prefecture_id') is-invalid @enderror" name="prefecture_id">
                            <option selected disabled>Select Prefecture</option>
                            @foreach ($prefectures as $prefecture)
                              <option value="{{$prefecture->id}}" 
                                {{old('prefecture_id') ? ((old('prefecture_id') == $prefecture->id) ? 'selected' : '') : (($company->city->prefecture_id == $prefecture->id) ? 'selected' : '')}}>
                                {{$prefecture->name}}
                              </option>
                            @endforeach
                        </select>
                        @error('prefecture_id')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                    {{-- City --}}
                    <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                        <span style="color:red;">*</span>City</label>
                        <select class="form-control form-control-user @error('city') is-invalid @enderror" name="city_id">
                            <option selected disabled>Select City</option>
                            @foreach ($cities as $city)
                              <option value="{{$city->id}}" 
                                {{old('city_id') ? ((old('city_id') == $city->id) ? 'selected' : '') : (($company->city_id == $city->id) ? 'selected' : '')}}>
                                {{$city->name}}
                              </option>
                            @endforeach
                        </select>
                        @error('status')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                    {{-- Postcode --}}
                    <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                        <span style="color:red;">*</span>Postcode</label>
                        <input 
                            type="text" 
                            class="form-control form-control-user @error('postcode') is-invalid @enderror" 
                            id="examplePostcode"
                            placeholder="Postcode" 
                            name="postcode" 
                            value="{{ old('postcode') ? old('postcode') : $company->postcode }}">

                        @error('postcode')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-success btn-user float-right mb-3">Save</button>
                <a class="btn btn-primary float-right mr-3 mb-3" href="{{ route('company.index') }}">Cancel</a>
            </div>
        </form>
    </div>

</div>
@endsection

@section('scripts')
    

<script src="//code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
$(document).ready(function() {
    // Listen for changes to prefecture select
    $('select[name="prefecture_id"]').change(function() {
        var prefecture = $('select[name="prefecture_id"]').val();
        
        // Make an AJAX request to get the corresponding city data
        $.ajax({
            url: '/cities',
            method: 'POST',
            data: {
                prefecture: prefecture,
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                // Clear and update city select options
                $('select[name="city_id"]').empty();
                $('select[name="city_id"]').append("<option value=''>Select City</option>");
                $.each(response, function(index, city) {
                    $('select[name="city_id"]').append("<option value='" + city.id + "'>" + city.name + "</option>");
                });
            }
            });
    });
});
</script>
@endsection