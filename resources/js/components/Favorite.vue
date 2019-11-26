<template>
    <a title="Click to mark as favorite question (Click again to undo)" :class="classes" @click.prevent="toggle">
        <i class="fas fa-star fa-2x"></i>
        <span class="favorites-count">{{ favoritesCount }}</span>
    </a>
</template>

<script>

export default {
    props: ['question'],

    data () {
        return {
            isFavorited: this.question.is_favorited,
            id: this.question.id,
            favoritesCount: this.question.favorites_count,
        };
    },

    computed: {
        classes () {
            return [
                'favorite',
                ! this.signedIn ? 'off' : (this.isFavorited ? 'favorited' : ''),
            ];
        },

        endpoint () {
            return `/questions/${this.id}/favorite`;
        },
    },

    methods: {
        toggle () {
            if (! this.signedIn) {
                this.$toast.warning('Please login to favorite this question.', 'Warning', {
                    timeout: 3000,
                    position: 'bottomLeft',
                    progressBar: false,
                });

                return;
            }
            this.isFavorited ? this.destroy() : this.create();
        },

        destroy () {
            axios.delete(this.endpoint)
                .then(res => {
                    this.isFavorited = false;
                    this.favoritesCount--;
                });
        },

        create () {
            axios.post(this.endpoint)
                .then(res => {
                    this.isFavorited = true;
                    this.favoritesCount++;
                });
        }
    }
}
</script>
