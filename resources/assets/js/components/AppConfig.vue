<template>
    <div class="config_wrap">
        <!-- <router-link :to="{ name: 'hello' }">Hello World</router-link> -->
        <!-- <span>{{ api_key }}</span> -->
        <div class="col-sm-4 col-xs-6 config_param config_param-flex_wrap">
            <label for="apikey" class="col-sm-6 control-label"> Webhook токен</label>
            <input class="config_input" name="apikey" type="text" v-model="apikey" placeholder="please, insert your Bitrix24 API key" @change="apiKeyUpdate" >
        </div>
        <div class="col-sm-4 col-xs-6 config_param config_param-flex_wrap">
            <label for="time" class="col-sm-8 control-label"> Время начала синхронизации</label>
            <!-- <input class="config_input" name="apikey" type="datetime"  placeholder="09:00"> -->
            <select name="time" id="" class="config_input">
                <option value="09:00">01:00</option>
                <option value="09:00">02:00</option>
                <option value="09:00">03:00</option>
                <option value="09:00">04:00</option>
                <option value="09:00">05:00</option>
                <option value="09:00">06:00</option>
                <option value="09:00">07:00</option>
                <option value="09:00">08:00</option>
                <option value="09:00">09:00</option>
                <option value="10:00">10:00</option>
                <option value="11:00">11:00</option>
                <option value="12:00">12:00</option>
                <option value="13:00">13:00</option>
                <option value="14:00">14:00</option>
                <option value="14:00">15:00</option>
                <option value="14:00">16:00</option>
                <option value="14:00">17:00</option>
                <option value="14:00">18:00</option>
                <option value="14:00">19:00</option>
                <option value="14:00">20:00</option>
                <option value="14:00">21:00</option>
                <option value="14:00">22:00</option>
                <option value="14:00">23:00</option>
                <option value="14:00">24:00</option>
            </select>
         <img class="entitys_config_svg" src="/svg/plus_12_b.svg">

        </div>
    
        <div class="col-sm-4 col-xs-6 config_param" v-for="(value, key) in config_params"  v-bind:key="key" @click="configParamsUpdate(value,key)">
            <span class="param_name" :class="[value == 'true' ? 'selected' : '']">{{ key }}</span>
            <img class="entitys_config_svg" src="/svg/plus_12_b.svg" v-if="value == 'false'" >
            <img class="entitys_config_svg" src="/svg/delete.svg" v-if="value == 'true'" >

        </div>        

    </div>
   
</template>

<script>
    export default {
        props: {
            apikey: {
                type:String,
                },

            tables: String,
        },

        mounted() {
            console.log('Component mounted.');
                console.log(this.config_params);
            // this.fields_data = JSON.parse(this.fields);
            // this.fields_data = this.fields_data.APIKey;

        },

        data:function(){
            return {
                config_params: JSON.parse(this.tables),
                selected: {},
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
            },

            configParamsUpdate(value,key){
                if(this.config_params[key] == 'true'){
                    this.config_params[key] = 'false';
                }else{
                    this.config_params[key] = 'true'
                };
               
                console.log(this.config_params);
                  axios.post('/config/update/tables',{
                    tables: this.config_params,
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
