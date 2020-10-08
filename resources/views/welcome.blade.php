@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <h1>{{__('welcome.app_name')}}</h1>
                    <h2>{{__('welcome.app_description')}}</h2>
                    <h3>{{__('welcome.project_by')}}</h3>
                    <a href="https://github.com/cryptobfund/php-project-lvl4" role="button">{{__('welcome.learn_more')}}</a>
                </div>
            </div>
        </div>
    </div>
@endsection
