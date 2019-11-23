<script>
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
                                $(this.$el).fadeOut(500, () => {
                                    this.$toast.success(res.data.message, 'Success', {timeout: 3000, position: 'topRight', progressBar: false,});
                                    
                                });
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