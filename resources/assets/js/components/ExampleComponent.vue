<template>
    <div class="tables_column_name">
        <span class="column_label">{{ this.columns }} </span>
        <!-- <button class="btn btn-primary" @click="test"> Button </button> -->
        <img src="/svg/accept.svg" v-if="status == 'false'" @click="select" >
        <img src="/svg/delete.svg" v-if="status == 'true'" @click="select" >

    </div>
</template>

<script>
    export default {
        props: {
            columns: String,
            isSelected: String,
        },

        mounted() {
            console.log('Component mounted.');
            console.log(this.status);
            console.log(this.isSelected);
            
        },

        data:function(){

            return {
                selected_fields:'',
                status:this.isSelected,
                }
        },

        methods:{
            getData(){
                axios.get('/config/deals')
                .then(response => {
                    alert(response.data);
                })
            },
            select(){
                this.selected_fields = this.columns;
                if(this.status == 'true'){
                    this.status = 'false';
                }
                else{
                     this.status = 'true';
                }
                console.log(this.status);

                axios.get('/config/deals/update?' + this.selected_fields + '=' + this.status)
                .then(response => {
                    console.log(response.data);
                })
                .catch((error) => {                    
                    if(this.status == 'true'){
                    this.status = 'false';
                    }
                    else{
                        this.status = 'true';
                    }
                    console.log(error);
                });
            }
        }
    }
</script>
