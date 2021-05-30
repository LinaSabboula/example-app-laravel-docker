<template>
    <div class="user-input">
        <label-component
            :label-for=nameInput
            label-text="Name: ">
        </label-component>

        <text-input-component
            :input-disabled=userInputDisabled
            :name=nameInput
            :required=requiredName
            :value=userNameInput
            @update:value=changeNameInput
            @change-text=changeText
            @new-input=validateName
            @submit-input=submitForm>
        </text-input-component>
        <span>{{ this }}</span>
        <label-component
            :label-for=emailInput
            label-text="Email: ">
        </label-component>

        <text-input-component
            :input-disabled=userInputDisabled
            :name=emailInput
            :required=requiredEmail
            :value=userEmailInput
            @update:value=changeEmailInput
            @change-text=changeText
            @new-input=validateEmail
            @submit-input=submitForm>
        </text-input-component>

        <label-component
            :label-for="passwordInput"
            label-text="Password: ">
        </label-component>

        <text-input-component
            :input-disabled=userInputDisabled
            :name=passwordInput
            :required=requiredPassword
            :value=userPasswordInput
            input-type="password"
            @update:value=changePasswordInput
            @change-text=changeText
            @new-input=validatePassword
            @submit-input=submitForm>
        </text-input-component>

        <button-component
            :button-disabled=userButtonDisabled
            button-text="Add"
            type="submit"
            @click-button=submitForm>
        </button-component>

        <loading
            :loading=userLoading>
        </loading>

        <div>
            <counter-component
                :countValue=userCount
                labelFor="userCount"
                user-count-text="Current user count: ">
            </counter-component>
        </div>
        <p>{{ userResponseText }}</p>
    </div>
</template>

<script>
import axios from 'axios';
import {isAlphabetic, isInputEmpty, isSpecificLength, isValidEmail, makeSingleSpaced} from '../helpers/validations.js'
import {mapMutations, mapState} from "vuex";

export default {
    name: 'AddUser',
    data() {
        return {
            //unchanging data
            nameInput: 'nameInput',
            requiredName: true,


            emailInput: 'emailInput',
            requiredEmail: true,


            passwordInput: 'passwordInput',
            requiredPassword: true,


            minPasswordLength: 8,

        }
    },
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
        changeNameInput(value) {
            this.changeUserNameInput(value);
        },
        changeEmailInput(value) {
            this.changeUserEmailInput(value);
        },
        changePasswordInput(value) {
            this.changeUserPasswordInput(value);
        },
        validateName() {
            let validationText = '';
            if (isInputEmpty(this.userNameInput)) {
                validationText = "Validation Failed: Please fill all fields!";
                this.buttonDisabled = true;
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
                validationText = "Validation Failed: Password must be at least 8 characters long";
                this.toggleUserButton(true);
            } else {
                this.toggleUserButton(false);
            }
            this.setUserResponseText(validationText);
        },
        submitForm() {
            this.changeLoadingScreen(true, true, true);
            this.changeNameInput(makeSingleSpaced(this.userNameInput));
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
                    this.clearPasswordInput();
                    let validationText = 'Validation Failed';
                    if (error.response && error.response.data) {
                        validationText += ": " + error.response.data;
                    }
                    this.setUserResponseText(validationText);
                });
        },
        clearAllInputs() {
            this.clearNameInput();
            this.clearEMailInput();
            this.clearPasswordInput();
        },
        clearNameInput() {
            this.clearUserNameInput();
        },
        clearEMailInput() {
            this.clearUserEmailInput();
        },
        clearPasswordInput() {
            this.clearUserPasswordInput();
        },
        changeText() {
            this.clearUserResponseText();
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

<style scoped>

</style>
