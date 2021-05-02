import Vue from 'vue';
import Router from 'vue-router';

import auth from './middleware/auth';
import NotFound from "./pages/NotFound";
import Forbidden from './pages/Forbidden'
import Login from "./pages/auth/Login";
import Register from "./pages/auth/Register";


import Welcome from "./pages/Index";
import Landing from "./pages/public/Landing";

import App from "./pages/App";
import Dashboard from "./pages/admin/Dashboard";


Vue.use(Router);

const router = new Router({
    routes: [
        {
            path:'',
            component:Welcome,
            children:[
                {
                    path:'',
                    component:Landing,
                    name:'landing.page',
                    meta:{ auth:undefined },
                },
                {
                    path:'login',
                    component:Login,
                    name:'login',
                    meta:{   auth: undefined  },
                },
                {
                    path:'register',
                    component:Register,
                    name:'rgister',
                    meta:{   auth: undefined  },
                },
            ]
        },

        {
            path:'/admin',
            component:App,
            children:[
                {
                    path:'dashboard',
                    component:Dashboard,
                    name:'admin-dashboard',
                    meta:{  middleware: [auth] },
                }
            ]
        },

        {
            path:'/*',
            component:NotFound,
            name:'error-404',
            meta:{   auth: undefined  }
        },
        {
            path:'/403',
            component:Forbidden,
            meta:{   auth: undefined  },
        },
    ],
    mode: 'history',
});

// Creates a `nextMiddleware()` function which not only
// runs the default `next()` callback but also triggers
// the subsequent Middleware function.
function nextFactory(context, middleware, index) {
    const subsequentMiddleware = middleware[index];
    // If no subsequent Middleware exists,
    // the default `next()` callback is returned.
    if (!subsequentMiddleware) return context.next;

    return (...parameters) => {
        // Run the default Vue Router `next()` callback first.
        context.next(...parameters);
        // Then run the subsequent Middleware with a new
        // `nextMiddleware()` callback.
        const nextMiddleware = nextFactory(context, middleware, index + 1);
        subsequentMiddleware({ ...context, next: nextMiddleware });
    };
}

router.beforeEach((to, from, next) => {
    if (to.meta.middleware) {
        const middleware = Array.isArray(to.meta.middleware)
            ? to.meta.middleware
            : [to.meta.middleware];

        const context = {
            from,
            next,
            router,
            to,
        };
        const nextMiddleware = nextFactory(context, middleware, 1);

        return middleware[0]({ ...context, next: nextMiddleware });
    }

    return next();
});


export default router;
