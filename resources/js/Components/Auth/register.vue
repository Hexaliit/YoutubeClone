<template>
    <div>
        <form @submit.prevent="register">
            <input type="text" placeholder="Enter your name" v-model="form.name">
            <br>
            <input type="email" placeholder="E-mail" v-model="form.email">
            <br>
            <input type="password" placeholder="Enter your password" v-model="form.password">
            <br>
            <input type="password" placeholder="Confirm your password" v-model="form.c_password">
            <br>
            <div v-if="errors">{{errors}}</div>
            <input type="submit" value="register">
        </form>
    </div>
</template>

<script>
    export default {
        name: "register",
        data: function () {
            return {
                form : {
                    'name' : '',
                    'email' : '',
                    'password' : '',
                    'c_password' : '',
                },
                errors : null,
            }
        },
        methods : {
            register : function () {
                axios.post('/api/register' , this.form)
                    .then(response => {
                        if (response.data.success) {
                            localStorage.setItem('token' , response.data.data.token);
                            this.$router.push('/home');
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
