<template>
    <label-component
        :for="labelFor"
        :labelText="userCountText">
    </label-component>
    <span>{{ countValue }}</span>
</template>

<script>

export default {
    props:{
        countValue: {
            type: Number,
            default: 0,
        },
        userCountText:{
          type: String,
          default: 'Count: ',
        },
        labelFor: {
            type: String,
        },
    }
}

</script>
