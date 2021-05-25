<template>
    <div class="user-input">
        <label-component
            :for="nameInput"
            :label-text="nameLabel">
        </label-component>

        <text-input-component
            :name="nameInput"
            :required="requiredName"
            v-model.trim="nameInputText"
            @changeText="changeText"
            @submitInput="submitForm"
            :input-disabled="inputDisabled">
        </text-input-component>

        <label-component
            :for="emailInput"
            :label-text="emailLabel">
        </label-component>

        <text-input-component
            :name="emailInput"
            :required="requiredEmail"
            v-model.trim="emailInputText"
            @changeText="changeText"
            @submitInput="submitForm"
            :input-disabled="inputDisabled">
        </text-input-component>

        <label-component
            :for="passwordInput"
            :label-text="passwordLabel">
        </label-component>

        <text-input-component
            :inputType="passwordInputType"
            :name="passwordInput"
            :required="requiredPassword"
            v-model.trim="passwordInputText"
            @changeText="changeText"
            @submitInput="submitForm"
            :input-disabled="inputDisabled">
        </text-input-component>

        <button-component
            :buttonText="buttonText"
            :type="buttonType"
            :button-disabled="inputDisabled"
            @clickButton="submitForm">
        </button-component>

        <loading
            :loading="loading">
        </loading>

        <p>{{ responseText }}</p>
    </div>

</template>

<script>
import axios from 'axios';
export default {
    methods: {
        submitForm(){
            this.changeLoadingScreen(true, true);
            const url = import.meta.env.VITE_APP_ADD_USER;
            axios.post(url, {
                name: this.nameInputText,
                email: this.emailInputText,
                password: this.passwordInputText,
            })
            .then(response => {
                this.changeLoadingScreen();
                this.responseText = response.data ? response.data : "Success";
                this.clearAllInputs();
            })
            .catch(error =>{
                this.changeLoadingScreen();
                this.clearPasswordInput();
                this.responseText = 'Validation Failed';
                console.log(error.response.data)
                if(error.response && error.response.data){
                    this.responseText += ": " + error.response.data;
                }
            })

        },
        clearAllInputs(){
            this.clearNameInput();
            this.clearEMailInput();
            this.clearPasswordInput();
        },
        clearNameInput(){
            this.nameInputText = '';
        },
        clearEMailInput() {
            this.emailInputText = '';
        },
        clearPasswordInput(){
            this.passwordInputText = '';
        },
        changeText(){
            this.responseText = '';
        },
        changeLoadingScreen(loading=false, inputDisabled=false){
            this.loading = loading;
            this.inputDisabled = inputDisabled;
        },
    },
    data() {
        return{
            nameInput: 'nameInput',
            requiredName: true,
            nameLabel: 'Name: ',
            nameInputText: '',

            emailInput: 'emailInput',
            requiredEmail: true,
            emailLabel: 'E-mail: ',
            emailInputText: '',

            passwordInput: 'passInput',
            passwordInputType: 'password',
            requiredPassword: true,
            passwordLabel: 'Password: ',
            passwordInputText: '',

            buttonText: 'Add',
            buttonType: 'submit',

            loading: false,

            responseText: '',

            inputDisabled: false,
        }
    },
}
</script>

<style scoped>

</style>
