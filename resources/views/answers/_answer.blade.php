<div class="media post">
    <div class="d-flex flex-column vote-controls">
        @include('shared._vote', [
            'model' => $answer,
        ])

        @include('shared._accept', [
            'answer' => $answer,
        ])
    </div>

    <div class="media-body">
        {!! $answer->bodyHTML !!}
        <div class="row">
            <div class="col-4">
                <div class="ml-auto">
                    @can('update', $answer)
                        <a href=" {{ route('questions.answers.edit', [$question->id, $answer->id]) }} " class="btn btn-sm btn-outline-info">Edit</a>    
                    @endcan

                    @can('delete', $answer)
                        <form class="d-inline-flex" method="post" action=" {{ route('questions.answers.destroy', [$question->id, $answer->id]) }} ">
                            @csrf
                            @method('DELETE')

                            <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    @endcan
                </div>
            </div>
            <div class="col-4"></div>
            <div class="col-4">
                @include('shared._author', [
                    'label' => 'answer',
                    'model' => $answer,
                ])
            </div>
        </div>

    </div>
</div>