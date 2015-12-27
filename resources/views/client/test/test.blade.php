@extends('client.app')
@section('content')
    <div class="panel panel-default">
        <div class="panel-body">
            <form action="{{route('client.test.answer', [$Test, $Question])}}" method="post">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <h4>{{$Test->prototype->title}}</h4>
                <hr>

                <p>{{$Question->text}}</p>

                @if($Question->image)
                    <img class="img-responsive" src="{{asset($Question->image)}}" alt="">
                @endif

                @foreach($Question->answers as $Answer)
                    <div class="form-group">
                        <label for="answer_{{$Answer->id}}">{{$Answer->text}}</label>
                        <input id="answer_{{$Answer->id}}" type="{{$Question->type}}" name="answers[]" value="{{$Answer->id}}">
                    </div>
                @endforeach
                <div class="form-group">
                    <input class="btn btn-success" type="submit" value="Ответить">
                </div>
            </form>
        </div>
    </div>
@stop