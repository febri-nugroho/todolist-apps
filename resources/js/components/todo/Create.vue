<template>
    <div class="container mt-3">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card card-default">
                    <div class="card-header">Add Todo List</div>
                    <div class="card-body">
                        <form @submit.prevent="PostStore">

                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" class="form-control" v-model="todo.name" placeholder="Name">
                                <div v-if="validation.name">
                                    <div class="alert alert-danger mt-1" role="alert">
                                        {{ validation.name[0] }}
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Description</label>
                                <textarea class="form-control" v-model="todo.description" rows="5" placeholder="Description"></textarea>
                                <div v-if="validation.description">
                                    <div class="alert alert-danger mt-1" role="alert">
                                        {{ validation.description[0] }}
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Status</label>
                                <select class="form-control col-sm-3" v-model="todo.status">
                                    <option value="1">Completed</option>
                                    <option value="0">Incompleted</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-md btn-success">Save</button>
                                <button type="reset" class="btn btn-md btn-danger">Reset</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                todo: {},
                validation: []
            }
        },
        methods: {
            PostStore() {
                let uri = 'http://127.00.1:8000/api/todolist';
                this.axios.post(uri, this.todo)
                    .then((response) => {
                        this.$router.push({
                            name: 'todos'
                        });
                    }).catch(error => {
                    this.validation = error.response.data.data;
                });
            }
        }
    }
</script>