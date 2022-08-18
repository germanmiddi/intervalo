<template>
    <App>
        <!-- CONTENT -->
        <div class="flex-grow flex flex-col">
            <div class="w-11/12 mx-auto flex justify-between items-center">
                <h1 class="my-10 text-4xl font-bold">Competencias</h1>
                <div>
                    <a class="btn btn-primary btn-sm mr-2" :href="route('competencia.import')">Importar</a>
                    <a class="btn btn-primary btn-sm" :href="route('competencia.create')">Nuevo</a>
                </div>
            </div>

            <div class="w-11/12 mx-auto my-2 flex justify-between align-middle">
                <div>
                    <label class="font-semibold mr-2" for="search">Buscar:</label>
                    <input class="input input-sm" type="text" id="search" v-model="search" placeholder="Buscar...">
                    <button class="ml-2 btn btn-primary btn-outline btn-sm" @click="getCompetencias">Buscar</button>
                </div>

                <div>
                    <label class="font-semibold mr-2" for="">Ver: </label>
                    <select class="text-sm border-gray-300 rounded-md" v-model="length" @change="getCompetencias">
                        <option value="10">10</option>
                        <option value="20">20</option>
                        <option value="30">30</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                </div>
            </div>

            <div class="w-11/12 mx-auto">
                <table class="table w-full">
                    <!-- head -->
                    <thead>
                        <tr>
                            <th>Afirmacion</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    <!-- row 1 -->
                    <tr v-for="a in competencias.data" :key="a.id" class="hover">
                        <td class="whitespace-normal" >{{a.competencia}}</td>
                        <td class="w-1/6 text-center">
                            <a :href="route('competencia.edit', a.id)">Detalle </a></td>
                    </tr>
                    </tbody>
                </table>
            </div>

           <div class="w-11/12 mx-auto my-5 flex justify-between items-center">
                <div>
                    Mostrando: {{this.competencias.from}} a {{this.competencias.to}} - Entradas encontradas: {{this.competencias.total}}
                </div>
                <div class="flex flex-wrap -mb-1">
                    <div v-for="link in competencias.links" :key="link.id">
                        <div v-if="link.url === null" class="mr-1 mb-1 px-4 py-3 text-sm leading-4 text-gray-400 border rounded-md" v-html="link.label"> </div>
                        <div v-else 
                            class="mr-1 mb-1 px-4 py-3 text-sm leading-4 border border-gray-300 rounded-md hover:bg-blue-500 hover:text-white cursor-pointer" 
                            :class="{ 'bg-blue-500': link.active },{ 'text-white': link.active }" 
                            @click="getCompetenciasPaginate(link.url)"
                            v-html="link.label"> </div>
                    </div>      
                </div>   
            </div>      
        </div>

        <!-- / CONTENT -->
   </App>
  
</template>

<script>
    import { Head, Link } from '@inertiajs/inertia-vue3';
    import App from '@/Layouts/App.vue'
    import Pageheader from '@/Layouts/Pageheader.vue'
    import Pagination from '@/Layouts/Pagination'
    import Icons from '@/Layouts/Components/Icons.vue'    

    export default {
        // props:{
        //     afirmaciones: Object
        // },
        components: {
            App,
            Icons,
            Link,
            Pagination
        },

        data(){
            return{
                loading: true,
                length:   "10",
                search: "",
                competencias:"",
                // nextpage: "",
                // prevpage: "",                
                
            }
        },
        methods:{
            async getCompetencias(){

                let filter = `&length=${this.length}` 
                
                if(this.search){
                    filter += `&search=${this.search}`
                }

                const get = `${route('competencia.list')}?${filter}` 

                const response = await fetch(get, {method:'GET'})
                this.competencias = await response.json() 
            },

            async getCompetenciasPaginate(link){

                var get = `${link}`;
                const response = await fetch(get,{method: 'GET'})

                this.competencias = await response.json()
                // this.nextpage = this.afirmaciones.next_page_url
                // this.prevpage = this.afirmaciones.prev_page_url
                console.log(this.competencias)   

            },            

        },
        created(){
            this.getCompetencias()

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