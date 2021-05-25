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
import {isInputEmpty, isAlphabetic, isValidEmail, isSpecificLength, makeSingleSpaced} from '../helpers/validations.js'
export default {
    methods: {
        submitForm(){
            this.changeLoadingScreen(true, true);
            this.nameInputText = makeSingleSpaced(this.nameInputText);
            console.log(this.nameInputText);
            if (isInputEmpty(this.nameInputText)||
                isInputEmpty(this.emailInputText)||
                isInputEmpty(this.passwordInputText)){
                this.responseText = "Validation Failed: Please fill all fields!";
                this.clearPasswordInput();
                this.changeLoadingScreen();
            }
            else if(!isAlphabetic(this.nameInputText)){
                this.responseText = "Validation Failed: Name must not contain any non-alphabetic characters"
                this.clearPasswordInput();
                this.changeLoadingScreen();
            }
            else if(!isValidEmail(this.emailInputText)){
                this.responseText = "Validation Failed: E-mail format not valid";
                this.clearPasswordInput();
                this.changeLoadingScreen();
            }
            else if(!isSpecificLength(this.passwordInputText, this.minPasswordLength = 8)){
                this.responseText = "Validation Failed: Password must be at least 8 characters long";
                this.clearPasswordInput();
                this.changeLoadingScreen();
            }
            else{
                this.submitRequest();
            }

        },
        submitRequest(){
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
                });
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
            minPasswordLength: 8,

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
