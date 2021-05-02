<template>
    <v-app id="inspire">
        <v-app-bar
            clipped-left
            color="primary"
            dark
            app
        >

            <img
                :src="'/images/footer_logo.png'"
                class="mr-1"
                contain
                height="48"
                max-width="48"
            />
            <v-spacer/>
            <v-btn text>

                {{ user.name }}&nbsp;
            </v-btn>
            <v-btn
            icon
            @click="logOff"
            >
                <v-icon

                >mdi-door-open</v-icon>
            </v-btn>

        </v-app-bar>
        <v-main>
            <transition :name="transitionName" mode="out-in"   origin="center center">
                <router-view></router-view>
            </transition>
        </v-main>
    </v-app>
</template>

<script>
    import { mapActions, mapGetters } from 'vuex'
    export default {
        data:() =>({
            drawer: null,
            transitionName:'scale-transition'
        }),

        watch:{
            authenticated(){
                if(!this.authenticated){
                    this.$router.push('/login')
                }
            },
        },


        computed:{
            ...mapGetters({
                user: 'auth/user',
                authenticated: 'auth/authenticated'
            }),
        },

        async created() {
            this.$router.beforeEach((to, from, next) => {
                let transitionName = to.meta.transitionName || from.meta.transitionName;

                if (transitionName === 'slide') {
                    const toDepth = to.path.split('/').length;
                    const fromDepth = from.path.split('/').length;
                    transitionName = toDepth < fromDepth ? 'slide-x-transition' : 'scroll-x-reverse-transition';
                }

                this.transitionName = transitionName || 'slide-x-transition';
                next();
            });


        },

        methods:{
            ...mapActions({
                signOut: 'auth/signOut'
            }),

            logOff(){
                this.signOut().then((res)=>{
                    this.$router.push('/login')
                })
            }
        }

    }
</script>

<style>
    .theme--light.v-application {
        background: #f5f5f5 !important;
    }

    .no-caps{
        text-transform: none !important;
    }

</style>
