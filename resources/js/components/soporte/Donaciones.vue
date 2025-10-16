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
        <v-data-table :headers="headers" :items="itemsDonaciones" :search="search">
            <template v-slot:item.actions="{ item }">
                <v-row class="justify-center align-center">
                    <v-col class="col-6">
                        <v-tooltip>
                            <template v-slot:activator="{ props }">
                                <v-icon size="x-large" class="mr-2" @click="editarDonaciones(item)" color="success"
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
                                <v-icon size="x-large" class="mr-2" @click="eliminarDonacion(item)" color="danger"
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

    <v-dialog v-model="dialogoDonaciones" max-width="60%" transition="dialog-top-transition" persistent>
        <v-card class="pa-6 rounded-lg elevation-12">
            <!-- Encabezado -->
            <v-toolbar color="primary" dark flat class="rounded-lg mb-4">
                <v-toolbar-title class="text-center w-100 text-h6 font-weight-bold">
                    {{ titleDialogo }}
                </v-toolbar-title>
            </v-toolbar>

            <!-- Formulario -->
            <v-card-text>
                <v-form ref="refsCatGastos">
                    <v-row class="mb-4 justify-space-between" dense>
                        <v-col cols="6" md="6" class="justify-center">
                            <v-select v-model="data.donante" label="Donante" variant="outlined" rounded
                                :items="itemsDonantes" item-title="nombre" item-value="id" :rules="[...requiredRule]" />
                        </v-col>
                        <v-col cols="6" md="6">
                            <v-text-field v-model="data.monto" label="Monto" variant="outlined" rounded prefix="Q"
                                :rules="[...requiredRule]" />
                        </v-col>
                    </v-row>
                    <v-row class="mb-4 justify-space-between" dense>
                        <v-menu v-model="data.menu" transition="scale-transition" :close-on-content-click="false">
                            <template v-slot:activator="{ props }">
                                <v-text-field v-bind="props" rounded variant="outlined" class="custom-text-field"
                                    label="Fecha de donación" :rules="[...requiredRule]"
                                    v-model="computedFechaDonacion"></v-text-field>
                            </template>
                            <v-date-picker v-model="data.fecha" :max="dateNow"
                                @update:modelValue="data.menu = false"></v-date-picker>
                        </v-menu>
                        <v-col cols="6" md="6" class="justify-center">
                            <v-select v-model="data.metodoPago" label="Método de pago" variant="outlined" rounded
                                :items="itemsMetodosPago" item-title="nombre" item-value="id"
                                :rules="[...requiredRule]" />
                        </v-col>
                    </v-row>
                    <v-row class="mb-4 justify-space-between">
                        <v-col cols="12" md="12" class="justify-center">
                            <v-textarea rounded variant="outlined" v-model="data.comentario"
                                label="comentario"></v-textarea>
                        </v-col>
                    </v-row>

                    <!-- Botones -->
                    <v-row justify="center">
                        <v-col cols="12" md="6" class="d-flex justify-center gap-4">
                            <v-btn v-if="banderaDialogo == 1" color="success" @click.prevent="guardarDonaciones()"
                                rounded>
                                <v-icon start icon="mdi-content-save" />
                                Guardar
                            </v-btn>
                            <v-btn v-if="banderaDialogo == 2" color="success" @click.prevent="editaqrSaveDonaciones()"
                                rounded>
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
    name: 'Donaciones',

    data() {
        return {
            overlay: false,
            search: '',
            dialogoDonaciones: false,
            titleDialogo: '',
            idItem: null,
            data: {
                donante: null,
                monto: '',
                fecha: (new Date(Date.now() - (new Date()).getTimezoneOffset() * 60000)),
                metodoPago: null,
                comentario: '',
                menu: false,
            },
            banderaDialogo: null,

            headers: [
                { title: 'ID', value: 'id' },
                { title: 'DONANTE', value: 'nombreDonante' },
                { title: 'MONTO', value: 'monto' },
                { title: 'FECHA', value: 'fecha' },
                { title: 'MÉTODO DE PAGO', value: 'metodoPago' },
                { title: 'COMENTARIO', value: 'comentario' },
                { title: 'USUARIO', value: 'nombreUsuario' },
                { title: 'ACCIONES', value: 'actions', align: 'center' },
            ],
            itemsDonaciones: [],
            itemsDonantes: [],
            itemsMetodosPago: [],

            dateNow: (new Date(Date.now() - (new Date()).getTimezoneOffset() * 60000)).toISOString().substr(0, 10),

            //Reglas
            requiredRule: [v => !!v || 'Campo obligatorio'],
        }
    },

    methods: {
        getData() {
            axios.get('/colaborador/getDonaciones')
                .then(response => {
                    this.itemsDonaciones = response.data.donaciones;
                    this.itemsDonantes = response.data.donantes.original.donantes;
                    this.itemsMetodosPago = response.data.metodosPago;
                })
        },

        openDialog() {
            this.overlay = true;
            this.titleDialogo = "Agregar Donaciones";
            this.banderaDialogo = 1;
            this.dialogoDonaciones = true;
            this.overlay = false;
        },

        closeDialog() {
            this.overlay = true;
            this.dialogoDonaciones = false;
            this.overlay = false;
            // this.idItem = null;
            if (this.$refs.refsCatGastos) this.$refs.refsCatGastos.reset();
        },

        async guardarDonaciones() {

            const resul = await this.$refs.refsCatGastos.validate();

            if (resul.valid) {
                this.overlay = true;
                axios.post('/colaborador/guardarDonaciones', {
                    data: this.data,
                }).then(res => {
                    this.overlay = false;
                    if (res.data.status === 'ok') {
                        this.dialogoDonaciones = false;
                        Swal.fire({
                            icon: 'success',
                            text: '¡Registro guardado exitosamente!'
                        });
                        this.getData();
                    }
                    else {
                        this.dialogoDonaciones = false;
                        Swal.fire({
                            icon: 'error',
                            text: 'Ha ocurrido un error al guardar el registro. Intente de nuevo.'
                        });
                    }
                })
            }
        },

        editarDonaciones(item) {
            console.log('item ', item);
            this.overlay = true;
            this.idItem = item.id;
            this.data.donante = item.idDonante;
            this.data.monto = item.monto;
            // this.data.fecha = new Date(item.fecha);
            const [year, month, day] = item.fecha.split('-');
            this.data.fecha = new Date(
                parseInt(year),
                parseInt(month) - 1, // Los meses en JS van de 0 a 11
                parseInt(day)
            );
            this.data.metodoPago = item.metodoPagoId;
            this.data.comentario = item.comentario;
            this.titleDialogo = 'Editar Donación';
            this.banderaDialogo = 2;
            this.dialogoDonaciones = true;
            this.overlay = false;
        },

        async editaqrSaveDonaciones() {
            const resul = await this.$refs.refsCatGastos.validate();

            if (resul.valid) {
                this.overlay = true;
                axios.post('/colaborador/editarDonaciones', {
                    id: this.idItem,
                    data: this.data,
                }).then(res => {
                    this.overlay = false;
                    if (res.data.status === 'ok') {
                        this.dialogoDonaciones = false;
                        Swal.fire({
                            icon: 'success',
                            text: '¡Registro modificado exitosamente!'
                        });
                        this.getData();
                    }
                    else {
                        this.dialogoDonaciones = false;
                        Swal.fire({
                            icon: 'error',
                            text: 'Ha ocurrido un error al modificar el registro. Intente de nuevo.'
                        });
                    }
                })
            }
        },

        eliminarDonacion(item) {
            Swal.fire({
                icon: 'warning',
                text: '¿Esta seguro de eliminar el registro?',
                showCancelButton: true,
                confirmButtonText: 'Si',
                cancelButtonText: 'No'
            }).then(result => {
                if (result.isConfirmed) {
                    this.overlay = true;

                    axios.post('/colaborador/eliminarDonacion', {
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
        computedFechaDonacion() {
            return this.formatoFecha(this.data.fecha);
        },
    }
}
</script>
<style>
.v-text-field .v-field--active input,
.v-select .v-field .v-field__input>input {
    border: none;
}
</style>