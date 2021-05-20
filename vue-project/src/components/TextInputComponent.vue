<template>
    <input :inputType="inputType"  :required="required"  :name="name" v-model="textInput">
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
