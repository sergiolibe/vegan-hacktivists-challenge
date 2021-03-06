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

    <form class="form-group mt-2" action="{{ route('question.store') }}" method="POST">
        @csrf

        <div class="col-12">
            <div class="form-group">
                <textarea name="text" id="text" class="form-control" required rows="3"
                          placeholder="ask something meaningful">{{old('text') ?? $randomQuestion}}</textarea>
            </div>
        </div>

        <div class="col-12 text-center">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>

    </form>

    <div class="mt-5 container">
        <div class="row">
            <div class="col-12">
                <h2>Questions</h2>
            </div>
        </div>
    </div>

    <div class="mt-5 container">

        @php /** @var \App\Models\Question $question **/@endphp
        @foreach($questions as $question)
            <div class="d-flex justify-content-between align-items-center border-bottom pb-3 mb-3">
                <h3 class="m-0">
                    <a href="{{route('question.show',[$question->getId()])}}" class="text-dark">
                        {{$question->getText()}}
                    </a>
                </h3>
                <div>
                    <span class="badge badge-primary">
                        {{$question->getAmountOfAnswers()}} answers
                    </span>
                </div>
            </div>
        @endforeach

    </div>
@endsection
