@extends('layouts.frontend')

@section('content')
    @include('frontend.partials.home_banner')



    <section class=" bg-white">
        <div class="container text-center py-5 mt-3">
            <h2 class="h1">Recent Added</h2>

            <h3 class=" mt-5 mb-4">New Ads</h3>
            <div class="row">
                @foreach($data['ads'] as $ads)
                    <div class="col-lg-12 col-sm-6">
                        <div
                           class="card cat-card lift">
                            <div class="ad-price">{{ $ads->package['amount_per_view'] }} USD</div>
                            <!-- Image -->
                            <video src="{{ asset('storage/app/public/'.$ads['video']) }}"
                                   class="card-img-top"></video>
                            <!-- Body -->
                            <div class="card-body text-left">
                                <!-- Heading -->
                                <h2 class="card-title text-dark">
                                    {{ $ads['title'] }}
                                </h2>
                                <p>
                                    @foreach($ads->categories as $cat)
                                        <span class="badge badge-secondary">{{ $cat->name }}</span>
                                    @endforeach
                                </p>
                                <p class="text-secondary font-italic">{{ $ads['description'] }}</p>
                                @if(Auth::user())
                                
                                <a class="btn btn-primary" href="{{ url('view/'.urlencode($ads['id'])) }}">Watch Ad</a>
                                <a class="btn btn-secondary" href="{{ $ads['link'] }}" target="_blank">{{$ads['btn_text']}}</a>
                                
                                @else

                                <a class="btn btn-primary" href="{{route('login')}}">Watch Ad</a>
                                <a class="btn btn-secondary" href="{{route('login')}}" target="_blank">{{$ads['btn_text']}}</a>
                               @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section>
        <div class="container text-center py-5 mt-5">
            <h2 class="h1">Browse Ads By Categories</h2>

            <div class="row mt-5">

                @for($a = 0; $a<8; $a++)
                    <div class="col-lg-3 col-sm-6">
                        <a href="{{ url('search?find='.urlencode($data['categories'][$a]['name'])) }}"
                           class="card cat-card lift">
                            <!-- Image -->
                            <img src="{{ asset('storage/app/public/'.$data['categories'][$a]['image']) }}" alt="..."
                                 class="card-img-top">
                            <!-- Body -->
                            <div class="card-body text-center py-3">
                                <!-- Heading -->
                                <h2 class="card-title text-dark">
                                    {{ $data['categories'][$a]['name'] }}
                                </h2>
                            </div>
                        </a>
                    </div>
                @endfor


            </div>
        </div>
    </section>
    @include('frontend.partials.footer')
@endsection
<!-- Libs JS -->

@section('script')

    <script>
        $(document).ready(function () {
            $(".rating").rate({
                update_input_field_name: $(".review_value"),
            });
        });
    </script>
@endsection
