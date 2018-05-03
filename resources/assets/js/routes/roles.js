export default  {
    path: '/admin/role',
    component: require('../components/main.vue'),
    children: [
        {
            name : 'role-home',
            path: '',
            component: require('../components/admin/role/index'),
        },
        {
            name : 'role-add',
            path: 'add',
            component: require('../components/admin/role/add'),
        },
    ]
}