<template>
    <div class="container mt-3">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card card-default">
                    <div class="card-header">Update Todo List</div>

                    <div class="card-body">

                        <form @submit.prevent="PostUpdate">

                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" class="form-control" v-model="todo.name">
                                <input type="hidden" class="form-control" v-model="todo.id">
                                <div v-if="validation.name">
                                    <div class="alert alert-danger mt-1" role="alert">
                                        {{ validation.name[0] }}
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Description</label>
                                <textarea class="form-control" v-model="todo.description" rows="5"></textarea>
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
                                <button type="submit" class="btn btn-md btn-success">Update</button>
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
        created() {
            let uri = 'http://127.00.1:8000/api/todolist/'+this.$route.params.id;
            this.axios.get(uri).then((response) => {
                this.todo = response.data.data;
            });
        },
        methods: {
            PostUpdate() {
                let uri = 'http://127.00.1:8000/api/todolist/update/'+this.$route.params.id;
                this.axios.post(uri, this.todo)
                    .then((response) => {
                        this.$router.push({name: 'todos'});
                    }).catch(error => {
                    this.validation = error.response.data.data;
                });
            }
        }
    }
</script>