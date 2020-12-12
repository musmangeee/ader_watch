@extends('layouts.frontend')

@section('content')

@include('frontend.partials.business_banner')
<!-- CARDS -->
<div class="container mt-4">
    <div class="row">
        <div class="col-md-6">
            <h1>Update new ad.</h1>
            <p>Start creating your ad and get new peoples.</p>
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{ route('ads.update',$ads->id) }}">
                        @method('PATCH')
                        @csrf
                        <div class="form-group">
                            <label for="">Ad Title</label>
                            <input type="text" class="form-control" value="{{$ads->title}}" required placeholder="" name="title">
                        </div>
                        <!-- Input -->
                        <div class="form-group">
                            <label for="">Ad Categories</label>

                            <select name="categories[]" id="" class="form-control" data-toggle="select" required multiple autocomplete="false">

                                @foreach($categories as $category)
                                <option value="{{ $category->id }}" @foreach($ads->categories as $cat) @if($cat['id'] == $category['id']) selected @endif @endforeach >{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="">Select Package</label>
                            <select name="package_id" id="" class="form-control" required>
                                <option value="{{$ads->package_id}}">{{$ads->package->name}}</option>
                                @foreach($packages as $package)
                                <option value="{{ $package->id }}">{{ $package->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Ad Description</label>
                            <textarea class="form-control" placeholder=""" required rows=" 5" name="description">{{$ads->description}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="">Redirect User Link:</label>
                            <input type="url" class="form-control" value="{{$ads->link}}" placeholder="" name="link" required>
                        </div>
                        <div class="form-group">
                            <label for="">Button Text:</label>
                            <input type="text" class="form-control" value="{{$ads->btn_text}}" placeholder="" name="btn_text" required>
                        </div>
                        <div class="form-group">
                            <video class="card-img-top" id="Myvideo" controls>
                                <source src="{{ asset('storage/app/public/'). '/' . $ads->video }}" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                        </div>
                        <div class="custom-file">

                            <input type="file" class="custom-file-input" value="$ads->video" id="validatedCustomFile" accept="video/mp4,video/x-m4v,video/*" name="video">
                            <label class="custom-file-label" for="validatedCustomFile">Upload Ad Video</label>
                        </div>

                        <button class="btn btn-primary mt-4 w-100" type="submit">Save Ad</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <video controls class="w-100">
                <source src="" type="video/mp4">
                Your browser does not support the video tag.
            </video>
        </div>
    </div>
    <!-- / .row -->

</div>


@endsection

@section('script')
<script>
    $('video').hide()
    $('#Myvideo').show()
    $(document).ready(function() {

        document.querySelector("input[type=file]")
            .onchange = function(event) {

                let file = event.target.files[0];
                let blobURL = URL.createObjectURL(file);
                document.querySelector("video").src = blobURL;
                $('video').show()
            }
    })
</script>
@endsection