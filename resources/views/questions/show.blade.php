@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        <div class="d-flex align-items-center">
                            <h1>{{ $question->title }}</h1>
                            <div class="ml-auto">
                                    <a href="{{ route('questions.index') }}" class="btn btn-outline-primary">Back to all questions</a>   
                            </div>
                        </div>
                    </div>

                    <hr>
    
                    <div class="media">
                        <div class="d-flex flex-column vote-controls">
                            <a title="This question is useful" class="vote-up">
                                <i class="fas fa-caret-up fa-3x"></i>
                            </a>
                            <span class="votes-count">13</span>
                            <a title="This question is not useful" class="vote-down off">
                                <i class="fas fa-caret-down fa-3x"></i>
                            </a>
                            <a title="Click to mark as favorite question (Click again to undo)" class="favorite {{ Auth::guest() ? 'off' : ($question->is_favorited ? 'favorited' : '') }}" class="favorite-question-{{ $question->id }}" onclick="event.preventDefault(); document.getElementById('favorite-question-{{ $question->id }}').submit()">
                                <i class="fas fa-star fa-2x"></i>
                                <span class="favorites-count">{{ $question->favorites_count }}</span>
                            </a>

                            <form action="/questions/{{ $question->id }}/favorite" method="post" id="favorite-question-{{ $question->id }}">
                                @csrf
                                @if (Auth::check() && $question->is_favorited)
                                    @method('DELETE')
                                @endif
                            </form>
                        </div>

                        <div class="media-body">
                            {!! $question->bodyHTML !!}
                            <div class="float-right">
                                <span class="text-muted">
                                    Asked {{ $question->created_date }}
                                </span>
                               
                                <div class="media mt-2">
                                    <a href="{{ $question->user->url }}" class="pr-2"><img src="{{ $question->user->avatar }}" alt="{{ $question->user->name }}"></a>
                                    
                                    <div class="media-body mt-1">
                                        <a href="{{ $question->user->url}}">{{ $question->user->name }}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('answers._index', [
        'answers' => $question->answers,
        'answersCount' => $question->answers_count
    ])

    @include('answers._create')
</div>
@endsection
