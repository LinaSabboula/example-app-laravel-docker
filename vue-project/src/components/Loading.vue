<template>
    <p v-if="loading">Please wait....</p>
</template>

<script>
export default {
    props: {
        'loading': {
            type: Boolean,
            required: true,
            default: false,
        }
    },
}
</script>

