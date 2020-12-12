@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <div class="header">
            <div class="container-fluid">

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
                                Ads
                            </h1>

                        </div>
                     
                    </div> <!-- / .row -->
                </div> <!-- / .header-body -->

            </div>
        </div>
        @if(Session::has('success'))
            <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('success') }}</p>
        @endif
        @if(Session::has('error'))
            <p class="alert {{ Session::get('alert-class', 'alert-danger') }}">{{ Session::get('error') }}</p>
        @endif

        <div class="card">
            <div class="card-body">

                <!-- Table -->
                <div class="table-responsive">
                    <table class="table table-sm table-nowrap card-table text-secondary">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Package</th>
                            <th>Business</th>
                            <th>Business User</th>
                          
                        </tr>
                        </thead>
                        <tbody>
                        @php
                            $i = 1;
                        @endphp
                        @foreach($data['ads'] as $ads)
                            <tr>
                                <th scope="row">{{$i++}}</th>
                                <td>{{ $ads['title'] }}</td>
                                <td>{{ $ads->package['name'] }}</td>
                                <td>{{ $ads->business['name'] }}</td>                     
                                <td>{{ $ads->business->user['name'] }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection

