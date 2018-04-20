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
    ]
}