const governmentModule = {
    namespaced: true,
    state: () => ({
        governmentList: [],
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
};
export default governmentModule;
