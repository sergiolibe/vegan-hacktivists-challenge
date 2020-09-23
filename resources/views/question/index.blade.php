@extends('layouts.app')

@section('styles')
    <link href="{{ asset('css/plugins/select-pure/select-pure.css') }}" rel="stylesheet">
@endsection

@section('content')

    <div class="col-lg-12">
        <div class="pull-left">
            <h2>New Question</h2>
        </div>
    <!--div class="pull-right">
            <a class="btn btn-dark" href="{{ route('question.index') }}"> Back</a>
        </div-->
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{!! $error !!}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('question.store') }}" method="POST">
        @csrf

        <div class="col-12">
            <div class="form-group">
                <textarea name="text" id="text" class="form-control" required rows="3"
                          placeholder="randomQuestion"></textarea>
            </div>
        </div>

        <div class="col-12 text-center">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>

    </form>

    <div class="mt-5 container">
        <div class="row">
            <table class="table">
                <thead>
                <tr>
                    <th>id</th>
                    <th>name</th>
                    <th>date</th>
                </tr>
                </thead>
                @foreach($questions as $question)
                    <tr>
                        <td>{{$question->getId()}}</td>
                        <td>{{$question->getText()}}</td>
                        <td>{{$question->created_at}}</td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
@endsection
