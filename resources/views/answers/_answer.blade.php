<answer :answer='{{ $answer }}' inline-template>
    <div class="media post">
        <div class="d-flex flex-column vote-controls">
            {{-- @include('shared._vote', [
                'model' => $answer,
            ]) --}}

            <vote :model="{{ $answer }}" name="answer"></vote>
    
            {{-- @include('shared._accept', [
                'answer' => $answer,
            ]) --}}

        {{-- <favorite :question="{{ $answer }}"></favorite> --}}

            <accept :answer="{{ $answer }}"></accept>
        </div>
    
        <div class="media-body">
            <form v-if='editing' @submit.prevent="update">
                <div class="form-group">
                    <textarea rows="10" v-model="body" class="form-control" required></textarea>
                </div>
                <button class="btn btn-primary" :disabled="isInvalid">Update</button>
                <button class="btn btn-outline-secondary" @click='cancel' type="button">Cancel</button>
            </form>
            <div v-else>
                {{-- {!! $answer->bodyHTML !!} --}}
                <div v-html="bodyHtml"></div>
                <div class="row">
                    <div class="col-4">
                        <div class="ml-auto">
                            @can('update', $answer)
                                {{-- <a href=" {{ route('questions.answers.edit', [$question->id, $answer->id]) }} " class="btn btn-sm btn-outline-info">Edit</a>     --}}
                                <a @click.prevent='edit' class="btn btn-sm btn-outline-info">Edit</a>    
                            @endcan
        
                            @can('delete', $answer)
                                <button @click='destroy' class="btn btn-sm btn-outline-danger">Delete</button>
                            @endcan
                        </div>
                    </div>
                    <div class="col-4"></div>
                    <div class="col-4">
                        {{-- @include('shared._author', [
                            'label' => 'answer',
                            'model' => $answer,
                        ]) --}}
                        <user-info :model="{{ $answer }}" label="Answered"></user-info>
                    </div>
                </div>    
            </div>    
        </div>
    </div>
</answer>