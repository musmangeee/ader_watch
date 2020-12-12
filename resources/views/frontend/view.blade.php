@extends('layouts.frontend')

@section('style')
    <link href="{{ asset('backend/assets/libs/fancy-timer/fancy-timer.css') }}" type="text/css" rel="stylesheet">
    
    <style>
        .rating {
            font-size: 1rem;
        }
        video::-webkit-media-controls {
  display:none !important;
}
video::-webkit-media-controls {
  display:none !important;
}
video::-webkit-media-controls-fullscreen-button {
    display: none;
}
video::-webkit-media-controls-enclosure {
  display:none !important;
}
    </style>
@endsection

@section('content')

    @include('frontend.partials.default_banner')



    <!-- CARDS -->
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-9">
                <video src="{{ asset('storage/app/public/'.$data['ad']['video']) }}"
                       class="rounded w-100 mb-3 " id="video" preload="metadata" 
                       
                        ></video>
                      
                <h1>{{ $data['ad']['title'] }}</h1>
                <p class="text-secondary"> {{ $data['ad']['description'] }}</p>
              
            </div>
            <div class="col-md-3">
                <div class="inline">
                    <div id="container" class="ft ft-dark"></div>
                </div>
                <button type="button" class="btn btn-primary w-100" id="playVideo">Watch Ad</button>
                
            </div>
        </div>
        <!-- / .row -->

    </div>
    <div class="modal" tabindex="-1" role="dialog" id="reward_modal">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body text-center p-5">
                    <span class="fa fa-sack-dollar mb-4 text-primary" style="font-size: 6rem"></span>

                    <h2 class="mb-4" id="modal_result"><span class="text-secondary font-italic">You have successfully earned</span>
                        <span
                            class="text-primary  font-weight-bold">{{ $data['ad']->package['amount_per_view'] }}</span>
                    </h2>


                    <a href="{{ $data['ad']['link'] }}" class="btn btn-primary" target="_blank">Go to Website</a>

                </div>
            </div>
        </div>
    </div>



    <div class="modal" tabindex="-1" role="dialog" id="review_modal" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body text-center p-5">
                    <form action="{{route('user.store.review')}}" method="POST" enctype="multipart/form-data"
                          id="review_form">
                        <h2>Rate the Ad</h2>
                        <div class="justify-content-center">
                            <div class="rate text-primary text-center mx-auto" data-rate-value=5
                                 style="font-size: 3rem"></div>
                        </div>
                        <input type="hidden" name="review_value" class="review_value" data-rate-value=1>
                        <input type="hidden" name="business_id" value="{{$data['ad']->id}}">

                        <div class="form-group">
                            <label for="">Write Your Review</label>
                            <textarea id="review_text" rows="5" class="form-control" name="message"
                            ></textarea>
                        </div>
                        <div class="input-images mb-3"></div>
                        <button class="btn btn-primary">Post Review</button>
                    </form>

                </div>
            </div>
        </div>
    </div>

@endsection


@section('script')

    <script src="{{ asset('backend/assets/libs/mediainfo/mediainfo.min.js') }}"></script>
    <script src="{{ asset('backend/assets/libs/fancy-timer/fancy-timer.min.js') }}"></script>
    
    
    <script>

        $(document).ready(function () {
            
            $('#myModal').modal({backdrop: 'static', keyboard: false})
            $(".rate").rate({
                step_size: 1,
            });


            function start_timer() {
                ft.start(-1);
            }

            $('#playVideo').on('click', function () {
                
                
                $(this).attr('disabled', 'true')
                $(this).html('Playing Ad...')
                
                $('#video').trigger('play');
                
                start_timer()
            })
        
            
            
                const container = document.getElementById('container');
                ft = new FancyTimer(container, {
                    value: {{ $data['ad']['video_duration'] }},
                    direction: -1,
                });
                ft.stop()
             
           
            
            $('#video').on('ended', function () {
                $('#playVideo').prop("disabled", false);
                $('#playVideo').html('Thank you for watching...');
                //$('#reward_modal').modal('show');
                $('#review_modal').modal('show');
                // toggleFullScreen();
            });

            // let  videoElement =  document.getElementById("video");
            // function toggleFullScreen() {
            //     if (!document.mozFullScreen && !document.webkitFullScreen) {
            //         if (videoElement.mozRequestFullScreen) {
            //             videoElement.mozRequestFullScreen();
            //         } else {
            //             videoElement.webkitRequestFullScreen(Element.ALLOW_KEYBOARD_INPUT);
            //         }
            //         document.mozFullScreen = true;
            //         document.webkitFullScreen = true;
            //     } else {
            //         if (document.mozCancelFullScreen) {
            //             document.mozCancelFullScreen();
            //         } else {
            //             document.webkitCancelFullScreen();
            //         }
            //     }
            // }


            function video_watched() {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: 'POST',
                    url: "{{ route('save_view') }}",
                    data: {user_id: {{ Auth::user()->id }}, 'ad_id': {{$data['ad']['id']}} },
                    success: function (data) {
                        $('#modal_result').html(data.success);
                        let amount = parseFloat($('#price-badge').html());
                        amount = amount + parseFloat(data.reward);
                        console.log(amount)
                        $('#price-badge').html(parseFloat(amount).toFixed(1));
                        $('#reward_modal').modal('show');
                    }
                });
            }

            $('#review_form').on('submit', function (e) {
                // validation code here
                console.log($(".rate").rate("getValue"));
                e.preventDefault();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: 'POST',
                    url: "{{ route('save_review_ajax') }}",
                    data: {
                        user_id: {{ Auth::user()->id }},
                        'ad_id': {{$data['ad']['id']}},
                        'stars': $(".rate").rate("getValue"),
                        'text': $('#review_text').val()
                    },
                    success: function (data) {
                        $('#review_modal').modal('hide');
                        $('#reward_modal').modal('show');
                        video_watched()
                    }
                });
            });
        })


        // $(window).on("blur focus", function(e) {
        //     var prevType = $(this).data("prevType");
        //
        //     if (prevType != e.type) {   //  reduce double fire issues
        //         switch (e.type) {
        //             case "blur":
        //                 // do work
        //                 ft.stop()
        //                 $('#video').trigger('pause');
        //                 break;
        //             case "focus":
        //                 ft.start(-1);
        //                 $('#video').trigger('play');
        //                 break;
        //         }
        //     }
        //
        //     $(this).data("prevType", e.type);
        // })
    </script>
    <script>
        $(document).ready(function () {

            $('#videoPlay').on('click', function (event) {

                openFullscreen($('#video'))
            });

            function openFullscreen(video) {
                var elem = document.getElementById("video");
                document.getElementById("video").controls = false;
                $('#video').trigger('play');
                if (elem.requestFullscreen) {
                    elem.requestFullscreen();
                } else if (elem.mozRequestFullScreen) {
                    elem.mozRequestFullScreen();
                } else if (elem.webkitRequestFullscreen) {
                    elem.webkitRequestFullscreen();
                    
                } else if (elem.msRequestFullscreen) {
                    elem.msRequestFullscreen();
                }
            }


        })


    </script>



@endsection
