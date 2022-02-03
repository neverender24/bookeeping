import Vue from 'vue'
import VueRouter from 'vue-router'

import HomeComponent from "./pages/home/index.vue"
import UserAccountComponent from "./pages/account/myAccount.vue"
import UserSettingsComponent from "./pages/account/settings.vue"
import UsersComponent from "./pages/user/index.vue"

import PpmpComponent from "./pages/ppmp/index.vue"
import EmployeeComponent from "./pages/employee/index.vue"
import JevhComponent from "./pages/jevh/index.vue"

Vue.use(VueRouter)

const routes = [
    {
        path: '/dashboard',
        name: 'home',
        component: HomeComponent,
    },
    {
        path: '/user/account',
        name: 'user_account',
        component: UserAccountComponent,
    },
    {
        path: '/user/settings',
        name: 'user_setting',
        component: UserSettingsComponent,
    },
    {
        path: '/users',
        name: 'users',
        component: UsersComponent,
    },
    {
        path: '/ppmp',
        name: 'ppmp',
        component: PpmpComponent,
    },
    {
        path: '/employees',
        name: 'employee',
        component: EmployeeComponent,
    },
    {
        path: '/jevh',
        name: 'jevh',
        component: JevhComponent,
    },
];

const router = new VueRouter({
    routes // short for `routes: routes`
});


export default router
