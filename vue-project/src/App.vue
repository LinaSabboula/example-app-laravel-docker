<template>
    <toggle-component
        :name="inputName"
        :showGov=showGov
        :showUser=showUser
        :labelText="labelText"
        @pageFlip="pageFlip">
    </toggle-component>
    <add-government v-if="showGov"></add-government>
    <add-user v-if="showUser"></add-user>
</template>

<script>
export default {
    data(){
        return{
            showGov: true,
            showUser: false,
            labelText: 'User',
            inputName: 'toggle-switch'
        }
    },
    methods:{
        pageFlip(){
            this.showGov = !this.showGov;
            this.showUser = !this.showUser;
            this.showGov ? this.labelText = 'User' : this.labelText = 'Government';
        }
    }
}
</script>

<style src="./css/app.css"/>
