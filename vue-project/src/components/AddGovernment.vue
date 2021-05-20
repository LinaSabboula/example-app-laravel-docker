<template>
    <label-component :for="inputName" :labelText="labelText"></label-component>
    <text-input-component :name="inputName" :required="required" v-model="textInput"></text-input-component>
    <button-component :buttonText="buttonText" :type="buttonType" @clickButton="submitForm"></button-component>
    <p>{{textInput}}</p>
</template>

<script>
import ButtonComponent from './ButtonComponent.vue'
import LabelComponent from "./LabelComponent.vue";
import TextInputComponent from "./TextInputComponent.vue"
export default {

    components: { ButtonComponent, LabelComponent, TextInputComponent},
    methods: {
        submitForm(){
            fetch('http://127.0.0.1/api/add-government', {
                headers: {
                    "Content-type": "application/x-www-form-urlencoded;charset=UTF-8",
                },
                method: 'post',
                mode: 'cors',
                body: new URLSearchParams({
                    'name': this.textInput,
                })
            })
                .then(function (response) {
                    return response.text();
                })
                .then(function (text){
                    console.log('Request successful: ', text);
                })
                .catch(function (error) {
                    console.log('Request failed', error);
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
            textInput: ''
        }
    }

}
</script>

<style>

</style>
