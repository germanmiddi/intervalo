<template>
    <div class="navbar bg-base-100 max-w-screen-xl mx-auto  ">
        <div class="flex-1">
            <img class="w-40" src="/img/logotipo.png" alt="">
            <!-- <a class="btn btn-ghost normal-case text-xl">daisyUI</a> -->
        </div>
        <div class="flex-none" v-if="!$page.props.user">
            <a :href="route('login')" class="text-xl font-medium text-pink-600 hover:text-pink-400">Ingresar</a>
        </div>
        <div class="flex-none" v-else>
            <a class="text-sm font-medium text-pink-600 hover:text-pink-400">Bienvenido! {{$page.props.user.name}}</a>
            <a class="btn btn-square btn-ghost text-pink-600 ml-4" title="Ver Resultados" :href="route('dashboard')">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6a7.5 7.5 0 1 0 7.5 7.5h-7.5V6Z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 10.5H21A7.5 7.5 0 0 0 13.5 3v7.5Z" />
                </svg>
            </a>
            <form @submit.prevent="logout">
                <button class="btn btn-square btn-ghost text-pink-600 " title="Cerrar Sesión">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />
                    </svg>
                </button>
            </form>
        </div>
    </div>
</template>

<script>
    export default {

        methods:{
            logout() {
                this.$inertia.post(route('logout'));
            },
        }

    }
</script>

<style>

</style>