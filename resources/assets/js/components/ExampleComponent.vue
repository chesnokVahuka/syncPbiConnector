<template>
    <div class="tables_column_name">
        <span class="column_label">{{ this.columns }} </span>
        <!-- <button class="btn btn-primary" @click="test"> Button </button> -->
        <img src="/svg/accept.svg" v-if="selected === 'false'" @click="test" >
        <img src="/svg/delete.svg" v-if="selected === 'true'" @click="test" >

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
            console.log(this.selected);
            console.log(this.isSelected);
        },

        data:function(){

            return {
                selected_fields:'',
                selected:this.isSelected,
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
                if(this.selected == 'true'){
                    this.selected = 'false';
                }
                else{
                     this.selected = 'true';
                }
                console.log(this.selected);

                axios.get('/config/deals/update?' + this.selected_fields)
                .then(response => {
                    console.log(response.data);
                })
                .catch((error) => {
                console.log(error);
                });
                alert(this.selected_fields);
            }
        }
    }
</script>
