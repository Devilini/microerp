<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <router-link to="/transport/create" class="btn btn-outline-success">Добавить <i class="fa fa-plus"></i>
                </router-link>
                <br><br>
                <div class="table-responsive">
                    <table class="table table-hover table-striped">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Название</th>
                            <th scope="col">Цвет</th>
                            <th scope="col">Год</th>
                            <th scope="col">Статус</th>
                            <th scope="col">Тип</th>
                            <th scope="col">Дата создания</th>
                            <th scope="col"></th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="transport in transports" :key="transport.id">
                            <th scope="row">{{transport.id}}</th>
                            <td>{{transport.name}}</td>
                            <td>{{transport.color}}</td>
                            <td>{{transport.year}}</td>
                            <td>{{transport.status}}</td>
                            <td>{{transport.type.name}}</td>
                            <td>{{transport.created_at}}</td>
                            <td>
                                <router-link :to="{ name: 'edit', params: { id: transport.id}}"
                                             class="btn btn-outline-primary">
                                    <i class="fa fa-edit"></i>
                                </router-link>
                                <a href="#" class="btn btn-outline-danger" @click="deleteTransport(transport.id)">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                transports: {}
            }
        },
        methods: {
            loadTransports() {
                axios.get('/api/transport').then(({data}) => {
                    this.transports = data.data;
                });
            },
            deleteTransport(id) {
                swal.fire({
                    title: 'Удалить?',
                    text: "Вы действительно хотите удалить запись?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    confirmButtonText: 'Да',
                    cancelButtonText: 'Отмена'
                }).then((result) => {
                    if (result.value) {
                        axios.delete('/api/transport/' + id).then(() => {
                            swal.fire(
                                'Удалено!',
                                'Запись была успешно удалена',
                                'success'
                            );
                            this.loadTransports();
                        }).catch(() => {
                            swal.fire("Ошибка", "Не удалось удалить запись", "warning");
                        });
                    }
                })
            }
        },
        mounted() {
            this.loadTransports();
        }
    }
</script>

<style scoped>

</style>
