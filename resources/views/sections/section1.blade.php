@extends('welcome')

@section('section')
    <div class="alert alert-danger" style="display:none"></div>
    <form method="POST" action="{{ route('section1Store') }}">
        @csrf
        <div class="form-group">
            <label for="field1">Pole 1</label>
            <input type="text" name="field1" class="form-control" id="field1" placeholder="Wpisz treść">
        </div>
        <div class="form-group">
            <label for="field2">Pole 2</label>
            <input type="text" name="field2" class="form-control" id="field2" placeholder="Wpisz treść">
        </div>

        <div class="result__block">
            Długość tekstu stanowi: <span class="result"></span>
        </div>

        <button type="submit" class="btn btn-primary submit">Oblicz</button>
    </form>
@endsection

@section('scripts')
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(".submit").click(function(e){
            e.preventDefault();
            let $form = $('form');
            let $alertDanger = $('.alert-danger');

            $.ajax({
                type: 'POST',
                url: $form.attr('action'),
                data: $form.serialize(),
                success:function(response){
                    $('.result').text(response.data);
                    $form.trigger('reset');
                    $('#field1').focus();
                    $alertDanger.hide();
                    $alertDanger.empty();
                },
                error: function (data) {
                    if( data.status === 422 ) {
                        let errors = $.parseJSON(data.responseText);
                        $alertDanger.empty();
                        $('#field1').focus();
                        $.each(errors.errors, function (key, val) {
                            $alertDanger.show();
                            $alertDanger.append('<p>'+val+'</p>');
                        });
                    }
                }
            });
        });
    </script>
@endsection