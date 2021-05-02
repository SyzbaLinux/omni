<template>
    <v-container>
        <v-row >
            <v-col cols="12" xs="8" sm="8" offset-sm="2"  offset-xs="2" md="6" offset-md="3">
                <v-card class="mt-5 login-registerForm">
                    <v-card-text>
                        <v-form v-model="valid" @submit.prevent="register">
                            <v-card-title>
                                <h1>Register Admin</h1>
                            </v-card-title>

                            <v-text-field
                                label="Your Full Name"
                                prepend-icon="mdi-account-multiple-plus-outline"
                                v-model="registerForm.full_name"
                                :rules="fullNameRules"
                            />
                            <v-text-field
                                label="Your Email"
                                prepend-icon="mdi-account-circle-outline"
                                v-model="registerForm.email"
                                :rules="emailRules"
                                :error-messages="email_errors"
                                @input="clearEmailErrors"
                                required
                            />
                            <v-text-field
                                label="Your Password"
                                type="password"
                                prepend-icon="mdi-shield-account"
                                v-model="registerForm.password"
                                :rules="passwordRules"
                                :error-messages="password_errors"
                                @input="clearPasswordErrors"
                            />

                            <v-text-field
                                label="Your Password"
                                type="password"
                                prepend-icon="mdi-shield-account"
                                v-model="registerForm.password_confirmation"
                                :rules="confirmPasswordRules"
                            />


                            <v-card-actions class="text-center">
                                <v-btn
                                    color="success"
                                    type="submit"
                                    :disabled="!valid"
                                >
                                    <v-icon>mdi-account-lock</v-icon> Register
                                </v-btn>
                                <v-spacer/>

                                <v-btn
                                    color="primary"
                                    text
                                    to="login"
                                >
                                    <v-icon>mdi-account</v-icon> LogIn
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
                registerForm: {
                    email: '',
                    password: '',
                    full_name:'',
                    password_confirmation:''
                },

                passwordRules: [
                    v => !!v || 'Password is required',
                    v => v.length >= 5 || 'Name must be more than 6 characters',
                ],
                emailRules: [
                    v => !!v || 'E-mail is required',
                    v => /.+@.+/.test(v) || 'E-mail must be valid',
                ],


                fullNameRules: [
                    v => !!v || 'Name  is required',
                ],

                confirmPasswordRules: [
                    v => !!v || 'Password must be is required',
                ],
            }
        },

        computed:{
            ...mapGetters({
                authenticated: 'auth/authenticated',
                email_errors: 'auth/get_email_errors',
                password_errors: 'auth/get_password_errors',
            })
        },

        async created(){
            if(this.authenticated){
                this.$router.push('/admin/dashboard')
            }
        },

        methods:{

            ...mapActions({
                RegisterUser: 'auth/register'
            }),

            async register(){

                await this.RegisterUser(this.registerForm).then((res)=>{
                   this.$router.push('/admin/dashboard')
                })
            },

            clearEmailErrors(){
                if(this.email_errors){
                    this.$store.commit('auth/SET_EMAIL_ERROR', null)
                }
            },

            clearPasswordErrors(){
                if(this.password_errors){
                    this.$store.commit('auth/SET_PASSWORD_ERROR', null)
                }
            }
        }
    }
</script>

