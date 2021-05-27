import { createStore } from "vuex";

const store = createStore({
    state(){
        return{
            // App.vue
            showGov: true,
            labelText: 'User',
        }
    },
    mutations: {
        //App.vue
        toggleViewState(state){
            state.showGov = !state.showGov;
        },
        toggleViewLabel(state){
            state.showGov ? state.labelText = 'User' : state.labelText = 'Government';
        },
    },
    actions: {
        //App.vue
        toggleViewState(context){
            context.commit('toggleViewState');
        },
        toggleViewLabel(context){
            context.commit('toggleViewLabel');
        }
    },
});

export default store;
