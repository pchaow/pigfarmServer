export default {
    path: '/admin/user',
    component: require('../components/main.vue'),
    children: [
        {
            path: '',
            name: 'user-home',
            component: require('../components/admin/user/index'),
        },
        {
            path: 'add',
            name: 'user-add',
            component: require('../components/admin/user/add'),
        },
        {
            path: ':id/edit',
            name: 'user-edit',
            component: require('../components/admin/user/edit'),
        }
    ]
}