@extends('client.app')
@section('content')
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="media">
                <div class="media-left">
                    <a href="#">
                        <img class="media-object" src="" alt="">
                    </a>
                </div>
                <div class="media-body">
                    <h4 class="media-heading">$User->getName()</h4>
                    ...
                </div>
            </div>
        </div>
    </div>
@stop