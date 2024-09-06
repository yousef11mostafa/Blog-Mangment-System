<script setup>
import { defineProps, ref, reactive, computed } from "vue";
import { useStore } from "vuex";

const store = useStore();

const errors = computed(() => store.state.comments.error);
const user = computed(() => store.state.auth.user);

// Define props
const props = defineProps({
    posts: {
        type: Array,
    },
});

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
        store.dispatch("user/getposts");
    });
};

const deletepost = async (post_id) => {
    if (confirm("Are you sure to delete the post")) {
        await store.dispatch(`posts/DeletePost`, post_id);
        alert("post deleted successfully");
        store.dispatch("user/getposts");
    }
};

const deletecomment = async (comment_id) => {
    if (confirm("Are you sure to delete the comment")) {
        await store.dispatch(`comments/DeleteComment`, comment_id);
        // alert("post deleted successfully");
        store.dispatch("user/getposts");
    }
};
</script>

<template>
    <!-- {{ posts }} -->

    <!-- <br>
<br> -->

    <!-- {{ errors }} -->

    <div class="row justify-content-center">
        <h4 class="text-center my-3 fw-bold">My Posts</h4>
        <div class="col-md-8">
            <div v-for="post in posts" :key="post.id" class="card post-card">
                <!-- Post Section -->

                <div class="p-2 d-flex align-items-center">
                    <div
                        class="rounded-circle bg-primary"
                        style="width: 50px; height: 50px"
                    ></div>
                    <h4 class="p-1">{{ user.name }}</h4>
                </div>

                <div
                    class="d-flex justify-content-between align-items-center p-3"
                >
                    <!-- Left side: post title and details -->
                    <div>
                        <h2 class="mb-0">{{ post.title }}</h2>
                        <p class="text-muted mb-0">
                            Posted by Username on September 1, 2024
                        </p>
                    </div>

                    <!-- Right side: buttons -->
                    <div>
                        <button class="btn btn-primary me-2">Edit</button>
                        <button
                            @click="deletepost(post.id)"
                            class="btn btn-danger"
                        >
                            Delete
                        </button>
                    </div>
                </div>

                <div class="card-body">
                    <p>{{ post.content }}.</p>
                </div>

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
                            <!-- View Comments {{ getcommentssize(post.comments) }} -->
                            View Comments
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
                                        @click="deletecomment(comment.id)"
                                        class="btn btn-sm btn-danger"
                                    >
                                        Delete
                                    </button>
                                </div>
                            </li>
                            <li><hr class="dropdown-divider" /></li>
                            <!-- Comment 2 -->

                            <li><hr class="dropdown-divider" /></li>
                            <!-- Comment 3 -->
                        </ul>
                    </div>

                    <!-- Add Comment Form -->
                    <div class="mt-4">
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
