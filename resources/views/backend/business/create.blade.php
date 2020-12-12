@extends('layouts.frontend')
@section('style')
<style>
    .upload-image-custom {
        height: 100px;
    }
</style>
@endsection
@section('content')
@include('frontend.partials.default_banner')


<!-- CARDS -->
<div class="container">
    <div class="row">
        <div class="col-md-6">

            <!-- Title -->
            <h1 class="mb-3 mt-5">
                Let’s create your business.
            </h1>

            <!-- Subtitle -->
            <p class="mb-3text-muted">
                Ad your business and earn new sales.
            </p>
            <div class="card">
                <div class="card-body">
                    <form class="tab-content" action="{{ route('user.business.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">

                            <!-- Label -->
                            <label class="mb-1">
                                Business Name
                            </label>

                            <input type="text" class="autocomplete_business form-control" name="name" autocomplete="off" required>
                        </div>
                        <div class="form-group">

                            <!-- Label -->
                            <label>
                                Business Categories
                            </label>

                            <!-- Input -->
                            <select name="categories[]" id="" class="form-control" data-toggle="select" required multiple autocomplete="false">
                                @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>

                        </div>

                        <!-- Team description -->
                        <div class="form-group">

                            <!-- Label -->
                            <label class="mb-1">
                                Business Phone Number
                            </label>

                            <input type="text" name="phone" class="form-control" placeholder="Business Phone Number" data-mask="(000) 000-0000" required>
                        </div>

                        <!-- Team description -->
                        <div class="form-group">

                            <!-- Label -->
                            <label class="mb-1">
                                Business Website
                            </label>

                            <input type="url" name="url" class="form-control" placeholder="Business Website">
                        </div>
                        <input type="file" id="gallery-photo-add" multiple name="images">

                        <div class="gallery row">

                        </div>


                        <button class="btn btn-lg btn-primary w-100 mt-5" type="submit">Create My Business</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-6 px-4 mt-7 text-center">
            <h1>Watch the video of your favorite businesses and earn money along the way!</h1>
            <img src="{{ asset('backend/images/video.svg') }}" alt="" class="img-fluid">
        </div>

    </div>
    <!-- / .row -->

</div>


@endsection

@section('script')
<script>
    $(function() {
        // Multiple images preview in browser
        var imagesPreview = function(input, placeToInsertImagePreview) {
            $('div.gallery').html("")
            if (input.files) {
                var filesAmount = input.files.length;

                for (i = 0; i < filesAmount; i++) {
                    var reader = new FileReader();

                    reader.onload = function(event) {

                        let img = $($.parseHTML('<img>')).attr('src', event.target.result)
                        img.addClass('col-4');
                        img.addClass('py-3');
                        img.addClass('upload-image-custom');
                        img.appendTo(placeToInsertImagePreview);
                    }

                    reader.readAsDataURL(input.files[i]);
                }
            }

        };

        $('#gallery-photo-add').on('change', function() {
            imagesPreview(this, 'div.gallery');
        });
    });
</script>
@endsection