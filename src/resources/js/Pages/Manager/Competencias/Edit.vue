<template>
    <App>
        <div class="flex-grow flex flex-col w-10/12 mx-auto p-10">
            <div class="w-full mx-auto flex justify-between items-center">
                <h1 class="my-10 text-4xl font-bold">Editar Competencia</h1>
                <div>
                    <button class="btn btn-primary btn-sm mr-2" @click.prevent="submit">Guardar</button>
                    <a class="btn btn-primary btn-sm mr-2" :href="route('competencia')">Volver</a>
                </div>
            </div>        
            <form action="#" method="POST">
                <div class="grid grid-cols-3 mx-auto ">
                    <div class="col-span-3 text-lg px-5 py-4 font-bold">
                        <div>Información General</div> 
                    </div>
                    <div class="col-span-3 pt-6 px-6">
                        <div class="">
                            <label for="competencia" class="block text-sm font-semibold text-gray-700">Competencia</label>
                            <input v-model="form.competencia" type="text" name="competencia" id="competencia"  class="mt-1 input input-bordered w-full" />
                        </div>

                        <div class="mt-4">
                            <label for="category" class="block text-sm font-semibold text-gray-700">Categoria</label>
                            <select class="select w-full mt-1" v-model="form.category_id" name="category" id="category">
                                <option value="" disabled selected>Seleccione una categoría</option>
                                <option v-for="cat in categories" :key="cat.id" :value="cat.id">{{cat.title}}</option>
                            </select>
                        </div>

                        <div class="mt-4 ">
                            <label for="resume" class="block text-sm font-semibold text-gray-700">Introducción</label>
                            <input v-model="form.resume" type="text" name="resume" id="resume"  class="mt-1 input input-bordered w-full" />
                        </div>

                        <div class="mt-4 ">
                            <label for="definicion" class="block text-sm font-semibold text-gray-700">Definición</label>
                            <textarea v-model="form.definicion" type="text" name="definicion" id="definicion"  rows="5"  class="mt-1 textarea textarea-bordered w-full"></textarea>
                        </div>
                       
                        <div class="mt-4 ">
                            <label for="comportamiento" class="block text-sm font-semibold text-gray-700">Comportamientos Observables</label>
                            <textarea v-model="form.comportamiento" type="text" name="comportamiento" id="comportamiento" rows="5" class="mt-1 textarea textarea-bordered w-full"></textarea>
                        </div>

                        <div class="mt-4">
                            <label for="capsule" class="block text-sm font-semibold text-gray-700">Capsulas</label>
                            <Multiselect v-model="form.tags" mode="tags"
                                        :close-on-select="true"
                                        :searchable="true"
                                        :options="cap_list" />

                        </div>                    

                    </div>
                    <div class="col-span-3 w-full mx-auto border-b border-gray-300 py-5"></div>
                    
                    <div class="col-span-3" v-if="competencia.afirmations">
                        <div class="col-span-3 text-lg px-5 py-4 font-bold">
                            <div>Afirmaciones</div> 
                        </div>
                        <div class="col-span-3">
                            <ul>
                                <li v-for="af in competencia.afirmations" :key="af.id"
                                    class="py-2 pl-6 border-b "
                                    >{{af.text}} <a class="link link-primary ml-2" :href="route('afirmation.edit', af.id)">Ver</a></li>
                            </ul>
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
    import Multiselect from '@vueform/multiselect'

    export default {
        props: {
            competencia: Object,
            categories:Object,
            capsules: Object
        },
        components: {
            Head,
            App,
            Link,
            Multiselect            
        },
        data(){
            var data = {
                competencia: this.competencia.competencia,
                resume: this.competencia.resume,
                definicion: this.competencia.definicion,
                comportamiento: this.competencia.comportamiento,
                category_id: this.competencia.category_id,
                tags: this.competencia.capsules.map( e => e.id)
            }

            return{
                form:this.$inertia.form(data),
                cap_list: this.capsules
            }
        },
        methods:{
            submit(){
                   this.$inertia.put(route('competencia.update', this.$props.competencia.id), this.form)
            }
        }
    }
</script>

<style src="@vueform/multiselect/themes/default.css"></style>