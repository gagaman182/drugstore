<template>
    <div>

        <b-container class="bv-example-row">

            <b-row>

                <b-col cols="12">

                    <div>
                        <div class="mt-3">
                            <b-button-group size="lg">


                                <b-button type="reset" variant="outline-warning" @click='back()'>
                                    <b-icon icon="skip-end-fill"></b-icon>กลับหน้าหลัก
                                </b-button>




                            </b-button-group>
                        </div>
                        <b-form>

                            <b-card class="mt-3 ">
                                <template v-slot:header>
                                    <h5 class="mb-0">แก้ไข-ข้อมูลบุคคล</h5>
                                </template>

                                <b-row>

                                    <b-col>
                                        <b-col>
                                            <b-form-group id="input-group-2" label="HN:" label-for="input-2">
                                                <b-form-input v-model="hn" required placeholder="HN" disabled>
                                                </b-form-input>



                                            </b-form-group>
                                        </b-col>
                                    </b-col>
                                    <b-col>
                                        <b-form-group id="input-group-3" label="ชื่อ-นามสกุล:" label-for="input-3">
                                            <b-form-input v-model="name" required placeholder="ชื่อ-นามสกุล" disabled>
                                            </b-form-input>

                                        </b-form-group>
                                    </b-col>

                                    <b-col cols="1.5">
                                        <b-form-group id="input-group-5" label="เพศ:" label-for="input-5">
                                            <b-form-input v-model="sex" required placeholder="เพศ" disabled>
                                            </b-form-input>

                                        </b-form-group>
                                    </b-col>
                                    <b-col>
                                        <b-form-group id="input-group-6" label="เลขบัตร บปช:" label-for="input-6">
                                            <b-form-input v-model="idcard" required placeholder="บปช" disabled>
                                            </b-form-input>

                                        </b-form-group>
                                    </b-col>
                                </b-row>
                                <b-row>

                                    <b-col>
                                        <b-form-group id="input-group-7" label="เบอร์โทรผู้ป่วย:" label-for="input-7">
                                            <b-form-input v-model="tel" required placeholder="เบอร์โทรผู้ป่วย">
                                            </b-form-input>

                                        </b-form-group>
                                    </b-col>
                                    <b-col>

                                        <b-form-group label="ที่อยู่:">
                                            <h6> {{address}}</h6>
                                        </b-form-group>

                                    </b-col>

                                </b-row>

                            </b-card>







                        </b-form>

                        <div class="mt-3">
                            <b-button-group size="lg">

                                <!-- <b-button type="submit" variant="outline-warning" @click='addperson()'>
                            <b-icon icon="pencil"></b-icon>แก้ไข
                        </b-button> -->
                                <b-button type="reset" variant="outline-danger" @click='deleteperson()'>
                                    <b-icon icon="trash-fill"></b-icon>ลบ
                                </b-button>




                            </b-button-group>
                        </div>

                    </div>

                </b-col>


            </b-row>






        </b-container>
    </div>


</template>
<script>
    import axios from 'axios'
    export default {

        data() {

            return {

                id: this.$route.params.num,
                hn: '',
                name: '',
                sex: '',
                tel: '',
                idcard: '',
                address: '',
                updateperson: '',

                form: {
                    token:'',
         
                     }


            }

        },
        mounted() {
                  // session login
                this.form.token = JSON.parse(localStorage.getItem('token'));
        
            if(this.form.token == undefined){
                  this.$router.push('/login')
            }else{
               

            axios.get('http://192.168.4.3/webapp/tee/drugs//person_my_update_person.php', {
                    params: {
                        id: this.id

                    }
                })
                .then(response => {
                    // JSON responses are automatically parsed.
                    this.updateperson = response.data
                    this.hn = this.updateperson[0].hn
                    this.name = this.updateperson[0].name
                    this.sex = this.updateperson[0].sex
                    this.idcard = this.updateperson[0].idcard
                    this.tel = this.updateperson[0].tel
                    this.address = this.updateperson[0].address





                    // multiselect vn code
                    axios.get('http://192.168.4.3/webapp/tee/drugs//vn.php', {
                            params: {
                                hn: this.hn
                            }
                        })
                        .then(response => {

                            this.optionsvn = response.data


                        })




                    //doctor code from mysql
                })
            axios
                .get('http://192.168.4.3/webapp/tee/drugs//doctor.php')
                .then(response => (
                    this.options = response.data
                    // this.options = this.doctor
                ))

            this.getdiag()
            this.getdrug()

            }
        },

        methods: {


            //ลบ ข้อมูล
            deleteperson: function () {

                this.resultconfirm = confirm("คุณแน่ใจว่าจะลบข้อมูล");
                if (this.resultconfirm) {




                    axios.get('http://192.168.4.3/webapp/tee/drugs//person_my_delete.php', {
                            params: {
                                id: this.id,


                            }
                        })
                        .then(response => {

                            this.ok = response.data
                            this.popupdelperson()



                        })

                    this.clearform()
                    this.popupdelperson()


                }
            },
            back: function () {
                this.$router.push('/about')
            },
            popupdelperson(append = false) {
                this.toastCount++

                this.$bvToast.toast('ลบข้อมูลบุคคลสำเร็จ' + this.ok[0].message, {
                    title: 'แจ้งเตือนการลบ',
                    autoHideDelay: 5000,
                    appendToast: append
                })
            },

            clearform: function () {



                this.hn = ''
                this.name = ''
                this.sex = ''
                this.idcard = ''
                this.tel = ''
                this.rounds = ''
                this.address = ''


            }
        }

    }
</script>