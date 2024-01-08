<template>
      <!-- <Head title="Dashboard" />
    
        <Pageheader :buttons="buttons"/> -->

        <!-- <div class="content flex-grow flex flex-col justify-between mt-8"> -->

          <div class="flex-grow flex flex-col">
            <div class="w-11/12 mx-auto mt-4">
                <div class="shadow sm:rounded-md sm:overflow-hidden">
                    <div class="bg-white py-6 px-4 space-y-6 sm:p-6">
                        <div class="flex items-center justify-between flex-wrap sm:flex-nowrap ">
                            <div class="flex">
                                <h3 class="text-lg leading-6 font-medium text-gray-900">Dashboard | Administrador</h3>
                            </div>
                            <div class="flex mt-4 sm:mt-0">
                                <label class="font-semibold mr-2"> {{$page.props.user.name}}</label>
                                <!-- <div>
                                    <button v-if="Object.keys(this.filter).length" class="text-xs font-medium text-gray-500 hover:text-gray-700 mr-2" 
                                    @click="clearFilter">Limpiar Filtro</button>
                                    <button type="button"
                                    class="btn btn-primary btn-outline btn-sm mr-4" @click="getCompanie()">Aplicar Filtro</button>
                                </div>
                                <div>
                                    <label class="font-semibold mr-2" for="">Ver: </label>
                                    <select class="text-sm border-gray-300 rounded-md" v-model="length" @change="getCompanie">
                                        <option value="10">10</option>
                                        <option value="20">20</option>
                                        <option value="30">30</option>
                                        <option value="50">50</option>
                                        <option value="100">100</option>
                                    </select>
                                </div> -->
                            </div>
                        </div>
                        <hr>
                        <div>
                            <div class="px-4 sm:px-0">
                            <h3 class="text-base font-semibold leading-7 text-gray-900">Detalle</h3>
                            <p class="mt-1 max-w-2xl text-sm leading-6 text-gray-500">Información de Personal y Competencias</p>
                            </div>
                            <div class="mt-6 border-t border-gray-100">
                            <dl class="divide-y divide-gray-100">
                                <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                                <dt class="text-sm font-medium leading-6 text-gray-900">Empleados</dt>
                                <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0"><b>Total Empleados Activos:</b> 20</dd>
                                </div>
                                <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                                <dt class="text-sm font-medium leading-6 text-gray-900">Competencias</dt>
                                <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                                    <p><b>Total Competencias Activas:</b> 10</p>
                                    <p class="text-green-500"><b>Competencia de mejor desempeño:</b> Etica</p>
                                    <p class="text-red-500"><b>Competencia de menor desempeño:</b> Autonomia</p>
                                </dd>
                                </div>
                                <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                                <dt class="text-sm font-medium leading-6 text-gray-900">Evaluaciones</dt>
                                <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                                    <p><b>Evaluaciones Disponibles (Q):</b> 100</p>
                                    <p class="text-green-500"><b>Evaluaciones Realizadas (%):</b> 65%</p>
                                    <p class="text-red-500"><b>Evaluaciones Pendientes (%):</b> 35%</p>
                                </dd>
                                </div>
                            </dl>
                            </div>
                        </div>
                        <div class="grid lg:grid-cols-2 md:grid-cols-1 sm:grid-cols-1 gap-2">                            
                            <div>
                                <div class="stats shadow w-full h-full border-solid border-2 border-gray-400">
                                    <div class="stat bg-gray-300  ">
                                        <div class="stat-figure ">
                                            <div class="radial-progress bg-blue-300 text-green-700 border-4 border-blue-500" style="--value:65;">65%</div>
                                        </div>
                                        <div class="stat-title">Evaluaciones Realizadas</div>
                                        <div class="stat-value text-primary">65</div>
                                        <div class="stat-desc">65% Evaluaciones</div>
                                    </div>

                                </div>  
                            </div>
                            <div>
                                <div class="stats shadow w-full h-full border-solid border-2 border-gray-400">
                                    <div class="stat bg-gray-300  ">
                                        <div class="stat-figure ">
                                            <div class="radial-progress bg-blue-300 text-green-700 border-4 border-blue-500" style="--value:35;">35%</div>
                                        </div>
                                        <div class="stat-title">Evaluaciones Pendientes</div>
                                        <div class="stat-value text-primary">35</div>
                                        <div class="stat-desc">35% Evaluaciones</div>
                                    </div>

                                </div>  
                            </div>

                            <div>
                                <div class="stats shadow w-full h-full border-solid border-2 border-gray-400">
                                    <div class="stat bg-gray-300  ">
                                        <div class="stat-figure ">
                                            <div class="radial-progress bg-blue-300 text-green-700 border-4 border-blue-500" style="--value:80;">80%</div>
                                        </div>
                                        <div class="stat-title">Nivel Aprobación</div>
                                        <div class="stat-value text-primary">52</div>
                                        <div class="stat-desc">80% Evaluaciones</div>
                                    </div>

                                </div>  
                            </div>
                            <div>
                                <div class="stats shadow w-full h-full border-solid border-2 border-gray-400">
                                    <div class="stat bg-gray-300  ">
                                        <div class="stat-figure ">
                                            <div class="radial-progress bg-blue-300 text-green-700 border-4 border-blue-500" style="--value:20;">20%</div>
                                        </div>
                                        <div class="stat-title">Nivel Desaprobación</div>
                                        <div class="stat-value text-primary">13</div>
                                        <div class="stat-desc">20% Evaluaciones</div>
                                    </div>
                                </div>  
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</template>


<script>
import { useForm } from '@inertiajs/inertia-vue3'

export default {
  props: {

  },
  components: {

  },
  methods: {

  }
}
</script>