<template>
    <el-button v-if="isAuthenticated" plain @click="dialogVisible = true">
        <h5 class="p-1">Add new post</h5>
    </el-button>

    <el-dialog
        v-model="dialogVisible"
        title="Tips"
        width="500"
        :before-close="handleClose"
    >
        <!-- start  -->
        <form id="profileForm" @submit.prevent="createpost">
            <div class="mb-3">
                <label for="title" class="form-label">title</label>
                <input
                    type="text"
                    class="form-control"
                    id="title"
                    v-model="post.title"
                />
                <p class="text-danger" v-if="errors && errors.errors['title']">
                    {{ errors.errors.title[0] }}
                </p>
            </div>
            <div class="mb-3">
                <label for="content" class="form-label">content</label>
                <textarea
                    class="form-control"
                    name="content"
                    id="content"
                    cols="30"
                    rows="10"
                    v-model="post.content"
                ></textarea>

                <p
                    class="text-danger"
                    v-if="errors && errors.errors['content']"
                >
                    {{ errors.errors.content[0] }}
                </p>
            </div>

            <button type="submit" class="btn btn-primary" id="createpost">
                create post
            </button>
        </form>
        <!-- end  -->
        <template #footer>
            <div class="dialog-footer">
                <el-button @click="dialogVisible = false">Cancel</el-button>
                <el-button type="primary" @click="dialogVisible = false">
                    Confirm
                </el-button>
            </div>
        </template>
    </el-dialog>
</template>

<script lang="ts" setup>
import { ElMessageBox } from "element-plus";

import { ref, onMounted, reactive, computed } from "vue";
import { useRouter } from "vue-router";
import { useStore } from "vuex";

const post = reactive({
    title: "",
    content: "",
});

const store = useStore();
const router = useRouter();
const isAuthenticated = computed(() => store.getters["auth/isAuthenticated"]);

const errors = computed(() => store.state.posts.error);

const createpost = async () => {
    store.commit("posts/clearerrors");
    await store.dispatch("posts/createpost", post);

    store.dispatch("front/getAllPosts");
    dialogVisible.value = false;
    store.commit("posts/clearerrors");
};

// the dialog code

const dialogVisible = ref(false);

const handleClose = (done: () => void) => {
    ElMessageBox.confirm("Are you sure to close this dialog?")
        .then(() => {
            done();
        })
        .catch(() => {
            // Handle the rejectiona
        });
};
</script>
