<template>
    <label-component
        :for="inputName"
        :labelText="labelText">
    </label-component>

    <text-input-component
        ref="inputField"
        :name="inputName"
        :required="required"
        v-model.trim="governmentInput"
        :input-disabled="inputDisabled">
    </text-input-component>

    <button-component
        :buttonText="buttonText"
        :type="buttonType"
        :button-disabled="buttonDisabled"
        @clickButton="submitForm">
    </button-component>
    <p v-if="loading">Please wait....</p>
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
            this.changeLoadingScreen(true, true, true)
            const params = new URLSearchParams();
            params.append('name', this.governmentInput);
            const url = import.meta.env.VITE_APP_ADD_GOV;
            axios.post(url, params)
                .then(response => {
                    this.changeLoadingScreen();
                    this.responseText = response.data;
                    this.clearInput();
                })
                .catch(error => {
                    this.responseText = 'Validation Failed: ' + error.response.data[0]
                });
        },
        changeLoadingScreen(loading=false, buttonDisabled=false, inputDisabled=false){
            this.loading = loading;
            this.buttonDisabled = buttonDisabled;
            this.inputDisabled = inputDisabled;

        },
        clearInput(){
            this.$refs.inputField.governmentInput = '';
        },
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
            buttonDisabled: false,
            inputDisabled: false,
            loading: false,
        }
    }
}
</script>
