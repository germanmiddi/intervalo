<template>
    <App>

        <div class="flex-grow flex flex-col">
            <div class="w-11/12 mx-auto flex justify-between items-center">
                <h1 class="my-10 text-4xl font-bold">Cápsulas</h1>
                <div>
                    <a class="btn btn-primary" :href="route('capsule.create')">Crear</a>
                </div>
            </div>

            <div class="w-11/12 mx-auto">
                <table class="table w-full">
                    <thead>
                        <tr>
                            <th class="w-1/5">Título</th>
                            <th class="w-3/5 px-6 py-4 text-center">Descripción</th>
                            <th class="w-1/5 px-6 py-4 text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="c in capsules.data" :key="c.id" class="hover">
                            <td class="" >{{c.id}} - {{c.title}}</td>
                            <td class="" >{{c.description}}</td>
                            <td class="text-center flex justify-center items-center">
                                <a class="link" :href="route('capsule.edit', c.id)">Detalle</a>
                                <button class="ml-2"> <Icons class="w-5 h-5" name="trash" /></button>
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