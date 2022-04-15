<template>
    <App>

        <div class="w-3/5 mx-auto mt-10 mb-20">

            <div class="my-10 text-4xl" >Diagnostico de Competencias</div>

            <div class="flex px-6">
                <div class="w-3/5"></div>
                <div class="w-2/5 flex justify-between">
                    <span class="text-center text-sm text-accent">Altamente<br>Cierto</span>
                    <span class="text-center text-sm text-accent"></span>
                    <span class="text-center text-sm text-accent"></span>
                    <span class="text-center text-sm text-accent">No es<br>Cierto</span>
                </div>
            </div>
            <div v-for="item in quests" :key="item.id" class="mx-auto border-b border-gray-200 ">
                <div class="flex p-8">
                    <div class="w-3/5">
                        {{item.text}}
                    </div>
                    <!--   -->
                    <div class="w-2/5 flex justify-between items-center pl-8">
                        <input type="radio" :name="item.id" class="appearance-none" v-model="item.value" value="1">
                        <input type="radio" :name="item.id" class="appearance-none" v-model="item.value" value="2">
                        <input type="radio" :name="item.id" class="appearance-none" v-model="item.value" value="3">
                        <input type="radio" :name="item.id" class="appearance-none" v-model="item.value" value="4">
                        <input type="radio" :name="item.id" class="appearance-none" v-model="item.value" value="5">
                    </div>
                </div>
            </div>

            <div class="mt-5 mb-20">
                <button class="btn btn-primary">
                    <span>Finalizar</span>
                    <Icons name="arrow" />
                </button>
            </div>
        </div>
    </App>
</template>

<script>
    import { Head } from '@inertiajs/inertia-vue3';
    import App from '@/Layouts/Web/App.vue'
    import Icons from '@/Layouts/Components/Icons.vue'
    import AfirmationItem from '@/Layouts/Web/AfirmationItem.vue';

    export default {
        props: {
            afirmations: Object
        },        
        components: {
            Head,
            App,
            Icons,
            AfirmationItem,
        },
        data(){

            let quests = this.afirmations.map(function(ele){
                return {...ele,value:''};
            })

            return{
                quests
            }
        },

    }

</script>

