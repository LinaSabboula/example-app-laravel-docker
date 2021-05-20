<template>
    <button :type="type" @click="clickButton">{{ buttonText }}</button>
</template>

<script>
export default {
    props: {
        'buttonText': { 
            type: String,
            required: true,
        },
        'type': {
            type: String,
            default: 'button',
        },
    },
    methods: {
        clickButton(){
            this.$emit("clickButton")
        }
    }
}
</script>

<style>
    button{
        color: rgba(255, 255, 255, 0.842);
        background-color: cornflowerblue;
        border-radius: 10px;
        width: auto;
        height: auto;
        border-style: none;
        font-size: 16px;
        margin: 5px;
        
    }
    button:hover{
        background-color: rgb(86, 125, 196); 
    }
</style>