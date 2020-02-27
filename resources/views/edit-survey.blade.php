@extends('layouts.app')

@section('content')
<div class="form-wrap">
    <div class="form-container">
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
                console.log("save pressed")
                var fullJSON = formBuilder.actions.getData('json', true);
                $.ajax({
                    type: 'POST',
                    url: '{{route('surveys.store')}}',
                    data: "json = " + fullJSON,
                    success: function(data) {
                        alert('success')
                        console.log(fullJSON);
                        //location.href = "{{route('success')}}";
                    },
                    error: function(data) {
                        alert('fail');
                    }
                });
            }
        };
        var formBuilder = $(fbEditor).formBuilder(options);
    });
</script>
@endsection
