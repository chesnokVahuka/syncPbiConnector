<template>
    <div class="tables_column_name">
        <span class="column_label">{{ this.columns }} </span>
        <!-- <button class="btn btn-primary" @click="test"> Button </button> -->
        <img src="/svg/accept.svg" v-if="isSelected == false" @click="test" >
        <img src="/svg/delete.svg" v-if="isSelected == true" @click="test" >


    </div>
</template>

<script>
    export default {
        props: ['columns'],

        mounted() {
            console.log('Component mounted.')
        },

        data:function(){

            return {
                selected_fields:'',
                isSelected: true,
                }
        },

        methods:{
            getData(){
                axios.get('/config/deals')
                .then(response => {
                    alert(response.data);
                })
            },
            test(){
                this.selected_fields = this.columns;
                this.isSelected = !this.isSelected;
                console.log(this.selected_fields);

                axios.get('/deals' ,this.selected_fields)
                .then(response => {
                    console.log(response.data);
                })
                .catch((error) => {
                console.log(error);
                });
                // alert(this.selected_fields);
            }
        }
    }
</script>
