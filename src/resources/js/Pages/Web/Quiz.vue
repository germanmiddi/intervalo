<template>
    <App>

        <div v-if="!this.showResult">
            <div class="w-4/5 mx-auto mt-10 mb-20">

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
                    <div class="flex p-8 rounded-xl my-4"
                        :class="{'bg-red-100' : item.empty == 'true'}">
                        <div class="w-3/5">
                            {{item.text}} {{item.id_competencia}}
                        </div>
                        <!--   -->
                        
                        <div class="w-2/5 flex justify-between items-center pl-8" @click="item.empty = 'false'">
                            <input type="radio" :name="item.id" class="appearance-none" v-model="item.value" :value="item.ponderacion == 'ASC' ? 10 : 100">
                            <input type="radio" :name="item.id" class="appearance-none" v-model="item.value" :value="item.ponderacion == 'ASC' ? 25 : 75">
                            <input type="radio" :name="item.id" class="appearance-none" v-model="item.value" :value="item.ponderacion == 'ASC' ? 50 : 50">
                            <input type="radio" :name="item.id" class="appearance-none" v-model="item.value" :value="item.ponderacion == 'ASC' ? 75 : 25">
                            <input type="radio" :name="item.id" class="appearance-none" v-model="item.value" :value="item.ponderacion == 'ASC' ? 100 : 10">
                        </div>

                    </div>
                </div>

                <div class="mt-5 mb-20">
                    <a @click="processQuiz" class="btn btn-primary" >
                        <span>Finalizar</span>
                        <Icons name="arrow" />
                    </a>
                </div>
            </div>
        </div>

        <div v-if="this.showResult">a
            asd
            <div class="w-3/5 mx-auto mt-10 mb-20">

                <div class="my-10 text-4xl" >Resultado</div>
                <p>{{this.resultado}}</p>
                
                <!-- <div v-for="r in this.resultado" :key="r.id" class="w-full mx-auto bg-white rounded-2xl p-10 shadow mb-6">
                    <div class="text-xl text-academy-accent mb-4">{{r.competencia}}</div>

                    <div class="flex justify-between items-center">
                        <div class="mx-auto">
                            <div class="radial-progress bg-blue-500  text-blue-200 border-4 border-blue-500" :style="`--value:${r.promedio}; --size:12rem; --thickness: 2rem;`">
                                <span class="font-bold text-3xl">{{r.promedio}}%</span>
                            </div>
                        </div>
                        <div class="w-4/5 mx-auto">
                            <div class="flex flex-col justify-between items-center mx-auto">
                                <div v-for="c in r.capsules" :key="c.id" class="card w-10/12 bg-blue-50 mb-4 cursor-pointer">
                                    <div class="card-body">
                                        <h2 class="card-title">{{c.title}}</h2>
                                        <p>{{c.description}}</p>
                                        <div class="card-actions justify-end">
                                            <div class="badge badge-outline">Liderazgo</div> 
                                            <div class="badge badge-outline">Innovación</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div> -->
            </div>
        </div>        
    </App>
</template>

<script>
    import { Head } from '@inertiajs/inertia-vue3';
    import App      from '@/Layouts/Web/App.vue'
    import Icons    from '@/Layouts/Components/Icons.vue'
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
                return {...ele,value:'', empty: 'false'};
            })

            return{
                showResult:false,
                resultado: "",
                quests,
                empty:""
            }
        },
        methods:{

            processQuiz(){

                this.quests = this.quests.map(function(ele){
                                                    if (ele['value'] == '' ){
                                                        ele['empty'] = 'true'
                                                    }
                                                    return ele
                                                })    

                let empty = this.quests.map(el => el['empty'])
                if(empty.includes('true'))return

                // if(this.empty.length > 0){
                //     console.log(this.empty)
                //     return
                // }                

                let post = route('quiz.calculate')

                axios.post(post, this.quests)
                .then(response =>{
                    this.resultado = response.data
                })

                this.showResult = true
            }
        }

    }

</script>

