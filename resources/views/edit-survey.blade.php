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
            disableFields: ['autocomplete', 'button', 'file'],
            //disabledActionButtons: ['data'],
            controlOrder: ['header', 'paragraph', 'text', 'textarea'],
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
                    success: function() {
                        alert('success')
                        console.log(fullJSON);
                    },
                    error: function() {
                        alert('fail');
                    }
                });
            }
        };
        var formBuilder = $(fbEditor).formBuilder(options);
    });
</script>
@endsection
