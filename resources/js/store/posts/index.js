// import getters  from "./getters";
// import mutations  from "./mutations";
// import actions  from "./actions";

import axios from "axios";
import axiosInstance from "../../axios";
import router from "../../router";

export default {
    namespaced: true,
    state: {
        error: null,
    },
    mutations: {
        seterror(state, error) {
            state.error = error;
        },
        clearerrors(state) {
            state.error = null;
        },
    },
    actions: {
        async createpost(context, post) {
            try {
                const response = await axiosInstance.post(`posts/create`, post);
                alert("post created successfully");
            } catch (error) {
                context.commit("seterror", error.response.data);
            }
        },
        async DeletePost(context, post_id) {
            try {
                const response = await axiosInstance.post(
                    `posts/delete/${post_id}`
                );
            } catch (error) {
                context.commit("seterror", error.response.data);
            }
        },
    },
};
