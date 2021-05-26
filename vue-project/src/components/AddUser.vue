<template>
    <div class="user-input">
        <label-component
            :for="nameInput"
            :labelText="nameLabel">
        </label-component>

        <text-input-component
            :name="nameInput"
            :required="requiredName"
            v-model.trim="nameInputText"
            @changeText="changeText"
            @submitInput="submitForm"
            @newInput="validateName"
            :input-disabled="inputDisabled">
        </text-input-component>

        <label-component
            :for="emailInput"
            :labelText="emailLabel">
        </label-component>

        <text-input-component
            :name="emailInput"
            :required="requiredEmail"
            v-model.trim="emailInputText"
            @changeText="changeText"
            @submitInput="submitForm"
            @newInput="validateEmail"
            :input-disabled="inputDisabled">
        </text-input-component>

        <label-component
            :for="passwordInput"
            :labelText="passwordLabel">
        </label-component>

        <text-input-component
            :inputType="passwordInputType"
            :name="passwordInput"
            :required="requiredPassword"
            v-model.trim="passwordInputText"
            @changeText="changeText"
            @submitInput="submitForm"
            @newInput="validatePassword"
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

        <div>
            <counter-component
                :countValue="userCount"
                userCountText="Current user count: "
                labelFor="userCount">
            </counter-component>
        </div>
        <p>{{ responseText }}</p>
    </div>
</template>

<script>
import axios from 'axios';
import {isAlphabetic, isInputEmpty, isSpecificLength, isValidEmail, makeSingleSpaced} from '../helpers/validations.js'

export default {
    mounted() {
        this.getUserCount()
    },
    methods: {
        validateName(){
            if(isInputEmpty(this.nameInputText)){
                this.responseText = "Validation Failed: Please fill all fields!";
                this.buttonDisabled = true;
            }
            else if(!isAlphabetic(this.nameInputText)) {
                this.responseText = "Validation Failed: Name must not contain any non-alphabetic characters";
                this.buttonDisabled = true;
            }
            else{
                this.buttonDisabled = false
            }
        },
        validateEmail(){
            if (isInputEmpty(this.emailInputText)){
                this.responseText = "Validation Failed: Please fill all fields!";
                this.buttonDisabled = true;
            }
            else if(!isValidEmail(this.emailInputText)) {
                this.responseText = "Validation Failed: E-mail format not valid";
                this.buttonDisabled = true;
            }
            else{
                this.buttonDisabled = false
            }
        },
        validatePassword(){
            if (isInputEmpty(this.passwordInputText)) {
                this.responseText = "Validation Failed: Please fill all fields!";
                this.buttonDisabled = true;
            }
        else if(!isSpecificLength(this.passwordInputText, this.minPasswordLength = 8)) {
                this.responseText = "Validation Failed: Password must be at least 8 characters long";
                this.buttonDisabled = true;
            }
            else{
                this.buttonDisabled = false
            }
        },
        submitForm(){
            this.changeLoadingScreen(true, true, true);
            this.nameInputText = makeSingleSpaced(this.nameInputText);
            this.validateName();
            this.validateEmail();
            this.validatePassword();
            this.changeLoadingScreen();
            if(!this.responseText){
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
                    this.getUserCount();
                    this.clearAllInputs();
                })
                .catch(error =>{
                    this.changeLoadingScreen();
                    this.clearPasswordInput();
                    this.responseText = 'Validation Failed';
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
        changeLoadingScreen(loading=false, inputDisabled=false, isButtonDisabled=false){
            this.loading = loading;
            this.inputDisabled = inputDisabled;
            this.buttonDisabled = isButtonDisabled;
        },
        async getUserCount(){
            const url = import.meta.env.VITE_APP_USER_COUNT;
            try {
                const response = await axios.get(url);
                if(response.data) {
                    this.userCount = response.data;
                }
            } catch (error) {
                console.error(error);
            }
        }
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
            buttonDisabled: false,

            loading: false,

            responseText: '',

            inputDisabled: false,

            userCount: 0,
        }
    },
}
</script>

<style scoped>

</style>
