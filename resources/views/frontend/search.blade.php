@extends('layouts.frontend')

@section('content')
@include('frontend.partials.default_banner')
<section>
    <div class="container mt-5">
        <div class="row">
            @foreach ($data['search_results'] as $result)
            <div class="col-lg-4 col-sm-6">
                <div class="card cat-card lift">
                    <div id="videoContainer" class="card-img-top">
                        <video src="{{ asset('storage/app/public/'.$result['video']) }}" class="rounded w-100 mb-3" preload="metadata"></video>
                    </div>
                    <div class="card-body text-left">
                        <h2 class="card-title text-dark">
                            {{ $result['title'] }}
                        </h2>
                        <p>
                                    @foreach($result->categories as $cat)
                                        <span class="badge badge-secondary">{{ $cat->name }}</span>
                                    @endforeach
                                </p>
                                <p class="text-secondary font-italic">{{ $result['description'] }}</p>
                        @if(Auth::user())
                                
                                <a class="btn btn-primary w-100" href="{{ url('view/'.urlencode($result['id'])) }}">Watch Ad</a> <br> <br>
                                <a class="btn btn-secondary w-100" href="{{ $result['link'] }}" target="_blank">{{$result['btn_text']}}</a>
                                
                                @else

                                <a class="btn btn-primary w-100" href="{{route('login')}}">Watch Ad</a> <br> <br>
                                <a class="btn btn-secondary w-100" href="{{route('login')}}" target="_blank">{{$result['btn_text']}}</a>
                               @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@include('frontend.partials.footer')
@endsection