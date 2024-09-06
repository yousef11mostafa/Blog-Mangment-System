// import getters  from "./getters";
// import mutations  from "./mutations";
// import actions  from "./actions";

import axios from "axios";
import axiosInstance from "../../axios";
import router from "../../router";

export default {
    namespaced: true,
    state: {
     posts:[],
     error:null,
    },
    mutations: {
    setposts(state,posts){
        state.posts=posts;
        console.log(posts);
    },
    seterror(state,error){
        state.error=error;
    },

    },
    actions: {
        async getAllPosts(context){
            try{
             const response=await axiosInstance.get(``);
             context.commit("setposts",response.data.data.data);
            }catch(error){
                context.commit("seterror",error.response.data);
            }
        },


    },

};
