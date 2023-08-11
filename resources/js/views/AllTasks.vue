<template>
    <div class="uk-card uk-card-default uk-width-1-1">
        <div class="uk-card-header">
            <div class="uk-grid-small uk-flex-middle" uk-grid>
                <div class="uk-width-expand">
                    <h3 class="uk-card-title uk-margin-remove-bottom">
                        <button class="uk-button uk-button-sm uk-button-danger uk-float-right" @click.prevent="deleteTask">
                            <span>X</span>
                        </button></h3>
                </div>
            </div>
        </div>
        <div class="uk-card-body" style="background: #edfbf6;" v-if="status">
            <p style="text-decoration: line-through;">{{ title }} </p>
            <button class="uk-button uk-button-primary" @click.prevent="updateTaskStatus" v-bind="form.status=0">
                <div uk-spinner v-if="loading"></div>
                <span v-else>Mark as Incomplete</span>
            </button>
        </div>

        <div class="uk-card-body" v-else>
            <p>{{ title }}</p>
            <button class="uk-button uk-button-primary" @click.prevent="updateTaskStatus" v-bind="form.status=1">
                <div uk-spinner v-if="loading"></div>
                <span v-else>Mark as Complete</span>
            </button>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            title: {
                type: String,
                default: "NULL"
            },
            status: {
                type: Number,
                default: false
            },
            id:{
                type:Number,
                default:0
            }
        },
        data: () => ({
            form: {
                status:0,
                _method:'put'
            },
            loading: false,
            error: false
        }),
        methods: {
            updateTaskStatus() {
                this.loading = true;
                axios.post('/api/task/'+this.id, this.form, {
                    headers: {
                        "Content-type": "application/json"
                    }
                })
                .then(res => {
                    if (res.data.status) {
                        this.$emit('load-updated-posts');
                    } else {
                        setTimeout(() => {
                            this.loading = false;
                        }, 300);
                        this.error = true;
                    }
                })
            },

            deleteTask() {
                this.loading = true;
                axios.delete('/api/task/'+this.id, {
                    headers: {
                        "Content-type": "application/json"
                    }
                })
                .then(res => {
                    if (res.data.status) {
                        this.$emit('load-updated-posts');
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

