<template>
    <App>
        <!-- CONTENT -->
        <div class="focus-within:content flex-grow flex flex-col">
            <div class="w-11/12 mx-auto flex justify-between items-center">
                <h1 class="my-10 text-4xl font-bold">Capsulas</h1>
                <div>
                    <Link :href="route('capsule.create')">Crear</Link>
                </div>
            </div>
            <div class="card mx-auto 
                             xl: w-11/12
                             lg: w-11/12">
                <div class="bg-white rounded-md shadow overflow-x-auto">    
                    <table class="w-full whitespace-nowrap">
                        <tr class="text-left font-bold bg-blue-500 text-white">
                            <!-- <th class="px-6 py-4 text-center">ID</th> -->
                            <th class="px-6 py-4 text-center">Titulo</th>
                            <th class="px-6 py-4 text-center">Descripción</th>
                            <th class="px-6 py-4 text-center">Imagen</th>
                            <th class="px-6 py-4 text-center">Acciones</th>
                        </tr>
                        <!-- {{orders.items}} -->
                         <tr v-for="c in capsules.data" :key="c.id" class="hover:bg-gray-50">
                            <td class="border-t px-6 py-4 text-center">{{c.title}}</td>
                            <td class="border-t px-6 py-4 text-center">{{c.description}}</td>
                            <td class="border-t px-6 py-4 text-center">{{c.image}}</td>
                            <td class="border-t px-6 py-4 text-center">
                                <div class="flex">
                                    <Link class="hover:text-blue-500"  tabindex="-1" >Detalle</Link>                                    

                                </div>
                               
                            </td>
                        </tr> 
                    </table>
                </div>
            </div>
        </div>

        <!-- / CONTENT -->
   </App>
  
</template>

<script>
    import { Head, Link } from '@inertiajs/inertia-vue3';
    import App from '@/Layouts/App.vue'
    import Icons from '@/Layouts/Components/Icons.vue'    

    export default {
        props:{
            capsules: Object
        },
        components: {
            App,
            Icons,
            Link
        },

        data(){
            return{
                loading: true
                
            }
        },
        methods:{

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