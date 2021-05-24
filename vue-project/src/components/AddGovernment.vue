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
        @changeText="changeText"
        :input-disabled="inputDisabled">
    </text-input-component>

    <button-component
        :buttonText="buttonText"
        :type="buttonType"
        :button-disabled="buttonDisabled"
        @clickButton="submitForm">
    </button-component>

    <loading
        :loading="loading">
    </loading>

    <p>{{ responseText }}</p>
</template>

<script>
import axios from 'axios';
export default {
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
                    this.changeLoadingScreen();
                    this.responseText = 'Validation Failed';
                    if(error.response !== null){
                        if(error.response.data){
                            this.responseText += ": " + error.response.data[0];
                        }
                    }
                });
        },
        changeLoadingScreen(loading=false, buttonDisabled=false, inputDisabled=false){
            this.loading = loading;
            this.buttonDisabled = buttonDisabled;
            this.inputDisabled = inputDisabled;
        },
        clearInput(){
            this.governmentInput = '';
            if(this.$refs.inputField){
                if(this.$refs.inputField.governmentInput){
                    this.$refs.inputField.governmentInput = '';
                }
            }
        },
        changeText(){
            this.responseText = '';
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
            buttonDisabled: false,
            inputDisabled: false,
            loading: false,
        }
    }
}
</script>
