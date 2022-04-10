<template>
    <header class="bg-dark-light text-white border-gray-200 flex items-center justify-between px-5 text-base">
        <div class="navbar-brand py-4 leading-4 w-64"><span>onMedia</span></div>
        <div class="navbar flex flex-grow justify-between items-center">
            <ul class="navbar-bar flex text-tiny items-center">
            <li class="navbar-item">
                <a @click.prevent="showSidebar = !showSidebar" href="" class="navbar-link">
                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
                </a>
            </li>
            </ul>
            <ul class="navbar-bar flex text-tiny items-center"> 
            <!-- <li class="navbar-item">
                <a href="" class="px-4"> Notificaciones</a>
            </li> -->
           </ul>
        </div>

        <!-- Settings Dropdown -->
        <div class="ml-3 relative">
            <userdropdown align="right" width="48">
                <template #trigger >
                    <div class="navbar-link flex items-center px-4">
                        <svg class="w-7 h-7 text-blue-500 bg-white rounded-full mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-6-3a2 2 0 11-4 0 2 2 0 014 0zm-2 4a5 5 0 00-4.546 2.916A5.986 5.986 0 0010 16a5.986 5.986 0 004.546-2.084A5 5 0 0010 11z" clip-rule="evenodd" />
                        </svg><span>Hola {{ $page.props.user.name }}</span>
                        <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" /></svg>
                    </div>                     
                </template>

                <template #content>
                    <!-- Account Management -->
                    <Link :href="route('profile.show')" class="block flex items-center px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition">
                            <i class="mr-5">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg></i><span>Mi Perfil</span>
                    </Link>
                    <div class="border-t border-gray-100"></div>

                    <!-- Authentication -->
                    <form @submit.prevent="logout">
                        <button type="submit" class="block flex items-center w-full px-4 py-2 text-sm leading-5 text-gray-700 text-left hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition">
                            <i class="mr-5"><svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                            </svg></i><span>Cerrar Sesión</span>
                        </button>
                    </form>                            
                </template>
            </userdropdown>
        </div>

    </header>
</template>

<script>

// import JetDropdown from '@/Jetstream/Dropdown.vue'
// import JetDropdownLink from '@/Jetstream/DropdownLink.vue'
import Userdropdown from '@/Layouts/Navbar/Userdropdown.vue'
import { Head, Link } from '@inertiajs/inertia-vue3'

export default {
    name: 'Navheader',

    components: {
        Head,
        Userdropdown,
        // JetDropdown,
        // JetDropdownLink,
        Link,
    },
    methods:{
        logout() {
            this.$inertia.post(route('logout'));
        },
    }


}
</script>