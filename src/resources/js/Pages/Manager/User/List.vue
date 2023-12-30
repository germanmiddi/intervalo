<template>
    <App>
        <!-- CONTENT -->
        <div class="flex-grow flex flex-col">
            <div class="w-11/12 mx-auto flex justify-between items-center">
                <h1 class="my-5 text-4xl font-bold">Usuarios</h1>
                <div>
                    <a class="btn btn-primary btn-sm" @click="open=true">Nuevo</a>
                </div>
            </div>
            <hr>
            <div class="w-11/12 mx-auto mt-4">
                <div class="shadow sm:rounded-md sm:overflow-hidden">
                    <div class="bg-white py-6 px-4 space-y-6 sm:p-6">
                        <div class="flex items-center justify-between flex-wrap sm:flex-nowrap ">
                            <div class="flex">
                                <h3 class="text-lg leading-6 font-medium text-gray-900">Filtro</h3>
                            </div>
                            <div class="flex mt-4 sm:mt-0">
                            
                            <div>
                                <button v-if="Object.keys(this.filter).length" class="text-xs font-medium text-gray-500 hover:text-gray-700 mr-2" 
                                    @click="clearFilter">Limpiar Filtro</button>
                                <button type="button"
                                    class="btn btn-primary btn-outline btn-sm mr-4" @click="getTramites()">Aplicar Filtro</button>
                            </div>
                            <div>
                                <label class="font-semibold mr-2" for="">Ver: </label>
                                <select class="text-sm border-gray-300 rounded-md" v-model="length" @change="getUser">
                                    <option value="10">10</option>
                                    <option value="20">20</option>
                                    <option value="30">30</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                </select>
                            </div>
                        </div>
                        </div>
                        <div class="grid grid-cols-12 gap-6">
                            <div class="col-span-12 sm:col-span-3 ">
                                <input v-model="filter.name" type="text" name="name" id="name" autocomplete="name-level2" placeholder="Buscar Nombre."
                                    class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" />
                            </div>
                            <div class="col-span-12 sm:col-span-3 ">
                                <input v-model="filter.email" type="text" name="email" id="email" autocomplete="name-level2" placeholder="Buscar Email."
                                    class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="w-11/12 mx-auto mt-4">
                <table class="table w-full">
                    <thead>
                        <tr>
                            <th class="px-6 py-4 text-center">ID</th>
                            <th class="px-6 py-4 text-center">Nombre</th>
                            <th class="px-6 py-4 text-center">Email</th>
                            <th class="px-6 py-4 text-center">Empresa</th>
                            <th class="px-6 py-4 text-center">Rol</th>
                            <th class="px-6 py-4 text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                    <!-- row 1 -->
                        <tr v-for="u in users.data" :key="u.id" class="bg-white hover:bg-gray-50 border-b border-gray-100 ">
                            <td class="w-1/12 text-center">
                                {{u.id}}
                            </td>
                            <td class="w-3/12 text-center">
                                {{u.name}}
                            </td>
                            <td class="w-2/12 text-center">
                                {{u.email}}
                            </td>
                            <td class="w-2/12 text-center">
                                {{u.empresa.description ?? '-'}}
                            </td>
                            <td class="w-2/12 text-center">
                               {{u.rol.name ?? '-'}}
                            </td>
                            <td class="w-2/12 text-center">
                                <button class="ml-2" @click="this.open = true, this.form = u">
                                    <Icons class="w-5 h-5" name="details" />
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

           <div class="w-11/12 mx-auto my-5 flex justify-between items-center">
                <div>
                    Mostrando: {{this.users.from}} a {{this.users.to}} - Entradas encontradas: {{this.users.total}}
                </div>
                <div class="flex flex-wrap -mb-1">
                    <div v-for="link in users.links" :key="link.id">
                        <div v-if="link.url === null" class="mr-1 mb-1 px-4 py-3 text-sm leading-4 text-gray-400 border rounded-md" v-html="link.label"> </div>
                        <div v-else 
                            class="mr-1 mb-1 px-4 py-3 text-sm leading-4 border border-gray-300 rounded-md hover:bg-blue-500 hover:text-white cursor-pointer" 
                            :class="{ 'bg-blue-500': link.active },{ 'text-white': link.active }" 
                            @click="getUserPaginate(link.url)"
                            v-html="link.label"> </div>
                    </div> 
                </div>   
            </div>      
        </div>

        <!-- / CONTENT -->

        <!-- MANEJO DE ALTA DE USUARIO- -->
        <TransitionRoot as="template" :show="open">
            <Dialog as="div" class="fixed inset-0 overflow-hidden" @close="open = false">
                <div class="absolute inset-0 overflow-hidden">
                    <DialogOverlay class="absolute inset-0" />

                    <div class="fixed inset-y-0 pl-16 max-w-full right-0 flex">
                        <TransitionChild as="template"
                            enter="transform transition ease-in-out duration-500 sm:duration-700"
                            enter-from="translate-x-full" enter-to="translate-x-0"
                            leave="transform transition ease-in-out duration-500 sm:duration-700"
                            leave-from="translate-x-0" leave-to="translate-x-full">
                            <div class="w-screen max-w-md">
                                <form class="h-full divide-y divide-gray-200 flex flex-col bg-white shadow-xl"
                                    enctype="multipart/form-data">
                                    <div class="flex-1 h-0 overflow-y-auto">
                                        <div class="py-6 px-4 bg-blue-500 sm:px-6">
                                            <div class="flex items-center justify-between">
                                                <DialogTitle
                                                    class="text-lg font-medium text-white"> Nuevo Usuario
                                                </DialogTitle>
                                                <!-- <DialogTitle v-else class="text-lg font-medium text-white"> Editar
                                                    Capsula
                                                </DialogTitle> -->
                                                <div class="ml-3 h-7 flex items-center">
                                                    <button type="button"
                                                        class="bg-blue-500 rounded-md text-indigo-200 hover:text-white focus:outline-none focus:ring-2 focus:ring-white"
                                                        @click="open = false">
                                                        <span class="sr-only">Cerrar</span>
                                                        <Icons class="w-5 h-5" name="closed" />
                                                    </button>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="flex-1 flex flex-col justify-between">
                                            <div class="px-4 divide-y divide-gray-200 sm:px-6">

                                                <div class="space-y-2 pt-2 pb-5">
                                                    <div>
                                                        <label for="time"
                                                            class="block text-xl font-medium text-gray-700 "><b>Usuario: {{ form.description }}</b></label>
                                                    </div>
                                                    <hr>
                                                    <div class="flex text-sm text-gray-700">
                                                        <label class="text-bold w-24 font-bold">Dirección:</label>
                                                        <span>{{ form.address}}</span>
                                                    </div>
                                                    
                                                    <hr>
                                                    <div>
                                                        <label for="time"
                                                            class="block text-xl font-medium text-gray-800">Datos de Contacto</label>
                                                    </div>

                                                    <div class="flex text-sm text-gray-700">
                                                        <label class="text-bold w-24 font-bold">Nombre:</label>
                                                        <span>{{  form.contact_name ?? '-'  }}</span>
                                                    </div>

                                                    <div class="flex text-sm text-gray-700">
                                                        <label class="text-bold w-24 font-bold">Email:</label>
                                                        <span>{{  form.contact_email ?? '-'  }}</span>
                                                    </div>

                                                    <div class="flex text-sm text-gray-700">
                                                        <label class="text-bold w-24 font-bold">Telefono:</label>
                                                        <span>{{  form.contact_phone ?? '-'  }}</span>
                                                    </div>

                                                    <hr>
                                                    <div>
                                                        <label for="time"
                                                            class="block text-xl font-medium text-gray-800">Competencias</label>
                                                    </div>
                                                    <hr>

                                                    <div v-for="c in this.form.competencias" :key="c.id" class="inline-flex items-center rounded-md bg-blue-50 px-2 py-1 text-xs font-medium text-blue-700 ring-1 ring-inset ring-blue-700/10 mr-2">
                                                        {{ c.competencia}}
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                        <!-- <div class="flex-1 flex flex-col justify-between">
                                            <div class="px-4 divide-y divide-gray-200 sm:px-6">

                                                <div class="space-y-6 pt-6 pb-5">
                                                    <div>
                                                        <label for="fullname"
                                                            class="block text-sm font-medium text-gray-900">Titulo</label>
                                                        <div class="mt-1">
                                                            <input type="text" v-model="user.name" name="name" autocomplete="off"
                                                                id="titulo"
                                                                class="block w-full shadow-sm sm:text-sm focus:ring-indigo-500 focus:border-indigo-500 border-gray-300 rounded-md" />
                                                        </div>
                                                    </div>

                                                    <div>
                                                        <label for="url"
                                                            class="block text-sm font-medium text-gray-900">Email</label>
                                                        <div class="mt-1">
                                                            <input type="text" name="email" v-model="user.email" id="email" autocomplete="off"
                                                                class="block w-full shadow-sm sm:text-sm focus:ring-indigo-500 focus:border-indigo-500 border-gray-300 rounded-md" />
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <label for="rol"
                                                            class="block text-sm font-medium text-gray-900">Rol</label>
                                                        <div class="mt-1">
                                                            <select class="block w-full shadow-sm sm:text-sm focus:ring-indigo-500 focus:border-indigo-500 border-gray-300 rounded-md" v-model="user.rol" name="rol" id="rol">
                                                                <option value="" disabled selected>Seleccione un rol</option>
                                                                <option v-for="r in roles" :key="r.id" :value="r.id">{{r.name}}</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <label for="rol"
                                                            class="block text-sm font-medium text-gray-900">Empresa</label>
                                                        <div class="mt-1">
                                                            <select class="block w-full shadow-sm sm:text-sm focus:ring-indigo-500 focus:border-indigo-500 border-gray-300 rounded-md" v-model="user.companie" name="rol" id="rol">
                                                                <option value="" disabled selected>Seleccione una empresa</option>
                                                                <option v-for="e in empresas" :key="e.id" :value="e.id">{{e.description}}</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> -->
                                    </div>
                                    <div class="flex-shrink-0 px-4 py-4 flex justify-end">
                                        <button type="button"
                                            class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                                            @click="open = false">Cancelar</button>
                                        <button @click.prevent="guardarCapsule"
                                            class="ml-4 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">Guardar</button>
                                    </div>
                                </form>
                            </div>
                        </TransitionChild>
                    </div>
                </div>
            </Dialog>
        </TransitionRoot>

   </App>
  
