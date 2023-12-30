<template>
    <div v-if="this.companies.length > 0">
            <!-- <div class="w-11/12 mx-auto mt-4">
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
                                    class="btn btn-primary btn-outline btn-sm mr-4" @click="getCompanie()">Aplicar Filtro</button>
                            </div>
                            <div>
                                <label class="font-semibold mr-2" for="">Ver: </label>
                                <select class="text-sm border-gray-300 rounded-md" v-model="length" @change="getCompanie">
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
                                <input v-model="filter.description" type="text" name="name" id="name" autocomplete="name-level2" placeholder="Buscar Empresa."
                                    class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" />
                            </div>
                            <div class="col-span-12 sm:col-span-3 ">
                                <input v-model="filter.contact" type="text" name="email" id="email" autocomplete="name-level2" placeholder="Buscar Contacto."
                                    class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" />
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->

            <div class="w-full mx-auto mt-4">
                <table class="table w-full">
                    <thead>
                        <tr>
                            <th class="px-6 py-4 text-center">Nombre</th>
                            <th class="px-6 py-4 text-center">Email</th>
                            <th class="px-6 py-4 text-center">Empresa</th>
                            <th class="px-6 py-4 text-center">Rol</th>
                            <th class="px-6 py-4 text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                    <!-- row 1 -->
                        <tr v-for="c in companies.data" :key="c.id" class="bg-white hover:bg-gray-50 border-b border-gray-100 ">
                            <td class="w-3/13 text-center">
                                {{c.name}}
                            </td>
                            <td class="w-2/13 text-center">
                                {{c.email ?? '-'}}
                            </td>
                            <td class="w-2/13 text-center">
                                {{c.contact_email ?? '-'}}
                            </td>
                            <td class="w-1/13 text-center">
                                {{c.contact_email ?? '-'}}
                            </td>
                            <td class="w-2/13 text-center">
                                <!-- <a :href="route('companie.edit', c.id)" title="Editar Empresa">
                                    <Icons class="w-5 h-5 inline" name="edit" />
                                </a>
                                <a class="ml-2" @click="this.form = c, this.editing = true, this.open = true" title="Detalle Empresa">
                                    <Icons class="w-5 h-5 inline" name="details" />
                                </a>
                                <a class="ml-2" v-if="c.active == 1" @click="this.companie = c, this.openDelete = true" title="Deshabilitar Empresa" >
                                    <Icons class="w-5 h-5 inline text-red-500" name="circle-down" />
                                </a>
                                <a class="ml-2" v-else @click="this.companie = c, this.openDelete = true" title="Habilitar Empresa">
                                    <Icons class="w-5 h-5 inline text-green-500" name="circle-up" />
                                </a> -->
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

           <div class="w-11/12 mx-auto my-5 flex justify-between items-center">
                <div>
                    Mostrando: {{this.companies.from}} a {{this.companies.to}} - Entradas encontradas: {{this.companies.total}}
                </div>
                <div class="flex flex-wrap -mb-1">
                    <div v-for="link in companies.links" :key="link.id">
                        <div v-if="link.url === null" class="mr-1 mb-1 px-4 py-3 text-sm leading-4 text-gray-400 border rounded-md" v-html="link.label"> </div>
                        <div v-else 
                            class="mr-1 mb-1 px-4 py-3 text-sm leading-4 border border-gray-300 rounded-md hover:bg-blue-500 hover:text-white cursor-pointer" 
                            :class="{ 'bg-blue-500': link.active },{ 'text-white': link.active }" 
                            @click="getUserCompaniePaginate(link.url)"
                            v-html="link.label"> </div>
                    </div> 
                </div>   
            </div>      
        </div>
        <div v-else>
            Sin datos
        </div>
</template>

<script>
    import { Head, Link } from '@inertiajs/inertia-vue3';
    import App from '@/Layouts/App.vue'
    import Pageheader from '@/Layouts/Pageheader.vue'
    import Pagination from '@/Layouts/Pagination'
    import Icons from '@/Layouts/Components/Icons.vue'    
    import Toast from '@/Layouts/Components/Toast.vue'
    import { Dialog, DialogOverlay, DialogTitle, TransitionChild, TransitionRoot } from '@headlessui/vue'

    export default {
        props:{
             toast: Object,
             idCompany: Number
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
            Toast,
        },

        data(){
            return{
                loading: true,
                length:   "10",
                search: "",
                companies:"",
                companie: "",
                filter: {},
                open: false,
                editing: false,
                openDelete: false,
                user: {},
                form: {},
                showToast: false,
                message: "",
                labelType: "success"               
            }
        },
        methods:{
            clearFilter(){
                this.filter = {}
                this.getUserCompanie()
            },
            async getUserCompanie(){

                let filter = `&length=${this.length}` 
                
                /* if(this.filter.description){
                    filter += `&description=${this.filter.description}`
                }

                if(this.filter.contact){
                    filter += `&contact=${this.filter.contact}`
                } */

                const get = `${route('companie.listUserByCompanie', this.idCompany)}?${filter}` 

                const response = await fetch(get, {method:'GET'})
                this.companies = await response.json() 
            },

            async getUserCompaniePaginate(link){

                var get = `${link}`;
                const response = await fetch(get,{method: 'GET'})

                this.companies = await response.json()  
            },
        },
        created(){
        },
        mounted(){
            this.getUserCompanie()
            if(this.toast){
                if(this.toast.status == 200){
                    this.labelType = "success"
                    this.message = this.toast.message
                }else{
                    this.labelType = "danger"
                    this.message = this.toast.message
                }
            }
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