<template>
    <div>
        <form action="">
            <button @click.prevent="addVote(1)"
                    :class="currentVote == 1 ? 'btn-primary' : 'btn-default'"
                    :disable="voteInProgress"
                    class="btn btn-default"> +1</button>
            Puntuación actual: <strong class="current-score">{{ currentScore }}</strong>
            <button @click.prevent="addVote(-1)"
                    :class="currentVote == -1 ? 'btn-primary' : 'btn-default'"
                    :disable="voteInProgress"
                    class="btn btn-default"> -1</button>
        </form>
    </div>
</template>

<script>
    export default {

        props: ['score', 'vote', 'id', 'module'],

        data() {
            return {
                currentVote : this.vote ? parseInt(this.vote) : null,
                currentScore : parseInt(this.score),
                voteInProgress: false,
            }
        },

        methods: {
            addVote( amount ) {
                this.voteInProgress = true;
                if (this.currentVote == amount ) {
                    this.processRequest( 'delete', 'vote');

                    this.currentVote = null;
                }else {
                    this.processRequest('post' , ( amount == 1 ? 'upvote' :'downvote'));

                    this.currentVote = amount;
                }
            },
            processRequest( method , action ) {
                axios[method](this.buildUrl(action)).then( response => {
                    this.currentScore = response.data.new_score;

                    this.voteInProgress = false;
                }).catch( (thrown) => {
                    alert('Wuoops! Ocurrió un error!');
                    this.voteInProgress = false;
                });
            },
            buildUrl(action) {
                return '/'+ this.module +'/' + this.id + '/' + action;
            }
        }
    }
</script>