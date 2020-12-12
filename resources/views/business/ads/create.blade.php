@extends('layouts.frontend')

@section('style')
<style>
    /**
 * The CSS shown here will not be introduced in the Quickstart guide, but shows
 * how you can use CSS to style your Element's container.
 */
    .StripeElement {
        box-sizing: border-box;

        height: 40px;

        padding: 10px 12px;

        border: 1px solid transparent;
        border-radius: 4px;
        background-color: white;

        box-shadow: 0 1px 3px 0 #e6ebf1;
        -webkit-transition: box-shadow 150ms ease;
        transition: box-shadow 150ms ease;
    }

    .StripeElement--focus {
        box-shadow: 0 1px 3px 0 #cfd7df;
    }

    .StripeElement--invalid {
        border-color: #fa755a;
    }

    .StripeElement--webkit-autofill {
        background-color: #fefde5 !important;
    }
</style>

@endsection

@section('content')

@include('frontend.partials.business_banner')



<div class="container mt-4">
    <div class="row">
        <div class="col-md-6">
            <h1>Create a new ad.</h1>
            <p>Start creating your ad and get new peoples.</p>
            <div class="card">
                <div class="card-body">
                    <script src="https://js.stripe.com/v3/"></script>
                    <form method="POST" action="{{ route('ads.store') }}" enctype="multipart/form-data" id="payment-form">
                        @csrf
                        <div class="form-group">
                            <label for="">Ad Title</label>
                            <input type="text" class="form-control" required placeholder="" name="title">
                        </div>
                        <!-- Input -->
                        <div class="form-group">
                            <label for="">Ad Categories</label>
                            <select name="categories[]" id="" class="form-control" data-toggle="select" required multiple autocomplete="false">
                                @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="">Select Package</label>
                            <select name="package_id" id="" class="form-control" required>
                                @foreach($packages as $package)
                                <option value="{{ $package->id }}">{{ $package->name . ' Package -  ' . $package->total_views.' '. 'views in ' .$package->price. ' only!'}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Ad Description</label>
                            <textarea class="form-control" placeholder="" required rows="5" name="description"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="">Redirect User Link:</label>
                            <input type="url" class="form-control" placeholder="" required name="link">
                        </div>
                        <div class="form-group">
                            <label for="">Button Text:</label>
                            <input type="text" class="form-control" placeholder="" name="btn_text" required>
                            <input type="hidden" class="form-control" placeholder="" id="infos" name="video_duration" value="" required>
                        </div>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="fileUp" required accept="video/mp4,video/x-m4v,video/*" name="video">
                            <label class="custom-file-label" for="validatedCustomFile">Upload Ad Video</label>
                        </div>


                        <hr>
                        <h2>Payment Details</h2>

                        <div class="form-group">
                            <label for="name_on_card">Name on Card</label>
                            <input type="text" class="form-control" placeholder="" name="name_on_card" required id="name_on_card">

                        </div>
                        <div class="form-group">

                            <label for="card-element">
                                Credit or debit card
                            </label>
                            <div id="card-element">
                                <!-- a Stripe Element will be inserted here. -->
                            </div>

                            <!-- Used to display form errors -->
                            <div id="card-errors" role="alert"></div>
                        </div>

                        <button class="btn btn-primary mt-4 w-100" id="save_add" type="submit" class="button-primary full-width">Save Ad</button>


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
    // Create a Stripe client
    var stripe = Stripe('pk_test_Ayusy22nWC3ectV3nGu6WUVh00hB1Ur5r7');

    // Create an instance of Elements
    var elements = stripe.elements();

    // Custom styling can be passed to options when creating an Element.
    // (Note that this demo uses a wider set of styles than the guide below.)
    var style = {
        base: {
            color: '#32325d',
            lineHeight: '18px',
            fontFamily: '"Roboto", Helvetica Neue", Helvetica, sans-serif',
            fontSmoothing: 'antialiased',
            fontSize: '16px',
            '::placeholder': {
                color: '#aab7c4'
            }
        },
        invalid: {
            color: '#fa755a',
            iconColor: '#fa755a'
        }
    };

    // Create an instance of the card Element
    var card = elements.create('card', {
        style: style
    });

    // Add an instance of the card Element into the `card-element` <div>
    card.mount('#card-element');

    // Handle real-time validation errors from the card Element.
    card.addEventListener('change', function(event) {
        var displayError = document.getElementById('card-errors');
        if (event.error) {
            displayError.textContent = event.error.message;
        } else {
            displayError.textContent = '';
        }
    });

    // Handle form submission
    var form = document.getElementById('payment-form');
    form.addEventListener('submit', function(event) {
        event.preventDefault();

        // Disable the submit button to prevent repeated clicks
        // document.getElementById('save_add').disabled = true;

        var options = {
            name: document.getElementById('name_on_card').value,

        }

        stripe.createToken(card, options).then(function(result) {
            if (result.error) {
                // Inform the user if there was an error
                var errorElement = document.getElementById('card-errors');
                errorElement.textContent = result.error.message;

                // Enable the submit button
                document.getElementById('save_add').disabled = false;
            } else {
                // Send the token to your server
                stripeTokenHandler(result.token);
            }
        });
    });

    function stripeTokenHandler(token) {
        // Insert the token ID into the form so it gets submitted to the server
        var form = document.getElementById('payment-form');
        var hiddenInput = document.createElement('input');
        hiddenInput.setAttribute('type', 'hidden');
        hiddenInput.setAttribute('name', 'stripeToken');
        hiddenInput.setAttribute('value', token.id);
        form.appendChild(hiddenInput);

        // Submit the form
        form.submit();
    }
</script>

<script>
    $('video').hide()
    $(document).ready(function() {

        $('#fileUp').on('change', function(event) {
            let file = event.target.files[0];
            let blobURL = URL.createObjectURL(file);
            document.querySelector("video").src = blobURL;
            $('video').show()
        })

        var myVideos = [];

        window.URL = window.URL || window.webkitURL;

        document.getElementById('fileUp').onchange = setFileInfo;

        function setFileInfo() {
            var files = this.files;
            myVideos.push(files[0]);
            var video = document.createElement('video');
            video.preload = 'metadata';

            video.onloadedmetadata = function() {
                window.URL.revokeObjectURL(video.src);
                var duration = video.duration;
                myVideos[myVideos.length - 1].duration = duration;
                updateInfos();
            }

            video.src = URL.createObjectURL(files[0]);;
        }


        function updateInfos() {
            //var infos = document.getElementById('infos');
            infos.textContent = "";
            for (var i = 0; i < myVideos.length; i++) {
                //  infos.textContent += " duration: " + myVideos[i].duration + '\n';

                $('#infos').val(parseInt(myVideos[i].duration));
            }
        }

    })
</script>
@endsection