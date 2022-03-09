import Login from './components/Auth/LoginComponent.vue';
import SubscriberList from './components/tasks/List.vue';
import Users from './components/users/List.vue';
import UserDetail from './components/users/Detail.vue';
import LocationList from './components/location/List.vue';
import LocationDetail from './components/location/Detail.vue';
import ForgotPassword from './components/Auth/ForgotPassword.vue';
import NewPassword from './components/Auth/NewPassword.vue';


export default {
    mode: 'history',

    routes: [
        {
            name: 'login',
            path: '/login',
            component: Login,
            meta: {
                hideForAuth: true,
            }
        },

        {
            name: 'forgot-password',
            path: '/forgot-password',
            component: NewPassword,
            meta: {
                hideForAuth: true,
            }
        },
        {
            name: 'forgot-password-send-email',
            path: '/forgot-password-send-email',
            component: ForgotPassword,
            meta: {
                hideForAuth: true,
            }
        },
        {
            name: 'tasks',
            path: '/tasks',
            component: SubscriberList,
            meta: {
                requiresAuth: true,
                type: 2,
            }
        },
        {
            name: 'location',
            path: '/location',
            component: LocationList,
            meta: {
                requiresAuth: true,
                type: 2,
            }
        },
        {
            name: 'location-detail',
            path: '/location/:id',
            component: LocationDetail,
            meta: {
                requiresAuth: true,
                type: 1,
            }
        },
        {
            name: 'users',
            path: '/users',
            component: Users,
            meta: {
                requiresAuth: true,
                type: 1,
            }
        },
        {
            name: 'userDetail',
            path: '/users/detail/:id',
            component: UserDetail,
            meta: {
                requiresAuth: true,
                type: 1,
            }
        },
    ]
}
