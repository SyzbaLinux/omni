<template>
    <v-container>
        <v-data-table
            :headers="headers"
            :items="courses"
            sort-by="calories"
            class="elevation-1"
        >
            <template v-slot:top>
                <v-toolbar
                    flat
                >
                    <v-toolbar-title>Available Course</v-toolbar-title>
                    <v-divider
                        class="mx-4"
                        inset
                        vertical
                    ></v-divider>
                    <v-spacer></v-spacer>
                    <v-dialog
                        v-model="dialog"
                    >
                        <template v-slot:activator="{ on, attrs }">
                            <v-btn
                                color="primary"
                                dark
                                class="mb-2"
                                v-bind="attrs"
                                v-on="on"
                            >
                                New Course
                            </v-btn>
                        </template>
                        <v-card>
                            <v-card-title>
                                <span class="headline">{{ formTitle }}</span>
                            </v-card-title>

                            <v-card-text>
                                <v-container>
                                    <v-text-field
                                        v-model="newCourse.title"
                                        label="Course Title"
                                        outlined
                                    />
                                    <v-row>
                                        <v-col cols="12" sm="12" md="6">
                                            <v-image-input
                                                v-model="newCourse.image"
                                                clearable
                                                label="Feature Image"
                                                :image-height="300"
                                                :image-width="300"
                                            />
                                        </v-col>
                                        <v-col cols="12" sm="12" md="6">
                                            <v-textarea
                                                outlined
                                                v-model="newCourse.meta"
                                                label="Course Title"
                                            />
                                            <v-text-field
                                                outlined
                                                type="number"
                                                v-model="newCourse.cost"
                                                label="Course Title"
                                            />
                                        </v-col>
                                    </v-row>
                                </v-container>
                            </v-card-text>

                            <v-card-actions>
                                <v-spacer></v-spacer>
                                <v-btn
                                    color="blue darken-1"
                                    text
                                    @click="close"
                                >
                                    Cancel
                                </v-btn>
                                <v-btn
                                    color="blue darken-1"
                                    text
                                    @click="save"
                                >
                                    Save
                                </v-btn>
                            </v-card-actions>
                        </v-card>
                    </v-dialog>

                </v-toolbar>
            </template>

            <template v-slot:item.image="{ item }">
                <img :src="item.image" alt="" height="150px">
            </template>


            <template v-slot:item.actions="{ item }">
                <v-icon
                    small
                    class="mr-2"
                    @click="editItem(item)"
                >
                    mdi-pencil
                </v-icon>
            </template>
            <template v-slot:no-data>
                <v-btn
                    color="primary"
                    @click="initialize"
                >
                    Reset
                </v-btn>
            </template>
        </v-data-table>
    </v-container>
</template>

<script>
    export default {
        data: () => ({
            dialog: false,
            dialogDelete: false,
            headers: [
                {
                    text: 'Course Title',
                    align: 'start',
                    sortable: false,
                    value: 'title',
                },
                { text: 'Image', value: 'image' },
                { text: 'Description', value: 'meta' },
                { text: 'Cost', value: 'cost' },
                { text: 'Actions', value: 'actions', sortable: false },
            ],
            courses: [],
            editedIndex: -1,
            newCourse: new Form({
                title: '',
                image: '',
                meta: '',
                cost: 0,
            }),

            defaultCourse: {
                title: '',
                image: '',
                meta: '',
                cost: 0,
            },
        }),

        computed: {
            formTitle () {
                return this.editedIndex === -1 ? 'New Course' : 'Edit Course'
            },
        },

        watch: {
            dialog (val) {
                val || this.close()
            },
            dialogDelete (val) {
                val || this.closeDelete()
            },
        },

        async created () {
            this.initialize()
        },

        methods: {

            async initialize () {
                axios.get('courses').then((res)=>{
                    this.courses = res.data
                })
            },

            editItem (item) {
                this.editedIndex = this.courses.indexOf(item)
                this.newCourse = Object.assign({}, item)
                this.dialog = true
            },

            close () {
                this.dialog = false
                this.$nextTick(() => {
                    this.newCourse = Object.assign({}, this.defaultCourse)
                    this.editedIndex = -1
                })
            },

            async save () {
                if (this.editedIndex > -1) {                    axios.put('courses/'+this.newCourse.id,this.newCourse).then((res)=>{
                        Swal.fire(
                            'Updated!',
                            'Course details updated successfully',
                            'success'
                        )
                    });

                } else {

                    await axios.post('courses',this.newCourse).then((res)=>{
                        Swal.fire('Saved','Course Saved successfully','success')
                        this.initialize()
                    })
                }
                this.close()
            },
        },
    }
</script>

