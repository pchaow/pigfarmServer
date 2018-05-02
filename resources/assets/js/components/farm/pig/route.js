export default {
    path: '/farm/pig',
    component: require('../../main'),
    canReuse: false,
    children: [
        {
            path: '',
            name: 'pig-home',
            component: require('./index'),
        },
        {
            path: '/add',
            name: 'pig-add',
            component: require('./add'),
        },
        {
            path: ':id/edit',
            name: 'pig-edit',
            component: require('./edit'),
        },
        {
            path: ':id/view',
            name: 'pig-view',
            component: require('./view'),
        },
        {
            path: ':id/breeder',
            name: 'pig-breeder',
            component: require('./breeder/add'),
        },
    ]
}