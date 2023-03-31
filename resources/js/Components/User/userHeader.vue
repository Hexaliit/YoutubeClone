<template>
    <div style="background: #a0aec0;
    margin-right: auto;
    margin-top: 20px ;margin-left : auto;  display:flex;justify-content: space-between;
    padding: 15px"
    v-if="this.user.name">
        <div>{{user.email}}</div>
        <div style="display: flex;justify-items: flex-end">
            <a href="#" @click="goToChannel" style="padding: 0 10px">MyChannel</a>
            <a href="#" style="padding: 0 10px" @click="logout">Log Out</a>
        </div>
    </div>
</template>

<script>
    export default {
        name: "userHeader",
        data : function() {
            return {
                user: {},
            }
        },
        mounted() {
            const token = 'Bearer '.concat(localStorage.getItem('token'))
            axios.get('/api/user',{headers : {Authorization : token}})
                .then(response => {
                    this.user = response.data;
                    // in this line we use Vuex to set user as a state
                    this.$store.commit("setUser" , this.user)
                    /*console.log(this.$store.state.user.channel.name)*/
                })
                .catch(error => {
                    console.log('ERROR::::'+error)
                })
        },
        methods : {
            logout : function () {
                localStorage.removeItem('token');
                this.$router.push('/');
            },
            userCheck() {
                if (localStorage.getItem('token')) {
                    return true
                } else {
                    return false
                }
            },
            goToChannel : function () {
/*                console.log(localStorage.getItem('token'));
                console.log(`/channels/${this.$store.state.user.channel.id}`);*/

                this.$router.push({ name: 'channel', params: { id: this.user.channel.id } })

                /*this.$router.push(`/channels/${this.$store.state.user.channel.id}`)*/
            }
        },
    }
</script>

<style scoped>

</style>
