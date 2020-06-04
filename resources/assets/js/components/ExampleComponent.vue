<template>
    <div>
        <button class="btn btn-primary" @click="getData"> Button </button>
    </div>
</template>

<script>
    export default {
        props: ['userId'],

        mounted() {
            console.log('Component mounted.')
        },

        methods:{
            getData(){
                axios.post('/follow/1')
                .then(response => {
                    alert(response);
                })
            }
        }
    }
</script>
