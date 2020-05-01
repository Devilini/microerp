<template>
    <div class="container">
        <div class="col-md-12">
            <alert-errors :form="form">Вы ввели некорректные данные</alert-errors>
            <form @submit.prevent="editmode ? updateTransport() : createTransport()" @keydown="form.onKeydown($event)">
                <div class="form-group">
                    <label>Название*</label>
                    <input v-model="form.name" type="text" name="name"
                           class="form-control" :class="{ 'is-invalid': form.errors.has('name') }">
                    <has-error :form="form" field="name"></has-error>
                </div>
                <div class="form-group">
                    <label>Цвет</label>
                    <input v-model="form.color" type="text" name="color"
                           class="form-control" :class="{ 'is-invalid': form.errors.has('color') }">
                    <has-error :form="form" field="color"></has-error>
                </div>
                <div class="form-group">
                    <label>Год</label>
                    <input v-model="form.year" type="text" name="year"
                           class="form-control" :class="{ 'is-invalid': form.errors.has('year') }">
                    <has-error :form="form" field="year"></has-error>
                </div>
                <div class="form-group">
                    <label>Тип*</label>
                    <select v-model="form.type_id" type="text" name="type_id"
                            class="form-control" :class="{ 'is-invalid': form.errors.has('type_id') }">
                        <option v-for="transport_type in transport_types" :value="transport_type.id">
                            {{transport_type.name}}
                        </option>
                    </select>
                    <has-error :form="form" field="type_id"></has-error>
                </div>
                <div class="form-group">
                    <label>Статус</label>
                    <select v-model="form.status" type="text" name="status"
                            class="form-control" :class="{ 'is-invalid': form.errors.has('status') }">
                        <option v-for="status_item in status" :value="status_item">{{status_item}}</option>
                    </select>
                    <has-error :form="form" field="status"></has-error>
                </div>
                <button v-show="editmode" :disabled="form.busy" type="submit" class="btn btn-success">Изменить</button>
                <button v-show="!editmode" :disabled="form.busy" type="submit" class="btn btn-success">Добавить</button>
            </form>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                editmode: false,
                transport_types: {},
                status: {},
                form: new Form({
                    name: '',
                    color: '',
                    year: '',
                    status: '',
                    type_id: ''
                })
            }
        },

        methods: {
            createTransport() {
                this.form.post('/api/transport').then(({data}) => {
                    toast.fire({
                        type: 'success',
                        icon: 'success',
                        title: 'Новая запись добавлена!'
                    });
                    this.$router.push('/transport');
                });
            },
            updateTransport () {
                this.form.put('/api/transport/' + this.$route.params.id )
                    .then(() => {
                        swal.fire(
                            'Обновлено!',
                            'Данные были успешно обновлены',
                            'success'
                        );
                        this.$router.push('/transport' );
                    })
                    .catch(() => {
                        swal.fire("Ошибка", "Не удалось обновить запись", "warning");
                    });

            },
            loadTransportForCreate() {
                axios.get('/api/transport/create').then(({data}) => {
                    this.transport_types = data.transport_types;
                    this.status = data.status
                });
            },
            loadTransportForUpdate() {
                axios.get('/api/transport/' + this.$route.params.id ).then(({data}) => {
                    this.form.fill(data.transport);
                    this.transport_types = data.transport_types;
                    this.status = data.status;
                });
            }
        },
        mounted() {
            if (this.$route.path === '/transport/create') {
                this.loadTransportForCreate();
            } else {
                this.editmode = true;
                this.loadTransportForUpdate();
            }
        }
    }
</script>

<style scoped>

</style>
