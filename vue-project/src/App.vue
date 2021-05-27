<template>
    <toggle-component
        :label-text=labelText
        :show-gov=showGov
        name="toggle-switch"
        @pageFlip="pageFlip">
    </toggle-component>
    <add-government v-if="showGov"></add-government>
    <add-user v-if="!showGov"></add-user>
</template>

<script>
import {mapMutations, mapState} from "vuex";

export default {
    computed: {
        ...mapState([
            'showGov',
            'labelText',
        ]),
    },
    methods: {
        ...mapMutations([
            'toggleViewState',
            'toggleViewLabel',
        ]),
        pageFlip() {
            this.toggleViewState();
            this.toggleViewLabel();
        }
    }
}
</script>

<style src="./css/app.css"/>
