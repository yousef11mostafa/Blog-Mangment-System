<script setup>
import layout from "../components/layouts/layout.vue";
import post from "../components/others/AllPosts.vue";
import createpost from "../components/others/createpost.vue";

import { useStore } from "vuex";
import { computed } from "vue";

const store = useStore();

const user = computed({
    get: () => store.state.auth.user,
    set: (value) => {
        store.commit("auth/setuser", value);
    },
});

const roles = computed(() => store.getters["auth/getRoles"]);
</script>

<template>
    <layout>
        <!-- <p class="text-danger mt-5">hello from home page</p> -->

        <!-- <p>{{ user }}</p> -->
        <!-- <p>{{ roles }}</p> -->

        <br /><br />

        <!-- create post -->
        <createpost></createpost>

        <!--  post component-->
        <post></post>
    </layout>
</template>
