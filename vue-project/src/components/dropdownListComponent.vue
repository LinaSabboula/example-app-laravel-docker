<template>
    <label-component :label-text="labelText"></label-component>
    <select name="labelText"
            :value="modelValue"
            @input="$emit('update:modelValue', $event.target.value)">
        <option value="" disabled selected>
            Select your option
        </option>
        <option
            v-for="item in items"
            :key="item.id"
            :value=item.id>
            {{ item.name }}
        </option>
    </select>
</template>

<script>

export default {
    name: "dropdownListComponent",
    props: {
        'placeholderValue': {
            String,
        },
        'modelValue':{
            type: String
        },
        'items': {
            type: Array,
            required: true,
            default: [],
        },
        'labelText': {
            type: String,
        },
        'inputName': {
            type: String,
        }
    },
}
</script>

