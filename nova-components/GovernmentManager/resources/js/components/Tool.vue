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
        this.getGovernments();
    },
    methods: {
        ...mapMutations('governmentModule', [
            'clearGovernmentList',
            'addToGovernmentList'
        ]),
        async getGovernments() {
            try {
                const url = 'http://127.0.0.1/nova-api/governments';
                const response = await axios.get(url);
                if (response.data && response.data.resources) {
                    this.clearGovernmentList();
                    for (let government of response.data.resources) {
                        this.addToGovernmentList(government);
                    }
                }
            } catch (error) {
                console.error(error);
            }
        }
    }
}
</script>

