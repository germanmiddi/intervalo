<template>
    <div>
        <div class="w-5/5 mx-auto">
            <div class="my-10 text-4xl">Resultado</div>
            <!-- <p>{{ this.resultado }}</p> -->
            <div v-for="r in this.resultado" :key="r.id" class="w-full mx-auto bg-white rounded-2xl p-10 shadow mb-6 ">
                <div v-for="re, key in r">
                    <div v-if="re.tipo == 'main'" class="grid grid-cols-3 gap-4">
                        <div class="col-span-3 text-xl text-academy-accent">COMPETENCIA: {{ key }}</div>
                        <div class="col-span-1 flex justify-between items-center">
                            <div class="mx-auto">
                                <div class="radial-progress bg-blue-500  text-blue-200 border-4 border-blue-500"
                                    :style="`--value:${parseInt(re.promedio)}; --size:12rem; --thickness: 2rem;`">
                                    <span class="font-bold text-3xl">{{ re.promedio }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-span-2 items-center">
                            <div class="w-full mx-auto">
                                <div class="card w-12/12 bg-gray-100 cursor-pointer">
                                    <div class="card-body p-4 grid grid-cols-3 gap-4">
                                        <h2 class="card-title col-span-1">{{ re.texto }}</h2>
                                    </div>
                                </div>
                            </div>
                            <div class="w-full mx-auto mt-2">
                                <div class="card w-12/12 bg-blue-50 cursor-pointer">
                                    <div class="card-body p-4 grid grid-cols-3 gap-4">
                                        <h2 class="card-title col-span-1">Capsulas:</h2>
                                        <div class="card-actions justify-center col-span-2" v-for="c in re.capsulas"
                                            :key="c.id">
                                            <div class="badge badge-outline">{{ c }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>  
                </div>
            </div>
        </div>
        <div class="mt-5 mb-20 items-center text-center">
            <a @click="$emit('return_start')" class="btn btn-secondary items-center text-center">
                <span class="mr-2">Inicio</span>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                </svg>
            </a>
        </div>
    </div>
</template>

<script>
//const resultado = [{ "Autonomía": { "competencia": "Autonomía", "competencia_id": 1, "suma": 775, "cantidad": 15, "tipo": "main", "promedio": 50, "texto": "BIEN", "capsulas": { "2": "Titulo 1" } }, "Adaptabilidad / Flexibilidad": { "competencia": "Adaptabilidad / Flexibilidad", "competencia_id": 2, "suma": 25, "cantidad": 1, "tipo": "related", "promedio": 25, "texto": "MAL" }, "Calidad y Mejora continua": { "competencia": "Calidad y Mejora continua", "competencia_id": 3, "suma": 50, "cantidad": 1, "tipo": "related", "promedio": 50, "texto": "BIEN" } }]

export default {
    props: {
        resultado: Object
    },
/*     setup() {
        return {

            resultado,

        }
    },*/ 
}

</script>

