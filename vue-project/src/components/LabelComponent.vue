<template>
    <label :label-for=inputName>{{ labelText }}</label>
</template>

<script>
export default {
    props: {
        inputName: {
            type: String,
            default: 'label',
        },
        labelText: {
            type: String,
            required: true,
        },
    },
}
</script>
