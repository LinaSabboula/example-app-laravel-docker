import governmentModule from "./store/index";

Nova.booting((Vue, router, store) => {
    store.registerModule('governmentModule', governmentModule);
    Vue.component('table-component', require('./components/TableComponent'));
    router.addRoutes([
        {
            name: 'government-manager',
            path: '/government-manager',
            component: require('./components/Tool'),
        },
    ]);
});

