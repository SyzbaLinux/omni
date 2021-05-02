<template>
    <v-container>
        <v-row >
            <v-col cols="12" xs="8" sm="8" offset-sm="2"  offset-xs="2" md="6" offset-md="3">
                <v-card class="mt-5 login-form">
                    <v-card-text>
                        <v-form v-model="valid" @submit.prevent="login">
                            <v-card-title>
                                <h1>SignIn</h1>
                            </v-card-title>

                            <v-text-field
                                label="Your Email"
                                prepend-icon="mdi-account-circle-outline"
                                v-model="form.email"
                                :rules="emailRules"
                                :error-messages="email_errors"
                                @input="clearEmailErrors"
                                required
                            />
                            <v-text-field
                                label="Your Password"
                                type="password"
                                prepend-icon="mdi-shield-account"
                                v-model="form.password"
                                :rules="passwordRules"
                                :error-messages="password_errors"
                                @input="clearPasswordErrors"
                                required
                            />
                            <v-row>
                                <v-col>
                                    <v-checkbox
                                        v-model="form.remember"
                                        label="Remember Me"
                                        color="success"
                                    ></v-checkbox>
                                </v-col>
                            </v-row>

                            <v-card-actions class="text-center">
                                <v-btn
                                    color="success"
                                    type="submit"
                                    :disabled="!valid"
                                >
                                    <v-icon>mdi-account-lock</v-icon> Login
                                </v-btn>

                                <router-link
                                    class="mx-5"
                                    to="forgot-password">
                                    Forgot Password?
                                </router-link>

                                <v-spacer/>

                                <v-btn
                                    color="primary"
                                    text
                                    to="register"
                                >
                                    <v-icon>mdi-account-multiple-plus-outline</v-icon> &nbsp;Register
                                </v-btn>
                            </v-card-actions>

                        </v-form>
                    </v-card-text>
                </v-card>
            </v-col>
        </v-row>
    </v-container>
</template>


<script>
    import { mapActions, mapGetters } from 'vuex'
    export default {

        data() {
            return {
                valid:false,
                form: {
                    email: '',
                    password: '',
                    remember:false
                },

                passwordRules: [
                    v => !!v || 'Password is required',
                    v => v.length >= 5 || 'Name must be more than 6 characters',
                ],
                emailRules: [
                    v => !!v || 'E-mail is required',
                    v => /.+@.+/.test(v) || 'E-mail must be valid',
                ],
            }
        },

        computed:{
            ...mapGetters({
                authenticated: 'auth/authenticated',
                email_errors: 'auth/get_email_errors',
                password_errors: 'auth/get_password_errors',
                get_gen_errors: 'auth/get_gen_errors',
            })
        },

        async created(){
            if(this.authenticated){
                this.$router.push('dashboard')
            }
        },

        methods:{

            ...mapActions({
                SignIn: 'auth/SignIn'
            }),

            async login(){

                await this.SignIn(this.form).then((res)=>{

                    console.log(res)
                    // this.$router.push('/admin/dashboard')
                })

            },

            clearEmailErrors(){
                if(this.email_errors){
                    this.$store.commit('auth/SET_EMAIL_ERROR', null)
                }
                this.clearGenErrors()
            },

            clearPasswordErrors(){
                if(this.password_errors){
                    this.$store.commit('auth/SET_PASSWORD_ERROR', null)
                }
                this.clearGenErrors()
            },

            clearGenErrors(){
                if(this.gen_error){
                    this.$store.commit('auth/SET_GENERAL_ERROR', null)
                }
            }
        }
    }
</script>