</template>

<script>
    import { Head, Link } from '@inertiajs/inertia-vue3';
    import App from '@/Layouts/App.vue'
    import Pageheader from '@/Layouts/Pageheader.vue'
    import Pagination from '@/Layouts/Pagination'
    import Icons from '@/Layouts/Components/Icons.vue'    
    import { Dialog, DialogOverlay, DialogTitle, TransitionChild, TransitionRoot } from '@headlessui/vue'

    export default {
        props:{
             roles: Object,
             empresas: Object,
        },
        components: {
            App,
            Icons,
            Link,
            Pagination,
            Dialog,
        DialogOverlay,
        DialogTitle,
        TransitionChild,
        TransitionRoot,
        },

        data(){
            return{
                loading: true,
                length:   "10",
                search: "",
                users:"",
                filter: {},
                open: false,
                user: {},
                // nextpage: "",
                // prevpage: "",                
                
            }
        },
        methods:{
            clearFilter(){
                this.filter = {}
                this.getUser()
            },
            async getUser(){

                let filter = `&length=${this.length}` 
                
                if(this.search){
                    filter += `&search=${this.search}`
                }

                const get = `${route('user.list')}?${filter}` 

                const response = await fetch(get, {method:'GET'})
                this.users = await response.json() 
            },

            async getUserPaginate(link){

                var get = `${link}`;
                const response = await fetch(get,{method: 'GET'})

                this.users = await response.json()
                // this.nextpage = this.afirmaciones.next_page_url
                // this.prevpage = this.afirmaciones.prev_page_url
                console.log(this.users)   

            },
            recoverPassword(email) {
                email = 'skiebah@gmail.com'
                axios.post('/forgot-password', {
    email: email
  })
  .then(response => {
    // Manejar la respuesta exitosa aquí
    console.log('Correo de restablecimiento enviado');
  })
  .catch(error => {
    // Manejar cualquier error aquí
    console.error('Error al enviar el correo de restablecimiento', error);
  });
            },         

        },
        created(){
            this.getUser()

        }        
    }

</script>

<style>
    .dropdown:hover .dropdown-menu {
        display: block;
        z-index: 999;
    }

    ul.dropdown-menu {
        right: 0px;
    }

</style>