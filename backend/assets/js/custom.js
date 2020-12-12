$(document).ready(function () {

    $(".rating").rate({
        update_input_field_name: $(".review_value"),
    });
    console.log(path);
    var location_path = path + "/autocomplete_locations";
    $('input.autocomplete_locations').typeahead({
        hint: true,
        highlight: true,
        source: function (query, process) {
            return $.get(location_path, {query: query}, function (data) {
                return process(data);
            });
        }
    });


    var current_location = $('input.autocomplete_locations').val();
    $('input.autocomplete_locations').on('typeahead:cursorchanged', function (e, datum) {
        current_location = datum;
        console.log(datum);
    });


    var keyword_path = path + "/autocomplete_keyword?location=" + current_location;
    $('input.autocomplete_find').typeahead({
        hint: true,
        highlight: true,
        source: function (query, process) {
            return $.get(keyword_path, {query: query}, function (data) {
                return process(data);
            });
        }
    });


    var category_path = path + "/autocomplete_business?location=" + current_location;
    $('input.autocomplete_business').typeahead({
        hint: true,
        highlight: true,
        source: function (query, process) {
            return $.get(category_path, {query: query}, function (data) {
                return process(data);
            });
        }
    });


    var city_list_path = path + '/list_cities';
    $('.signup_town').show();
    $.get(city_list_path, {city: $('.signup_city').val()}, function (data) {
        var option = '';
        if (parseInt(data.length) > 0) {
            console.log(parseInt(data.length))
            $('.signup_town').show();
            for (var i = 0; i < data.length; i++) {
                if(parseInt(i) == 0)
                    option += `<option value="${data[i].id}" selected>${data[i].name}</option>`
                else
                    option += `<option value="${data[i].id}">${data[i].name}</option>`
            }
            $('.signup_town select').html(option)
            $('.signup_town select').prop('required',true);
        }else{
            $('.signup_town').hide();
            $('.signup_town select').html('')
            $('.signup_town select').prop('required',false);
        }

    });
    $('.signup_city').on('change', function () {
        $.get(city_list_path, {city: $(this).val()}, function (data) {
            var option = '';
            if (parseInt(data.length) > 0) {
                console.log(parseInt(data.length))
                $('.signup_town').show();
                for (var i = 0; i < data.length; i++) {
                    if(parseInt(i) == 0)
                    option += `<option value="${data[i].id}" selected>${data[i].name}</option>`
                    else
                    option += `<option value="${data[i].id}">${data[i].name}</option>`
                }
                console.log(option)
                $('.signup_town select').html(option)
                $('.signup_town select').prop('required',true);
            }else{
                $('.signup_town').hide();
                $('.signup_town select').html('')
                $('.signup_town select').prop('required',false);

            }

        });
    })



});