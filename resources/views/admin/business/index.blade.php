@extends('layouts.admin')

@section('content')


    <div class="header">
        <div class="container">

            <!-- Body -->
            <div class="header-body">
                <div class="row align-items-end">
                    <div class="col">

                        <!-- Pretitle -->
                        <h6 class="header-pretitle">
                            Overview
                        </h6>

                        <!-- Title -->
                        <h1 class="header-title">
                            Business
                        </h1>

                    </div>
                    <div class="col-auto">

                        <!-- Button -->
                        <a href="{{route('business.create')}}" class="btn btn-primary lift">
                            Create New Business
                        </a>

                    </div>
                </div> <!-- / .row -->
            </div> <!-- / .header-body -->

        </div>
    </div>

    <!-- CARDS -->
    <div class="container-fluid">
        @if(Session::has('success'))
            <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('success') }}</p>
        @endif
        @if(Session::has('error'))
            <p class="alert {{ Session::get('alert-class', 'alert-danger') }}">{{ Session::get('error') }}</p>
        @endif

        <div class="card">
            <div class="card-body">
                <table class="table table-sm table-nowrap">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Business Name</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Website</th>
                        <th scope="col">Verified</th>
                        <th scope="col">Claimed</th>
                        <th scope="col">Created</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($business as $b)
                        <tr>
                            <th scope="row">1</th>
                            <td>{{ $b->name }}</td>
                            <td>{{ $b->phone }}</td>
                            <td>{{ $b->url }}</td>
                            <td>
                            @if($b->status == 0)
                                <form action="{{ route('verify_business', 1) }}" method="POST">
                                    @csrf
                                    <input type="hidden" value="{{$b->id}}" name="business_id">
                                    <button type="submit" class="btn btn-warning btn-sm mb-2" data-toggle="tooltip"
                                            data-placement="top" title="" data-original-title="Click to verify"><i
                                                class="fe fe-check-square pr-2"></i>Not Verified
                                    </button>
                                </form>
                            @else
                                <button type="button" class="btn btn-success mb-2 btn-sm" disabled><i
                                            class="fe fe-x-square pr-2"></i>Verified
                                </button>
                                @endif
                                </td>
                                <td>@if($b->claimed == 0) Not Claimed @else Claimed @endif </td>
                                <td>{{  \Carbon\Carbon::parse($b->created_at)->diffForhumans()  }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>


@endsection



@section('script')
    <script>
        $(document).ready(function () {
            $('.input-images').imageUploader();
        })
    </script>
@endsection
