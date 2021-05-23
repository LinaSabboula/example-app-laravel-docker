<template>
    <button :type="type" @click="clickButton">{{ getButtonText }}</button>
</template>

<script>
export default {
    props: {
        'buttonText': {
            type: String,
            required: true,
            default: "Ok",
        },
        'type': {
            type: String,
            default: 'button',
        },
    },
    computed: {
        getButtonText(){
            return this.buttonText=== null ? 'OK' : this.buttonText
        }
    },
    methods: {
        clickButton(){
            this.$emit("clickButton")
        }
    }
}
</script>

<style src="../css/button.css"/>
