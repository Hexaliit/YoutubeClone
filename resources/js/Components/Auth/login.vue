<template>
    <div>
        <div style="display: flex;justify-content: center;align-items: center;border: 1px solid #e2e2e2;padding: 100px">
            <form style="padding: 30px;border: 1px solid #aeae" @submit.prevent="login">
                <label for="userName">User Name</label>
                <input style="padding:15px ; margin : 15px;border:1px solid #e2e2e2" id="userName" type="email" placeholder="Enter your e-mail" v-model="form.email">
                <br>
                <label for="password">Password</label>
                <input style="padding:15px ; margin : 15px;border:1px solid #e2e2e2" id="password" type="password" placeholder="Enter your password" v-model="form.password">
                <br>
                <div v-if="errors">{{errors}}</div>
                <div style="display:flex;justify-content:center">
                    <input style="margin-top:20px;padding: 10px;background: green;color: white;" type="submit" value="Login">
                </div>
            </form>
        </div>
        <div v-if="this.errors">
            <p>{{this.errors}}</p>
        </div>
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
                        console.log(response.data)
                        localStorage.setItem('token' , response.data.token);
                        this.$router.push('/')
                    })
                    .catch(error => {
                        this.errors = 'Invalid Username or Password'
                        return
                    })
            }
        }
    }
</script>

<style scoped>

</style>
