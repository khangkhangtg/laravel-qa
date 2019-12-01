<template>
    <div class="media post">
        <div class="d-flex flex-column vote-controls">
            <vote :model="answer" name="answer"></vote>

            <accept :answer="answer"></accept>
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
                <div v-html="bodyHtml"></div>
                <div class="row">
                    <div class="col-4">
                        <div class="ml-auto">
                            <a v-if="authorize('modify', answer)" @click.prevent='edit' class="btn btn-sm btn-outline-info">Edit</a>    
                            <button v-if="authorize('modify', answer)" @click='destroy' class="btn btn-sm btn-outline-danger">Delete</button>
                        </div>
                    </div>
                    <div class="col-4"></div>
                    <div class="col-4">
                        <user-info :model="answer" label="Answered"></user-info>
                    </div>
                </div>    
            </div>    
        </div>
    </div>
</template>

<script>
import Accept from './Accept';

export default {
    props: ['answer'],

    data () {
        return {
            editing: false,
            body: this.answer.body,
            bodyHtml: this.answer.body_html,
            id: this.answer.id,
            questionId: this.answer.question_id,
            beforeEditCache: null,
        }
    },

    components: {Accept},

    methods: {
        edit () {
            this.beforeEditCache = this.body;
            this.editing = true;
        },

        cancel () {
            this.body = this.beforeEditCache;
            this.editing = false;
        },

        update () {
            axios.patch(this.endpoint, {
                body: this.body,
            })
            .then(res => {
                this.bodyHtml = res.data.bodyHtml;
                this.editing = false;
                // alert(res.data.message);
                this.$toast.success(res.data.message, 'Success', {timeout: 3000, position: 'topRight', progressBar: false,});
            })
            .catch(err => {
                // console.log('Something went wrong.');
                this.$toast.error('Something went wrong.', 'Error', {timeout: 3000, position: 'topRight', progressBar: false,});
            });
        },
        
        destroy () {
            this.$toast.question('Are you sure?', 'Confirm',{
                timeout: 20000,
                close: false,
                overlay: true,
                displayMode: 'once',
                zindex: 999,
                position: 'center',
                progressBar: false,
                buttons: [
                    ['<button><b>YES</b></button>', (instance, toast) => {
                        axios.delete(this.endpoint)
                            .then(res => {
                                this.$emit('deleted');
                        });
                        instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');
                    }, true],
                    ['<button>NO</button>', (instance, toast) => {
                        instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');
                    }],
                ],
            });
        },
    },

    computed: {
        isInvalid () {
            return this.body.length < 10;
        },
        endpoint () {
            return `/questions/${this.questionId}/answers/${this.id}`;
        }
    }
}
</script>