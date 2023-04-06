<template>
    <div>
        <a href="#" style="padding: 0 10px" @click="logout">Log Out</a>
        <div>
            <div style="display: flex;justify-content: center;align-items: center">
                <div style="display: flex;align-items: center;width:30%;justify-content:center">
                    <svg style="color: red" xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="currentColor" class="bi bi-youtube" viewBox="0 0 16 16"> <path d="M8.051 1.999h.089c.822.003 4.987.033 6.11.335a2.01 2.01 0 0 1 1.415 1.42c.101.38.172.883.22 1.402l.01.104.022.26.008.104c.065.914.073 1.77.074 1.957v.075c-.001.194-.01 1.108-.082 2.06l-.008.105-.009.104c-.05.572-.124 1.14-.235 1.558a2.007 2.007 0 0 1-1.415 1.42c-1.16.312-5.569.334-6.18.335h-.142c-.309 0-1.587-.006-2.927-.052l-.17-.006-.087-.004-.171-.007-.171-.007c-1.11-.049-2.167-.128-2.654-.26a2.007 2.007 0 0 1-1.415-1.419c-.111-.417-.185-.986-.235-1.558L.09 9.82l-.008-.104A31.4 31.4 0 0 1 0 7.68v-.123c.002-.215.01-.958.064-1.778l.007-.103.003-.052.008-.104.022-.26.01-.104c.048-.519.119-1.023.22-1.402a2.007 2.007 0 0 1 1.415-1.42c.487-.13 1.544-.21 2.654-.26l.17-.007.172-.006.086-.003.171-.007A99.788 99.788 0 0 1 7.858 2h.193zM6.4 5.209v4.818l4.157-2.408L6.4 5.209z" fill="red"></path> </svg>
                    <div>
                        <p style="font-weight: bold;font-size:25px">YouTube</p>
                    </div>
                </div>
                <div style="display:flex;justify-content:center;width:40%">
                    <input placeholder="Search" style="border: 1px solid #e2e2e2;border-radius: 10%;padding: 15px;width: 85%;" type="text">
                    <button>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16"> <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/> </svg>
                    </button>
                </div>
                <div style="width:30%;display:flex;justify-content:flex-end">
                    <svg style="padding: 0 10px" width="75" height="40" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"> <circle cx="9" cy="7" r="3" stroke="#333333" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/> <path d="M11 13H7C4.79086 13 3 14.7909 3 17C3 18.6569 4.34315 20 6 20H12C13.6569 20 15 18.6569 15 17C15 14.7909 13.2091 13 11 13Z" stroke="#333333" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/> <path d="M21 8L18 11L16.5 9.5" stroke="#333333" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/> </svg>
                    <svg style="padding: 0 10px" width="75" height="40" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"> <circle cx="9" cy="7" r="3" stroke="#333333" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/> <path d="M11 13H7C4.79086 13 3 14.7909 3 17C3 18.6569 4.34315 20 6 20H12C13.6569 20 15 18.6569 15 17C15 14.7909 13.2091 13 11 13Z" stroke="#333333" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/> <path d="M21 8L18 11L16.5 9.5" stroke="#333333" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/> </svg>
                    <svg style="padding: 0 10px" width="75" height="40" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"> <circle cx="9" cy="7" r="3" stroke="#333333" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/> <path d="M11 13H7C4.79086 13 3 14.7909 3 17C3 18.6569 4.34315 20 6 20H12C13.6569 20 15 18.6569 15 17C15 14.7909 13.2091 13 11 13Z" stroke="#333333" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/> <path d="M21 8L18 11L16.5 9.5" stroke="#333333" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/> </svg>
                </div>
            </div>
            <div style="display:flex;justify-content:center">
                <div style="width:20%">A</div>
                <div style="width:80%">
                    <div style="display: flex;justify-content:flex-start">
                        <a style="padding: 5px 10px;margin: 0 3px;background: #aeaeae;border: 1px solid #e2e2e2;border-radius: 14%" href="#">JavaScript</a>
                        <a style="padding: 5px 10px;margin: 0 3px;background: #aeaeae;border: 1px solid #e2e2e2;border-radius: 14%" href="#">JavaScript</a>
                        <a style="padding: 5px 10px;margin: 0 3px;background: #aeaeae;border: 1px solid #e2e2e2;border-radius: 14%" href="#">JavaScript</a>
                        <a style="padding: 5px 10px;margin: 0 3px;background: #aeaeae;border: 1px solid #e2e2e2;border-radius: 14%" href="#">JavaScript</a>
                        <a style="padding: 5px 10px;margin: 0 3px;background: #aeaeae;border: 1px solid #e2e2e2;border-radius: 14%" href="#">JavaScript</a>
                        <a style="padding: 5px 10px;margin: 0 3px;background: #aeaeae;border: 1px solid #e2e2e2;border-radius: 14%" href="#">JavaScript</a>
                        <a style="padding: 5px 10px;margin: 0 3px;background: #aeaeae;border: 1px solid #e2e2e2;border-radius: 14%" href="#">JavaScript</a>
                        <a style="padding: 5px 10px;margin: 0 3px;background: #aeaeae;border: 1px solid #e2e2e2;border-radius: 14%" href="#">JavaScript</a>
                        <a style="padding: 5px 10px;margin: 0 3px;background: #aeaeae;border: 1px solid #e2e2e2;border-radius: 14%" href="#">JavaScript</a>
                        <a style="padding: 5px 10px;margin: 0 3px;background: #aeaeae;border: 1px solid #e2e2e2;border-radius: 14%" href="#">JavaScript</a>
                        <a style="padding: 5px 10px;margin: 0 3px;background: #aeaeae;border: 1px solid #e2e2e2;border-radius: 14%" href="#">JavaScript</a>
                        <a style="padding: 5px 10px;margin: 0 3px;background: #aeaeae;border: 1px solid #e2e2e2;border-radius: 14%" href="#">JavaScript</a>
                    </div>
                    <div style="display:flex;justify-content:center;padding:15px 0">
                        <div>
                            <div style="padding: 5px;">
                                <img :src="'/storage/photos/no-image.jpg'" alt="No Picture" style="width: 350px;height: 300px;border-radius: 5%;box-shadow: 1px 1px 1px #eaeaea;">
                            </div>
                            <div style="display: flex;justify-content: flex-start">
                                <img :src="'/storage/photos/no-image.jpg'" alt="" style="width: 50px;height: 50px;border-radius: 100%">
                                <div style="margin: 10px">
                                    <a target="_blank" href="#" style="margin: 5px">Video Title</a>
                                    <p style="margin: 5px">Channel Name</p>
                                    <div style="display: flex;justify-content: flex-start">
                                        <small style="margin:5px">821 Views</small>
                                        <small style="margin:5px">2 days ago</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div>
                            <div style="padding: 5px;">
                                <img :src="'/storage/photos/no-image.jpg'" alt="No Picture" style="width: 350px;height: 300px;border-radius: 5%;box-shadow: 1px 1px 1px #eaeaea;">
                            </div>
                            <div style="margin: 10px">
                                <a target="_blank" href="#" style="margin: 5px">Video Title</a>
                                <p style="margin: 5px">Channel Name</p>
                                <div style="display: flex;justify-content: flex-start">
                                    <small style="margin:5px">821 Views</small>
                                    <small style="margin:5px">2 days ago</small>
                                </div>
                            </div>
                        </div>
                        <div>
                            <div style="padding: 5px;">
                                <img :src="'/storage/photos/no-image.jpg'" alt="No Picture" style="width: 350px;height: 300px;border-radius: 5%;box-shadow: 1px 1px 1px #eaeaea;">
                            </div>
                            <div style="margin: 10px">
                                <a target="_blank" href="#" style="margin: 5px">Video Title</a>
                                <p style="margin: 5px">Channel Name</p>
                                <div style="display: flex;justify-content: flex-start">
                                    <small style="margin:5px">821 Views</small>
                                    <small style="margin:5px">2 days ago</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

<!--        <h1>
            Root
            <strong>{{this.$store.state}}</strong>
        </h1>-->
    </div>
</template>

<script>
    export default {
        name: "root",
        mounted() {
            console.log(this.$store.state)
        },
        methods :{
            logout : function () {
                localStorage.removeItem('token');
                this.$router.push('/');
            },
        },
    }
</script>

<style scoped>

</style>
