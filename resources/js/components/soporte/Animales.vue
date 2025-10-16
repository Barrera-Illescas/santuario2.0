<template>
    <div class="ma-4">
        <v-overlay v-model="overlay" class="align-center justify-center overlay" persistent>
            <v-progress-circular v-if="overlay" :width="12" :size="85" color="#004080"
                :indeterminate="overlay"></v-progress-circular>
        </v-overlay>

        <v-row>
            <v-col class="mt-6 col-8 justify-center d-flex">
                <div class="input-group border rounded-pill p-1 ma-4 bg-body rounded col-10 justify-center d-flex">
                    <input type="search" aria-describedby="button-addon3"
                        class="form-control bg-none border-0 rounded-pill" placeholder="Buscar" id="" onkeyup="search()"
                        v-model="search">
                    <div class="input-group-append border-0 ">
                        <button id="button-addon3" type="button" class="btn btn-link text-success"><i
                                class="fa fa-search encabezado__icono-search"></i></button>
                    </div>
                </div>
            </v-col>
            <v-col class="mt-6 col-4 d-flex justify-end">
                <v-btn color="primary" @click="openDialog()">
                    <i class="fa fa-plus"></i> Agregar</v-btn>
            </v-col>
        </v-row>
        <v-divider class="mt-8"></v-divider>
        <v-data-table :headers="headers" :items="itemsAnimales" :search="search">
            <template v-slot:item.actions="{ item }">
                <v-row class="justify-center align-center">
                    <v-col class="col-6">
                        <v-tooltip>
                            <template v-slot:activator="{ props }">
                                <v-icon size="x-large" class="mr-2" @click="editarEspecie(item)" color="success"
                                    v-bind="props">
                                    mdi mdi-pencil
                                </v-icon>
                            </template>
                            <span>Editar</span>
                        </v-tooltip>
                    </v-col>
                    <v-col class="col-6">
                        <v-tooltip>
                            <template v-slot:activator="{ props }">
                                <v-icon size="x-large" class="mr-2" @click="eliminarEspecie(item)" color="danger"
                                    v-bind="props">
                                    mdi mdi-trash-can
                                </v-icon>
                            </template>
                            <span>Eliminar</span>
                        </v-tooltip>
                    </v-col>
                </v-row>
            </template>
        </v-data-table>
    </div>

    <v-dialog v-model="dialogEspecies" max-width="60%" transition="dialog-top-transition" persistent>
        <v-card class="pa-6 rounded-lg elevation-12">
            <!-- Encabezado -->
            <v-toolbar color="primary" dark flat class="rounded-lg mb-4">
                <v-toolbar-title class="text-center w-100 text-h6 font-weight-bold">
                    {{ titleDialogo }}
                </v-toolbar-title>
            </v-toolbar>

            <!-- Formulario -->
            <v-card-text>
                <v-form ref="refEspecie">
                    <v-row class="mb-4 justify-center" dense>
                        <v-col cols="12" md="10" class="justify-center">
                            <v-text-field v-model="nombre" label="Nombre de la especie" variant="outlined" rounded
                                :rules="[...requiredRule]" />
                        </v-col>
                        <v-col cols="12" md="10">
                            <v-textarea v-model="descripcion" label="Descripción" variant="outlined" rounded rows="4"
                                auto-grow :rules="[...requiredRule]" />
                        </v-col>
                    </v-row>

                    <!-- Botones -->
                    <v-row justify="center">
                        <v-col cols="12" md="6" class="d-flex justify-center gap-4">
                            <v-btn v-if="banderaDialogo == 1" color="success" @click.prevent="guardarEspecie()" rounded>
                                <v-icon start icon="mdi-content-save" />
                                Guardar
                            </v-btn>
                            <v-btn v-if="banderaDialogo == 2" color="success" @click.prevent="editarSaveEspecie()" rounded>
                                <v-icon start icon="mdi-content-save" />
                                Actualizar
                            </v-btn>
                            <v-btn class="bg-warning" @click="closeDialog()" rounded>
                                <v-icon start icon="mdi-close" />
                                Cancelar
                            </v-btn>
                        </v-col>
                    </v-row>
                </v-form>
            </v-card-text>
        </v-card>
    </v-dialog>

