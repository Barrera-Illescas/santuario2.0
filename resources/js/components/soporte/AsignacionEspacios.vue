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
        <v-data-table :headers="headers" :items="itemsCorrales" :search="search">
            <template v-slot:item.actions="{ item }">
                <v-row class="justify-center align-center">
                    <v-col class="col-6">
                        <v-tooltip>
                            <template v-slot:activator="{ props }">
                                <v-icon size="x-large" class="mr-2" @click="editarCorrales(item)" color="success"
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
                                <v-icon size="x-large" class="mr-2" @click="eliminarCorral(item)" color="danger"
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


    <v-dialog v-model="dialogoCorrales" max-width="60%" transition="dialog-top-transition" persistent>
        <v-card class="pa-6 rounded-lg elevation-12">
            <!-- Encabezado -->
            <v-toolbar color="primary" dark flat class="rounded-lg mb-4">
                <v-toolbar-title class="text-center w-100 text-h6 font-weight-bold">
                    {{ titleDialogo }}
                </v-toolbar-title>
            </v-toolbar>

            <!-- Formulario -->
            <v-card-text>
                <v-form ref="refsCorral">
                    <v-row class="mb-4" dense>
                        <v-col cols="12" md="6">
                            <v-text-field v-model="data.nombre" label="Nombre" variant="outlined" rounded
                                density="comfortable" :rules="requiredRule" />
                        </v-col>
                        <v-col cols="12" md="6">
                            <v-text-field v-model="data.edad" label="Edad" variant="outlined" rounded
                                density="comfortable" :rules="requiredRule" type="number" />
                        </v-col>
                    </v-row>

                    <v-row class="mb-4" dense>
                        <v-col cols="12" md="6">
                            <v-menu v-model="data.menu" transition="scale-transition" :close-on-content-click="false"
                                max-width="290px" min-width="290px">
                                <template v-slot:activator="{ props }">
                                    <v-text-field v-bind="props" v-model="computedFechaIngreso" label="Fecha de ingreso"
                                        variant="outlined" rounded density="comfortable" :rules="requiredRule"
                                        readonly />
                                </template>
                                <v-date-picker v-model="data.fechaIngreso" :max="dateNow"
                                    @update:modelValue="data.menu = false" />
                            </v-menu>
                        </v-col>

                        <v-col cols="12" md="6">
                            <v-select v-model="data.especie" :items="itemsEspecie" item-value="id" item-title="nombre"
                                label="Especie" variant="outlined" rounded density="comfortable"
                                :rules="requiredRule" />
                        </v-col>
                    </v-row>

                    <v-row class="mb-4" dense>
                        <v-col cols="12" md="6">
                            <v-select v-model="data.especioCorrales" :items="corralesFiltrados" item-value="id"
                                item-title="nombre" label="Corral" variant="outlined" rounded density="comfortable"
                                :rules="requiredRule" />
                        </v-col>
                    </v-row>

                    <!-- Botones -->
                    <v-row justify="center">
                        <v-col cols="12" md="6" class="d-flex justify-center gap-4">
                            <v-btn v-if="banderaDialogo === 1" color="success" @click.prevent="guardarLugar()" rounded>
                                <v-icon start icon="mdi-content-save" />
                                Guardar
                            </v-btn>
                            <v-btn v-if="banderaDialogo === 2" color="success" @click.prevent="edatarSaveLugares()"
                                rounded>
                                <v-icon start icon="mdi-content-save" />
                                Actualizar
                            </v-btn>
                            <v-btn class="bg-danger" @click="closeDialog()" rounded>
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
    name: 'Corrales',

    data() {
        return {
            overlay: false,
            search: '',
            dialogoCorrales: false,
            titleDialogo: '',
            idItem: null,
            data: {
                nombre: '',
                edad: null,
                fechaIngreso: (new Date(Date.now() - (new Date()).getTimezoneOffset() * 60000)),
                especie: null,
                especioCorrales: null,
                menu: false,
            },
            banderaDialogo: null,

            headers: [
                { title: 'ID', value: 'id' },
                { title: 'NOMBRE', value: 'nombre' },
                { title: 'EDAD', value: 'edad' },
                { title: 'FECHA DE INGRESO', value: 'fecha_ingreso' },
                { title: 'ESPECIE', value: 'especie' },
                { title: 'CORRAL', value: 'corral' },
                { title: 'ACCIONES', value: 'actions', align: 'center' },
            ],
            itemsCorrales: [],
            itemsEspecie: [],
            itemsLugares: [],

            dateNow: (new Date(Date.now() - (new Date()).getTimezoneOffset() * 60000)).toISOString().substr(0, 10),

            //Reglas
            requiredRule: [v => !!v || 'Campo obligatorio'],
        }
    },

    methods: {
        getData() {
            axios.get('/colaborador/getAsigacion')
                .then(response => {
                    this.itemsCorrales = response.data.asignacion;
                    this.itemsEspecie = response.data.especies.original.especies;
                    this.itemsLugares = response.data.corrales;
                })
        },

        openDialog() {
            this.overlay = true;
            this.titleDialogo = "Agregar Corral";
            this.banderaDialogo = 1;
            this.dialogoCorrales = true;
            this.overlay = false;
        },

        closeDialog() {
            this.overlay = true;
            this.dialogoCorrales = false;
            this.overlay = false;
            // this.idItem = null;
            if (this.$refs.refsCorral) this.$refs.refsCorral.reset();
        },

        async guardarCorrales() {

            const resul = await this.$refs.refsCorral.validate();

            if (resul.valid) {
                this.overlay = true;
                axios.post('/colaborador/guardarCorrales', {
                    data: this.data,
                }).then(res => {
                    this.overlay = false;
                    if (res.data.status === 'ok') {
                        this.dialogoCorrales = false;
                        Swal.fire({
                            icon: 'success',
                            text: '¡Registro guardado exitosamente!'
                        });
                        this.getData();
                    }
                    else {
                        this.dialogoCorrales = false;
                        Swal.fire({
                            icon: 'error',
                            text: 'Ha ocurrido un error al guardar el registro. Intente de nuevo.'
                        });
                    }
                })
            }
        },

        editarCorrales(item) {
            console.log('item ', item);
            this.overlay = true;
            this.idItem = item.id;
            this.data.nombre = item.nombre;
            this.data.capacidad = item.capacidad;
            this.data.ubicacion = item.ubicacion;
            this.data.especie = item.especieId;
            this.titleDialogo = 'Editar Corral';
            this.banderaDialogo = 2;
            this.dialogoCorrales = true;
            this.overlay = false;
        },

        async editarSaveCorrales() {
            const resul = await this.$refs.refsCorral.validate();

            if (resul.valid) {
                this.overlay = true;
                axios.post('/colaborador/editarCorrales', {
                    id: this.idItem,
                    data: this.data,
                }).then(res => {
                    this.overlay = false;
                    if (res.data.status === 'ok') {
                        this.dialogoCorrales = false;
                        Swal.fire({
                            icon: 'success',
                            text: '¡Registro modificado exitosamente!'
                        });
                        this.getData();
                    }
                    else {
                        this.dialogoCorrales = false;
                        Swal.fire({
                            icon: 'error',
                            text: 'Ha ocurrido un error al modificar el registro. Intente de nuevo.'
                        });
                    }
                })
            }
        },

        eliminarCorral(item) {
            Swal.fire({
                icon: 'warning',
                text: '¿Esta seguro de eliminar el registro?',
                showCancelButton: true,
                confirmButtonText: 'Si',
                cancelButtonText: 'No'
            }).then(result => {
                if (result.isConfirmed) {
                    this.overlay = true;

                    axios.post('/colaborador/eliminarCorral', {
                        id: item.id
                    }).then(res => {
                        this.overlay = false;
                        if (res.data.status === 'ok') {
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
        },
        formatoFecha(fecha) {
            if (!fecha) return null;
            const year = fecha.getFullYear();
            const month = String(fecha.getMonth() + 1).padStart(2, '0');
            const day = String(fecha.getDate()).padStart(2, '0');
            // const [year, month, day] = fecha.split('-');
            return `${day}/${month}/${year}`;
        },
    },

    mounted() {
        this.getData();
    },

    computed: {
        corralesFiltrados() {
            if (!this.data.especie) return [];
            return this.itemsLugares.filter(
                corral => corral.especie_id === this.data.especie
            );
        },


        computedFechaIngreso() {
            return this.formatoFecha(this.data.fechaIngreso);
        },
    }

}
</script>