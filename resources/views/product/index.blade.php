@extends('template')

@section('content')
    <div class="container"> 
        <h1>Recent Questions</h1>
        <hr/>

        @foreach($questions as $question)
            <div class="card">
                <h3>{{ $question->title }}</h3>
                <p>
                    {{ $question->description }}
                </p>
                <div><a href="{{ route('questions.show', $question->id) }}" class="btn btn-primary btn-small">Show answers</a></div>
            </div>
        @endforeach

        {{ $questions->links() }}
    </div>
@endsection