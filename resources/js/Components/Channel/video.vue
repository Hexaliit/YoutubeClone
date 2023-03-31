<template>
    <user-header></user-header>
    <div v-if="this.loading === true">
        <b>LOADING . . . </b>
    </div>
    <div style="background-color: #e2e2e2;padding-bottom: 500px"  v-else>
        <div style="margin: auto;width: 50% ; padding: 10px;background-color: white;">
<!--            <div v-if="this.loading === true">
                <b>LOADING . . . </b>
            </div>-->
            <div>
                <div style="margin: auto;width: 100%">
                    <!--<h3 style="text-align:center">{{this.video.title}}</h3>
                    <img :src="'/storage/thumbnails/bafe7c81-72fd-42f7-a9df-9813ce4191da.png'" alt="Can not proccess">
                    <div style="
                        display: flex;
                        justify-content: center;
                        padding: 10px;">
                        <img style="width: 100px;height: 100px" :src="this.video.thumbnail" alt="Can not proccess">
                    </div>-->
                    <div>
                        <video-player :options="videoOptions"></video-player>
                    </div>
                    <form enctype="multipart/form-data">
                    <div style="display:flex; padding:15px;justify-content: space-between; align-items:center;border-bottom: 1px solid #eaeaea;">
                        <div>
                            <input v-if="this.authentucatedUser()" style="display: block;border: 1px solid #eaeaea;padding: 10px 5px;font-size: 20px;" type="text" v-model="this.video.title">
                            <h4 v-else style="padding-left: 15px;">
                                {{this.video.title}}
                            </h4>
                            {{this.video.views}}  Views
                        </div>
                        <votes :default_votes="this.video.votes" :entity_id="this.video.id" :entity_owner="this.video.channel.user_id"></votes>
                    </div>
                    <div style="border-bottom: 1px solid #eaeaea;margin: 15px 0">
                        <textarea v-if="this.authentucatedUser()" style="border: 1px solid #e2e8f0;" v-model="this.video.description" name="description" cols="90" rows="10"></textarea>
                        <p style="padding: 5px 20px;" v-else>{{this.video.description}}</p>
                    </div>
                    <button v-if="this.authentucatedUser()" @click.prevent="this.updateVideo()" class="update-btn">Update Video</button>
                    </form>


                    <!-- channel detail -->
                    <div style="display:flex; padding:15px;justify-content: space-between; align-items:center;">
                        <div style="display:flex;justify-content:center;align-items:center">
                            <img :src="this.ourImage(this.video.channel.image)" alt="Picture" style="width: 50px;height: 50px;border-radius: 100%;margin-right:10px">
                            <div>
                                <h3 style="margin: 1px;">
                                    {{this.video.channel.name}}
                                </h3>
                                <span style="font-size: 12px;">
                                Published on {{this.convertDate(this.video.channel.created_at)}}
                            </span>
                            </div>
                        </div>
                        <div>
                            <subscribe-button @reloadServer="this.getSub" :channel="this.video.channel" :initial-subscriptions="this.subscriptions"></subscribe-button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div style="margin:20px"></div>
        <comments></comments>
    </div>
</template>

<script>
    import userHeader from "../User/userHeader";
    import VideoPlayer from "../Layouts/VideoPlayer";
    import subscribeButton from "../Layouts/subscribeButton";
    import votes from "./votes";
    import comments from "./comments";
    export default {
        name: "video",
        components:{userHeader , VideoPlayer , subscribeButton , votes , comments},
        methods: {
            authentucatedUser(){
                if(localStorage.getItem('token')  &&  this.video.channel.user_id === this.$store.state.user.id){
                    return true
                } else {
                    return false
                }
            },
            updateVideo(){
                const config = {
                    headers : {
                        'content-type': 'multipart/form-data',

                    }
                };
                const data = new FormData;
                data.append('title',this.video.title)
                data.append('description',this.video.description)
                axios.post(`/api/videos/${this.$route.params.video}/update` , data)
                    .then(response => {
                        this.getVideo();
                    })
                    .catch(err => {
                        console.log(err)
                    })
            },
            getVideo(){
                axios.get(`/api/videos/${this.$route.params.video}`)
                    .then(response => {
                        this.video = response.data.video
                        this.subscriptions = response.data.video.channel.subscriptions
                        this.loading = false
                    })
                    .catch(err => {
                        console.log("ERROR : : ."+err)
                        return
                    })
            },
            convertDate(date){
                let d = new Date(date);
                let ye = new Intl.DateTimeFormat('en', { year: 'numeric' }).format(d);
                let mo = new Intl.DateTimeFormat('en', { month: 'short' }).format(d);
                let da = new Intl.DateTimeFormat('en', { day: '2-digit' }).format(d);
                return `${da}-${mo}-${ye}`;
            },
            ourImage(image) {
                return `/storage/photos/${image}`;
            },
            getSub(){
                alert("UPDATED")
            },
        },
        data:function () {
            return {
                video : {},
                subscriptions:[],
                loading : true,
                videoOptions: {
                    videoId : this.$route.params.video,
                    autoplay: true,
                    controls: true,
                    sources: [
                        {
                            src: `http://127.0.0.1:8000/storage/videos/${this.$route.params.video}/${this.$route.params.video}.m3u8` ,
                            /*src: 'http://127.0.0.1:8000/storage/videos/bafe7c81-72fd-42f7-a9df-9813ce4191da/bafe7c81-72fd-42f7-a9df-9813ce4191da.m3u8' ,*/
                            type : 'application/x-mpegURL'
                        }
                    ]
                }
            }
        },
        mounted(){
            this.getVideo();
        }
    }
</script>

<style scoped>
.update-btn {
    color: white;
    background: #2f2bdf;
    font-weight: bold;
    border-radius: 5%;
    margin: 10px;
    padding: 10px
}
.update-btn:hover {
    cursor:pointer;
    background: #0069df ;
}
</style>




