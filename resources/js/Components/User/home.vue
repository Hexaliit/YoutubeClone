<template>
    <user-header></user-header>
    <div style="margin: 20px 0 0 20px">
        <div>
            <div style="padding: 20px;background: #6b7280;width: 250px">Welcome to Home Page</div>
            <div style="padding: 20px;background: #a0aec0;width: 250px">You are loggedin as <p>{{ this.$store.state.user.name }}</p></div>
        </div>
    </div>
</template>

<script>
    import userHeader from "./userHeader";
    export default {
        name: "home",
        components : {
            userHeader
        },
    }
</script>

<style scoped>

</style>
