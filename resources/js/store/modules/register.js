import axios from 'axios'

export default {
    namespaced:true,
    state:{
        token:null,
        user:null,
        email_error:null,
        password_error:null,
        gen_error:null
    },

    getters:{
        authenticated(state){
            return state.token && state.user
        },

        user(state){
            return state.user
        },

        get_email_errors(state){
            return state.email_error
        },

        get_password_errors(state){
            return state.password_error
        },

        get_gen_errors(state){
            return state.gen_error
        },

    },
    mutations:{
        SET_TOKEN(state,token){
            state.token = token
        },
        SET_USER(state,user){
            state.user = user
        },

        SET_EMAIL_ERROR(state,email_error){
            state.email_error = email_error
        },

        SET_PASSWORD_ERROR(state,password_error){
            state.password_error = password_error
        },

        SET_GENERAL_ERROR(state,gen_error){
            state.gen_error = gen_error
        }
    },

    actions:{

        async SignIn({ dispatch, commit },loginData){

            await axios.post('auth/login', loginData).then(response=>{

                return dispatch('attempt',response.data.token)

            }).catch(error => {



                if(error.response.data.errors.email){
                    commit('SET_EMAIL_ERROR', error.response.data.errors.email)

                }else if(error.response.data.errors.password){

                    commit('SET_PASSWORD_ERROR', error.response.data.errors.password)
                }
                else{

                    Swal.fire('Authentication Failed',''+error.response.data.errors+'','error')
                }
            })

        },



        async register({ dispatch },registerData){
            let response = await axios.post('auth/register/', registerData);

            if(response.data.status == 'success'){
                return dispatch('SignIn',registerData )
            }
        },


        async attempt({ commit, state },token){
            if(token){
                commit('SET_TOKEN', token)
            }
            if(!state.token){
                return
            }
            try {
                let response = await axios.get('auth/user')
                commit('SET_USER', response.data)

            } catch (e) {

                commit('SET_TOKEN', null)
                commit('SET_USER', null)
            }
        },
    },

}
