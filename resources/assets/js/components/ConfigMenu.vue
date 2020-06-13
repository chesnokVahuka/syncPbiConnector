<template>
    <div class="config_menu_wrapper">
        <div class="config_menu">
            <router-link :to="{ name: 'entityFields' }">entityFields</router-link>
            <router-link :to="{ name: 'appconfig' }">appconfig</router-link>
        </div>
        <!-- <router-link :to="{ name: 'hello' }">Hello World</router-link> -->
        <div class="container">
            <router-view></router-view>
        </div>
    </div>
   
</template>

<script>
    export default {
        props: {
        },

        mounted() {
            console.log('Component mounted.');
        },

        data:function(){
            return{
                someData: true,
            }
        },

        methods:{

        }
    }
</script>
