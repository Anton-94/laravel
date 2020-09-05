@extends('welcome')

@section('section')
    <form method="POST" action="{{ route('chatStore') }}">
        @csrf
        <div class="result__block">
            @foreach($messages as $message)
                <p>{{ $message }}</p>
            @endforeach
            <span class="result"></span>
        </div>

        <div class="form-group">
            <label for="message">Tekst</label>
            <input type="text" name="message" class="form-control" id="message" placeholder="Wpisz treść">
        </div>

        <button type="submit" class="btn btn-primary submit">Wyślij</button>
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

            $.ajax({
                type: 'POST',
                url: $form.attr('action'),
                data: $form.serialize(),
                success:function(response){
                    $('.result').append('<p>' + response.data + '</p>');
                    $form.trigger('reset');
                }
            });
        });
    </script>
@endsection