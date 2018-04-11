export default {
    path: '/admin/choice',
    component: require('../components/main.vue'),
    canReuse : false,
    children: [
        {
            path: '',
            name: 'choice-home',
            component: require('../components/admin/choice/index'),
        },
        {
            path: 'add',
            name: 'choice-add',
            component: require('../components/admin/choice/add'),
        },
        {
            path: ':id/edit',
            name: 'choice-edit',
            component: require('../components/admin/choice/edit'),
        },
        {
            path: ':parent/:id/edit',
            name: 'choice-children-edit',
            component: require('../components/admin/choice/edit'),
        }
    ]
}