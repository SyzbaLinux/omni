<template>
    <v-app id="inspire">
               <v-app-bar
                   app
                   flat
                   color="white"
               >
                   <img
                       :src="'/images/logo.png'"
                       class="mr-1 mt-1 mb-1"
                       contain
                       height="48px"
                       width="auto"
                       max-width="257%"
                   />
                   <v-spacer/>
                   <v-icon color="success">mdi-magnify</v-icon>
                   <v-btn
                       outlined
                       class="mx-2"
                       to="login"
                   >
                       Login
                   </v-btn>

                   <v-btn
                       color="success"
                       outlined
                       class="mx-2"
                       to="register"
                   >
                       Signup
                   </v-btn>
               </v-app-bar>
       <v-main>
           <v-toolbar class="d-flex justify-center" color="primary">
               <v-toolbar-title dark>
                  <v-btn text color="white" to="/">
                      Home
                  </v-btn>

                   <v-btn text color="white">
                      About
                  </v-btn>

                   <v-menu offset-y  open-on-hover>
                       <template v-slot:activator="{ on, attrs }">
                           <v-btn
                               color="white"
                               text
                               v-bind="attrs"
                               v-on="on"
                           >
                               Courses
                               <v-icon>mdi-chevron-down</v-icon>
                           </v-btn>
                       </template>
                       <v-list>
                           <v-list-item link>
                               <v-list-item-title>O Level</v-list-item-title>
                           </v-list-item>
                            <v-divider></v-divider>
                           <v-list-item link>
                               <v-list-item-title>SkillsDevelopment</v-list-item-title>
                           </v-list-item>
                           <v-divider></v-divider>
                           <v-list-item link>
                               <v-list-item-title>Languages</v-list-item-title>
                           </v-list-item>
                       </v-list>
                   </v-menu>

                   <v-btn text color="white">
                       Find A Tutor
                   </v-btn>

                   <v-btn text color="white">
                       Library
                   </v-btn>

                   <v-btn text color="white">
                       News
                   </v-btn>

                   <v-btn text color="white">
                       Contact
                   </v-btn>
               </v-toolbar-title>
           </v-toolbar>
           <router-view></router-view>
           <v-container fluid class="footer">
                    <v-row class="pa-6">
                        <v-col cols="12" md="4" sm="12">
                            <img src="/images/footer_logo.png" alt="" height="45px" width="auto" >
                        </v-col>

                        <v-col  cols="12" md="2" sm="12">
                            <h4 class="white--text">Omni For Business</h4>
                            <a href="#" class="footer-a" >Become a Tutor</a> <br>
                            <a href="#" class="footer-a" >About Us</a> <br>
                            <a href="#" class="footer-a" >Contact Us</a>
                        </v-col>


                        <v-col cols="12" md="2" sm="12">
                            <h4 class="white--text">Get Involved</h4>
                            <a href="#" class="footer-a" >Careers</a> <br>
                            <a href="#" class="footer-a" >Blog</a> <br>
                        </v-col>


                        <v-col cols="12" md="2" sm="12">
                            <h4 class="white--text">Helpful Links</h4>
                            <a href="#" class="footer-a" >Help & Support</a> <br>
                            <a href="#" class="footer-a" >Refund Policy</a> <br>
                        </v-col>


                        <v-col cols="12" md="2" sm="12">
                            <v-menu top>
                                <template v-slot:activator="{ on, attrs }">
                                    <v-btn
                                        color="white"
                                        outlined
                                        class="border-white"
                                        text
                                        v-bind="attrs"
                                        v-on="on"
                                    >
                                      <span class="pa-2">
                                            <v-icon>mdi-earth</v-icon>
                                        En
                                        <v-icon>mdi-chevron-down</v-icon>
                                      </span>
                                    </v-btn>
                                </template>
                                <v-list>
                                    <v-list-item link>
                                        <v-list-item-title>English</v-list-item-title>
                                    </v-list-item>
                                </v-list>
                            </v-menu>
                        </v-col>


                    </v-row>
                   <hr color="white">
                   <v-row class="pa-6">
                       <v-col class="pa-4 white--text text-center"  cols="12" md="4" sm="12">
                           Copyright &copy; 2020 Omni Learning.
                       </v-col>

                       <v-col class="pa-4 white--text text-center" cols="12" md="4" sm="12">

                           <v-icon class="mx-1" color="white">mdi-facebook</v-icon>
                           <v-icon class="mx-1" color="white">mdi-instagram</v-icon>
                           <v-icon class="mx-1" color="white">mdi-twitter</v-icon>
                           <v-icon class="mx-1" color="white">mdi-linkedin</v-icon>
                           <v-icon class="mx-1" color="white">mdi-youtube-tv</v-icon>

                       </v-col>

                       <v-col  class="pa-4 white--text text-center" cols="12" md="4" sm="12">
                           <a href="#" class="footer-a" >Terms & Condition</a>
                           <a href="#" class="footer-a">Privacy Policy</a>
                       </v-col>
                   </v-row>
           </v-container>
       </v-main>
    </v-app>

</template>

<script>
    export default {
        name: "Index"
    }
</script>

<style scoped>
    .v-btn{
        text-transform: unset !important;
    }

    .footer{
        background-color:#1976d2 !important;
    }

    .footer-a{
        color:white !important;
        text-decoration:none;
    }

    .border-white{
        border:1px solid white !important;
    }
</style>
