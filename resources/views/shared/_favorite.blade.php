<a title="Click to mark as favorite question (Click again to undo)" class="favorite {{ Auth::guest() ? 'off' : ($question->is_favorited ? 'favorited' : '') }}" onclick="event.preventDefault(); document.getElementById('favorite-question-{{ $question->id }}').submit()">
    <i class="fas fa-star fa-2x"></i>
    <span class="favorites-count">{{ $question->favorites_count }}</span>
</a>

<form action="/questions/{{ $question->id }}/favorite" method="post" id="favorite-question-{{ $question->id }}">
    @csrf
    @if (Auth::check() && $question->is_favorited)
        @method('DELETE')
    @endif
</form>