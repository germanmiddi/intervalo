<template>
    <App>
        <!-- CONTENT -->
        <div class="focus-within:content flex-grow flex flex-col">
            <div class="mx-auto my-10 text-4xl font-bold
                        xl: w-11/12
                        lg: w-11/12">
                <h1>Pedidos</h1>
            </div>
            <div class="card mx-auto 
                             xl: w-11/12
                             lg: w-11/12">
                <div class="bg-white rounded-md shadow overflow-x-auto">    
                    <table class="w-full whitespace-nowrap">
                        <tr class="text-left font-bold bg-blue-500 text-white">
                            <th class="px-6 py-4 text-center">ID</th>
                            <th class="px-6 py-4 text-center">Competencia</th>
                            <th class="px-6 py-4 text-center">Definicion</th>
                            <th class="px-6 py-4 text-center">Acciones</th>
                        </tr>
                        <!-- {{orders.items}} -->
                         <tr v-for="order in orders.data" :key="order.id" class="hover:bg-gray-50">
                            <td class="border-t px-6 py-4 text-center"># {{ order.wix_number }}</td>
                            <td class="border-t px-6 py-4 text-center">{{ formatDate(order.wix_dateCreated)}}
                                                                   <br>{{ formatHour(order.wix_dateCreated)}}</td>
                          <td class="border-t px-6 py-4 text-center"> 
                                <!-- <span v-if="order.buyerInfo.lastName != undefined"> {{ order.buyerInfo.lastName}}</span>  -->
                                <!-- <span v-if="order.buyerInfo.firstName">{{order.buyerInfo.firstName}}</span> -->
                          </td>
                         <td class="border-t px-6 py-4 text-center">
                                
                                <span class="py-1 px-2 text-sm rounded font-bold"
                                       :class="{'bg-green-400'   : order.wix_paymentStatus == 'PAID',
                                                'text-green-900' : order.wix_paymentStatus == 'PAID',
                                                'bg-red-500'     : order.wix_paymentStatus != 'PAID',
                                                'text-white'     : order.wix_paymentStatus != 'PAID',}" >
                                        {{ order.wix_paymentStatus }}
                                </span></td>
                            
                            <td class="border-t px-6 py-4 text-center">
                                <span class="py-1 px-2  text-sm text-sky-50  rounded font-bold"
                                       :class="{'bg-blue-400': order.wix_fulfillmentStatus == 'FULFILLED',
                                               'bg-green-500': order.wix_fulfillmentStatus != 'FULFILLED'}" >
                                        {{order.wix_fulfillmentStatus}}
                                </span></td>
                            <td class="border-t px-6 py-4 text-center">$ {{ formatPrice(order.wix_totals) }}</td>
                            <td class="border-t px-6 py-4 text-center">
                                <div class="flex">
                                    <button @click="createInvoice(order)" class="flex py-1 px-2 mr-1 text-sm border border-gray-300 bg-gray-100 text-blue-400 rounded font-bold 
                                                items-center hover:bg-gray-200">
                                        <Icons  name="file" class="mr-2 h-6 w-6"/>Detalle
                                    </button>
                                    <Link class="hover:text-blue-500"  tabindex="-1" >Detalle</Link>                                    
                                    <!-- <button @click="createInvoice(order)" class="flex py-1 px-2 mr-1 text-sm border border-gray-300 bg-gray-100 text-blue-400 rounded font-bold 
                                                items-center hover:bg-gray-200">
                                        <Icons  name="file" class="mr-2 h-6 w-6"/>Facturar
                                    </button>
                                    <a :href="route('invoice.showpdf')" class="flex py-1 px-2 mr-1 text-sm border border-gray-300 bg-gray-100 text-blue-400 rounded font-bold 
                                                items-center hover:bg-gray-200">
                                        <Icons name="file" class="mr-2 h-6 w-6"/>Ver Factura
                                    </a>
                                    <button @click="createShipment(order)"
                                             class="flex py-1 px-2 text-sm border border-gray-300 bg-gray-100 text-blue-400 rounded font-bold items-center hover:bg-gray-200">
                                        <Icons  name="file" class="mr-2 h-6 w-6"/>Crear Envio DHL
                                    </button>
                                    <button @click="createShipmentFedex(order)"
                                             class="flex py-1 px-2 text-sm border border-gray-300 bg-gray-100 text-blue-400 rounded font-bold items-center hover:bg-gray-200">
                                        <Icons  name="file" class="mr-2 h-6 w-6"/>Crear Envio Fedex
                                    </button>
                                    <button @click="fullfilment(order)"
                                             class="flex py-1 px-2 text-sm border border-gray-300 bg-gray-100 text-blue-400 rounded font-bold items-center hover:bg-gray-200">
                                        <Icons  name="file" class="mr-2 h-6 w-6"/>Fullfilment
                                    </button> -->
                                </div>
                               
                            </td>
                        </tr> 
                    </table>
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