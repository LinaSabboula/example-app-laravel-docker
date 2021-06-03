Nova.booting((Vue, router, store) => {
  router.addRoutes([
    {
      name: 'government-manager',
      path: '/government-manager',
      component: require('./components/Tool'),
    },
  ])
})
