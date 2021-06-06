<template>
    <div>
        <table>
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Active</th>
                <th>Created</th>
                <th>Updated</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="(government, index) in this.governmentList" :key="index">
                <td>{{ government.id }}</td>
                <td>{{ government.name }}</td>
                <td>{{ government.active }}</td>
                <td>{{ government.created }}</td>
                <td>{{ government.updated }}</td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
import axios from 'axios';
import {mapState, mapMutations} from 'vuex';

export default {
    name: 'Tool',
    computed: {
        ...mapState('governmentModule', {
            governmentList: state => state.governmentList,
        })
    },
    mounted() {
        this.getGovernmentList();
    },
    methods: {
        ...mapMutations('governmentModule', [
            'clearGovernmentList',
            'addToGovernmentList'
        ]),
        ...mapActions('governmentModule', [
            'getGovernmentList'
            ]),
    }
}
</script>

