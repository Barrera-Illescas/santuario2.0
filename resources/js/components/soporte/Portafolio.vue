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
        <v-data-table :headers="headers" :items="itemsPOrtafolio" :search="search">
            <template v-slot:item.imagen="{ item }">
                <v-img :src="`/portafolio/${item.imagen_url}`" max-width="100" max-height="100" contain
                    class="rounded"></v-img>
            </template>
            <template v-slot:item.estado="{ item }">
                <span>{{ item.estado === 1 ? 'Activo' : 'Inactivo' }}</span>
            </template>
            <template v-slot:item.actions="{ item }">
                <v-row class="justify-center align-center">
                    <v-col class="col-6">
                        <v-tooltip>
                            <template v-slot:activator="{ props }">
                                <v-icon size="x-large" class="mr-2" @click="editarPortafolio(item)" color="success"
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
                                <v-icon size="x-large" class="mr-2" @click="deshabilitarPortafolio(item)" color="danger"
                                    v-bind="props">
                                    mdi mdi-publish-off
                                </v-icon>
                            </template>
                            <span>Deshabilitar</span>
                        </v-tooltip>
                    </v-col>
                </v-row>
            </template>
        </v-data-table>
    </div>

    <v-dialog v-model="dialogoPortafolio" max-width="60%" transition="dialog-top-transition" persistent>
        <v-card class="pa-6 rounded-lg elevation-12">
            <!-- Encabezado -->
            <v-toolbar color="primary" dark flat class="rounded-lg mb-4">
                <v-toolbar-title class="text-center w-100 text-h6 font-weight-bold">
                    {{ titleDialogo }}
                </v-toolbar-title>
            </v-toolbar>

            <!-- Formulario -->
            <v-card-text>
                <v-form ref="refsPortafolio">
                    <v-row class="mb-4 justify-space-between" dense>
                        <v-col cols="6" md="6" class="justify-center">
                            <v-text-field v-model="data.titulo" label="Titulo" variant="outlined" rounded
                                :rules="[...requiredRule]" />
                        </v-col>
                        <v-col cols="6" md="6">
                            <v-text-field v-model="data.subtitulo" label="Subtitulo" variant="outlined" rounded />
                        </v-col>
                    </v-row>
                    <v-row class="mb-4 justify-space-between" dense>
                        <v-col cols="6" md="6" class="justify-center">
                            <v-file-input label="Subir imagen" v-model="data.imagen"
                                accept="image/png, image/jpeg, image/jpg, image/gif, image/webp" variant="outlined"
                                rounded prepend-icon="mdi-image"></v-file-input>
                        </v-col>
                        <v-col cols="6" md="6" class="justify-center">
                            <v-select v-model="data.categoria" label="Categoría" variant="outlined" rounded
                                :items="itemsCategoria" item-title="nombre" item-value="id"
                                :rules="[...requiredRule]" />
                        </v-col>
                    </v-row>
                    <v-row class="mb-4 justify-space-between">
                        <v-col cols="12" md="12" class="justify-center">
                            <v-textarea rounded variant="outlined" v-model="data.descripcion"
                                label="Descripción"></v-textarea>
                        </v-col>
                    </v-row>

                    <!-- Botones -->
                    <v-row justify="center">
                        <v-col cols="12" md="6" class="d-flex justify-center gap-4">
                            <v-btn v-if="banderaDialogo == 1" color="success" @click.prevent="guardarPortafolio()"
                                rounded>
                                <v-icon start icon="mdi-content-save" />
                                Guardar
                            </v-btn>
                            <v-btn v-if="banderaDialogo == 2" color="success" @click.prevent="editarSavePortafolio()"
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
            dialogoPortafolio: false,
            titleDialogo: '',
            idItem: null,
            data: {
                titulo: '',
                subtitulo: '',
                imagen: null,
                descripcion: '',
                categoria: null,
            },
            banderaDialogo: null,

            headers: [
                { title: 'ID', value: 'id' },
                { title: 'TITULO', value: 'titulo' },
                { title: 'SUBTITULO', value: 'subtitulo' },
                { title: 'IMAGEN', value: 'imagen' },
                { title: 'DESCRIPCIÓN', value: 'descripcion' },
                { title: 'CATEGORÍA', value: 'categoria' },
                { title: 'FECHA PUBLICACIÓN', value: 'fecha_publicacion' },
                { title: 'ESTADO', value: 'estado' },
                { title: 'USUARIO PUBLICACIÓN', value: 'nombreUsuario' },
                { title: 'ACCIONES', value: 'actions', align: 'center' },
            ],
            itemsPOrtafolio: [],
            itemsCategoria: [],

            //Reglas
            requiredRule: [v => !!v || 'Campo obligatorio'],
        }
    },

    methods: {
        getData() {
            axios.get('/colaborador/getPortafolio')
                .then(response => {
                    this.itemsPOrtafolio = response.data.portafolio;
                    this.itemsCategoria = response.data.catPortafolio.original.catPortafolio;
                })
        },

        openDialog() {
            this.overlay = true;
            this.titleDialogo = "Agregar Publicación";
            this.banderaDialogo = 1;
            this.dialogoPortafolio = true;
            this.overlay = false;
        },

        closeDialog() {
            this.overlay = true;
            this.dialogoPortafolio = false;
            this.overlay = false;
            // this.idItem = null;
            if (this.$refs.refsPortafolio) this.$refs.refsPortafolio.reset();
        },

        async guardarPortafolio() {
            const resul = await this.$refs.refsPortafolio.validate();
            console.log(this.data.imagen);
            console.log(this.data.imagen instanceof File); // debe ser true



            if (resul.valid) {
                this.overlay = true;

                const formData = new FormData();
                formData.append('titulo', this.data.titulo);
                formData.append('subtitulo', this.data.subtitulo);
                formData.append('categoria', this.data.categoria);
                formData.append('descripcion', this.data.descripcion);
                formData.append('imagen', this.data.imagen); // archivo de imagen

                axios.post('/colaborador/guardarPortafolio', formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                }).then(res => {
                    this.overlay = false;
                    if (res.data.status === 'ok') {
                        this.dialogoPortafolio = false;
                        Swal.fire({
                            icon: 'success',
                            text: '¡Registro guardado exitosamente!'
                        });
                        this.getData();
                    } else {
                        this.dialogoPortafolio = false;
                        Swal.fire({
                            icon: 'error',
                            text: 'Ha ocurrido un error al guardar el registro. Intente de nuevo.'
                        });
                    }
                });
            }
        },

        editarPortafolio(item) {
            console.log('item', item);
            this.overlay = true;

            this.idItem = item.id;
            this.data.titulo = item.titulo;
            this.data.subtitulo = item.subtitulo;
            this.data.descripcion = item.descripcion;
            this.data.categoria = item.categoria_id;
            this.data.imagen = null;

            this.titleDialogo = 'Editar Portafolio';
            this.banderaDialogo = 2;
            this.dialogoPortafolio = true;
            this.overlay = false;
        },
        async editarSavePortafolio() {
            const resul = await this.$refs.refsPortafolio.validate();

            if (resul.valid) {
                this.overlay = true;

                const formData = new FormData();
                formData.append('id', this.idItem);
                formData.append('titulo', this.data.titulo);
                formData.append('subtitulo', this.data.subtitulo);
                formData.append('descripcion', this.data.descripcion);
                formData.append('categoria', this.data.categoria);

                // Solo enviar imagen si se ha cargado una nueva
                if (this.data.imagen) {
                    formData.append('imagen', this.data.imagen);
                }

                axios.post('/colaborador/editarPortafolio', formData)
                    .then(res => {
                        this.overlay = false;
                        if (res.data.status === 'ok') {
                            this.dialogoPortafolio = false;
                            Swal.fire({
                                icon: 'success',
                                text: '¡Registro modificado exitosamente!'
                            });
                            this.getData();
                        } else {
                            this.dialogoPortafolio = false;
                            Swal.fire({
                                icon: 'error',
                                text: 'Ha ocurrido un error al modificar el registro. Intente de nuevo.'
                            });
                        }
                    })
                    .catch(() => {
                        this.overlay = false;
                        Swal.fire({
                            icon: 'error',
                            text: 'Error de conexión al modificar el registro.'
                        });
                    });
            }
        },

        deshabilitarPortafolio(item) {
            Swal.fire({
                icon: 'warning',
                text: '¿Esta seguro de deshabilitar el registro?',
                showCancelButton: true,
                confirmButtonText: 'Si',
                cancelButtonText: 'No'
            }).then(result => {
                if (result.isConfirmed) {
                    this.overlay = true;

                    axios.post('/colaborador/deshabilitarPortafolio', {
                        id: item.id
                    }).then(res => {
                        this.overlay = false;
                        if (res.data.status === 'ok') {
                            Swal.fire({
                                icon: 'success',
                                text: '¡Registro deshabilitado exitosamente!'
                            })
                        }
                        else {
                            Swal.fire({
                                icon: 'error',
                                text: 'Ha ocurrido un error al deshabilitar el registro. Intente de nuevo.'
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