@extends('layouts.app')

@section('content')
    <div class="container">
            <div class="jumbotron">
                    <h1 class="display-4">{{__('welcome.app_name')}}</h1>
                    <p class="lead">{{__('welcome.app_description')}}</p>
                    <hr class="my-4">
                    <p>{{__('welcome.project_by')}}</p>
                    <a class="btn btn-primary btn-lg" href="https://github.com/cryptobfund/php-project-lvl4" role="button">{{__('welcome.learn_more')}}</a>
            </div>
    </div>
@endsection
