<template>
    <user-header></user-header>
    <div style="background-color: #e2e2e2;padding-bottom: 500px">
        <div style="margin: auto;width: 50% ; padding: 10px;background-color: white;">
            <div v-if="!selected">
                <div style="margin: auto;width: 50%">
                    <svg onclick="document.getElementById('video-files').click()" style="width: 100%;height: 50px" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-play" viewBox="0 0 16 16"> <path d="M10.804 8 5 4.633v6.734L10.804 8zm.792-.696a.802.802 0 0 1 0 1.392l-6.363 3.692C4.713 12.69 4 12.345 4 11.692V4.308c0-.653.713-.998 1.233-.696l6.363 3.692z"/> </svg>
                    <input multiple style="display: none" @change="videoUpload" type="file" ref="videos" id="video-files">
                    <h3 style="text-align:center">Upload Videos</h3>
                </div>
            </div>
            <div v-else>
                <div v-for="video in videos" style="margin-top: 20px">
                    <div style="height:24px;width:100%;background-color: #e2e2e2">
                        <div :style="{'width' : `${video.percentage || progress[video.name]} %`,'height' : '24px','background-color' : 'green'}">
                            {{video.percentage ? video.percentage === 100 ? 'Video Proccesing Completed' : 'Proccesing' : 'Uploading'}}
                        </div>
                    </div>
                    <div style="display: flex;justify-content: space-between">
                        <div>
                            <div v-if="!video.thumbnail" style="background-color: #2d3748;padding: 20px;color:white;margin-top: 10px">
                                Loading Thumbnail ...
                            </div>
                            <img v-else style="width:100%" :src="video.thumbnail" alt="">
                        </div>
                        <div>
                            <a v-if="video.percentage && video.percentage === 100" target="_blank"  :href="`/videos/${video.id}`">
                                {{video.title}}
                            </a>
                            <h4>
                                {{video.title ||  video.name}}
                            </h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import userHeader from "../User/userHeader";
    export default {
        name: "upload",
        components : {
            userHeader
        },
        data : function () {
            return {
                selected : false,
                videos : [],
                progress:{},
                uploads:[] ,
                intervals : {}
            }
        },
        mounted(){
            /*console.log(this.$route.params.channel)*/
        },
        methods: {
            videoUpload(){
                this.selected = true
                this.videos = Array.from(this.$refs.videos.files)
                const uploaders = this.videos.map(video => {
                    const form = new FormData()
                    this.progress[video.name] = 0
                    form.append('video',video)
                    form.append('title',video.name)
                    return axios.post(`/api/channels/${this.$route.params.channel}/videos`,form,{
                        onUploadProgress: (event) => {
                            this.progress[video.name] = Math.ceil((event.loaded / event.total) * 100 )
                            this.$forceUpdate()
                        }
                    }).then(({ data }) => {
                        this.uploads = [
                            ...this.uploads,
                            data
                        ]
                    })
                        .catch(error => {
                            console.log("ERROR::..  "+error)
                        })

                })

                axios.all(uploaders)
                    .then(() => {
                        this.videos = this.uploads


                        this.videos.forEach(video => {
                            this.intervals[video.id] = setInterval(() => {
                                axios.get(`/api/videos/${video.id}`).then(({data}) => {
                                    if(data.percentage === 100) {
                                        clearInterval(this.intervals[video.id])
                                    }
                                    this.videos = this.videos.map(v => {
                                        if(v.id === data.id) {
                                            return data
                                        }


                                        return v
                                    })
                                    }

                                )
                            },3000)
                        })
                    })
            },
        },
    }
</script>

<style scoped>

</style>
