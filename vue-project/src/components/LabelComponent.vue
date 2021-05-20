<template>
    <label :for="inputName">{{ labelText }}</label>
</template>

<script>
export default {
    props: {
        'inputName': {
            type: String,
        },
        'labelText': {
            type: String,
            required: true,
        },
    },
}
</script>
