<template>
    <div v-if="commentLoaded === true" style="margin: auto;width: 50% ; padding: 10px;background-color: white;">
        <div v-if="this.authUser === true" style="display: flex;justify-content: center;margin-top: 15px;">
            <input type="text" v-model="this.newComment" style="width: 80%;border: 1px solid #aeaeae;padding: 7px;margin-right: 7px;">
            <button @click.prevent="this.addComment()" style="background: blue;">
                <small style="color:white">
                    Add Comment
                </small>
            </button>
        </div>
        <!---->
        <comment v-for="comment in this.comments.data" :key="comment.id" :comment="comment" />
        <div style="text-align: center">
            <button v-if="this.comments.next_page_url" @click="this.getComments()" class="load-more-btn">
                Load More
            </button>
            <span v-else>No more comments to show</span>
        </div>
    </div>
    <div v-else style="text-align: center">Loading Comments</div>
</template>




<script>
    import Avatar from "vue-boring-avatars";
    import votes from "./votes";
    import comment from "./comment";
    export default {
        name: "comments" ,
        mounted() {
            this.getComments()
        },
        computed : {
            authUser(){
                if(localStorage.getItem('token')){
                    return true
                } else {
                    return false
                }
            }
        },
        components: {
            Avatar,
            votes,
            comment,
        },
        data() {
            return {
                commentLoaded : false,
                comments : {
                    data : []
                },
                colors: ["#92A1C6", "#146A7C", "#F0AB3D", "#C271B4", "#C20D90"] ,
                newComment : '',
            }
        },
        methods : {
            addComment(){
                if(! this.newComment) return
                const data = new FormData;
                data.append('body',this.newComment)
                data.append('user_id',this.$store.state.user.id)
                axios.post(`/api/comments/${this.$route.params.video}` , data)
                    .then(response => {
                        this.comments = {
                            ...this.comments ,
                            data : [
                                response.data ,
                                ...this.comments.data
                            ]
                        }
                    })

            },
            getComments(){
                const url = this.comments.next_page_url ? this.comments.next_page_url : `/api/videos/${this.$route.params.video}/comments`
                axios.get(url)
                    .then( response => {
                        this.comments = {
                            ...response.data ,
                            data : [
                                ...this.comments.data ,
                                ...response.data.data
                            ]
                        }
                        this.commentLoaded = true
                    })
            }
        },

    }
</script>

<style scoped>
.load-more-btn {
    padding: 10px 15px;
    background: plum;
    color: #edf2f7
}
.load-more-btn:hover {
    cursor: pointer;
    background: #af46af;
}
</style>
