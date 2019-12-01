<template>
    <div>
        <a v-if="authorize('accept', answer)" title="Mark this answer as best answer" :class="classes" @click.prevent="create">
            <i class="fas fa-check fa-2x"></i>
        </a>

        <a v-if="accepted" title="The question owner accepted this answer as best answer" :class="classes" >
            <i class="fas fa-check fa-2x"></i>
        </a>

    </div>
</template>

<script>
import EventBus from '../event-bus.js';

export default {
    props: ['answer'],

    data () {
        return {
            isBest: this.answer.is_best,
            id: this.answer.id,
        };
    },

    computed: {
        canAccept () {
            return true;
        },

        accepted () {
            return ! this.canAccept && this.isBest;
        },

        classes () {
            return [this.isBest ? 'vote-accepted':''];
        }
    },

    created () {
        EventBus.$on('isAccepted', id => { // listen for a custom Event isAccepted
            this.isBest = (this.id === id);
        })
    },

    methods: {
        create () {
            axios.post(`/answers/${this.id}/accept`)
                .then(res => {
                    this.$toast.success(res.data.message, 'Success', {
                        timeout: 3000,
                        position:'bottomLeft',
                    });

                    this.isBest = true;

                    EventBus.$emit('isAccepted', this.id); // add Custom Event listener isAccepted
                });
        },
    },
}
</script>
