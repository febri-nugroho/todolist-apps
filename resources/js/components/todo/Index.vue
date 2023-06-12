<template>
    <div class="container mt-3">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card card-default">
                    <center><div class="card-header">TODO LIST TEST FEBRI NUGROHO</div></center>

                    <div class="card-body">
                        <div class="col-md-12">
                            <div>
                                <router-link :to="{ name: 'create' }" class="btn btn-md btn-success">Add Todo List</router-link>&nbsp;
                            </div>
                        </div>

                        <div class="table-responsive mt-2">
                            <table class="table table-hover table-bordered">
                                <thead>
                                <tr>
                                    <th></th>
                                    <th @click="sortList('name')">Name &#8597;</th>
                                    <th>Description</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="(todo, index) in todos" :key="todo.id">
                                    <!-- <td><input :id="todo.id" type="checkbox" @change="UpdateStatus(todo.id)" /></td> -->
                                    <td><input :id="todo.id" type="checkbox" v-on:change="UpdateStatus(todo.id)" /></td>
                                    <td>{{ todo.name }}</td>
                                    <td>{{ todo.description }}</td>
                                    <td>
                                        <div :style='{color:getColor(todo.status)}'>{{todo.status === 1 ? "Completed" : "Incompleted"}}</div>
                                    </td>
                                    <td class="text-center">
                                        <router-link :to="{name: 'edit', params: { id: todo.id }}" class="btn btn-sm btn-primary">Edit</router-link>
                                        <button @click.prevent="PostDelete(todo.id, index)" class="btn btn-sm btn-danger">Delete</button>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>

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
                todos: [],
                sortedbyASC: true,
            }
        },
        created() {
            let uri = 'http://127.0.0.1:8000/api/todolist';
            this.axios.get(uri).then(response => {
                console.log(response);
                this.todos = response.data.data;
            });
        },
        methods: {
            sortList(sortBy) {
                if (this.sortedbyASC) {
                    this.todos.sort((x, y) => (x[sortBy] > y[sortBy] ? -1 : 1));
                    this.sortedbyASC = false;
                } else {
                    this.todos.sort((x, y) => (x[sortBy] < y[sortBy] ? -1 : 1));
                    this.sortedbyASC = true;
                }
            },
            getColor(status) {
                if(status === 0) {
                    return "red"
                } else {
                    return "green"
                }
            },
            UpdateStatus(id) {
                let uri = 'http://127.00.1:8000/api/todolist/updatestatus/'+id;
                this.axios.post(uri, this.todo)
                    .then((response) => {
                        this.$router.push({
                            name: 'todos'
                        });
                        window.location.reload();
                    }).catch(error => {
                    this.validation = error.response.data.data;
                });
            }
        },
    }
</script>