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

<style src="../css/button.css"/>
