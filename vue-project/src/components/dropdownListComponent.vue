<template>
    <label-component
        :for=inputName
        :label-text="labelText">
    </label-component>
    <select :name=inputName
            :value="value"
            @change="$emit('changeText')"
            @input="$emit('update:value', $event.target.value)">
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
    emits: [
        'changeText',
        'update:value',
    ],
    props: {
        placeholderValue: {
            String,
        },
        value:{
            type: String
        },
        items: {
            type: Array,
            required: true,
            default: [],
        },
        labelText: {
            type: String,
        },
        inputName: {
            type: String,
        }
    },
}
</script>

