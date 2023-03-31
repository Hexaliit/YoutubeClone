<template>
    <div>
        <video ref="videoPlayer" class="video-js"></video>
    </div>
</template>

<script>
    import videojs from 'video.js'
    export default {
        name: "VideoPlayer",
        props: {
            options:{
                type: Object,
                default() {
                    return {};
                }
            }
        },
        data() {
            return {
                player:null ,
            }
        },
        mounted() {
            /*console.log(this.options.videoId)*/
            this.player = videojs(this.$refs.videoPlayer , this.options , () => {
                this.player.log('onPlayerReady' , this);
                /*console.log(this.player.currentTime());*/
                let viewLogged = false
                let viewCounter = this.options.videoId
                this.player.on('timeupdate' , function () {
                    let percentagePlayed = Math.ceil(this.currentTime() / this.duration() * 100)
                    if(percentagePlayed > 10 && !viewLogged){
                        axios.put(`/api/videos/${viewCounter}`)
                            .then()
                            .catch(err => {
                                console.log(err)
                            })
                        viewLogged = true
                    }
                })
            });


        },
        beforeDestroy() {
            if (this.player) {
                this.player.dispose();
            }
        }
    }
</script>

<style scoped>
    @import url('~video.js');
    #vjs_video_3 {
        width : 100%;
    }
</style>
