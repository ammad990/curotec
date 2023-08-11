<template>
    <div>
        <div class="uk-alert-danger" uk-alert v-if="error">
            <a class="uk-alert-close" uk-close></a>
            <p>Check the correctness of the entered fields</p>
        </div>
        <form style="margin-bottom: 20px;">
            <fieldset class="uk-fieldset">

                <legend class="uk-legend">Tasks ({{ posts.length }})</legend>

                <div class="uk-margin">
                    <input class="uk-input" v-model="form.title" type="text" placeholder="title">
                </div>

                <button class="uk-button uk-button-primary" @click.prevent="store">
                    <div uk-spinner v-if="loading"></div>
                    <span v-else>+Add</span>
                </button>
            </fieldset>

        </form>
        <spin v-if="loading"></spin>
        <div  v-else>
            <all-tasks
                v-for="post in posts"
                :title="post.title"
                :status="post.status"
                :id="post.id"
                :date="post.created_at" v-bind:key="post.id" @load-updated-posts="loadPosts"
            />
        </div>
    </div>
</template>

<script>
    import Spin from "../components/Spin";
    import axios from 'axios';
    import AllTasks from "../views/AllTasks";
    export default {
        components: {
            Spin,
            AllTasks
        },
        data: () => ({
            loading: true,
            posts: [],
            form: {
                title: "",
                status: false
            },
            error: false
        }),
        mounted() {
            this.loadPosts();
        },
        methods: {
            loadPosts() {
                axios.get('/api/task')
                .then(res => {
                    this.posts = res.data;
                    setTimeout(() => {
                        this.loading = false;
                    }, 500)
                })
            },
            store() {
                this.loading = true;
                axios.post('/api/task', this.form, {
                    headers: {
                        "Content-type": "application/json"
                    }
                })
                .then(res => {
                    if (res.data.status) {
                       debugger;
                        this.posts.push(res.data.task);
                        this.loadPosts();
                        this.form.title="";
                    } else {
                        setTimeout(() => {
                            this.loading = false;
                        }, 300);
                        this.error = true;
                    }
                })
            }
        }
    }
</script>

