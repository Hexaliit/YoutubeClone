<template>
    <div>
        <user-header></user-header>
        <!---->
        <div style="background: #e2e2e2;padding-bottom: 300px;display: flex;justify-content: center">
            <div class="channel-desc">
                <div style="display: flex;justify-content: center;padding: 15px;"><img :src="ourImage(this.channel.image)" alt="No Picture" style="width: 150px;height: 150px;border-radius: 5%;box-shadow: 1px 1px 1px #eaeaea;"></div>
                <h4 style="padding: 10px 5px;text-align: center">{{this.channel.name}}</h4>
                <p style="padding: 0 25px">{{this.channel.description}}</p>
                <div style="display:flex;justify-content: center;">
                    <subscribe-button @reloadServer="this.getChannel" :channel="this.channel" :initial-subscriptions="this.subscriptions"></subscribe-button>
                </div>
                <div style="padding: 0 25px" v-if="this.checkUser() === true">
                    <form enctype="multipart/form-data">
                        <label for="name"> Channel Name<br>
                            <input class="channel-input" type="text" id="name" v-model="this.channel.name"><br>
                        </label><br>
                        <label for="description"> Channel Description<br>
                            <textarea style="border: 1px solid #e2e2e2; margin: 10px 0" id="description" cols="100" rows="5" v-model="this.channel.description"></textarea><br>
                        </label><br>
                        <div style="display: flex;justify-content: center;align-items:center">
                            <div>
                                <img class="channel-avatar" :src="ourImage(this.channel.image)" alt="not found">
                            </div>
                            <div style="margin:10px">
                                <strong>Image : </strong>
                                <input type="file" @change="selectFile">
                            </div>
                        </div>
                        <div style="display: flex;justify-content: center">
                            <button style="margin:10px;color:white;padding: 10px;background: plum" @click.prevent="updateChannel">Update Channel</button>
                            <button style="margin:10px;color:white;padding: 10px;background: palevioletred" @click.prevent="this.goToUpload">Upload Videos</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="channel-video">
                <div>
                    <h4 style="text-align: center;border-bottom: 1px solid #e2e2e2;margin: 0;padding: 15px 0;">
                        Videos for this channel
                    </h4>
                </div>
                <div v-if="this.videos.length === 0" style="text-align: center;margin:15px">
                    No Videos For This Channel Yet
                </div>
                <div v-else  v-for="video in this.videos" :key="video.id" style="display: flex;justify-content: flex-start;padding: 5px 0;align-items:center">
                    <div style="padding: 5px;">
                        <img :src="video.thumbnail" alt="No Picture" style="width: 100px;height: 100px;border-radius: 5%;box-shadow: 1px 1px 1px #eaeaea;">
                    </div>
                    <div style="margin: 10px">
                        <a target="_blank" :href="`/videos/${video.id}`" style="margin: 5px">{{video.title}}</a>
                        <p style="margin: 5px">{{this.channel.name}}</p>
                        <small v-if="video.percentage === 100" style="display: flex;justify-content: flex-start;align-items:center">
                            <svg style="color: rgb(0, 219, 4);" xmlns="http://www.w3.org/2000/svg" width="10" height="10" fill="currentColor" class="bi bi-circle-fill" viewBox="0 0 16 16"> <circle cx="8" cy="8" r="8"></circle> </svg>
                            <p style="margin:0 2px">Live</p>
                        </small>
                        <small v-else style="display: flex;justify-content: flex-start;align-items:center">
                            <svg style="color: red;" xmlns="http://www.w3.org/2000/svg" width="10" height="10" fill="currentColor" class="bi bi-circle-fill" viewBox="0 0 16 16"> <circle cx="8" cy="8" r="8"></circle> </svg>
                            <p style="margin:0 2px">processing</p>
                        </small>
                        <div style="display: flex;justify-content: flex-start">
                            <small style="margin:5px">{{video.views}} Views</small>
                            <small style="margin:5px">{{this.formatDate(video.created_at)}}</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import userHeader from "./userHeader";
    import subscribeButton from "../Layouts/subscribeButton";
    var moment = require('moment');
    export default {
        name: "userChannel",
        components : {
            userHeader ,
            subscribeButton
        },
        data : function() {
            return {
                channel : {},
                subscriptions : [],
                videos : [],
                channel_id : this.$route.params.id,
                isLoged : true,
                photo: null,
                form : {
                    name : '',
                    description : '',
                    image : '',
                    id : '',
                    user_id : ''
                }
            }
        },
        methods : {
            formatDate(data){
                return moment(data).fromNow()
            },
            ourImage(image) {
                if (image){
                    return `/storage/photos/${image}`;
                } else {
                    return '/storage/photos/no-image.jpg'
                }
            },
            checkUser () {
/*                console.log("USER_ID IS "+this.$store.state.user.id)
                console.log("CHANNEL'S USER_ID IS "+this.form.user_id)*/
                if (localStorage.getItem('token') && this.$store.state.user.id === this.channel.user_id){
                    this.isLoged = true;
                    return true;
                } else {
                    this.isLoged = false;
                    return false;
                }
            },
            goToUpload(){
                return this.$router.push({ name: 'uploadVideos', params: { channel: this.channel.id } })
            },
            getChannel(){
                axios.get(`/api/channels/${this.channel_id}`)
                    .then(response => {
                        this.channel = response.data.channel
                        this.subscriptions = this.channel.subscriptions
                        this.videos = response.data.videos
                        console.log(response.data)
/*                        console.log(this.channel.user_id)
                        console.log(this.$store.state.user.channel.user_id)*/
                    })
                    .catch(error => {
                        console.log(error)
                        return
                    })
            },
            updateChannel(){
                if (this.checkUser()){
                    const config = {
                        headers : {
                            'content-type': 'multipart/form-data',

                        }
                    };
                    const data = new FormData;
                    data.append('name' , this.channel.name)
                    data.append('description' , this.channel.description)
                    data.append('image' , this.photo)
                    data.append('id' , this.channel.id)
                    data.append('user_id' , this.channel.user_id)
                    axios.post(`/api/update_channel/${this.channel_id}` , data , config)
                        .then(response => {
                            this.getChannel();
                        })
                        .catch(error => {
                            console.log(error)
                            alert("Failed")
                        })
                } else {
                    this.$router.push('/register');
                }

            },
            selectFile(event) {
                // `files` is always an array because the file input may be in multiple mode
                this.photo = event.target.files[0]
            }
        },
        mounted() {
            this.getChannel();
        },
    }
</script>

<style scoped>
.channel-avatar {
    margin-top: 5px;
    width: 200px;
    height: 150px;
    border: 1px solid #1a202c;
}
.channel-input{
        padding: 10px;
        width: 100%;
        border: 1px solid #e2e2e2;
        margin: 10px 0;
    }
.update-btn{
        background-color: green;
        color: white;
        padding: 7px;
        align-content: center;
        margin : 10px 0;
    }
.channel-desc {
    width: 70%;
    margin:20px;
    background : white;
    padding-bottom: 20px;
}
.channel-video {
    width: 30%;
    margin:20px;
    background : white;
    padding-bottom: 20px;
}
</style>
