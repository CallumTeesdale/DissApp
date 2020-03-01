@extends('layouts.app')

@section('content')
<div class="form-wrap">
    <div class="form-container">
        <form action="" class="login-form">
            <br>
            <input class="username" type="text" name="title" id="title" placeholder="title">
            <br>
            <input class="username" name="description" id="description" type="textarea" cols="30" rows="5" placeholder="description">
        </form>
        <br>
        <div id="build-wrap"></div>
    </div>
</div>
<script src="/js/jquery.min.js"></script>
<script src="/js/jquery-ui.min.js"></script>
<script src="/js/form-builder.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
             }
            });
    jQuery(function($) {
        var fbEditor = document.getElementById("build-wrap");
        options = {
            dataType: 'json',
            disabledAttrs: ["access", "className", "description", "max", "maxlength", "min", "multiple", "name", "other", "rows", "step", "style", "subtype", "placeholder"],
            disableFields: ['autocomplete', 'button', 'file', 'hidden'],
            disabledActionButtons: ['data'],
            controlOrder: ['header', 'paragraph', 'text', 'textarea'],
            editOnAdd: true,
            stickyControls: {
                enable: true
            },
            onSave: function() {
                console.log("save pressed");
                var fullJSON = formBuilder.actions.getData('json', true);
                var title = $('#title').val();
                var description = $('#description').val();
                if(title && description){
                $.ajax({
                    type: 'POST',
                    url: "{{route('surveys.store')}}",
                    data: JSON.stringify({json:fullJSON, title:title, description:description}),
                    success: function(data) {
                        alert('success')
                        console.log(fullJSON);
                        //location.href = "{{route('successResponse')}}";
                    },
                    error: function(data) {
                        alert('fail');
                    }
                });
                }
                else{
                    $('#title').val('Cannot be empty')
                    $('#description').val('Cannot be empty');
                }
            }
        };
        var formBuilder = $(fbEditor).formBuilder(options);
    });
</script>
@endsection
