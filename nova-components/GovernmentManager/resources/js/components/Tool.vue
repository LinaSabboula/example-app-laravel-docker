<template>
    <div>
        <table-component
            :headers=this.governmentHeaders
            :body='this.governmentList'>
        </table-component>
    </div>
</template>

<script>
import {mapState, mapMutations, mapActions} from 'vuex';

export default {
    name: 'Tool',
    computed: {
        ...mapState('governmentModule', {
            governmentList: state => state.governmentList,
            governmentHeaders: state => state.governmentHeaders,
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

