<template>
    <div>
        <form @submit.prevent="login">
            <input type="email" placeholder="Enter your e-mail" v-model="form.email">
            <br>
            <input type="password" placeholder="Enter your password" v-model="form.password">
            <br>
            <div v-if="errors">{{errors}}</div>
            <input type="submit" value="Login">
        </form>
    </div>
</template>

<script>
    export default {
        name: "login",
        data: function () {
            return {
                form : {
                    'email' : '',
                    'password' : '',
                },
                errors : null,
            }
        },
        methods : {
            login : function () {
                axios.post('/api/login' , this.form)
                    .then(response => {
                        if (response.data.success) {
                            localStorage.setItem('token' , response.data.data.token);
                            this.$router.push( { name:'home', params:{ auth : response.data.data.token} })
                        } else {
                            this.errors = response.data.message;
                        }
                    })
                    .catch(error => {
                    })
            }
        }
    }
</script>

<style scoped>

</style>
