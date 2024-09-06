<script setup>
import { defineProps } from "vue";

// Define props
const props = defineProps({
    posts: {
        type: Array,
    },
});
</script>

<template>
    {{ posts }}

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card post-card">
                <!-- Post Section -->
                <div class="card-header d-flex align-items-center">
                    <img src="" alt="Post Author" class="avatar me-3" />
                    <div>
                        <h2 class="mb-0">Post Title</h2>
                        <p class="text-muted mb-0">
                            Posted by Username on September 1, 2024
                        </p>
                    </div>
                </div>
                <div class="card-body">
                    <p>
                        This is an example post body. The post details will be
                        displayed here.
                    </p>
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
                            View Comments (3)
                        </button>
                        <ul
                            class="dropdown-menu"
                            aria-labelledby="dropdownMenuButton"
                        >
                            <!-- Comment 1 -->
                            <li>
                                <a
                                    class="dropdown-item d-flex align-items-start"
                                    href="#"
                                >
                                    <img
                                        src=""
                                        alt="Comment Author"
                                        class="avatar me-3"
                                    />
                                    <div>
                                        <p class="mb-1">
                                            <strong>Commenter Name</strong>
                                        </p>
                                        <p>This is a comment on the post.</p>
                                        <p class="text-muted">
                                            September 1, 2024
                                        </p>
                                    </div>
                                </a>
                            </li>
                            <li><hr class="dropdown-divider" /></li>
                            <!-- Comment 2 -->
                            <li>
                                <a
                                    class="dropdown-item d-flex align-items-start"
                                    href="#"
                                >
                                    <img
                                        src=""
                                        alt="Comment Author"
                                        class="avatar me-3"
                                    />
                                    <div>
                                        <p class="mb-1">
                                            <strong>Commenter Name</strong>
                                        </p>
                                        <p>
                                            This is another comment on the post.
                                        </p>
                                        <p class="text-muted">
                                            September 2, 2024
                                        </p>
                                    </div>
                                </a>
                            </li>
                            <li><hr class="dropdown-divider" /></li>
                            <!-- Comment 3 -->
                            <li>
                                <a
                                    class="dropdown-item d-flex align-items-start"
                                    href="#"
                                >
                                    <img
                                        src=""
                                        alt="Comment Author"
                                        class="avatar me-3"
                                    />
                                    <div>
                                        <p class="mb-1">
                                            <strong>Commenter Name</strong>
                                        </p>
                                        <p>
                                            This is a third comment on the post.
                                        </p>
                                        <p class="text-muted">
                                            September 3, 2024
                                        </p>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </div>

                    <!-- Add Comment Form -->
                    <div class="mt-4">
                        <h5>Add a Comment</h5>
                        <form>
                            <div class="mb-3">
                                <textarea
                                    class="form-control"
                                    placeholder="Write a comment..."
                                    rows="3"
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
