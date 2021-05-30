<template>
    <div class="container">
        <div class="item">
            <label-component
                label-for="gov-name"
                labelText='Government: '>
            </label-component>

            <text-input-component
                :input-disabled=this.governmentInputDisabled
                :required=true
                :value=this.governmentInput
                name="gov-name"
                @change-text=clearResponseText
                @new-input=validateGovernment
                @submit-input=submitForm
                @update:value=changeTextInput>
            </text-input-component>
        </div>
        <div class="item">
            <button-component
                :button-disabled=this.governmentButtonDisabled
                button-text="Add"
                type="submit"
                @click-button=submitForm>
            </button-component>
        </div>
        <div class="item">
            <loading
                :loading=this.governmentLoading>
            </loading>
        </div>
        <div class="item counter">
            <counter-component
                :count-value=this.governmentCount
                count-text='Current government count: '
                label-for="govCount">
            </counter-component>
        </div>

        <p class="item response">{{ this.governmentResponseText }}</p>

        <div class="item dropdown">
            <dropdown-list-component
                :items=this.governmentList
                :value=this.selectedGovernment
                input-name="gov-list"
                label-text="Governments: "
                @update:value=selectGovernment
                @change-text=clearResponseText>
            </dropdown-list-component>

            <button-component
                v-if=this.selectedGovernment
                id="delete"
                :button-disabled=this.governmentButtonDisabled
                button-text="Delete"
                type="submit"
                @click-button=deleteGov>
            </button-component>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
import {mapMutations, mapState} from 'vuex';
import {isInputEmpty} from '../helpers/validations.js'

export default {
    name: 'AddGovernment',
    computed: {
        ...mapState([
            'governmentInput',
            'governmentResponseText',
            'governmentInputDisabled',
            'governmentButtonDisabled',
            'governmentLoading',
            'governmentCount',
            'governmentList',
            'selectedGovernment',
        ]),
    },
    mounted() {
        this.getGovernmentCount();
        this.populateList();
    },
    methods: {
        ...mapMutations([
            'changeGovernmentTextInput',
            'clearGovernmentInputText',
            'setGovernmentResponseText',
            'clearGovernmentResponseText',
            'toggleGovernmentInput',
            'toggleGovernmentButton',
            'toggleGovernmentLoading',
            'changeGovernmentCount',
            'clearGovernmentList',
            'addToGovernmentList',
            'changeSelectedGovernment',
            'clearSelectedGovernment',

        ]),
        changeTextInput(value) {
            this.changeGovernmentTextInput(value);
        },
        selectGovernment(value) {
            this.changeSelectedGovernment(value);
        },
        deleteGov() {
            this.changeLoadingScreen(true, true, true);
            // ensure that `selectedGovernment` is set
            if (isInputEmpty(this.selectedGovernment)) {
                let validationText = "Validation Failed: Please provide a government!";
                this.setGovernmentResponseText(validationText);
                this.changeLoadingScreen();
            } else {
                this.deleteRequest();
            }
        },
        successfulRequest(response) {
            this.changeLoadingScreen();
            let validationText = response.data ? response.data : "Success";
            this.setGovernmentResponseText(validationText);
            this.getGovernmentCount();
            this.populateList();
        },
        failedRequest(error) {
            this.changeLoadingScreen();
            let validationText = 'Validation Failed: ';
            if (error.response && error.response.data) {
                validationText += error.response.data;
            } else {
                validationText += error;
            }
            this.setGovernmentResponseText(validationText);
        },
        deleteRequest() {
            const url = import.meta.env.VITE_APP_DELETE_GOV;
            axios.delete(url + this.selectedGovernment)
                .then(response => {
                    this.successfulRequest(response);
                })
                .catch(error => {
                    this.failedRequest(error);
                });
        },
        validateGovernment() {
            if (isInputEmpty(this.governmentInput)) {
                let validationText = "Validation Failed: Please provide a government!";
                this.setGovernmentResponseText(validationText);
                this.toggleGovernmentButton(true);
            } else {
                this.toggleGovernmentButton(false);
            }
        },
        submitForm() {
            this.changeLoadingScreen(true, true, true);
            if (isInputEmpty(this.governmentInput)) {
                let validationText = "Validation Failed: Please provide a government!";
                this.setGovernmentResponseText(validationText);
                this.changeLoadingScreen();
            } else {
                this.submitRequest();
            }
        },
        submitRequest() {
            const url = import.meta.env.VITE_APP_ADD_GOV;
            axios.post(url, {
                name: this.governmentInput,
            })
                .then(response => {
                    this.successfulRequest(response);
                    this.clearInput();
                })
                .catch(error => {
                    this.failedRequest(error);
                    /**
                     * TODO
                     *  cache failed duplicate government variable
                     *  and check if new input is different from
                     *  cached variable instead of sending multiple queries
                     */
                });
        },
        changeLoadingScreen(loading = false, inputDisabled = false, buttonDisabled = false) {
            this.toggleGovernmentLoading(loading);
            this.toggleGovernmentInput(inputDisabled);
            this.toggleGovernmentButton(buttonDisabled);
        },
        clearInput() {
            this.clearGovernmentInputText();
        },
        clearResponseText() {
            this.clearGovernmentResponseText();
        },
        async getGovernmentCount() {
            const url = import.meta.env.VITE_APP_GOV_COUNT;
            try {
                const response = await axios.get(url);
                if (response.data) {
                    this.changeGovernmentCount(response.data);
                }
            } catch (error) {
                console.error(error);
            }
        },
        async populateList() {
            const url = import.meta.env.VITE_APP_GET_ALL_GOVS;
            try {
                const response = await axios.get(url);
                if (response.data) {
                    this.clearGovernmentList();
                    this.clearSelectedGovernment();
                    for (let government of response.data) {
                        this.addToGovernmentList(government);
                    }
                }
            } catch (error) {
                console.error(error);
            }
        },
    },
}
</script>

<style src="../css/government.css"/>
