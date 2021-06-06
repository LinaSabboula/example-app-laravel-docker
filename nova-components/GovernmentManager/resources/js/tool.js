import governmentModule from "./store/index";

Nova.booting((Vue, router, store) => {
    store.registerModule('governmentModule', governmentModule);
    router.addRoutes([
        {
            name: 'government-manager',
            path: '/government-manager',
            component: require('./components/Tool'),
        },
    ]);
});

