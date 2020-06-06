<template>
    <div>
        <button class="btn btn-primary" @click="test"> Button </button>
    </div>
</template>

<script>
    export default {
        props: ['userId','columns'],

        mounted() {
            console.log('Component mounted.')
        },

        methods:{
            getData(){
                axios.get('/config/deals')
                .then(response => {
                    alert(response.data);
                })
            },
            test(){
                alert(this.columns);
            }
        }
    }
</script>
