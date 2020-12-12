@extends('layouts.frontend')

@section('content')

    @include('frontend.partials.business_banner')
    <!-- CARDS -->
    <div class="container mt-4">
        <div class="row">
            @foreach($data['ads'] as $ad)
                <div class="col-md-4">
                    <div class="card">

                        <video class="card-img-top" id="remote_video" controls>
                            <source src="{{ asset('storage/app/public/'). '/' . $ad->video }}" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>

                        <div class="card-body">
                            <h3 class="card-title">{{ $ad->title }}</h3>
                            <p>{{ $ad->description }}</p>
                            <a href="{{route('ads.edit', $ad->id)}}"
                class="btn btn-warning btn-sm lift"><i class="fe fe-edit"></i></a>
            <form action="{{ route('ads.destroy', $ad->id)}}" method="post"
                    class="d-inline-block">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger btn-sm lift   " type="submit"><i class="fe fe-trash"></i>
                </button>
            </form>

                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <!-- / .row -->

    </div>
   
@endsection

