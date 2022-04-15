<template>
    <App>
        <div class="content flex-grow flex flex-col">
            <div class="w-11/12 mx-auto flex justify-between items-center">
                <h1 class="my-10 text-4xl font-bold">Nueva Afirmacion</h1>
                <div>
                    <button @click.prevent="submit">Guardar</button>
                </div>
            </div>        
            <form action="#" method="POST">
                <div class="grid grid-cols-3 w-8/12 mx-auto ">
                    <div class="col-span-3 text-lg px-5 py-4 font-bold">
                        <div>Información General</div> 
                    </div>
                    <div class="card col-span-3 pt-6 pb-8 px-6">
                        <div class="">
                            <label for="text" class="block text-sm font-semibold text-gray-700">Afirmación</label>
                            <input v-model="form.text" type="text" name="text" id="text"  class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" />
                        </div>

                        <div class="mt-4">
                            <label for="ponderacion" class="block text-sm font-semibold text-gray-700">Ponderación</label>
                            <select v-model="form.ponderacion" id="ponderacion" name="ponderacion" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                <option disabled value="">Seleccione una opción</option>
                                <option value="ASC">Ascendente</option>
                                <option value="DESC">Descendente</option>
                            </select>
                        </div>
                        <div class="mt-4">
                            <label for="competencia" class="block text-sm font-semibold text-gray-700">Competencia</label>
                            <Multiselect v-model="form.tags" mode="tags"
                                        :close-on-select="true"
                                        :searchable="true"
                                        :options="com_list" />

                        </div>

                        <!-- <div class="mt-4 ">
                            <label for="definicion" class="block text-sm font-semibold text-gray-700">Definición</label>
                            <textarea v-model="form.definicion" type="text" name="definicion" id="definicion"  class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"></textarea>
                        </div>

                        <div class="mt-4 ">
                            <label for="comportamiento" class="block text-sm font-semibold text-gray-700">Comportamientos Observables</label>
                            <textarea v-model="form.comportamiento" type="text" name="comportamiento" id="comportamiento" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"></textarea>
                        </div> -->

                    </div>

                </div>

            </form>
        </div>
   </App>
   
</template>

<script>
    import { Head, Link } from '@inertiajs/inertia-vue3';
    import App from '@/Layouts/App.vue'
      import Multiselect from '@vueform/multiselect'


    export default {
        props: {
            competencias: Object
            // section: String,
            // title: String,
            // buttons: Object,
            // libraries: Object
        },
        components: {
            Head,
            App,
            Link,
            Multiselect
        },
        data(){
            return{
                form:{},
                com_list: this.competencias
            }
        },
        methods:{

            submit(){
                this.$inertia.post(route('afirmation.store'), this.form)
            }
        }
    }
</script>

<style src="@vueform/multiselect/themes/default.css"></style>
