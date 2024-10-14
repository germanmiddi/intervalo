<template>
    <App>
        <!-- CONTENT -->
        <div class="flex-grow flex flex-col">
            <div class="w-11/12 mx-auto flex justify-between items-center">
                <h1 class="my-10 text-4xl font-bold">Resultados</h1>
                <div>
                    <a class="btn btn-primary btn-sm mr-2" href="test/downloadexcel" _blank>Descargar Excel</a>
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
                                    <button v-if="Object.keys(this.filter).length"
                                        class="text-xs font-medium text-gray-500 hover:text-gray-700 mr-2"
                                        @click="clearFilter">Limpiar Filtro</button>
                                    <button type="button" class="btn btn-primary btn-outline btn-sm mr-4"
                                        @click="getTests()">Aplicar Filtro</button>
                                </div>
                                <div>
                                    <label class="font-semibold mr-2" for="">Ver: </label>
                                    <select class="text-sm border-gray-300 rounded-md" v-model="length"
                                        @change="getCategory">
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
                            <div class="col-span-12 sm:col-span-2 ">
                                <label for="name" class="block text-sm font-medium text-gray-700">Busqueda</label>
                                <input v-model="filter.search" type="text" name="search" id="search" autocomplete="off"
                                    placeholder="Buscar."
                                    class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" />
                            </div>
                            <div class="col-span-12 sm:col-span-2 ">
                                <label for="name" class="block text-sm font-medium text-gray-700">Competencia</label>
                                <select
                                    class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                                    v-model="filter.competencia_id">
                                    <option value="" disabled selected>Seleccione una categoría</option>
                                    <option v-for="com in competencias" :key="com.id" :value="com.id">
                                        {{ com.competencia }}</option>
                                </select>
                            </div>
                            <div class="col-span-12 sm:col-span-2 ">
                                <label for="name" class="block text-sm font-medium text-gray-700">Diagnóstico</label>
                                <select
                                    class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                                    v-model="filter.diagnostico_id">
                                    <option value="" disabled selected>Seleccione un diagnostico</option>
                                    <option v-for="item in diagnosticos" :key="item.id" :value="item.id">
                                        {{ item.name }}</option>
                                </select>
                            </div>
                            <div class="col-span-12 sm:col-span-2 ">
                                <label for="name" class="block text-sm font-medium text-gray-700">Sector</label>
                                <select
                                    class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                                    v-model="filter.sector_id">
                                    <option value="" disabled selected>Seleccione un sector</option>
                                    <option v-for="item in sectores" :key="item.id" :value="item.id">
                                        {{ item.name }}</option>
                                </select>
                            </div>
                            <div class="col-span-12 sm:col-span-2 ">
                                <label for="name" class="block text-sm font-medium text-gray-700">Tipo
                                    Evaluación</label>
                                <select
                                    class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                                    v-model="filter.test_type_id">
                                    <option value="" disabled selected>Seleccione una Tipo</option>
                                    <option v-for="item in test_types" :key="item.id" :value="item.id">
                                        {{ item.description }}</option>
                                </select>
                            </div>
                            <div class="col-span-12 sm:col-span-2">
                                <label for="name" class="block text-sm font-medium text-gray-700">Estado</label>
                                <select
                                    class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                                    v-model="filter.status_id">
                                    <option value="" disabled selected>Seleccione un estado</option>
                                    <option v-for="item in status" :key="item.id" :value="item.id">
                                        {{ item.description }}</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="w-11/12 mx-auto mt-4">
                <table class="table w-full">
                    <!-- head -->
                    <thead>
                        <tr>
                            <th class="w-3/11 px-6 py-4 text-center hover:bg-blue-100">
                                <div class="flex items-center justify-center">
                                    Nombre
                                </div>
                            </th>
                            <th class="w-1/11 px-6 py-4 text-center hover:bg-blue-100">
                                <div class="flex items-center justify-center">
                                    Tipo Usuario
                                </div>
                            </th>

                            <th class="w-3/11 px-6 py-4 text-center hover:bg-blue-100"
                                @click="sort_by = 'competencias.competencia', sortTest()">
                                <div class="flex items-center justify-center">
                                    Competencia
                                    <Icons v-if="sort_by == 'competencias.competencia' && sort_order == 'ASC'"
                                        name="bars-up" class="h-4 w-4 ml-2" />
                                    <Icons
                                        v-else-if="sort_by == 'competencias.competencia' && sort_order == 'DESC'"
                                        name="bars-down" class="h-4 w-4 ml-2" />
                                    <Icons v-else name="bars" class="h-4 w-4 ml-2" />
                                </div>
                            </th>

                            <th class="w-3/11 px-6 py-4 text-center hover:bg-blue-100"
                                @click="sort_by = 'diagnosticos.name', sortTest()">
                                <div class="flex items-center justify-center">
                                    Diagnóstico
                                    <Icons v-if="sort_by == 'diagnosticos.name' && sort_order == 'ASC'"
                                        name="bars-up" class="h-4 w-4 ml-2" />
                                    <Icons
                                        v-else-if="sort_by == 'diagnosticos.name' && sort_order == 'DESC'"
                                        name="bars-down" class="h-4 w-4 ml-2" />
                                    <Icons v-else name="bars" class="h-4 w-4 ml-2" />
                                </div>
                            </th>

                            <th class="w-3/11 px-6 py-4 text-center hover:bg-blue-100"
                                @click="sort_by = 'test.fecha', sortTest()">
                                <div class="flex items-center justify-center">
                                    Fecha
                                    <Icons v-if="sort_by == 'test.fecha' && sort_order == 'ASC'" name="bars-up"
                                        class="h-4 w-4 ml-2" />
                                    <Icons v-else-if="sort_by == 'test.fecha' && sort_order == 'DESC'" name="bars-down"
                                        class="h-4 w-4 ml-2" />
                                    <Icons v-else name="bars" class="h-4 w-4 ml-2" />
                                </div>
                            </th>

                            <th class="w-3/11 px-6 py-4 text-center hover:bg-blue-100"
                                @click="sort_by = 'test_status.description', sortTest()">
                                <div class="flex items-center justify-center">
                                    Estado
                                    <Icons v-if="sort_by == 'test_status.description' && sort_order == 'ASC'" name="bars-up"
                                        class="h-4 w-4 ml-2" />
                                    <Icons v-else-if="sort_by == 'test_status.description' && sort_order == 'DESC'"
                                        name="bars-down" class="h-4 w-4 ml-2" />
                                    <Icons v-else name="bars" class="h-4 w-4 ml-2" />
                                </div>
                            </th>

                            <th class="w-3/11 px-6 py-4 text-center hover:bg-blue-100"
                                @click="sort_by = 'test_types.description', sortTest()">
                                <div class="flex items-center justify-center">
                                    Tipo
                                    <Icons v-if="sort_by == 'test_types.description' && sort_order == 'ASC'" name="bars-up"
                                        class="h-4 w-4 ml-2" />
                                    <Icons v-else-if="sort_by == 'test_types.description' && sort_order == 'DESC'" name="bars-down"
                                        class="h-4 w-4 ml-2" />
                                    <Icons v-else name="bars" class="h-4 w-4 ml-2" />
                                </div>
                            </th>

                            <th class="w-3/11 px-6 py-4 text-center hover:bg-blue-100"
                                @click="sort_by = 'score', sortTest()">
                                <div class="flex items-center justify-center">
                                    Resultado
                                    <Icons v-if="sort_by == 'score' && sort_order == 'ASC'" name="bars-up"
                                        class="h-4 w-4 ml-2" />
                                    <Icons v-else-if="sort_by == 'score' && sort_order == 'DESC'"
                                        name="bars-down" class="h-4 w-4 ml-2" />
                                    <Icons v-else name="bars" class="h-4 w-4 ml-2" />
                                </div>
                            </th>
                            <th class="w-1/11 px-6 py-4 text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- row 1 -->
                        <tr v-for="item in tests.data" :key="item.id" class="hover">

                            <td class="text-center" v-if="item.person">
                                {{ item.test.person.name }} - {{ item.test.person.lastname }} <br> {{ item.test.person.email }}
                            </td>
                            <td class="text-center" v-else>
                                {{ item.test.user.name }}
                            </td>
                            <td class="text-center">{{ item.test.person ? 'Externo' : 'Usuario' }}</td>
                            <td class="text-center">{{ item.competencia_related?.competencia?.competencia }}</td>
                            <td class="text-center">{{ item.test?.diagnostico?.diagnostico?.name ?? '-'}}</td>
                            <td class="text-center">{{ item.test?.fecha ?? '-' }}</td>
                            <td class="text-center">{{ item.test?.status?.description ?? '-' }}</td>
                            <td class="text-center">{{ item.test?.type?.description ?? '-' }}</td>
                            <td class="text-center">{{ item.score }} %</td>
                            <td class="text-center">
                                <!-- <a class="link">Detalle</a> -->
                                -
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
    props: {
        competencias: Object,
        diagnosticos: Object,
        status: Object,
        test_types: Object,
        sectores: Object,
    },
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
            filter: {},
            afirmaciones: "",
            tests: "",
            sort_order: 'DESC',
            sort_by: "test.fecha"
        }
    },
    methods: {
        async getTests() {

            let filter = `&length=${this.length}`
            filter += `&sort_by=${this.sort_by}`
            filter += `&sort_order=${this.sort_order}`

            if (this.filter.search) {
                filter += `&search=${this.filter.search}`
            }

            if (this.filter.competencia_id) {
                filter += `&competencia_id=${this.filter.competencia_id}`
            }

            if (this.filter.diagnostico_id) {
                filter += `&diagnostico_id=${this.filter.diagnostico_id}`
            }

            if (this.filter.sector_id) {
                filter += `&sector_id=${this.filter.sector_id}`
            }

            if (this.filter.test_type_id) {
                filter += `&test_type_id=${this.filter.test_type_id}`
            }

            if (this.filter.status_id) {
                filter += `&status_id=${this.filter.status_id}`
            }

            const get = `${route('test.list')}?${filter}`

            const response = await fetch(get, { method: 'GET' })
            this.tests = {}
            this.tests = await response.json()
        },
        clearFilter(){
            this.filter = {}
            this.getTests()
        },
        async getTestsPaginate(link) {

            var get = `${link}`;
            const response = await fetch(get, { method: 'GET' })

            this.tests = await response.json()
            // this.nextpage = this.afirmaciones.next_page_url
            // this.prevpage = this.afirmaciones.prev_page_url

        },
        sortTest() {
            this.sort_order = this.sort_order === 'ASC' ? 'DESC' : 'ASC'
            this.getTests()
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