<template>
    <div>
        <v-carousel v-model="model" hide-delimiters>
            <v-carousel-item
                v-for="(item,i) in items"
                :key="i"
                :src="item.src"
                reverse-transition="slide-x-transition"
                transition="slide-x-transition"
            >
                <v-row
                    class="fill-height justify-start align-center pa-5"
                >
                    <v-col cols="12" sm="12" md="6" class="offset-md-1">
                        <h1>{{ item.title }}</h1>
                        <p>
                            {{item.subtitle}} <br>
                            {{item.lastline}}
                        </p>

                        <v-btn color="primary">Start Now</v-btn>
                    </v-col>
                </v-row>
            </v-carousel-item>
        </v-carousel>

        <v-container>
           <v-row class="mt--50">
               <v-col cols="12" sm="12" md="4">
                   <v-hover>
                       <template v-slot:default="{ hover }">
                           <v-card
                               class="mb-3 transition-swing"
                               outlined
                               color="primary"
                               dark
                               :elevation="hover? 0: 7"
                           >
                               <v-card-text class="text-center">
                                   <h4>
                                       <v-icon>mdi-book-open-page-variant</v-icon>
                                       <br>
                                       Courses
                                   </h4>
                                   <p>Accesslearning anywhere, anytime</p>
                               </v-card-text>

                           </v-card>
                       </template>
                   </v-hover>
               </v-col>
               <v-col cols="12" sm="12" md="4">
                   <v-hover>
                       <template v-slot:default="{ hover }">
                           <v-card
                               class="mb-3 transition-swing"
                               outlined
                               color="primary"
                               dark
                               :elevation="hover? 0: 7"
                           >
                               <v-card-text class="text-center">
                                   <h4>
                                       <v-icon>mdi-account-multiple</v-icon>
                                       <br>
                                       Find a Tutor
                                   </h4>
                                   <p>Find personalized tutors</p>
                               </v-card-text>

                           </v-card>
                       </template>
                   </v-hover>
               </v-col>
               <v-col cols="12" sm="12" md="4">
                   <v-hover>
                       <template v-slot:default="{ hover }">
                           <v-card
                               class="mb-3 transition-swing"
                               outlined
                               color="primary"
                               dark
                               :elevation="hover? 0: 7"
                           >
                               <v-card-text class="text-center">
                                   <h4>
                                       <v-icon>mdi-library</v-icon>
                                       <br>
                                       Library
                                   </h4>
                                   <p>
                                       The automated lifetime access to learning material
                                   </p>
                               </v-card-text>

                           </v-card>
                       </template>
                   </v-hover>
               </v-col>
           </v-row>


            <h2 class="my-5">Most Popular Courses</h2>

            <v-row>
                <v-col cols="12" sm="12" md="4"
                   v-for="(course,i) in courses.slice(0, 3)"
                   :key="i"
                >
                    <v-card
                        class="mx-auto"
                        max-width="400"
                    >
                        <v-img
                            class="white--text  align-center"
                            height="200px"
                            :src="course.image"
                        >
                            <v-btn
                                fab
                                small
                                class="price-btn"
                            >$ {{ course.cost }}</v-btn>
                        </v-img>

                        <v-card-subtitle class="pb-0">
                            {{ course.title }}
                        </v-card-subtitle>

                        <v-card-text class="text--primary">
                            {{ course.meta }}
                        </v-card-text>

                        <v-card-actions>
                            <v-spacer></v-spacer>

                            <v-btn
                                outlined
                                small
                                class="mx-2"
                            >
                                <v-icon>mdi-heart-outline</v-icon>
                            </v-btn>

                           <v-btn
                               outlined
                               small
                            class="mx-2"
                           >
                               <v-icon>mdi-cart-arrow-down</v-icon>
                           </v-btn>
                        </v-card-actions>
                    </v-card>
                </v-col>
            </v-row>


            <h2 class="my-5">Featured Courses</h2>

            <v-slide-group
                show-arrows
            >
                <v-slide-item
                    v-for="featured_course in courses"
                    :key="featured_course.id"
                >

                       <v-card
                           class="mx-2"
                           max-width="300"
                       >
                           <v-img
                               class="white--text  align-center"
                               height="200px"
                               :src="featured_course.image"
                           >
                               <v-btn
                                   fab
                                   small
                                   class="price-btn"
                               >$ {{ featured_course.cost }}</v-btn>
                           </v-img>

                           <v-card-subtitle class="pb-0">
                               {{ featured_course.title }}
                           </v-card-subtitle>

                           <v-card-text class="text--primary">
                               {{ featured_course.meta }}
                           </v-card-text>

                           <v-card-actions>
                               <v-spacer></v-spacer>

                               <v-btn
                                   outlined
                                   small
                                   class="mx-2"
                               >
                                   <v-icon>mdi-heart-outline</v-icon>
                               </v-btn>

                               <v-btn
                                   outlined
                                   small
                                   class="mx-2"
                               >
                                   <v-icon>mdi-cart-arrow-down</v-icon>
                               </v-btn>
                           </v-card-actions>

                    </v-card>
                </v-slide-item>
            </v-slide-group>

            <br>
            <h2 class="my-5">Why Join Us</h2>
            <v-row>

                <v-col cols="12" md="6" sm="12">
                   <div>
                       <v-img src="/images/omni-why-join-us.png" fluid></v-img>
                   </div>
                </v-col>


                <v-col cols="12" md="6" sm="12">
                        <div class="mb-5">
                            <h4>Expert tutors</h4>
                            <p>
                                Our expert tutors will help you excel in your studies through well-crafted and personalized programs.
                                Select your preferred expert, join live sessions, and get assessed by the best.
                            </p>
                            <v-btn
                                to="/tutors"
                                color="primary"
                            >
                                Start Now
                            </v-btn>
                        </div>

                        <hr>
                        <div class="my-5">
                            <h4>Virtual Classrooms</h4>
                            <p>
                                Join a community of other students, discuss, share information, and solve problems together
                            </p>
                            <v-btn
                                to="/tutors"
                                color="primary"
                            >
                                Start Now
                            </v-btn>
                        </div>


                        <hr>
                        <div class="my-5">
                            <h4>Track your results!</h4>
                            <p>
                                We provide a well-crafted step by step assessment process to help you track your progress or the progress of your child.
                            </p>

                            <v-btn
                                to="/tutors"
                                color="primary"
                            >
                                Start Now
                            </v-btn>
                        </div>
                </v-col>
            </v-row>

        </v-container>



    </div>
</template>

<script>
    export default {
        name: "Landing",
        data: () => ({
            model: 0,
            items: [
                {
                    src: '/images/slider1.jpeg',
                    title:'Learn Something',
                    subtitle:'New and Exciting skills like Coding',
                    lastline:'for Kids',
                },
                {
                    src: '/images/slider2.png',
                    title:'Personalized',
                    subtitle:'Learning',
                    lastline:'for excellent results',
                },
                {
                    src: '/images/slider3.jpg',
                    title:'Selft Placed',
                    subtitle:'Learn at your ouwn',
                    lastline:'pace and convinience',
                },
            ],

            courses: [],
        }),

        async created(){
            await axios.get('allcourses').then((res)=>{
                this.courses = res.data
            })
        }
    }
</script>

<style scoped>
    .v-carousel{
        height:375px !important;
    }


    .mt--50{
        margin-top:-70px !important;
        z-index:3;
    }

    .price-btn{
        margin-left:80%;
    }


</style>
