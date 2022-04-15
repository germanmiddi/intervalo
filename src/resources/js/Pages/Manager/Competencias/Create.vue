<template>
    <App>
        <div class="content flex-grow flex flex-col">
            <div class="w-11/12 mx-auto flex justify-between items-center">
                <h1 class="my-10 text-4xl font-bold">Nueva Competencia</h1>
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
                            <label for="competencia" class="block text-sm font-semibold text-gray-700">Competencia</label>
                            <input v-model="form.competencia" type="text" name="competencia" id="competencia"  class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" />
                        </div>

                        <div class="mt-4 ">
                            <label for="definicion" class="block text-sm font-semibold text-gray-700">Definición</label>
                            <textarea v-model="form.definicion" type="text" name="definicion" id="definicion"  class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"></textarea>
                        </div>

                        <div class="mt-4 ">
                            <label for="comportamiento" class="block text-sm font-semibold text-gray-700">Comportamientos Observables</label>
                            <textarea v-model="form.comportamiento" type="text" name="comportamiento" id="comportamiento" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"></textarea>
                        </div>

                    </div>

                    <div class="col-span-3 text-lg px-5 py-4 font-bold">
                        <div>Afirmaciones</div> 
                    </div>
                    <div class="card col-span-3 pt-6 pb-8 px-6">
                        <div class="">
                            <label for="competencia" class="block text-sm font-semibold text-gray-700">Competencia</label>
                            <input v-model="form.competencia" type="text" name="competencia" id="competencia"  class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" />
                        </div>

                    </div>

                </div>

            </form>
        </div>
   </App>
   
</template>

<script>
    import { Head, Link } from '@inertiajs/inertia-vue3';
    import App from '@/Layouts/App.vue'

    export default {
        props: {
            // section: String,
            // title: String,
            // buttons: Object,
            // libraries: Object
        },
        components: {
            Head,
            App,
            Link,
        },
        data(){
            return{
                form:{}
            }
        },
        methods:{
            submit(){
                this.$inertia.post(route('competencia.store'), this.form)
            }
        }
    }
</script>