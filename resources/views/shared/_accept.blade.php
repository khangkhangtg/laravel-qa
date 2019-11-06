@can('accept', $answer)
    <a title="Mark this answer as best answer" class="{{ $answer->status }}" onclick="event.preventDefault();document.getElementById('accept-answer-{{ $answer->id }}').submit()">
        <i class="fas fa-check fa-2x"></i>
    </a>

    <form action="{{ route('answers.accept', $answer->id) }}" method="post" id="accept-answer-{{ $answer->id }}" class="d-none">
        @csrf
    </form>
@else
    @if ($answer->is_best)
        <a title="The question owner accepted this answer as best answer" class="{{ $answer->status }}" >
            <i class="fas fa-check fa-2x"></i>
        </a>
    @endif
@endcan