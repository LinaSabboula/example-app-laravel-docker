<template>
    <input :inputType="inputType"  :required="required"  :name="name" v-model.trim="governmentInput">
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
    },
}
</script>
