@extends('layouts.app')

@section('title', 'Review List')

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Review</h1>
            <div class="row">
                {{-- <div class="col-md-6">
                    <a href="{{ route('review.create') }}" class="btn btn-sm btn-primary">
                        <i class="fas fa-plus"></i> Add New
                    </a>
                </div> --}}
                {{-- <div class="col-md-6">
                    <a href="{{ route('review.export') }}" class="btn btn-sm btn-success">
                        <i class="fas fa-check"></i> Export To Excel
                    </a>
                </div> --}}
                
            </div>

        </div>

        {{-- Alert Messages --}}
        @include('common.alert')

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">All Reviews</h6>

            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th width="20%">User</th>
                                <th width="25%">Nursery</th>
                                {{-- <th width="15%">Role</th> --}}
                                <th width="25%">Status</th>
                                <th width="30%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($reviews as $review)
                                <tr>
                                    <td>{{ $review->user_name }}</td>
                                    <td>{{ $review->nursery_name }}</td>
                                    <td>
                                        @if ($review->status == 0)
                                            <span class="badge badge-danger">pending</span>
                                        @elseif ($review->status == 1)
                                            <span class="badge badge-success">published</span>
                                        @endif
                                    </td>
                                    <td style="display: flex">
                                        @if ($review->status == 0)
                                            <a href="{{ route('review.status', ['review_id' => $review->id, 'status' => 1]) }}"
                                                class="btn btn-success m-2">
                                                <i class="fa fa-check"></i>
                                            </a>
                                        @elseif ($review->status == 1)
                                            <a href="{{ route('review.status', ['review_id' => $review->id, 'status' => 0]) }}"
                                                class="btn btn-danger m-2">
                                                <i class="fa fa-ban"></i>
                                            </a>
                                        @endif
                                        <a href="{{ route('review.edit', ['review' => $review->id]) }}"
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

                    {{ $reviews->links() }}
                </div>
            </div>
        </div>

    </div>

    @include('review.delete-modal')

@endsection

@section('scripts')
    
@endsection
