import axios from "axios";

const governmentModule = {
    namespaced: true,
    state: () => ({
        governmentList: [],
        governmentHeaders: ['ID', 'Name', 'Active', 'Created', 'Updated'],
    }),
    mutations: {
        addToGovernmentList(state, value) {
            state.governmentList.push({
                'id': value.fields[0].value,
                'name': value.fields[1].value,
                'active': value.fields[2].value,
                'created': value.fields[3].value,
                'updated': value.fields[4].value
            })
        },
        clearGovernmentList(state) {
            state.governmentList = [];
        },
    },
    actions: {
        getGovernmentList({ commit }) {
            const url = 'http://127.0.0.1/nova-api/governments';
            axios.get(url)
                .then(function (response) {
                    if (response.data && response.data.resources) {
                        commit('clearGovernmentList');
                        for (let government of response.data.resources) {
                            commit('addToGovernmentList', government)
                        }
                    }
                })
                .catch(function (error) {
                    console.error(error);
                });
        }
    },
};
export default governmentModule;
