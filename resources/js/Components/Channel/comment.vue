<template>
    <div  class="media" style="margin: 10px 25px;display: flex;justify-content: flex-start;">
        <!--<img  alt="Picture" style="width: 40px;height: 40px;border-radius: 100%;margin-right: 10px;margin-top: 15px;">-->
        <Avatar :size="50"
                variant="bauhaus"
                name="comment.user.name ? comment.user.name : 'Unkown User'"
                :colors="this.colors"></Avatar>
        <div class="media-body">
            <h4>{{comment.user.name ? comment.user.name : 'Unkown User'}}</h4>
            <small>{{comment.body}}</small>
            <!---->
            <div style="display:flex;justify-content:flex-start">
                <votes :default_votes="comment.votes" :entity_id="comment.id" :entity_owner="comment.user_id"></votes>
                <button @click="this.addingReply = !this.addingReply" style="font-size:10px;border:none;border-radius: 12%" :class="{ 'btn-default': !this.addingReply , 'btn-danger': this.addingReply }">
                    {{this.addingReply ? 'Cancel' : 'Add Reply'}}
                </button>
            </div>
            <div v-if="this.addingReply === true" style="display: flex;justify-content: center;margin: 15px;">
                <input v-model="this.body" type="text"  style="width: 80%;border: 1px solid #aeaeae;padding: 7px;margin-right: 7px;">
                <button @click.prevent="this.addReply()" style="background: blue;">
                    <small style="color:white">
                        Add Reply
                    </small>
                </button>
            </div>
            <replies ref="replies" :comment="comment"></replies>
        </div>

    </div>
</template>

<script>
    import Avatar from "vue-boring-avatars";
    import replies from "./replies";
    import votes from "./votes";
    export default {
        name: "comment",
        components : {
            Avatar ,
            replies ,
            votes ,
        },
        data() {
            return  {
                addingReply : false,
                body : '',
            }
        },
        methods : {
            addReply(){
                const data = new FormData
                data.append('body' , this.body)
                data.append('user_id' , this.$store.state.user.id)
                data.append('comment_id' , this.comment.id)
                axios.post(`/api/comments/${this.$route.params.video}` , data)
                    .then(response => {
                        this.body = ''
                        this.addingReply = false
                        this.$refs.replies.addReply(response.data)
                    })
            }
        },
        props : {
            comment : {
                required : true,
                default : () => ({})
            }
        }
    }
</script>

<style scoped>
.media-body {
    width: 100%;
}
.btn-default {
    box-shadow: 1px 1px 1px #a0aec0;
}
.btn-danger {
    background: red;
    color: white;
    box-shadow: 1px 1px 1px #a0aec0;
}
</style>
