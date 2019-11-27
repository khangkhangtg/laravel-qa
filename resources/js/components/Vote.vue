<template>
    <div>
        <a :title="title('up')" :class="classes" @click.prevent="voteUp()">
            <i class="fas fa-caret-up fa-3x"></i>
        </a>

        <span class="votes-count"> {{ count }} </span>

        <a :title="title('down')" :class="classes" @click.prevent="voteDown()">
            <i class="fas fa-caret-down fa-3x"></i>
        </a>
    </div>
</template>

<script>
export default {
    props: ['model', 'name'],

    data() {
        return {
            id: this.model.id,
            count: this.model.votes_count,
        }
    },

    computed: {
        classes () {
            return [! this.signedIn ? 'off':''];
        },

        endpoint () {
            return `/${this.name}s/${this.id}/vote`;
        }
    },

    methods: {
        title (typeVote) {
            let titles = {
                up: `This ${this.name} is useful`,
                down: 'This ' + this.name + ' is not useful',
            };

            return titles[typeVote];
        },

        voteUp () {
            // console.log('vote up');
            return this._vote(1);
        },

        voteDown () {
            // console.log('vote down');
            return this._vote(-1);
        },

        _vote (vote) {
            if (! this.signedIn) {
                this.$toast.warning(`Please login to vote this ${this.name}`, 'Warning', {
                    timeout: 3000,
                    position: 'bottomLeft',
                    progressBar: false,
                });
                return;
            }
            axios.post(this.endpoint, {vote})
                .then(res => {
                    this.$toast.success(res.data.message, 'Success', {
                        timeout: 3000,
                        position: 'bottomLeft',
                        progressBar: false,
                    })

                    this.count = res.data.votes_count;
                });
        },
    }
}
</script>
