<template>
    <div class="container user-input">
        <div class="input-section item">
            <label-component
                label-for="nameInput"
                label-text="Name: ">
            </label-component>

            <text-input-component
                :input-disabled=this.userInputDisabled
                :required=true
                :value=this.userNameInput
                name="nameInput"
                @update:value=this.changeUserNameInput
                @change-text=this.clearUserResponseText
                @new-input=validateName
                @submit-input=submitForm>
            </text-input-component>
        </div>

        <div class="input-section item">
            <label-component
                label-for="emailInput"
                label-text="Email: ">
            </label-component>

            <text-input-component
                :input-disabled=this.userInputDisabled
                :required=true
                :value=this.userEmailInput
                name="emailInput"
                @update:value=this.changeUserEmailInput
                @change-text=this.clearUserResponseText
                @new-input=validateEmail
                @submit-input=submitForm>
            </text-input-component>
        </div>

        <div class="input-section item">
            <label-component
                label-for="passwordInput"
                label-text="Password: ">
            </label-component>

            <text-input-component
                :input-disabled=this.userInputDisabled
                :required=true
                :value=this.userPasswordInput
                input-type="password"
                name="passwordInput"
                @update:value=this.changeUserPasswordInput
                @change-text=this.clearUserResponseText
                @new-input=validatePassword
                @submit-input=submitForm>
            </text-input-component>
        </div>

        <div class="item btn">
            <button-component
                :button-disabled=this.userButtonDisabled
                button-text="Add"
                type="submit"
                @click-button=submitForm>
            </button-component>
        </div>
        <div class="item loading">
            <loading
                :loading=this.userLoading>
            </loading>
        </div>
        <div class="counter item">
            <counter-component
                :countValue=this.userCount
                count-text="Current user count: "
                label-for="userCount">
            </counter-component>
        </div>

    </div>
    <p class="response item">{{ this.userResponseText }}</p>
</template>

<script>
import axios from 'axios';
import {isAlphabetic, isInputEmpty, isSpecificLength, isValidEmail, makeSingleSpaced} from '../helpers/validations.js'
import {mapMutations, mapState} from "vuex";

export default {
    name: 'AddUser',
    computed: {
        ...mapState([
            'userNameInput',
            'userEmailInput',
            'userPasswordInput',
            'userButtonDisabled',
            'userLoading',
            'userResponseText',
            'userInputDisabled',
            'userCount',
        ]),
    },
    mounted() {
        this.getUserCount()
    },
    methods: {
        ...mapMutations([
            'changeUserNameInput',
            'changeUserEmailInput',
            'changeUserPasswordInput',
            'clearUserNameInput',
            'clearUserEmailInput',
            'clearUserPasswordInput',
            'toggleUserLoading',
            'toggleUserButton',
            'toggleUserInput',
            'setUserResponseText',
            'clearUserResponseText',
            'changeUserCount'
        ]),
        validateName() {
            let validationText = '';
            if (isInputEmpty(this.userNameInput)) {
                validationText = "Validation Failed: Please fill all fields!";
                this.toggleUserButton(true);
            } else if (!isAlphabetic(this.userNameInput)) {
                validationText = "Validation Failed: Name must not contain any non-alphabetic characters";
                this.toggleUserButton(true);
            } else {
                this.toggleUserButton(false);
            }
            this.setUserResponseText(validationText);
        },
        validateEmail() {
            let validationText = '';
            if (isInputEmpty(this.userEmailInput)) {
                validationText = "Validation Failed: Please fill all fields!";
                this.toggleUserButton(true);
            } else if (!isValidEmail(this.userEmailInput)) {
                validationText = "Validation Failed: E-mail format not valid";
                this.toggleUserButton(true);
            } else {
                this.toggleUserButton(false);
            }
            this.setUserResponseText(validationText);
        },
        validatePassword() {
            let validationText = '';
            if (isInputEmpty(this.userPasswordInput)) {
                validationText = "Validation Failed: Please fill all fields!";
                this.toggleUserButton(true);
            } else if (!isSpecificLength(this.userPasswordInput, this.minPasswordLength = 8)) {
                validationText = "Validation Failed: Password must be at least " + this.minPasswordLength + " characters long";
                this.toggleUserButton(true);
            } else {
                this.toggleUserButton(false);
            }
            this.setUserResponseText(validationText);
        },
        submitForm() {
            this.changeLoadingScreen(true, true, true);
            this.changeUserNameInput(makeSingleSpaced(this.userNameInput));
            this.validateName();
            this.validateEmail();
            this.validatePassword();
            this.changeLoadingScreen();
            if (!this.userResponseText) {
                this.submitRequest();
            }
        },
        submitRequest() {
            const url = import.meta.env.VITE_APP_ADD_USER;
            axios.post(url, {
                name: this.userNameInput,
                email: this.userEmailInput,
                password: this.userPasswordInput,
            })
                .then(response => {
                    this.changeLoadingScreen();
                    this.setUserResponseText(response.data ? response.data : "Success");
                    this.getUserCount();
                    this.clearAllInputs();
                })
                .catch(error => {
                    this.changeLoadingScreen();
                    this.clearUserPasswordInput();
                    let validationText = 'Validation Failed';
                    if (error.response && error.response.data) {
                        validationText += ": " + error.response.data;
                    }
                    this.setUserResponseText(validationText);
                });
        },
        clearAllInputs() {
            this.clearUserNameInput();
            this.clearUserEmailInput();
            this.clearUserPasswordInput();
        },

        changeLoadingScreen(loading = false, inputDisabled = false, buttonDisabled = false) {
            this.toggleUserLoading(loading);
            this.toggleUserButton(buttonDisabled);
            this.toggleUserInput(inputDisabled);
        },
        async getUserCount() {
            const url = import.meta.env.VITE_APP_USER_COUNT;
            try {
                const response = await axios.get(url);
                if (response.data) {
                    this.changeUserCount(response.data);
                }
            } catch (error) {
                console.error(error);
            }
        }
    },
}
</script>

<style src="../css/user.css"/>
