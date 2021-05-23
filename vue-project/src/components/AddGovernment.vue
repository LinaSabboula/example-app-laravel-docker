<template>
    <label-component :for="inputName" :labelText="labelText"></label-component>
    <text-input-component :name="inputName" :required="required" v-model="governmentInput"></text-input-component>
    <button-component :buttonText="buttonText" :type="buttonType" @clickButton="submitForm"></button-component>
    <p>{{ responseText }}</p>
</template>

<script>
import ButtonComponent from './ButtonComponent.vue'
import LabelComponent from "./LabelComponent.vue";
import TextInputComponent from "./TextInputComponent.vue"
import axios from 'axios';
export default {
    components: { ButtonComponent, LabelComponent, TextInputComponent},
    methods: {
        submitForm(){
            const params = new URLSearchParams();
            params.append('name', this.governmentInput);
            const url = import.meta.env.VITE_APP_ADD_GOV;
            axios.post(url, params)
                .then(response => {
                    this.responseText = response.data;
                    console.log(response.data);
                })
                .catch(error => {
                    this.responseText = 'Validation Failed: ' + error.response.data[0]
                });
        }
    },
    data(){
        return{
            inputName: 'gov-name',
            labelText: 'Government: ',
            buttonType: 'submit',
            buttonText: 'Add',
            inputType: 'text',
            required: true,
            governmentInput: '',
            responseText: '',
        }
    }
}
</script>
