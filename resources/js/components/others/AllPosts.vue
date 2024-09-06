<script setup>
import { ref, onMounted, reactive, computed } from "vue";
import { useStore } from "vuex";

const store = useStore();

onMounted(() => {
    store.dispatch("front/getAllPosts");
});

const posts = computed(() => store.state.front.posts);
const isAuthenticated = computed(() => store.getters["auth/isAuthenticated"]);
const isAdminAuthorized = computed(() =>
    store.getters["auth/isAuthorized"]("admin")
);

const user = store.state.auth.user;

const CheckIsUserPost = (post) => {
    if (user) {
        return post.user.id === user.id;
    }
    return false;
};
const CheckIsUserComment = (comment) => {
    if (user) {
        return comment.user.id === user.id;
    }
    return false;
};

const comment = ref("");
const commentData = reactive({
    content: "",
    post_id: "",
});

const getcommentssize = (comments) => {
    return comments.size;
};

const AddCommint = (post_id) => {
    commentData.post_id = post_id;
    store.dispatch("comments/AddComment", commentData).then(() => {
        alert("coment added successfully");
        store.dispatch("front/getAllPosts");
        commentData.content = "";
    });
};

const deletepost = async (post_id) => {
    if (confirm("Are you sure to delete the post")) {
        await store.dispatch(`posts/DeletePost`, post_id);
        alert("post deleted successfully");
        store.dispatch("front/getAllPosts");
    }
};

const deletecomment = async (comment_id) => {
    if (confirm("Are you sure to delete the comment")) {
        await store.dispatch(`comments/DeleteComment`, comment_id);
        // alert("post deleted successfully");
        store.dispatch("front/getAllPosts");
    }
};
</script>

<template>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div v-for="post in posts" :key="post.id" class="card post-card">
                <!-- Post Section -->

                <!-- testuser -->
                <div class="p-2 d-flex align-items-center">
                    <div
                        class="rounded-circle bg-primary"
                        style="width: 50px; height: 50px"
                    ></div>
                    <h4 class="p-1">{{ post.user.name }}</h4>
                </div>
                <!-- testuser -->

                <div
                    class="d-flex justify-content-between align-items-center p-3"
                >
                    <!-- Left side: post title and details -->
                    <div>
                        <h2 class="mb-0">{{ post.title }}</h2>
                        <p class="text-muted mb-0">
                            {{ post.content }}
                        </p>
                    </div>

                    <!-- Right side: buttons -->
                    <div v-if="isAdminAuthorized || CheckIsUserPost(post)">
                        <button class="btn btn-primary me-2">Edit</button>
                        <button
                            @click="deletepost(post.id)"
                            class="btn btn-danger"
                        >
                            Delete
                        </button>
                    </div>
                </div>
                <!-- <div class="card-body">
          <p>This is an example post body. The post details will be displayed here.</p>
        </div> -->

                <!-- Comments Dropdown Section -->
                <div class="card-footer">
                    <h4>Comments</h4>
                    <div class="dropdown">
                        <button
                            class="btn btn-secondary dropdown-toggle"
                            type="button"
                            id="dropdownMenuButton"
                            data-bs-toggle="dropdown"
                            aria-expanded="false"
                        >
                            View Comments (3)
                        </button>
                        <ul
                            class="dropdown-menu"
                            aria-labelledby="dropdownMenuButton"
                        >
                            <!-- Comment 1 -->
                            <li
                                v-for="comment in post.comments"
                                :key="comment.id"
                            >
                                <!-- testcode -->
                                <div
                                    class="dropdown-item d-flex align-items-center justify-content-between"
                                    href="#"
                                >
                                    <div class="d-flex align-items-center">
                                        <img
                                            src=""
                                            alt="Comment Author"
                                            class="avatar me-3"
                                        />
                                        <div>
                                            <div>
                                                <p class="mb-1">
                                                    <strong>{{
                                                        comment.user.name
                                                    }}</strong>
                                                </p>
                                                <p>{{ comment.content }}</p>
                                                <!-- <p class="text-muted">September 1, 2024</p> -->
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Button aligned to the right and centered vertically -->
                                    <button
                                        v-if="
                                            CheckIsUserPost(post) ||
                                            CheckIsUserComment(comment) ||
                                            isAdminAuthorized
                                        "
                                        @click="deletecomment(comment.id)"
                                        class="btn btn-sm btn-danger"
                                    >
                                        Delete
                                    </button>
                                </div>

                                <!-- end test -->
                            </li>
                            <li><hr class="dropdown-divider" /></li>
                            <!-- Comment 2 -->
                        </ul>
                    </div>

                    <!-- Add Comment Form -->
                    <div class="mt-4" v-if="isAuthenticated">
                        <h5>Add a Comment</h5>
                        <form @submit.prevent="AddCommint(post.id)">
                            <div class="mb-3">
                                <textarea
                                    class="form-control"
                                    placeholder="Write a comment..."
                                    rows="3"
                                    v-model="commentData.content"
                                ></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">
                                Submit Comment
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
.post-card {
    margin-bottom: 1.5rem;
}
.avatar {
    width: 40px;
    height: 40px;
    border-radius: 50%;
}
.dropdown-menu {
    max-height: 300px; /* Set max height for the dropdown */
    overflow-y: auto; /* Add scroll if content exceeds max-height */
}
</style>
