<template>
  <transition name="fade">
      <div class="sidebar origin-top ease bg-dark-default text-white w-64 ">
        <div class="sidebar-content">
          <!-- MAIN NAVIGATION -->
          <div>
            <ul class="nav-sidebar">
              <li class="nav-item-header py-3 px-5"><div class="text-xs text-gray-400">MAIN</div></li>
              
              <li class="nav-item">
                <nav-link :href="route('dashboard')" 
                      :active="route().current('dashboard')">
                      <i class="nav-icon mr-5 "><svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                      <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" /></svg></i>
                      <span class="nav-label font-medium text-sm pt-1">Dashboard</span>
                </nav-link>   
              </li>

              <li class="nav-item">
                <nav-link :href="route('competencia.list')" 
                      :active="route().current('competencia.list')">
                      <!-- <Icons name="shopping-cart" class="mr-5 w-6 h-6" ></Icons> -->
                      <span class="nav-label font-medium text-sm pt-1">Competencias</span>
                </nav-link>   
              </li>
             
              <li class="nav-item">
                <nav-link :href="route('afirmation')" 
                      :active="route().current('afirmation')">
                      <!-- <Icons name="truck" class="h-6 w-6 mr-5" /> -->
                      <span class="nav-label font-medium text-sm pt-1">Afirmaciones</span>
                </nav-link>   
              </li>              

              <li class="nav-item">
                <nav-link :href="route('capsule')" 
                      :active="route().current('capsule')">
                      <!-- <Icons name="truck" class="h-6 w-6 mr-5" /> -->
                      <span class="nav-label font-medium text-sm pt-1">Capsulas</span>
                </nav-link>   
              </li>              
 
              <li class="nav-item">
                <nav-link >
                      <!-- <Icons name="truck" class="h-6 w-6 mr-5" /> -->
                      <span class="nav-label font-medium text-sm pt-1">Usuarios</span>
                </nav-link>   
              </li>              
              
              <!-- <li class="nav-item">
                <nav-link :href="route('order.list')" 
                      :active="route().current('libraries.list')">
                      <Icons name="file" class="h-6 w-6 mr-5"/>
                      <span class="nav-label font-medium text-sm pt-1">Facturación</span>
                </nav-link>   
              </li>
              <li class="nav-item">
                <nav-link :href="route('users.list')" 
                      :active="route().current('users.list')">
                      <Icons name="key" class="h-6 w-6 mr-5"/>
                      <span class="nav-label font-medium text-sm pt-1">Usuarios</span>
                </nav-link>   
              </li>
              <li class="nav-item">
                <nav-link :href="route('order.list')" 
                      :active="route().current('libraries.list')">
                      <Icons name="cog" class="h-6 w-6 mr-5"/>
                      <span class="nav-label font-medium text-sm pt-1">Configuración</span>
                </nav-link>   
              </li> -->
            </ul>
          </div>
          <!-- / MAIN NAVIGATION -->        
        </div>

      </div>
  </transition>
</template>

<script>

import { Link } from '@inertiajs/inertia-vue3';
import NavLink from '@/Layouts/Sidebar/NavLink.vue'
import Icons from '@/Layouts/Components/Icons.vue'


export default {
    name: 'Sidebar',
    components: {
        NavLink,
        Link,
        Icons
    },

}
</script>