@extends('client.app')
@section('content')
    <div class="panel panel-default">
        <div class="panel-body">
            <form action="{{route('client.test.answer', [$Test, $Question])}}" method="post">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <h4>{{$Test->prototype->title}}</h4>
                <div class="h6">Вопрос {{$Test->questions()->count() - $Test->questions()->notAnswered($Test)->count() + 1}} из {{$Test->questions()->count()}}</div>
                <hr>

                <p>{{$Question->text}}</p>

                @if($Question->image)
                    <img class="img-responsive" src="{{asset($Question->image)}}" alt="">
                @endif

                @foreach($Question->answers as $Answer)
                    <div class="form-group">
                        <div class="row">
                            <div class="col-lg-1">
                                <input  id="answer_{{$Answer->id}}" type="{{$Question->type}}" name="answers[]" value="{{$Answer->id}}">
                            </div>
                            <div class="col-lg-11">
                                <label for="answer_{{$Answer->id}}">{{$Answer->text}}</label>
                            </div>
                            <div class="col-lg-6">
                                @if($Answer->image)
                                    <img class="img-responsive" src="{{asset($Answer->image)}}" alt="">
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
                <div class="form-group">
                    <input class="btn btn-success" type="submit" value="Ответить">
                </div>

                <div class="form-group">
                    <span id="timer" data-time="{{$Test->prototype->time * 60 - \Carbon\Carbon::now()->diffInSeconds($Test->created_at)}}"></span>
                </div>
            </form>
        </div>
    </div>
@stop
@section('js')
    <script type="text/javascript" src="{{asset('js/jquery.time-to.min.js')}}"></script>
    <script type="text/javascript">
        $('#timer').timeTo({
            seconds: $('#timer').attr('data-time') * 1,
            theme: "black",
            callback: function(){
                alert('time');
            }
        });
    </script>
@stop
@section('css')
    <link rel="stylesheet" href="{{asset('css/timeTo.css')}}">
@stop
