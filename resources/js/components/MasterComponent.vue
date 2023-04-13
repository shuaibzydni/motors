<template>
    <div class="container-fluid">
        <div class="row">
            <div class="offset-md-2 col-md-8">

                <div v-if="errors && errors.message" class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    {{ errors.message[0] || '' }}
                </div>

                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">{{ modelName | splitAtUpperCase }}</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">

                        <div class="float-left">
                            <input class="form-control float-right mb-2" type="text" placeholder="Search" v-model="search">
                        </div>

                        <div class="float-right">
                            <button @click="$_showModal('master-create')" class="btn btn-primary">Add {{ modelName | splitAtUpperCase }}</button>
                        </div>

                        <table class="table table-bordered table-sm">
                            <thead>
                            <tr>
                                <th style="width: 50px">#</th>
                                <th>Name</th>
                                <th style="width: 200px">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="(datum, i) in data.data" :key="i">
                                <td>{{ data.from + i }}</td>
                                <td>{{ datum[columnName] }}</td>
                                <td>
                                    <button @click="editData(datum)" class="btn btn-sm btn-info">Edit</button>
                                    <button @click="deleteData(datum.id)" class="btn btn-sm btn-danger">Delete</button>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer clearfix">
                        <div class="float-right">
                            <pagination
                                class="pagination pagination-sm m-0 float-right"
                                :limit="3"
                                :data="data"
                                @pagination-change-page="listMaster"
                            ></pagination>
                        </div>
                    </div>
                </div>
                <!-- /.card -->
            </div>
        </div>
        <v-modal
            name="master-create"
            :pivotY="_modal.pivotY"
            :height="_modal.height"
            :draggable="_modal.draggable"
            :scrollable="_modal.scrollable"
        >
            <MasterCreateComponent
                :model-name="modelName"
                :column-name="columnName"
                :hasCloseButton="true"
                @masterCreated="listMaster"
            ></MasterCreateComponent>
        </v-modal>

        <v-modal
            name="master-edit"
            :pivotY="_modal.pivotY"
            :height="_modal.height"
            :draggable="_modal.draggable"
            :scrollable="_modal.scrollable"
        >
            <MasterCreateComponent
                :model-name="modelName"
                :column-name="columnName"
                :hasCloseButton="true"
                :masterData="masterData"
                @masterUpdated="listMaster"
            ></MasterCreateComponent>
        </v-modal>
    </div>
</template>

<script>
    import MasterApi from "../api/MasterApi";

    export default {
        props: {
            modelName: String,
            columnName: String
        },

        data() {
            return {
                search: null,
                data: {},
                masterData: null,
                errors: []
            }
        },

        watch: {
            search: function () {
                this.listMaster()
            },

            errors: function (error) {
                if(error.length > 0) {
                    this.$_toast(error, 'error')
                }
            },
        },

        async created() {
            await this.listMaster()
        },

        methods: {
            listMaster(page = 1) {
                let params = {
                    query: JSON.stringify({ search: this.search }),
                }
                params = { page, ...params }
                this.getMaster(params)
            },

            async getMaster(params) {
                await MasterApi.list(this.modelName, params)
                    .then(response => {
                        this.data = response.data
                        this.errors = []
                    })
                    .catch(error => {
                        this.errors = error.response ? error.response.data.errors : []
                    });
            },

            editData(masterData) {
                this.masterData = masterData;
                this.$_showModal('master-edit')
            },

            deleteData(masterId) {
                this.$_confirmDelete().then(async (confirm) => {
                    if (confirm.value) {
                        await MasterApi.delete(this.modelName, masterId)
                            .then((response) => {
                                this.$_toast(null, 'success')
                                this.listMaster()
                            })
                            .catch((error) => {
                                this.errors = error.response ? error.response.data.errors : []
                            })
                    }
                })
            },
        },

        filters: {
            splitAtUpperCase: function (input) {
                let uppers = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
                //start at 1 because 0 is always uppercase
                for (let i=1; i<input.length; i++){
                    if (uppers.indexOf(input.charAt(i)) !== -1){
                        //the uppercase letter is at i
                        return `${input.substring(0,i)} ${input.substring(i,input.length)}`;
                    }
                }

                return input.charAt(0).toUpperCase() + input.slice(1);
            }
        }
    }
</script>
