require('./bootstrap');

import {createApp} from 'vue'
import  * as VueRouter from 'vue-router'
import {createStore} from "vuex";
import root from './Components/root'
import login from "./components/auth/login"
import register from "./Components/Auth/register"
import home from "./Components/User/home"
import userChannel from "./Components/User/userChannel";
import uploadVideos from "./Components/Channel/upload";
import playVideo from "./Components/Channel/video";



const routes = [
    {
        path:'/',
        component:root,
        name: 'root',
        meta: {
            requiresAuth: false
        }
    },
    {
        path:'/login',
        name : 'Login',
        component:login,
        meta: {
            requiresAuth: false
        }
    },
    {
        path:'/register',
        name : 'register',
        component:register,
        meta: {
            requiresAuth: false
        }
    },
    {
        path:'/home',
        name : 'home',
        component:home,
        meta: {
            requiresAuth: true
        }
    },
    {
        path:'/channels/:id',
        name : 'channel',
        component:userChannel,
        meta: {
            requiresAuth: false
        }
    },
    {
        path:'/channels/:channel/videos',
        name : 'uploadVideos',
        component:uploadVideos,
        meta: {
            requiresAuth: true
        }
    },
    {
        path:'/videos/:video',
        name : 'playVideo',
        component:playVideo,
        meta: {
            requiresAuth: true
        }
    },
]

const router = VueRouter.createRouter({
    history : VueRouter.createWebHistory('/'),
    routes
})

const store = createStore({
    state() {
        return {
            user : {}
        }
    } ,
    getters : {

    },
    mutations : {
        setUser (state , payload) {
            state.user = payload
        }
    },
    actions : {},
})



router.beforeEach((to,from) => {
    if(to.meta.requiresAuth && !localStorage.getItem('token')){
        return { name : 'Login'}
    }
/*    if(to.meta.requiresAuth === false && localStorage.getItem('token')){
        return { name : 'home'}
    }*/
})

const app = createApp({})

app.use(router)



app.use(store)

app.component('root' , root)

app.mount('#app')


