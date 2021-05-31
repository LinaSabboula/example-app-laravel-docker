<template>
    <button :id="id"
            :disabled="buttonDisabled"
            :type="type"
            @click="$emit('clickButton')">
        {{ getButtonText }}
    </button>
</template>

<script>
export default {
    emits: [
        'clickButton'
    ],
    props: {
        id: {
            type: String,
            default: "btn"
        },
        buttonText: {
            type: String,
            required: true,
            default: "Ok",
        },
        type: {
            type: String,
            default: 'button',
        },
        buttonDisabled: {
            type: Boolean,
            required: true,
            default: false,
        }
    },
    computed: {
        getButtonText() {
            return this.buttonText === null ? 'OK' : this.buttonText
        }
    },
}
</script>

<style src="../css/button.css"/>
