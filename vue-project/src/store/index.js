import { createStore } from "vuex";

const store = createStore({
    strict: true,
    state(){
        return{
            // App.vue
            showGov: true,
            labelText: 'User',

            //AddGovernment.vue
            governmentInput: '',
            governmentResponseText: '',
            governmentInputDisabled: false,
            governmentButtonDisabled: false,
            governmentLoading: false,
            governmentCount: null,
            governmentList: [],
            selectedGovernment: null,
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
        //AddGovernment.vue
        changeGovernmentTextInput(state, value){
            state.governmentInput = value;
        },
        clearGovernmentInputText(state){
            state.governmentInput = '';
        },
        setGovernmentResponseText(state, value){
            state.governmentResponseText = value;
        },
        clearGovernmentResponseText(state){
            state.governmentResponseText = '';
        },
        toggleGovernmentInput(state, value){
            state.governmentInputDisabled = value;
        },
        toggleGovernmentButton(state, value){
            state.governmentButtonDisabled = value;
        },
        toggleGovernmentLoading(state, value){
            state.governmentLoading = value;
        },
        changeGovernmentCount(state, value){
            state.governmentCount = value;
        },
        clearGovernmentList(state){
            state.governmentList = [];
        },
        addToGovernmentList(state, value){
            state.governmentList.push(value);
        },
        changeSelectedGovernment(state, value){
            state.selectedGovernment = value;
        },
        clearSelectedGovernment(state){
            state.selectedGovernment = null;
        }
    },
});

export default store;
