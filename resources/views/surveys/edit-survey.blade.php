@extends('layouts.app')

@section('content')
<div class="form-wrap">
    <div class="form-container">
        <form action="" class="login-form">
            <br>
            <input class="username form-control" type="text" name="title" id="title" placeholder="title"
                onkeyup="countCharTitle(this)">
            <small id="charcountTitle" class="form-text text-center text-muted">255</small>
            <br>
            <input class="username form-control" name="description" id="description" type="textarea"
                onkeyup="countChar(this)" cols="30" rows="5" placeholder="description">
            <small id="charcount" class="form-text text-center text-muted">255</small>
            <br>
            <select name="category" id="category" class="form-control">
                @foreach ($categories as $cat)
                <option value="{{$cat->id}}"> {{$cat->name}}</option>
                @endforeach
            </select>
        </form>
        <br>
        <div id="build-wrap"></div>
    </div>
</div>
<script src="/js/jquery.min.js"></script>
<script src="/js/jquery-ui.min.js"></script>
<script src="/js/form-builder.min.js"></script>
<script>
    function countChar(val) {
        var len = val.value.length;
        if (len >= 255) {
          val.value = val.value.substring(0, 255);
        } else {
          $('#charcount').text(255 - len);
        }
      };
      function countCharTitle(val) {
        var len = val.value.length;
        if (len >= 255) {
          val.value = val.value.substring(0, 255);
        } else {
          $('#charcountTitle').text(255 - len);
        }
      };
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
                var category = $('#category').val();
                if(title && description){
                $.ajax({
                    type: 'POST',
                    url: "{{route('surveys.store')}}",
                    data: JSON.stringify({json:fullJSON, title:title, description:description, category:category}),
                    success: function(data) {
                        alert('success')
                        console.log(fullJSON);
                        location.href = "{{route('successResponse')}}";
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
