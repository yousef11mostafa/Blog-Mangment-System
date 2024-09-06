<script setup>
import layout from "../layouts/layout.vue";
import post from "../others/ProfilePosts.vue";

import { useStore } from "vuex";
import { ref, reactive, onMounted, computed } from "vue";
import axiosinstance from "../../axios";
import { useRouter, useRoute } from "vue-router";

const store = useStore();
const router = useRouter();
const route = useRoute();

onMounted(async () => {
    store.dispatch("user/getposts");
});

// const posts=store.getters['user/getposts'];
const posts = computed(() => store.state.user.posts);
const errors = computed(() => store.state.user.error);
const user = store.state.auth.user;

const userdata = reactive({
    name: user.name,
    email: user.email,
    // image:user.image,
});

const updateProfile = () => {
    store.dispatch("user/updateProfile", userdata).then(() => {
        store.dispatch("auth/autoLogin", { router, route });
        store.commit("auth/clearerror");
    });
};

const passwordData = reactive({
    current_password: "",
    new_password: "",
    new_password_confirmation: "",
});

const updatePassword = () => {
    store.dispatch("user/updatePassword", passwordData).then(() => {
        store.commit("auth/clearerror");
    });
};
</script>

<template>
    <layout>
        <!-- {{ posts }} -->
        <!-- <br>
           <br> -->
        <!-- {{ user }} -->
        <!-- <br>
           <br> -->
        <!-- {{ errors }} -->

        <h2 class="text-center my-3 fw-bold">My Profile Page</h2>



        <!-- User Data -->
        <div class="card mt-4">
    <div class="card-header">
        User Information
        <button
            class="btn btn-link float-end"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#profileContent"
            aria-expanded="false"
            aria-controls="profileContent"
        >
            Toggle
        </button>
    </div>

    <div id="profileContent" class="collapse">
        <div class="card-body">
            <form id="profileForm" @submit.prevent="updateProfile">
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input
                        type="text"
                        class="form-control"
                        id="username"
                        v-model="userdata.name"
                    />
                    <p class="text-danger" v-if="errors && errors['name']">
                        {{ errors.name[0] }}
                    </p>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input
                        type="email"
                        class="form-control"
                        id="email"
                        v-model="userdata.email"
                    />
                    <p class="text-danger" v-if="errors && errors['email']">
                        {{ errors.email[0] }}
                    </p>
                </div>
                <div class="mb-3">
                    <label for="image" class="form-label">Choose Picture</label>
                    <!-- <input class="form-control" type="file" id="image" > -->
                </div>
                <button
                    type="submit"
                    class="btn btn-primary"
                    id="updateProfile"
                >
                    Update Profile
                </button>
            </form>
        </div>
    </div>
         </div>



        <!-- Update Password -->
   <div class="card mt-4">
    <div class="card-header">
        Change Password
        <button
            class="btn btn-link float-end"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#passwordContent"
            aria-expanded="false"
            aria-controls="passwordContent"
        >
            Toggle
        </button>
    </div>

    <div id="passwordContent" class="collapse">
        <div class="card-body">
            <form id="passwordForm" @submit.prevent="updatePassword">
                <p class="text-danger" v-if="errors && errors['message']">
                    {{ errors.message }}
                </p>
                <div class="mb-3">
                    <label for="currentPassword" class="form-label">Current Password</label>
                    <input
                        type="password"
                        class="form-control"
                        id="currentPassword"
                        v-model="passwordData.current_password"
                    />
                    <p class="text-danger" v-if="errors && errors['current_password']">
                        {{ errors.current_password[0] }}
                    </p>
                </div>
                <div class="mb-3">
                    <label for="newPassword" class="form-label">New Password</label>
                    <input
                        type="password"
                        class="form-control"
                        id="newPassword"
                        v-model="passwordData.new_password"
                    />
                    <p class="text-danger" v-if="errors && errors['new_password']">
                        {{ errors.new_password[0] }}
                    </p>
                </div>
                <div class="mb-3">
                    <label for="confirmPassword" class="form-label">Confirm New Password</label>
                    <input
                        type="password"
                        class="form-control"
                        id="confirmPassword"
                        v-model="passwordData.new_password_confirmation"
                    />
                </div>
                <button
                    type="submit"
                    class="btn btn-warning"
                    id="updatePassword"
                >
                    Update Password
                </button>
            </form>
        </div>
    </div>
</div>


        <!-- posts component -->
        <post :posts="posts"></post>

        
    </layout>
</template>
