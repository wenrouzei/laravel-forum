<template>
    <button class="btn btn-default"
            v-bind:class="{'btn-success': liked}"
            v-text="text"
            v-on:click="follow"
    >
    </button>
</template>

<script>
    export default {
        props:['like','user'],
        mounted() {
            this.$http.post('/api/liked',{'like':this.like,'user':this.user}).then(response=>{
                this.liked = response.data.liked
            })
        },
        data() {
            return {
                liked: false
            }
        },
        computed: {
            text(){
                return this.liked ? '已赞' : '点赞'
            }
        },
        methods: {
            follow(){
                this.$http.post('/api/like',{'like':this.like,'user':this.user}).then(response=>{
                    this.liked = response.data.liked
                })
            }
        }
    }
</script>
