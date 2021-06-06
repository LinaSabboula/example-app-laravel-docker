<template>
    <table>
        <thead>
        <tr>
            <th v-for="(header, index) in this.headers"
                :key="index">
                {{ header }}
            </th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="(item, index) of this.body" :key="index">
            <td v-for="(property, index) in item" :key="index">{{ property }}</td>
        </tr>
        </tbody>
    </table>
</template>

<script>
export default {
    name: "TableComponent",
    props: {
        headers: {
            type: Array,
        },
        body: {
            type: Array,
        }
    }
}
</script>

