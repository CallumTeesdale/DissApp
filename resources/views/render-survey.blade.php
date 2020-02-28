@extends('layouts.app')

@section('content')

<div class="form-wrap">
    <div class="form-container">
        <form id="fb-render" method="post" action="">
        </form>
        <button id="submit" type="button" style="  cursor: pointer;
  display: flex;
  flex-direction: row;
  justify-content: center;
  float: left;
  width: 100%;
  height: 60px;
  margin-top: 10px;
  border: none;
  font-size: 1em;
  background-color: #E07854;
  border-radius: 0px 0px 25px 25px"><span>submit</span></button>
    </div>

    <script src="/js/jquery.min.js"></script>
    <script src="/js/jquery-ui.min.js"></script>
    <script src="/js/form-render.min.js"></script>
    <script>
            $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
             }
            });
        jQuery(function($) {
            var data = {!! $survey->form_data !!};
            $('#fb-render').formRender({
                dataType: 'json',
                formData: data
            });
            $("button").click(function(e) {
                var userData = $('#fb-render').formRender("userData");
    e.preventDefault();
  let allAreFilled = true;
  document.getElementById("fb-render").querySelectorAll("[required]").forEach(function(i) {
    if (!allAreFilled) return;
    if (!i.value) allAreFilled = false;
    if (i.type === "radio") {
      let radioValueCheck = false;
      document.getElementById("fb-render").querySelectorAll(`[name=${i.name}]`).forEach(function(r) {
        if (r.checked) radioValueCheck = true;
      })
      allAreFilled = radioValueCheck;
    }
  })
  if (!allAreFilled) {
    $('span').text(' Fill all the required fields');
  }else{
    $.ajax({
        type: "POST",
        url: "{{route('response.store')}}",
       // processData:false,
        data: JSON.stringify({userData:userData, survey_id:{!!$survey->id!!}})
        ,
        success: function(result) {
            alert('ok');
            console.log("userDate="+ userData);
            console.log("data=" + data);
            location.href = "{{route('successResponse')}}";
        },
        error: function(result) {
            alert('error');

            console.log(userData);
            console.log(data);
            location.href = "{{route('failResponse')}}";
        }
    });
};

});
        });
    </script>
@endsection
