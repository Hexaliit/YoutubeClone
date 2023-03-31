<template>
    <button class="btn-danger" @click="this.toggleSubscription">
        {{ this.owner ? '' : this.subscribed ? 'Unsubscribe' : 'Subscribe' }} {{this.subscriptions.length }} {{this.owner ? 'Subscribtions' : ''}}
    </button>
</template>

<script>
    export default {
        name: "subscribeButton",
        props : {
            initialSubscriptions : {
                type : Array,
                required : true,
                default: () => []
            },
            channel : {
                type : Object,
                required : true,
                default: () => ({})
            },
        },
        data: function() {
            return {
                subscriptions : []
            }
        },
        methods: {
            toggleSubscription(){
                if (!localStorage.getItem('token')){
                    return  alert("Please Log In")
                }
                if(this.owner){
                    return alert("You Can not Log in")
                }

                if(this.subscribed){
                        axios.delete('/api/channels/'+this.channel.id+'/subscriptions/'+this.subscription.id)
                            .then(() => {
                                this.subscriptions = this.subscriptions.filter(s => s.id !== this.subscription.id)
                                /*this.$router.go();*/
                                this.$emit('reloadServer')
                            })
                        .catch(error => {
                            console.log("ERROR :::: "+error)
                        })
                } else {
                    axios.post(`/api/channels/${this.channel.id}/subscriptions`, this.$store.state.user)
                        .then(response => {
                            this.subscriptions = [
                                ...this.subscriptions,
                                response.data
                            ]
                            this.$emit('reloadServer')
                            /*this.$router.go();*/

                        })
                }
            },
        },
        mounted(){
            this.subscriptions = this.initialSubscriptions;
        },
        computed : {
            subscribed() {
                if (! localStorage.getItem('token') || this.channel.user_id === this.$store.state.user.id) return false
                return !!this.subscriptions.find(subscription => subscription.user_id === this.$store.state.user.id)
            } ,
            subscription() {
                if (! localStorage.getItem('token')) return null
                return this.subscriptions.find(subscription => subscription.user_id === this.$store.state.user.id)
            },
            owner() {
                if (localStorage.getItem('token') && this.channel.user_id === this.$store.state.user.id) return true
                return false
            }
        },
        updated() {

        },
    }
</script>

<style scoped>
.btn-danger{
    background-color: red;
    color: white;
    padding: 5px 10px;
    margin: 0 15px
}
.btn-danger:hover {
    cursor: pointer;
}
</style>
