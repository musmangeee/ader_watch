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
                        <th scope="col">User Name</th>
                        <th scope="col">Business Name</th>
                        <th scope="col">Role</th>
                        <th scope="col">Business Phone</th>
                        <th scope="col">Claimer Email</th>
                        <th scope="col">Status</th>
                        <th scope="col">Created</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($claims as $c)
                        <tr>
                            <th scope="row">1</th>
                            <td>{{ $c->user->name }}</td>
                            <td>{{ $c->business->name }}</td>
                            <td>{{ $c->role }}</td>
                            <td>{{ $c->business->phone }}</td>
                            <td>{{ $c->email_username . '@' . preg_replace('#^(http(s)?://)?w{3}\.#', '$1', parse_url($c->business->url)['host']) }}</td>
                            <td>
                            @if($c->status == 0)
                                <form action="{{ route('admin.claim_business', 1) }}" method="POST">
                                    @csrf
                                    <input type="hidden" value="{{$c->id}}" name="claim_id">
                                    <input type="hidden" value="{{$c->business->id}}" name="business_id">
                                    <input type="hidden" value="{{$c->user->id}}" name="user_id">
                                    <button type="submit" class="btn btn-warning btn-sm mb-2" data-toggle="tooltip"
                                            data-placement="top" title="" data-original-title="Click to verify"><i
                                                class="fe fe-check-square pr-2"></i>Not Claimed
                                    </button>
                                </form>
                            @else
                                <button type="button" class="btn btn-success mb-2 btn-sm" disabled><i
                                            class="fe fe-x-square pr-2"></i>Claimed
                                </button>
                                @endif
                                </td>

                                <td>{{  \Carbon\Carbon::parse($c->created_at)->diffForhumans()  }}</td>
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
