import {createStore} from "vuex";

const store = createStore({
    strict: true,
    state() {
        return {
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

            //AddUser.vue
            userNameInput: '',
            userEmailInput: '',
            userPasswordInput: '',
            userButtonDisabled: false,
            userInputDisabled: false,
            userLoading: false,
            userResponseText: '',
            userCount: null,
        }
    },
    mutations: {
        //App.vue
        toggleViewState(state) {
            state.showGov = !state.showGov;
        },
        toggleViewLabel(state) {
            state.showGov ? state.labelText = 'User' : state.labelText = 'Government';
        },
        //AddGovernment.vue
        changeGovernmentTextInput(state, value) {
            state.governmentInput = value;
        },
        clearGovernmentInputText(state) {
            state.governmentInput = '';
        },
        setGovernmentResponseText(state, value) {
            state.governmentResponseText = value;
        },
        clearGovernmentResponseText(state) {
            state.governmentResponseText = '';
        },
        toggleGovernmentInput(state, value) {
            state.governmentInputDisabled = value;
        },
        toggleGovernmentButton(state, value) {
            state.governmentButtonDisabled = value;
        },
        toggleGovernmentLoading(state, value) {
            state.governmentLoading = value;
        },
        changeGovernmentCount(state, value) {
            state.governmentCount = value;
        },
        clearGovernmentList(state) {
            state.governmentList = [];
        },
        addToGovernmentList(state, value) {
            state.governmentList.push(value);
        },
        changeSelectedGovernment(state, value) {
            state.selectedGovernment = value;
        },
        clearSelectedGovernment(state) {
            state.selectedGovernment = null;
        },

        //AddUser.vue
        changeUserNameInput(state, value) {
            state.userNameInput = value;
        },
        changeUserEmailInput(state, value) {
            state.userEmailInput = value;
        },
        changeUserPasswordInput(state, value) {
            state.userPasswordInput = value;
        },
        clearUserNameInput(state) {
            state.userNameInput = '';
        },
        clearUserEmailInput(state) {
            state.userEmailInput = '';
        },
        clearUserPasswordInput(state) {
            state.userPasswordInput = '';
        },
        toggleUserLoading(state, value) {
            state.userLoading = value;
        },
        toggleUserInput(state, value) {
            state.userInputDisabled = value;
        },
        toggleUserButton(state, value) {
            state.userButtonDisabled = value;
        },
        setUserResponseText(state, value) {
            state.userResponseText = value;
        },
        clearUserResponseText(state) {
            state.userResponseText = '';
        },
        changeUserCount(state, value) {
            state.userCount = value;
        },


    },
});

export default store;
