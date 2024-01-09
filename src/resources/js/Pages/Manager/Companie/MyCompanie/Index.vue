<template>
    <App>
        <Toast :toast="this.message" :type="this.labelType" @clear="clearMessage"></Toast>
        <!-- CONTENT -->
        <div class="flex-grow flex flex-col">
            <div class="w-11/12 mx-auto flex justify-between items-center">
                <h1 class="my-5 text-4xl font-bold">Empresa | {{this.companie.description}}</h1>
                <!-- <div>
                    <button  button class="btn btn-primary btn-sm mr-2" @click.prevent="submit">Guardar</button>
                    <a class="btn btn-primary btn-sm" :href="route('companie')">Volver</a>
                </div> -->
            </div>
            <hr>

            <div class="w-11/12 mx-auto mt-4">
                <div class="card w-full bg-base-100 shadow-xl">
                   
                    <div class="card-body">
                        <h2 class="card-title">Datos de Empresa</h2>
                        <hr>
                        <div class="grid grid-cols-1 md:grid-cols-2 sm:grid-cols-1 lg:grid-cols-3 gap-4 ">
                            <div>
                                <label for="time"
                                    class="block text-sm font-medium text-gray-700 "><b>Empresa: </b>{{ this.companie.description }}</label>
                                <label for="time"
                                    class="block text-sm font-medium text-gray-700 "><b>Dirección: </b>{{ this.companie.address ?? '-' }}</label>
                            </div>
                        </div>
                        <h2 class="card-title mt-4">Datos de Contacto</h2>
                        <hr>
                        <div class="grid grid-cols-1 md:grid-cols-2 sm:grid-cols-1 lg:grid-cols-3 gap-4 ">
                            <div>
                                <label for="time"
                                    class="block text-sm font-medium text-gray-700 "><b>Nombre: </b>{{ this.companie.contact_name ?? '-' }}</label>
                                <label for="time"
                                    class="block text-sm font-medium text-gray-700 "><b>Email: </b>{{ this.companie.contact_email ?? '-' }}</label>
                                <label for="time"
                                    class="block text-sm font-medium text-gray-700 "><b>Telefono: </b>{{ this.companie.contact_phone ?? '-' }}</label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card w-full bg-base-100 shadow-xl mt-4 mb-4">
                   <div class="card-body">
                       <h2 class="card-title">Competencias Relacionadas</h2>
                       <!-- <div class="w-full mx-auto flex justify-between items-center">
                            <div class="mt-4">
                                <label for="category" class="block text-sm font-semibold text-gray-700">Competencia</label>
                                <select class="select w-full mt-1 input-bordered" v-model="this.competencia_select" name="competencia_select" id="competencia_select">
                                    <option value="" disabled selected>Seleccione una competencia</option>
                                    <option v-for="com in competencias" :key="com.id" :value="com">{{com.competencia}}</option>
                                </select>
                            </div>
                            <div>
                                <button class="btn btn-primary btn-sm" @click.prevent="add_competencias_relacionadas">Agregar</button>
                            </div>
                        </div> 

                        <hr> -->
                        <div>
                            <label for="time"
                            class="block text-xl font-medium text-gray-800">Detalle de Competencias</label>
                        </div>
                        <div class="space-y-2 pt-2 pb-5">
                            <div v-for="cs in this.competencias_select" :key="cs.id" class="inline-flex items-center rounded-md bg-blue-50 px-2 py-1 text-md font-medium text-blue-700 ring-1 ring-inset ring-blue-700/10 mr-2">
                                {{ cs.competencia}}
                            </div>
                        </div>
                   </div>
               </div>

               <div class="card w-full bg-base-100 shadow-xl mt-4 mb-4">
                   <div class="card-body">
                        <div class="w-full mx-auto flex justify-between items-center">
                            <div class="mt-4">
                                <h2 class="card-title">Usuarios Relacionados</h2>
                            </div>
                            <div>
                                <a class="btn btn-primary btn-sm" :href="route('user')">Agregar Usuario</a>
                            </div>
                        </div> 
                       
                       <ListUser :idCompany=companie.id></ListUser>
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
    import Icons from '@/Layouts/Components/Icons.vue'
    import Toast from '@/Layouts/Components/Toast.vue'
    import ListUser from '../User/ListUser.vue'

    export default {
        props:{
             competencias: Object,
             companie: Object,
             competencias_asociadas: Object
        },
        components: {
            App,
            Icons,
            Toast,
            ListUser
        },

        data(){
            return{
                form: {},
                competencias_select: [],
                showToast: false,
                message: "",
                labelType: "success"
            }
        },
        methods:{
            clearMessage() {
                this.message = ""
            },
            submit(){
                this.form.competencias_select = this.competencias_select
                this.$inertia.post(route('companie.update', this.form.id), this.form)
            },
            add_competencias_relacionadas(){
                let resultado = this.competencias.find( competencia => competencia.id === this.competencia_select.id );
                //Verificar que competencia no se encuentre incluida previamente.
                if(resultado){
                    let existe_competencia = this.competencias_select.find( competencia => competencia.id === this.competencia_select.id );
                    if(existe_competencia){
                        this.labelType = "danger"
                        this.message = 'La competencia fue incluida previamente'
                    }else{
                        let comp = {
                            'competencia' : this.competencia_select.competencia,
                            'id' : this.competencia_select.id,
                        }
                        this.competencias_select.push(comp)
                        this.competencia_select = ''
                        this.labelType = "success"
                        this.message = 'Se ha agregado correctamente'
                    }
                }else{
                    this.labelType = "danger"
                    this.message = 'No se ha detectado una competencia valida'
                }
            },
        },
        created(){
        },
        mounted(){
            this.competencias_select = this.competencias_asociadas
            this.form.id = this.companie.id
            this.form.description = this.companie.description
            this.form.address = this.companie.address
            this.form.contact_name = this.companie.contact_name
            this.form.contact_email = this.companie.contact_email
            this.form.contact_phone = this.companie.contact_phone
            
        }     
    }

</script>

