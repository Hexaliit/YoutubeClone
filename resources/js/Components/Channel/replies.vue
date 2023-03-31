<template>
    <div v-for="reply in replies.data" class="media-body-reply" style="padding: 10px 40px;display: flex;justify-content: flex-start">
        <div>
            <img  alt="Picture" style="width: 40px;height: 40px;border-radius: 100%;margin-right: 10px;margin-top: 15px;">
        </div>
        <div>
            <h4>{{reply.user.name}}</h4>
            <small>{{reply.body}}</small>
            <votes :default_votes="reply.votes" :entity_id="reply.id" :entity_owner="reply.user_id"></votes>
            <!--<div style="display: flex;justify-content: center;margin-top: 15px;">
                <input type="text" style="width: 80%;border: 1px solid #aeaeae;padding: 7px;margin-right: 7px;">
                <button style="background: blue;">
                    <small style="color:white">
                        Add Comment
                    </small>
                </button>
            </div>-->
        </div>
    </div>
    <button v-if="comment.repliesCount > 0 && this.replies.next_page_url" @click="this.getReplies()" class="load-replies-btn">
        Load Replies
    </button>
</template>

<script>
    import Avatar from "vue-boring-avatars";
    import votes from "./votes";
    export default {
        name: "replies",
        components: {
            Avatar,
            votes,
        },
        props : ['comment'],
        data() {
            return {
                replies:{
                    data:[],
                    next_page_url : `/api/comments/${this.comment.id}/replies`
                }
            }
        },
        mounted(){
            /*console.log(this.comment)*/
        },
        methods : {
            getReplies(){
                axios.get(this.replies.next_page_url)
                    .then( response => {
                        this.replies = {
                            ...response.data ,
                            data : [
                                ...this.replies.data ,
                                ...response.data.data
                            ]
                        }
                    })
            },
            addReply(reply){
                this.replies = {
                    ...this.replies ,
                    data : [
                        reply,
                        ...this.replies.data
                    ]
                }
            }
        },
    }
</script>

<style scoped>
.load-replies-btn {
    padding: 4px 7px;
    background: plum;
    color: #edf2f7;
    font-size: 9px;
    text-align: center;
    display: block;
    margin: auto;
}
.load-replies-btn:hover {
    cursor: pointer;
    background: #af46af;
}
h4 {
    margin : 5px
}
</style>
