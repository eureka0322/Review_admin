@extends('layouts.app')

@section('title', 'Company List')

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Companies</h1>
            <div class="row">
                <div class="col-md-6">
                    <a href="{{ route('company.create') }}" class="btn btn-sm btn-primary">
                        <i class="fas fa-plus"></i> Add New
                    </a>
                </div>
            </div>

        </div>

        {{-- Alert Messages --}}
        @include('common.alert')

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">All Companies</h6>

            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th width="25%">Name</th>
                                <th width="10%">Prefecture</th>
                                <th width="10%">City</th>
                                <th width="15%">Address</th>
                                <th width="10%">PostCode</th>
                                <th width="10%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($companies as $company)
                                <tr>
                                    <td>{{ $company->name }}</td>
                                    <td>{{ $company->city->prefecture->name }}</td>
                                    <td>{{ $company->city->name }}</td>
                                    <td>{{ $company->address }}</td>
                                    <td>{{ $company->postcode }}</td>
                                    <td style="display: flex">
                                        <a href="{{ route('company.edit', ['company' => $company->id]) }}"
                                            class="btn btn-primary m-2">
                                            <i class="fa fa-pen"></i>
                                        </a>
                                        <a class="btn btn-danger m-2" href="#" data-toggle="modal" data-target="#deleteModal">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    {{ $companies->links() }}
                </div>
            </div>
        </div>

    </div>

    @include('company.delete-modal')

@endsection

@section('scripts')
    
@endsection
