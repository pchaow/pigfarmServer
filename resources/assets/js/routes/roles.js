export default  {
    path: '/admin/role',
    component: require('../components/main.vue'),
    children: [
        {
            path: '',
            component: require('../components/admin/role/index'),
        },
        {
            path: 'add',
            component: require('../components/admin/role/add'),
        },
    ]
}