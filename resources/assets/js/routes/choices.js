export default {
    path: '/admin/choice',
    component: require('../components/main.vue'),
    canReuse: false,
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
            path: '/:id/edit',
            name: 'choice-edit',
            component: require('../components/admin/choice/edit'),
        },
        {
            path: '/:id/view',
            name: 'choice-view',
            component: require('../components/admin/choice/view'),
        },
        {
            path: '/:id/add',
            name: 'choice-children-add',
            component: require('../components/admin/choice/add'),
        },

    ]
}