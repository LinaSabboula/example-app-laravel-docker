<template>
    <div class="toggle">
            <label-component :for="inputName"
                             :labelText="labelText">
            </label-component>
            <input :name="inputName"
                   type="checkbox"
                   @change="$emit('pageFlip')">
            <div class="switch-btn"></div>
        </div>

</template>

<script>
export default {
    emits: [
        'pageFlip'
    ],
    props:{
        'showGov': {
            type: Boolean,
            default: true,
        },
        'labelText': {
            type: String,
            default: 'User',
        },
        'inputName': {
            type: String,
            default: 'toggle-switch'
        }
    },
}
</script>

<style src="../css/toggle.css"/>
