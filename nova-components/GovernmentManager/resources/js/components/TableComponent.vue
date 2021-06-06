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
        <tr v-for="(item, index) in this.body" :key="index">
            <td>{{ item.id }}</td>
            <td>{{ item.name }}</td>
            <td>{{ item.active }}</td>
            <td>{{ item.created }}</td>
            <td>{{ item.updated }}</td>
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

