<template>
    <input
        :inputType="inputType"
        :required="required"
        :name="name"
        :disabled="inputDisabled"
        v-model="governmentInput">
</template>

<script>
export default {
    props: {
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
