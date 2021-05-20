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
            // front-side validation
            console.log("button has been clicked")
            console.log(this.textInput)
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