<template>
    <input
        :type="inputType"
        :required="required"
        :name="name"
        :disabled="inputDisabled"
        @keydown="$emit('changeText')"
        @keyup.enter="$emit('submitInput')"
        @keyup="$emit('newInput')"
        :value="modelValue"
        @input="$emit('update:modelValue', $event.target.value)">

</template>

<script>
export default {
    emits: [
        'changeText',
        'submitInput',
        'update:modelValue',
        'newInput',
    ],
    props: {
        'modelValue':{
            type: String
        },
        'name': {
            type: String,
        },
        'required': {
            type: Boolean,
            required: true,
        },
        'inputType': {
            type: String,
            default: 'text',
        },
        'inputDisabled': {
            type: Boolean,
            required: true,
            default: false,
        },
    },
}
</script>
