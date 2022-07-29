<template>
    <App>
        <div class="flex-grow flex flex-col">
            <div class="w-11/12 mx-auto flex justify-between items-center">
                <h1 class="my-10 text-4xl font-bold">Cápsulas</h1>
                <div>
                    <a class="btn btn-primary" href="#" @click.prevent="open = true">Crear</a>
                </div>
            </div>

            <div class="w-11/12 mx-auto">
                <table class="table w-full">
                    <thead>
                        <tr>
                            <th class="w-1/7">Título</th>
                            <th class="w-3/7 px-6 py-4 text-center">Descripción</th>
                            <th class="w-1/7 px-6 py-4 text-center">Url</th>
                            <th class="w-1/7 px-6 py-4 text-center">Imagen</th>
                            <th class="w-1/7 px-6 py-4 text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>c
                        <tr v-for="c in capsules.data" :key="c.id" class="hover">
                            <td class="">{{ c.id }} - {{ c.title }}</td>
                            <td class="">{{ c.description }}</td>
                            <td class="">{{ c.url }}</td>
                            <td class=""><img src="https://upload.wikimedia.org/wikipedia/commons/thumb/6/65/Pac-Man_Cutscene.svg/1024px-Pac-Man_Cutscene.svg.png" alt=""></td>
                            <td class="">
                                <a class="link" :href="route('capsule.edit', c.id)">Detalle</a>
                                <button class="ml-2">
                                    <Icons class="w-5 h-5" name="trash" />
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>
        <TransitionRoot as="template" :show="open">
            <Dialog as="div" class="fixed inset-0 overflow-hidden" @close="open = false">
                <div class="absolute inset-0 overflow-hidden">
                    <DialogOverlay class="absolute inset-0" />

                    <div class="fixed inset-y-0 pl-16 max-w-full right-0 flex">
                        <TransitionChild as="template"
                            enter="transform transition ease-in-out duration-500 sm:duration-700"
                            enter-from="translate-x-full" enter-to="translate-x-0"
                            leave="transform transition ease-in-out duration-500 sm:duration-700"
                            leave-from="translate-x-0" leave-to="translate-x-full">
                            <div class="w-screen max-w-md">
                                <form class="h-full divide-y divide-gray-200 flex flex-col bg-white shadow-xl">
                                    <div class="flex-1 h-0 overflow-y-auto">
                                        <div class="py-6 px-4 bg-blue-500 sm:px-6">
                                            <div class="flex items-center justify-between">
                                                <DialogTitle class="text-lg font-medium text-white"> Nueva Capsula
                                                </DialogTitle>
                                                <div class="ml-3 h-7 flex items-center">
                                                    <button type="button"
                                                        class="bg-blue-500 rounded-md text-indigo-200 hover:text-white focus:outline-none focus:ring-2 focus:ring-white"
                                                        @click="open = false">
                                                        <span class="sr-only">Cerrar</span>
                                                        <Icons class="w-5 h-5" name="closed" />
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="flex-1 flex flex-col justify-between">
                                            <div class="px-4 divide-y divide-gray-200 sm:px-6">

                                                <div class="space-y-6 pt-6 pb-5">
                                                    <div>
                                                        <label for="fullname"
                                                            class="block text-sm font-medium text-gray-900">Titulo</label>
                                                        <div class="mt-1">
                                                            <input type="text" v-model="formTitulo" name="titulo"
                                                                id="titulo"
                                                                class="block w-full shadow-sm sm:text-sm focus:ring-indigo-500 focus:border-indigo-500 border-gray-300 rounded-md" />
                                                        </div>
                                                    </div>

                                                    <div>
                                                        <label for="url"
                                                            class="block text-sm font-medium text-gray-900">Url</label>
                                                        <div class="mt-1">
                                                            <input type="text" name="url" v-model="formUrl" id="url"
                                                                class="block w-full shadow-sm sm:text-sm focus:ring-indigo-500 focus:border-indigo-500 border-gray-300 rounded-md" />
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <label for="descripcion"
                                                            class="block text-sm font-medium text-gray-900">Descripcion</label>
                                                        <div class="mt-1">
                                                            <textarea type="text" name="descripcion" id="descripcion"
                                                                rows="4" v-model="formDescripcion"
                                                                class="block w-full shadow-sm sm:text-sm focus:ring-indigo-500 focus:border-indigo-500 border-gray-300 rounded-md"></textarea>
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <label for="truck"
                                                            class="block text-sm font-medium text-gray-900">Imagen</label>
                                                        <div class="mt-1">
                                                            <input
                                                                class="block w-full shadow-sm sm:text-sm focus:ring-indigo-500 focus:border-indigo-500 border-gray-300 rounded-md"
                                                                id="file_input" type="file">
                                                        </div>
                                                    </div>

                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex-shrink-0 px-4 py-4 flex justify-end">
                                        <button type="button"
                                            class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                                            @click="open = false">Cancelar</button>
                                        <button @click.prevent="submit"     
                                            class="ml-4 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">Guardar</button>
                                    </div>
                                </form>
                            </div>
                        </TransitionChild>
                    </div>
                </div>
            </Dialog>
        </TransitionRoot>
    </App>

</template>

<script>
import { Head, Link } from '@inertiajs/inertia-vue3';
import App from '@/Layouts/App.vue'
import Icons from '@/Layouts/Components/Icons.vue'
import { Dialog, DialogOverlay, DialogTitle, TransitionChild, TransitionRoot } from '@headlessui/vue'
//import { XIcon } from "@vue-hero-icons/outline"

export default {
    props: {
        capsules: Object
    },
    components: {
        App,
        Icons,
        Link,
        Dialog,
        DialogOverlay,
        DialogTitle,
        TransitionChild,
        TransitionRoot,
        // XIcon,
    },

    data() {
        return {
            loading: true,
            open: false,
            showToast: false,

        }
    },
    methods: {
        async getCapsules() {
            const get = `${route('capsule.list')}`
       // console.log(get);
            const response = await fetch(get, { method: 'GET' })
            this.capsules = await response.json()

        },
        submit() {
            axios.post(route('capsule.store'), {
                title: this.formTitulo,
                url: this.formUrl,
                description: this.formDescripcion,
               /*  email: this.formEmail,
                truck: this.formTruck,
                notes: this.formNotes, */
            }).then(response => {
                //console.log(response)
                this.open = false
                this.showToast = true
                this.getCapsules()// this.$inertia.get(this.route('drivers.list'), this.params, {replace:true, preserveState:true})
                // console.log(response)
            })
        }
    },
    created() {
        this.getCapsules()
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