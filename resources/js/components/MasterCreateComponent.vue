<template>
    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title">{{ masterData ? `Edit` : `Create` }}</h3>
            <div class="card-tools">
                <button
                    type="button"
                    class="btn btn-tool"
                    v-if="hasCloseButton"
                    @click="masterData ? $_closeModal('master-edit') : $_closeModal('master-create')"
                >
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form
            class="form-horizontal"
            @submit.prevent="createMaster(payload)"
        >
            <div class="card-body">
                <div class="form-group row">
                    <label for="name" class="col-sm-4 col-form-label">Name</label>
                    <div class="col-sm-8">
                        <input
                            type="text"
                            class="form-control"
                            id="name"
                            name="name"
                            autocomplete="name"
                            autofocus
                            :class="{
                                'is-invalid': formErrors.hasOwnProperty(columnName),
                            }"
                            v-model="payload.name"
                        />
                        <span
                            v-if="formErrors[columnName]"
                            class="error invalid-feedback"
                        >{{ formErrors[columnName][0] }}</span
                        >
                    </div>
                </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <button type="submit" class="btn btn-info">
                    {{ masterData ? `Update` : `Create` }}
                </button>
            </div>
            <!-- /.card-footer -->
        </form>
    </div>
</template>

<script>
import MasterApi from "../api/MasterApi";

export default {
    name: 'MasterCreateComponent',
    props: {
        hasCloseButton: {
            type: Boolean,
            required: false,
            default: false,
        },
        modelName: String,
        columnName: String,
        masterData: {
            type: Object,
            required: false,
            default: null,
        },
    },

    watch: {
        errors: function (error) {
            if(error.length > 0) {
                this.$_toast(error, 'error')
            }
        },
    },

    data() {
        return {
            payload: {
                name: null,
            },
            errors: [],
            formErrors: [],
        }
    },

    mounted() {
        this.payload.name = this.masterData[this.columnName]
    },

    methods: {
        async createMaster(payload) {

            if(this.columnName === 'title') {
                payload = {
                    title: payload.name
                }
            }

            if(this.masterData) {
                await MasterApi.update(this.modelName, this.masterData.id, payload)
                    .then((response) => {
                        this.$_toast(null, 'success')
                        this.$emit('masterUpdated')
                        this.$_closeModal('master-edit')
                    })
                    .catch((error) => {
                        if (error.response.status !== 422) {
                            this.errors = error.response.data.errors
                        }
                        this.formErrors = error.response.data.errors
                    })
            } else {
                await MasterApi.add(this.modelName, payload)
                    .then((response) => {
                        this.$_toast(null, 'success')
                        this.$emit('masterCreated')
                        this.$_closeModal('master-create')
                    })
                    .catch((error) => {
                        if (error.response.status !== 422) {
                            this.errors = error.response.data.errors
                        }
                        this.formErrors = error.response.data.errors
                    })
            }
        },
    },
}
</script>

<style scoped>
.card {
    margin-bottom: auto !important;
}
</style>
