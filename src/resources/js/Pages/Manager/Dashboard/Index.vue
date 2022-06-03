<template>
    <App>
        <!-- <Head title="Dashboard" />
    
        <Pageheader :buttons="buttons"/> -->

        <div class="content flex-grow flex flex-col justify-between mt-8">
  

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