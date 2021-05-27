<template>
    <input
        :disabled="inputDisabled"
        :name="name"
        :required="required"
        :type="inputType"
        :value="value"
        @input="$emit('update:value', $event.target.value)"
        @keydown="$emit('changeText')"
        @keyup="$emit('newInput')"
        @keyup.enter="$emit('submitInput')">

</template>

<script>
export default {
    emits: [
        'changeText',
        'submitInput',
        'update:value',
        'newInput',
    ],
    props: {
        value: {
            type: String
        },
        name: {
            type: String,
        },
        required: {
            type: Boolean,
            required: true,
        },
        inputType: {
            type: String,
            default: 'text',
        },
        inputDisabled: {
            type: Boolean,
            required: true,
            default: false,
        },
    },
}
</script>
