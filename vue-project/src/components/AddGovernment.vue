<template>
    <label-component
        :for="inputName"
        :labelText="labelText">
    </label-component>

    <text-input-component
        :name="inputName"
        :required="required"
        v-model.trim="governmentInput"
        @changeText="changeText"
        @submitInput="submitForm"
        @newInput="validateGovernment"
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
            :countValue="govCount"
            userCountText='Current government count: '
            labelFor="govCount">
        </counter-component>
    </div>
    <p>{{ responseText }}</p>
    <dropdown-list-component
        :items="govList"
        label-text="Governments: "
        input-name="gov-list"
        v-model="selectedGovID"
        @change-text="changeText">
    </dropdown-list-component>

    <button-component
        v-if="selectedGovID"
        button-text="Delete"
        type="submit"
        :button-disabled="buttonDisabled"
        @click-button="deleteGov">
    </button-component>
</template>

<script>
import axios from 'axios';
import {isInputEmpty} from '../helpers/validations.js'
export default {
    name: 'AddGovernment',
    mounted(){
        this.getGovernmentCount();
        this.populateList();
    },
    methods: {
        deleteGov(){
            this.changeLoadingScreen(true,true, true);
            // ensure that `selectedGovID` is set
            if(isInputEmpty(this.selectedGovID)){
                this.responseText = "Validation Failed: Please provide a government!";
                this.changeLoadingScreen();
            }
            else{
                this.deleteRequest();
            }
        },
        deleteRequest(){
            const url = import.meta.env.VITE_APP_DELETE_GOV;
            axios.delete(url+this.selectedGovID)
                .then(response => {
                    this.changeLoadingScreen();
                    this.responseText = response.data ? response.data : "Success";
                    this.getGovernmentCount();
                    this.populateList();
                })
                .catch(error => {
                    this.changeLoadingScreen();
                    this.responseText = 'Validation Failed';
                    if (error.response && error.response.data) {
                        this.responseText += ": " + error.response.data;
                    }
                });
        },
        validateGovernment(){
            if(isInputEmpty(this.governmentInput)) {
                this.responseText = "Validation Failed: Please provide a government!";
                this.buttonDisabled = true;
            }
            else{
                this.buttonDisabled = false;
            }
        },
        submitForm(){
            this.changeLoadingScreen(true,true, true);
            if(isInputEmpty(this.governmentInput)){
                this.responseText = "Validation Failed: Please provide a government!";
                this.changeLoadingScreen();
            }
            else{
                this.submitRequest();
            }
        },
        submitRequest(){
            const url = import.meta.env.VITE_APP_ADD_GOV;
            axios.post(url,{
                name: this.governmentInput,
            })
                .then(response => {
                    this.changeLoadingScreen();
                    this.responseText = response.data ? response.data : "Success";
                    this.getGovernmentCount();
                    this.populateList();
                    this.clearInput();
                })
                .catch(error => {
                    this.changeLoadingScreen();
                    this.responseText = 'Validation Failed';
                    if(error.response && error.response.data){
                        this.responseText += ": " + error.response.data;
                    }
                });
        },
        changeLoadingScreen(loading=false, inputDisabled=false, buttonDisabled=false){
            this.loading = loading;
            this.inputDisabled = inputDisabled;
            this.buttonDisabled = buttonDisabled;
        },
        clearInput(){
            this.governmentInput = '';
        },
        changeText() {
            this.responseText = '';
        },
        async getGovernmentCount() {
            const url = import.meta.env.VITE_APP_GOV_COUNT;
            try {
                const response = await axios.get(url);
                if(response.data) {
                    this.govCount = response.data;
                }
            } catch (error) {
                console.error(error);
            }
        },
        async populateList(){
            const url = import.meta.env.VITE_APP_GET_ALL_GOVS;
            try {
                const response = await axios.get(url);
                if(response.data) {
                    this.govList = [];
                    this.selectedGovID = null;
                    for (let gov of response.data){
                        this.govList.push(gov);
                    }
                }
            } catch (error) {
                console.error(error);
            }
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
            inputDisabled: false,
            buttonDisabled: false,
            loading: false,
            govCount: 0,
            govList: [],
            selectedGovID: null,
        }
    },

}
</script>
