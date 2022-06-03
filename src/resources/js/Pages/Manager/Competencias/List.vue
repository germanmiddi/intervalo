<template>
    <App>
        <div class="flex-grow flex flex-col">
            <div class="w-11/12 mx-auto flex justify-between items-center">
                <h1 class="my-10 text-4xl font-bold">Competencias</h1>
                <div>
                    <a class="btn btn-primary" :href="route('competencia.create')">Crear</a>
                </div>
            </div>

            <div class="w-11/12 mx-auto">
                <table class="table w-full">
                    <!-- head -->
                    <thead>
                        <tr>
                            <th class="w-1/5 " >Competencia</th>
                            <th class="w-3/5 px-6 py-4 text-center">Resumen</th>
                            <th class="w-1/5 px-6 py-4 text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                    <!-- row 1 -->
                    <tr v-for="a in competencias.data" :key="a.id" class="hover">
                        <td class="" >{{a.id}} - {{a.competencia}}</td>
                        <td class="" >{{a.resume}}</td>
                        <td class="text-center flex justify-center items-center">
                            <a class="link" :href="route('competencia.edit', a.id)">Detalle </a>
                            <button class="ml-2"> <Icons class="w-5 h-5" name="trash" />   </button>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>

        </div>
  </App>
</template>

<script>
    import { Head, Link } from '@inertiajs/inertia-vue3';
    import App from '@/Layouts/App.vue'
    import Pageheader from '@/Layouts/Pageheader.vue'
    import Pagination from '@/Layouts/Pagination'
    import Icons from '@/Layouts/Components/Icons.vue'    

    export default {
        props:{
            competencias: Object
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