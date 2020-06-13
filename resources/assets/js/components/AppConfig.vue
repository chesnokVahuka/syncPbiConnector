<template>
    <div class="">
        <!-- <router-link :to="{ name: 'hello' }">Hello World</router-link> -->
        <!-- <span>{{ api_key }}</span> -->
        <input type="text" v-model="apikey" placeholder="please, insert your Bitrix24 API key" @change="apiKeyUpdate">
        <div v-for="(val, key) in fields_data"  v-bind:key="key" >
             <span :class="[val == 'true' ? 'selected' : '']">{{ key }}</span>
             <span>{{ val }}</span>
        </div> 
        
       <span>AppConfig</span>
    </div>
   
</template>

<script>
    export default {
        props: {
            apikey: {
                type:String,
                },

            fields: String,
            // tables: Array,
        },

        mounted() {
            console.log('Component mounted.');
            console.log(this.apikey);
            // if(this.apikey == undefined){
            //     this.apikey = 'apikey 123';
            // }
            // this.fields_data = JSON.parse(this.fields);
            // this.fields_data = this.fields_data.APIKey;

        },

        data:function(){
            return {
                fields_data: JSON.parse(this.fields),
            }
        },

        methods:{
            apiKeyUpdate(){
                axios.post('/config/update/apikey',{
                    apikey: this.apikey,
                })
                .then(response => {
                    console.log(response.data);
                })
                .catch((error) => {                    
                    console.log(error);
                });

            }
        },
        computed: {
            // apikey: function() {
            //     let apikey = this.fields_data.TITLE;
            //     console.log(apikey);
            //     return apikey;
            // }
        }
    }
</script>
