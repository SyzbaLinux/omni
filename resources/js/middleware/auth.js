import store from '../store/index'

export default function auth({ next, router }) {

    if (!store.getters['auth/authenticated']) {
        return router.push('/admin/login');
    }

    return next();
}
