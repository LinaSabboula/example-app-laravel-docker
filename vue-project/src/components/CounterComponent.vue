<template>
    <label-component
        :for=labelFor
        :label-text=countText>
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
        countText:{
          type: String,
          default: 'Count: ',
        },
        labelFor: {
            type: String,
        },
    }
}

</script>
