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

            <div class="w-11/12 mx-auto my-2 flex justify-between align-middle">
                <div>
                    <label class="font-semibold mr-2" for="search">Buscar:</label>
                    <input class="input input-sm" type="text" id="search" v-model="filter.search" placeholder="Buscar...">

                    <label class="font-semibold ml-2 mr-2" for="search">Competencia:</label>
                    <select class="text-sm border-none rounded-md" v-model="filter.competencia">
                            <option value="" disabled selected>Seleccione una categoría</option>
                            <option v-for="com in competencias" :key="com.id" :value="com.id">{{com.competencia}}</option>
                    </select>
                    
                    <button class="ml-2 btn btn-primary btn-outline btn-sm" @click="getTests">Buscar</button>
                </div>

                <div>
                    <label class="font-semibold mr-2" for="">Ver: </label>
                    <select class="text-sm border-gray-300 rounded-md" v-model="length" @change="getTests">
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
                            <th class="w-3/11 px-6 py-4 text-center hover:bg-blue-100">
                                <div class="flex items-center justify-center">
                                    Nombre
                                    <!-- <Icons v-if="sort_by == 'p.name' && sort_order == 'ASC'" name="bars-up"
                                        class="h-4 w-4 ml-2" />
                                    <Icons v-else-if="sort_by == 'p.name' && sort_order == 'DESC'"
                                        name="bars-down" class="h-4 w-4 ml-2" />
                                    <Icons v-else name="bars" class="h-4 w-4 ml-2" /> -->
                                </div>
                            </th>
                            <th class="w-1/11 px-6 py-4 text-center hover:bg-blue-100">
                                <div class="flex items-center justify-center">
                                    Tipo Usuario
                                    <!-- <Icons v-if="sort_by == 'p.name' && sort_order == 'ASC'" name="bars-up"
                                        class="h-4 w-4 ml-2" />
                                    <Icons v-else-if="sort_by == 'p.name' && sort_order == 'DESC'"
                                        name="bars-down" class="h-4 w-4 ml-2" />
                                    <Icons v-else name="bars" class="h-4 w-4 ml-2" /> -->
                                </div>
                            </th>

                            <th class="w-3/11 px-6 py-4 text-center hover:bg-blue-100"
                                @click="sort_by = 'test_detail.competencia_related_id', sortTest()">
                                <div class="flex items-center justify-center">
                                    Competencia
                                    <Icons v-if="sort_by == 'test_detail.competencia_related_id' && sort_order == 'ASC'" name="bars-up"
                                        class="h-4 w-4 ml-2" />
                                    <Icons v-else-if="sort_by == 'test_detail.competencia_related_id' && sort_order == 'DESC'"
                                        name="bars-down" class="h-4 w-4 ml-2" />
                                    <Icons v-else name="bars" class="h-4 w-4 ml-2" />
                                </div>
                            </th>

                            <th class="w-3/11 px-6 py-4 text-center hover:bg-blue-100"
                                @click="sort_by = 't.fecha', sortTest()">
                                <div class="flex items-center justify-center">
                                    Fecha
                                    <Icons v-if="sort_by == 't.fecha' && sort_order == 'ASC'" name="bars-up"
                                        class="h-4 w-4 ml-2" />
                                    <Icons v-else-if="sort_by == 't.fecha' && sort_order == 'DESC'"
                                        name="bars-down" class="h-4 w-4 ml-2" />
                                    <Icons v-else name="bars" class="h-4 w-4 ml-2" />
                                </div>
                            </th>

                            <th class="w-3/11 px-6 py-4 text-center hover:bg-blue-100"
                                @click="sort_by = 'ts.description', sortTest()">
                                <div class="flex items-center justify-center">
                                    Estado
                                    <Icons v-if="sort_by == 'ts.description' && sort_order == 'ASC'" name="bars-up"
                                        class="h-4 w-4 ml-2" />
                                    <Icons v-else-if="sort_by == 'ts.description' && sort_order == 'DESC'"
                                        name="bars-down" class="h-4 w-4 ml-2" />
                                    <Icons v-else name="bars" class="h-4 w-4 ml-2" />
                                </div>
                            </th>

                            <th class="w-3/11 px-6 py-4 text-center hover:bg-blue-100"
                                @click="sort_by = 't.type_id', sortTest()">
                                <div class="flex items-center justify-center">
                                    Tipo
                                    <Icons v-if="sort_by == 't.type_id' && sort_order == 'ASC'" name="bars-up"
                                        class="h-4 w-4 ml-2" />
                                    <Icons v-else-if="sort_by == 't.type_id' && sort_order == 'DESC'"
                                        name="bars-down" class="h-4 w-4 ml-2" />
                                    <Icons v-else name="bars" class="h-4 w-4 ml-2" />
                                </div>
                            </th>
                            
                            <th class="w-3/11 px-6 py-4 text-center hover:bg-blue-100"
                                @click="sort_by = 'test_detail.score', sortTest()">
                                <div class="flex items-center justify-center">
                                    Resultado
                                    <Icons v-if="sort_by == 'test_detail.score' && sort_order == 'ASC'" name="bars-up"
                                        class="h-4 w-4 ml-2" />
                                    <Icons v-else-if="sort_by == 'test_detail.score' && sort_order == 'DESC'"
                                        name="bars-down" class="h-4 w-4 ml-2" />
                                    <Icons v-else name="bars" class="h-4 w-4 ml-2" />
                                </div>
                            </th>
                            <th class="w-1/11 px-6 py-4 text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- row 1 -->
                        <tr v-for="t in tests.data" :key="t.id" class="hover">
                            <td class="text-center" v-if="t.person">
                                {{ t.person.name }} - {{ t.person.lastname }} <br> {{t.person.email}} 
                            </td>
                            <td class="text-center" v-else>
                                {{ t.user.name }}
                            </td>
                            <td class="text-center">{{ t.person ? 'Externo' : 'Usuario' }}</td>
                            <td class="text-center">{{ t.competencia }}</td>
                            <td class="text-center">{{ t.fecha }}</td>
                            <td class="text-center">{{ t.status }}</td>
                            <td class="text-center">{{ t.type ?? '-' }}</td>
                            <td class="text-center">{{ t.score }} %</td>
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
    props:{
        competencias: Object
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
            sort_by: "t.fecha"
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

            if (this.filter.competencia) {
                filter += `&competencia=${this.filter.competencia}`
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