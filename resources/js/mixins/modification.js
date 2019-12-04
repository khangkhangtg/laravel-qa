export default {
    data () {
        return {
            editing: false,
        }
    },

    methods: {
        edit () {
            this.setEditCache();
            this.editing = true;
        },

        cancel () {
            this.restoreFromCache();
            this.editing = false;
        },

        setEditCache () {},
        restoreFromCache () {},

        update () {
            axios.put(this.endpoint, this.payload())
            .then(res => {
                this.bodyHtml = res.data.bodyHtml;
                this.editing = false;
                this.$toast.success(res.data.message, 'Success', {timeout: 3000, position: 'topRight', progressBar: false,});
            })
            .catch(({response}) => {
                this.$toast.error(response.data.message, 'Error', {timeout: 3000, position: 'topRight', progressBar: false,});
            });
        },

        payload () {},
        
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
                        this.delete();
                        instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');
                    }, true],
                    ['<button>NO</button>', (instance, toast) => {
                        instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');
                    }],
                ],
            });
        },

        delete () {},
    }
}