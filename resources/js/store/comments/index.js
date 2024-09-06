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
    },
    actions: {
        async AddComment(context, data) {
            try {
                const response = await axiosInstance.post(
                    "comments/create",
                    data
                );
                //  router.push("/profile");
            } catch (error) {
                context.commit("seterror", error.response.data);
            }
        },

        async DeleteComment(context, comment_id) {
            try {
                await axiosInstance.post(`comments/delete/${comment_id}`);
            } catch (error) {
                context.commit("seterror", error.response.data);
            }
        },
    },
};