</template>
<script>
import Swal from 'sweetalert2';

export default {
    name: 'Animales',

    data() {
        return {
            overlay: false,
            search: '',
            dialogEspecies: false,
            titleDialogo: '',
            idItem: null,
            nombre: '',
            descripcion: '',
            banderaDialogo: null,

            headers: [
                { title: 'ID', value: 'id' },
                { title: 'NOMBRE', value: 'nombre' },
                { title: 'DESCRIPCIÓN', value: 'descripcion' },
                { title: 'ACCIONES', value: 'actions', align: 'center' },
            ],
            itemsAnimales: [],

            //Reglas
            requiredRule: [v => !!v || 'Campo obligatorio'],
        }
    },

    methods: {
        getData() {
            axios.get('/colaborador/getEspecies')
                .then(response => {
                    this.itemsAnimales = response.data.especies;
                })
        },

        openDialog() {
            this.overlay = true;
            this.titleDialogo = "Agregar Especie";
            this.banderaDialogo = 1;
            this.dialogEspecies = true;
            this.overlay = false;
        },

        closeDialog() {
            this.overlay = true;
            this.dialogEspecies = false;
            this.overlay = false;
            // this.idItem = null;
            if (this.$refs.refEspecie) this.$refs.refEspecie.reset();
        },

        async guardarEspecie() {

            const resul = await this.$refs.refEspecie.validate();

            if (resul.valid) {
                this.overlay = true;
                axios.post('/colaborador/guardarEspecie', {
                    nombre: this.nombre,
                    descripcion: this.descripcion,
                }).then(res => {
                    this.overlay = false;
                    if (res.data.status === 'ok') {
                        this.dialogEspecies = false;
                        Swal.fire({
                            icon: 'success',
                            text: '¡Registro guardado exitosamente!'
                        });
                        this.getData();
                    }
                    else {
                        this.dialogEspecies = false;
                        Swal.fire({
                            icon: 'error',
                            text: 'Ha ocurrido un error al guardar el registro. Intente de nuevo.'
                        });
                    }
                })
            }
        },

        editarEspecie(item) {
            this.overlay = true;
            this.idItem = item.id;
            this.nombre = item.nombre;
            this.descripcion = item.descripcion;
            this.titleDialogo = 'Editar Especie';
            this.banderaDialogo = 2;
            this.dialogEspecies = true;
            this.overlay = false;
        },

        async editarSaveEspecie() {
            const resul = await this.$refs.refEspecie.validate();

            if (resul.valid) {
                this.overlay = true;
                axios.post('/colaborador/editarEspecie', {
                    id: this.idItem,
                    nombre: this.nombre,
                    descripcion: this.descripcion,
                }).then(res => {
                    this.overlay = false;
                    if (res.data.status === 'ok') {
                        this.dialogEspecies = false;
                        Swal.fire({
                            icon: 'success',
                            text: '¡Registro modificado exitosamente!'
                        });
                        this.getData();
                    }
                    else {
                        this.dialogEspecies = false;
                        Swal.fire({
                            icon: 'error',
                            text: 'Ha ocurrido un error al modificar el registro. Intente de nuevo.'
                        });
                    }
                })
            }
        },

        eliminarEspecie(item) {
            Swal.fire({
                icon: 'warning',
                text: '¿Esta seguro de eliminar el registro?',
                showCancelButton: true,
                confirmButtonText: 'Si',
                cancelButtonText: 'No'
            }).then(result => {
                if(result.isConfirmed) {
                    this.overlay = true;

                    axios.post('/colaborador/eliminarEspecie', {
                        id: item.id
                    }).then(res => {
                        this.overlay = false;
                        if(res.data.status === 'ok') {
                            Swal.fire({
                                icon: 'success',
                                text: '¡Registro eliminado exitosamente!'
                            })
                        }
                        else {
                            Swal.fire({
                            icon: 'error',
                            text: 'Ha ocurrido un error al eliminar el registro. Intente de nuevo.'
                        });
                        }
                    })
                    this.getData();
                }
            })
        }
    },

    mounted() {
        this.getData();
    },
}
</script>
<style>
.v-text-field .v-field--active input,
.v-select .v-field .v-field__input>input {
    border: none;
}
</style>