<template>
    <App>
        <!-- <Head title="Dashboard" />
    
        <Pageheader :buttons="buttons"/> -->

        <div class="content flex-grow flex flex-col justify-between mt-8">
        
            <div class="m-5">
                <!-- <div class="content flex-grow flex flex-col justify-between">
                </div>                   -->
                    <!-- Component Start -->
                    <div class="grid lg:grid-cols-3 md:grid-cols-2 gap-2 w-full max-w-6xl">

                       
                        <div class="col-span-3 mx-6 text-3xl font-bold"><h1>Última semana</h1></div>

                        <div class="card rounded-xl shadow">
                            <div class="card-body px-2 py-5 flex items-center" >
                                <div class="">
                                    <Icons name="shopping-cart" class="w-10 h-10 mx-4 text-indigo-500"></Icons>
                                </div>    
                                <div class="flex-grow flex flex-col px-2">
                                    <div class="text-sm text-gray-500">Nuevos Pedidos</div>
                       				<div class="flex items-center justify-between">
                                        <div class="font-bold text-2xl">234</div>
                                        <span class="text-green-600 text-sm font-bold bg-green-100 py-1 px-2 rounded-xl">+12.6%</span>
                                    </div>
                                </div>   
                            </div>
                            <div class="card-footer bg-gray-50 px-2  py-3 text-sm rounded-b-xl ">
                                <div class="mx-4 text-indigo-500 font-bold">
                                    <!-- <a :href="route('order.list')">Ver todo</a> -->
                                </div>    
                            </div>
                        </div>
                        <div class="card rounded-xl shadow">
                            <div class="card-body px-2 py-5 flex items-center" >
                                <div class="">
                                    <Icons name="file" class="w-10 h-10 mx-4 text-sky-500"></Icons>
                                </div>    
                                <div class="flex-grow flex flex-col px-2">
                                    <div class="text-sm text-gray-500">Total Facturado</div>
                       				<div class="flex items-center justify-between">
                                        <div class="font-bold text-2xl">$ 1324,00</div>
                                        <span class="text-green-600 text-sm font-bold bg-green-100 py-1 px-2 rounded-xl">+12.6%</span>
                                    </div>
                                </div>   
                            </div>
                            <div class="card-footer bg-gray-50 px-2  py-3 text-sm rounded-b-xl ">
                                <div class="mx-4 text-sky-500 font-bold">
                                    <!-- <a :href="route('order.list')">Ver todo</a> -->
                                </div>    
                            </div>
                        </div>
                        <div class="card rounded-xl shadow">
                            <div class="card-body px-2 py-5 flex items-center" >
                                <div class="">
                                    <Icons name="truck" class="w-10 h-10 mx-4 text-blue-500"></Icons>
                                </div>    
                                <div class="flex-grow flex flex-col px-2">
                                    <div class="text-sm text-gray-500">Envios Creados</div>
                       				<div class="flex items-center justify-between">
                                        <div class="font-bold text-2xl">105</div>
                                        <span class="text-green-600 text-sm font-bold bg-green-100 py-1 px-2 rounded-xl">+12.6%</span>
                                    </div>
                                </div>   
                            </div>
                            <div class="card-footer bg-gray-50 px-2  py-3 text-sm rounded-b-xl ">
                                <div class="mx-4 text-blue-500 font-bold">
                                    <!-- <a :href="route('order.list')">Ver todo</a> -->
                                </div>    
                            </div>
                        </div>
                        
                    </div>
                    <!-- Component End  -->
            </div>

            <!-- <div class="card w-auto ">
                <div class="card-header text-lg px-5 py-4">
                    <div>Dashboard</div> 
                </div>
                <div class="card-body px-5 pb-5">

                    <div class="grid grid-cols-5 gap-5">
                        <a class="col-span-2 xl:col-span-1" :href="route('order.list')" >
                        <div class="bg-sky-400 flex items-center py-5 px-3 rounded-xl text-white shadow hover:bg-sky-500 cursor-pointer" >
                            <Icons name="shopping-cart" class="w-8 h-8 mr-4"></Icons>
                            <div class="text-2xl font-bold">Pedidos</div>
                        </div></a>
                        
                        <a class="col-span-2 xl:col-span-1" :href="route('order.list')" >
                        <div class="bg-indigo-400 flex items-center py-5 px-3 rounded-xl text-white shadow hover:bg-indigo-500 cursor-pointer" >
                            <Icons name="truck" class="w-8 h-8 mr-4"></Icons>
                            <div class="text-2xl font-bold">Envio</div>
                        </div></a>
                        
                        <a class="col-span-2 xl:col-span-1" :href="route('order.list')" >
                        <div class="bg-blue-500 flex items-center py-5 px-3 rounded-xl text-white shadow hover:bg-blue-600 cursor-pointer" >
                            <Icons name="file" class="w-8 h-8 mr-4"></Icons>
                            <div class="text-2xl font-bold">Facturación</div>
                        </div></a>
                    </div>
                </div>
            </div> -->
        </div>  
    </App>
</template>

<script>
    import { Head } from '@inertiajs/inertia-vue3';
    import App from '@/Layouts/App.vue'
    import Pageheader from '@/Layouts/Pageheader.vue'
    import Icons from '@/Layouts/Components/Icons.vue'

    export default {
        components: {
            Head,
            App,
            Pageheader,
            Icons
        },
    }

</script>