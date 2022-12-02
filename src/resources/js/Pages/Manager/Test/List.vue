<template>
    <App>
        <!-- CONTENT -->
        <div class="flex-grow flex flex-col">
            <div class="w-11/12 mx-auto flex justify-between items-center">
                <h1 class="my-10 text-4xl font-bold">Resultados</h1>
                <div>
                    <a class="btn btn-primary btn-sm mr-2" href="#">Descargar Excel</a>
                </div>
            </div>

            <div class="w-11/12 mx-auto my-2 flex justify-between align-middle">
                <div>
                    <label class="font-semibold mr-2" for="search">Buscar:</label>
                    <input class="input input-sm" type="text" id="search" v-model="search" placeholder="Buscar...">
                    <button class="ml-2 btn btn-primary btn-outline btn-sm" @click="getTests">Buscar</button>
                </div>

                <div>
                    <label class="font-semibold mr-2" for="">Ver: </label>
                    <select class="text-sm border-gray-300 rounded-md" v-model="length" @change="getTests">
                        <option value="1">1</option>
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
                            <th class="w-2/10 px-6 py-4 text-center">Persona</th>
                            <th class="w-3/10 px-6 py-4 text-center">Competencia</th>
                            <th class="w-2/10 px-6 py-4 text-center">Fecha</th>
                            <th class="w-1/10 px-6 py-4 text-center">Estado</th>
                            <th class="w-1/10 px-6 py-4 text-center">Resultado</th>
                            <th class="w-1/10 px-6 py-4 text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- row 1 -->
                        <tr v-for="t in tests.data" :key="t.id" class="hover">
                            <td class="text-center">{{ t.person.name }} - {{ t.person.lastname }} <br> {{t.person.email}} </td>
                            <td class="text-center">{{ t.competencia }}</td>
                            <td class="text-center">{{ t.fecha }}</td>
                            <td class="text-center">{{ t.status }}</td>
                            <td class="text-center">{{ t.score }} %</td>
                            <td class="text-center">
                                <a class="link" >
                                Detalle</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="w-11/12 mx-auto my-5 flex justify-between items-center">
                <div>
                    Mostrando: {{ this.tests.from }} a {{ this.tests.to }} - Entradas encontradas:
                    {{ this.tests.total }}
                </div>
                <div class="flex flex-wrap -mb-1">
                    <div v-for="link in tests.links" :key="link.id">
                        <div v-if="link.url === null"
                            class="mr-1 mb-1 px-4 py-3 text-sm leading-4 text-gray-400 border rounded-md"
                            v-html="link.label"> </div>
                        <div v-else
                            class="mr-1 mb-1 px-4 py-3 text-sm leading-4 border border-gray-300 rounded-md hover:bg-blue-500 hover:text-white cursor-pointer"
                            :class="{ 'bg-blue-500': link.active }, { 'text-white': link.active }"
                            @click="getTestsPaginate(link.url)" v-html="link.label"> </div>
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

    data() {
        return {
            loading: true,
            length: "10",
            search: "",
            afirmaciones: "",
            tests: ""
            // nextpage: "",
            // prevpage: "",                

        }
    },
    methods: {
        async getTests() {

            let filter = `&length=${this.length}`

            if (this.search) {
                filter += `&search=${this.search}`
            }

            const get = `${route('test.list')}?${filter}`

            const response = await fetch(get, { method: 'GET' })
            this.tests = await response.json()
        },

        async getTestsPaginate(link) {

            var get = `${link}`;
            const response = await fetch(get, { method: 'GET' })

            this.tests = await response.json()
            // this.nextpage = this.afirmaciones.next_page_url
            // this.prevpage = this.afirmaciones.prev_page_url

        },

    },
    created() {
        this.getTests()

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