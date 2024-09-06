// import getters  from "./getters";
// import mutations  from "./mutations";
// import actions  from "./actions";

import axios from "axios";
import axiosInstance from "../../axios";
import router from "../../router";

export default {
    namespaced: true,
    state: {
        posts: "posts",
        error: null,
        status:'',

    },
    mutations: {
        AUTH_REQUEST(state) {
            state.status = "loading";
            state.error = null;
        },
        seterror(state,errors){
            console.log(errors);
             state.error=errors;
        },
        setposts(state,posts){
            state.posts=posts;
        },
        clearerror(state,){
            state.error=null;
        },




    },
    actions: {
        async getposts(context){
            try{
             const response=await axiosInstance.get('user');
             context.commit("setposts",response.data.data.posts);

            }catch(error){
                context.commit("seterror",error.response.data);
            }
        },
        async updateProfile(context,userdata){

            try{
                if( confirm("are you want to updated profile")){
                await axiosInstance.post("user/updateProfile",userdata);
                }
                await axiosInstance.get("profile");

                router.push("/profile");
            }catch(error)
            {
                context.commit("seterror",error.response.data.errors);
            }
        },
        async updatePassword(context,passwordData){

            console.log(passwordData);

            try{
                if( confirm("are you want to updated profile")){
                    console.log(passwordData);
                 await axiosInstance.post("user/changePassword",passwordData);

                }
                alert("password updated sucssefully");

            }catch(error)
            {
                context.commit("seterror",error.response.data);
            }
        },

    },
    getters: {
         getposts(state){
            console.log(state.posts)
            return state.posts;
         },
         geterrors(state){
            console.log("geterrors");
            return state.error;
         }
    },
};
