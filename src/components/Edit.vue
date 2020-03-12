<template>
    <div>

        <b-container class="bv-example-row">

            <div class="mt-3">
                <b-button-group size="lg">


                    <b-button type="reset" variant="outline-warning" @click='back()'>
                        <b-icon icon="skip-end-fill"></b-icon>กลับหน้าหลัก
                    </b-button>




                </b-button-group>
            </div>
            <b-row>

                <b-col cols="12">

                    <div>

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
                            <b-card class="mt-3">
                                <template v-slot:header>
                                    <h5 class="mb-0">
                                        แก้ไข-ข้อมูลการรับบริการ</h5>
                                </template>
                                <b-row>
                                    <b-col sm="2">

                                        <b-form-group id="input-group-17" label="รอบที่ร่วมโครงการ:"
                                            label-for="input-17">
                                            <b-form-radio v-model="rounds" value="รอบ1">รอบ1</b-form-radio>
                                            <b-form-radio v-model="rounds" value="รอบ2">รอบ2 </b-form-radio>
                                        </b-form-group>

                                    </b-col>
                                    <b-col>
                                        <b-form-group id="input-group-0" label="แพทย์ที่ส่งตัว:" label-for="input-8">
                                            <multiselect v-model="doctor" :options="options"
                                                :custom-label="nameWithLang" placeholder="เลือกรายชื่อหมอ" label="name"
                                                track-by="name" id="input-8" @input="Selecteddoctor">
                                            </multiselect>
                                        </b-form-group>
                                    </b-col>
                                    <b-col>
                                        <b-form-group id="input-group-9" label="ร้านยาที่ร่วมให้บริการ:"
                                            label-for="input-3">
                                            <b-form-select id="input-3" v-model="drugstore" :options="drugstores">
                                            </b-form-select>
                                        </b-form-group>
                                    </b-col>
                                </b-row>
                            </b-card>

                            <b-card class="mt-3" sub-title="วันที่เริ่มรับยา ">

                                <b-row>
                                    <b-col>
                                        <b-form-group id="input-group-11" label="VN จ่ายยา รพ:" label-for="input-11">
                                            <multiselect v-model="startvn" :options="optionsvn"
                                                :custom-label="nameWithLang2" placeholder="vn-วันที่รับบริการ-โรค"
                                                label="vn" track-by="vn" id="input-11" @input="Selectedstartvn">
                                            </multiselect>
                                        </b-form-group>
                                        <div>
                                            <h4>
                                                <b-badge variant="danger">วันที่จะ refill ครั้งที่1</b-badge>
                                            </h4>
                                        </div>
                                        <h4> {{drugrefill3m}} </h4>
                                    </b-col>
                                    <b-col>
                                        <b-form-group id="input-group-10" label="วันที่เริ่มรับยาที่ รพ:"
                                            label-for="input-10">
                                            <b-form-input type="date" id="input-10" v-model="startdrug"
                                                placeholder="ชื่อ">
                                            </b-form-input>
                                        </b-form-group>
                                        <div>
                                            <h4>
                                                <b-badge variant="danger">วันที่จะ refill ครั้งที่2</b-badge>
                                            </h4>
                                        </div>
                                        <h4> {{drugrefill6m}}</h4>
                                    </b-col>
                                    <b-col>
                                        <div>
                                            <b-form-group label="ICD10">
                                                <b-table :fields="fieldsdiag" :items="diag" :label="label" sticky-header
                                                    head-variant="light" ref="diagtable">
                                                    <template v-slot:table-busy>
                                                        <div class="text-center text-danger my-2">
                                                            <b-spinner class="align-middle"></b-spinner>
                                                            <strong>Loading...</strong>
                                                        </div>
                                                    </template>
                                                </b-table>
                                            </b-form-group>
                                        </div>
                                    </b-col>
                                    <b-col>
                                        <div>
                                            <b-form-group label="รายละเอียดยา">
                                                <b-table :fields="fieldsdrug" :items="drug" :label="label" sticky-header
                                                    head-variant="light" ref="drugtable">
                                                    <template v-slot:table-busy>
                                                        <div class="text-center text-danger my-2">
                                                            <b-spinner class="align-middle"></b-spinner>
                                                            <strong>Loading...</strong>
                                                        </div>
                                                    </template>
                                                </b-table>
                                            </b-form-group>
                                        </div>

                                    </b-col>


                                </b-row>
                            </b-card>
                            <b-card class="mt-3" sub-title="refillยา ครั้งที่1 ">
                                <b-row>
                                    <b-col>
                                        <b-form-group id="input-group-13" label="VN จ่ายยา รพ :" label-for="input-13">

                                            <multiselect v-model="refill1vn" :options="optionsvn"
                                                :custom-label="nameWithLang2" placeholder="vn-วันที่รับบริการ-โรค"
                                                label="vn" track-by="vn" id="input-13" @input="Selectedrefill1">
                                            </multiselect>
                                        </b-form-group>
                                    </b-col>
                                    <b-col>
                                        <b-form-group id="input-group-12" label="วันที่ refill :" label-for="input-12">
                                            <b-form-input type="date" id="input-12" v-model="refill1"
                                                placeholder="ชื่อ">
                                            </b-form-input>
                                        </b-form-group>
                                    </b-col>
                                    <b-col>

                                        <b-form-group>
                                            <h4>
                                                <b-badge variant="success">สถานะการรับยา</b-badge>
                                            </h4>
                                            <b-form-radio v-model="getdrug1" value="รับยา">รับยา</b-form-radio>
                                            <b-form-radio v-model="getdrug1" value="ไม่มารับยา">ไม่มารับยา
                                            </b-form-radio>
                                        </b-form-group>

                                    </b-col>
                                    <b-col>
                                        <b-form-group id="input-group-18" label=" วันที่รับยา:" label-for="input-18">
                                            <b-form-input type="date" id="input-18" v-model="getdrugdate1"
                                                placeholder="วันที่">
                                            </b-form-input>
                                        </b-form-group>

                                    </b-col>


                                </b-row>
                            </b-card>
                            <b-card class="mt-3" sub-title="refillยา ครั้งที่2">
                                <b-row>
                                    <b-col>
                                        <b-form-group id="input-group-13" label="VN จ่ายยารพ :" label-for="input-13">

                                            <multiselect v-model="refill2vn" :options="optionsvn"
                                                :custom-label="nameWithLang2" placeholder="vn-วันที่รับบริการ-โรค"
                                                label="vn" track-by="vn" id="input-13" @input="Selectedrefill2">
                                            </multiselect>
                                        </b-form-group>
                                    </b-col>
                                    <b-col>
                                        <b-form-group id="input-group-12" label="วันที่ refill:" label-for="input-12">
                                            <b-form-input type="date" id="input-12" v-model="refill2"
                                                placeholder="ชื่อ">
                                            </b-form-input>
                                        </b-form-group>
                                    </b-col>
                                    <b-col>

                                        <b-form-group>
                                            <h4>
                                                <b-badge variant="success">สถานะการรับยา</b-badge>
                                            </h4>
                                            <b-form-radio v-model="getdrug2" value="รับยา">รับยา</b-form-radio>
                                            <b-form-radio v-model="getdrug2" value="ไม่มารับยา">ไม่มารับยา
                                            </b-form-radio>
                                        </b-form-group>

                                    </b-col>
                                    <b-col>
                                        <b-form-group id="input-group-18" label=" วันที่รับยา:" label-for="input-18">
                                            <b-form-input type="date" id="input-18" v-model="getdrugdate2"
                                                placeholder="วันที่">
                                            </b-form-input>
                                        </b-form-group>

                                    </b-col>

                                </b-row>
                            </b-card>
                            <b-card class="mt-3" sub-title="พบแพทย์">
                                <b-row>
                                    <b-col>
                                        <b-form-group id="input-group-16" label="วันที่ต้องพบแพทย์:"
                                            label-for="input-16">
                                            <b-form-input type="date" id="input-16" placeholder="ชื่อ"
                                                v-model="appointdocotor1">
                                            </b-form-input>

                                        </b-form-group>
                                    </b-col>

                                    <b-col>

                                        <b-form-group id="input-group-19" label="มาพบแพทย์:" label-for="input-19">
                                            <b-form-radio v-model="seedoctor1" name="seedoctor" value="พบ">พบ
                                            </b-form-radio>
                                            <b-form-radio v-model="seedoctor1" name="seedoctor" value="ไม่พบ">ไม่พบ
                                            </b-form-radio>
                                        </b-form-group>

                                    </b-col>

                                    <b-col>

                                        <b-form-group id="input-group-20" label="วันที่มาพบแพทย์:" label-for="input-20">
                                            <b-form-input type="date" id="input-20" v-model="seedoctordate1"
                                                placeholder="ชื่อ">
                                            </b-form-input>
                                        </b-form-group>
                                    </b-col>

                                </b-row>
                            </b-card>

                        </b-form>

                         <pre class="m-0">{{addok}}</pre>





                    </div>

                </b-col>

            </b-row>


            <div class="mt-3">
                <b-button-group size="lg">

                    <b-button type="submit" variant="outline-info" @click='updateall()' class="mb-2 mr-sm-2 mb-sm-0">
                        <b-icon icon="pencil"></b-icon>แก้ไข
                    </b-button>
                    <b-button type="reset" variant="outline-danger" @click='deleteperson()'
                        class="mb-2 mr-sm-2 mb-sm-0">
                        <b-icon icon="trash-fill"></b-icon>ลบ
                    </b-button>




                </b-button-group>
            </div>



        </b-container>
    </div>


</template>
<script>
    import axios from 'axios'
    import moment from 'moment'
    export default {

        data() {

            return {

                // id: this.$route.params.num, // num 
                id: this.$route.query.num,
                vnuse: this.$route.query.vn,
                num: '',
                hn: '',
                name: '',
                sex: '',
                tel: '',
                idcard: '',
                address: '',
                rounds: '',
                updateperson: '',
                options: '', //multiselect1 doctor
                doctor: { //multiselect1
                    doccode: '',
                    name: ''

                },
                drugstore: '',

                drugstores: [{
                        text: 'ร้านยา',
                        value: null
                    }, 'หมอยา',
                    'พงศ์ฟาร์มาแคร์',
                    'ทรงพรเภสัช',
                    'ร้านยาหน้าสวน',
                    'ธนพัฒน์เภสัช​',
                    'อาร์มเภสัช',
                    'ซิตี้ฟาร์มาซี2',
                    'ศูนย์ยาทุ่งเสา',
                    'แฮปปี้ฟาร์มา',
                    'ร้านวรวรรณเภสัช',
                    'ร้านยาฟาร์มาเพล็กซ์',
                    'เอ็กตร้าพลัส สาขาตลาดยรรยง',
                    'บู๊ท เซ็นทรัล เฟสติวัล ชั้นG '
                ],
                startdrug: '',
                startvn: { //multiselect2
                    vn: '',
                    opdtime: '',
                    pla: ''
                },
                optionsvn: '',
                fieldsdiag: [{
                    key: 'ICD_CODE',
                    label: 'ICD10'
                }, {
                    key: 'NAME',
                    label: 'ประเภท DX'
                }],
                diag: {

                    'ICD_CODE': '',
                    'NAME': ''
                },
                fieldsdrug: [{
                    key: 'CODE',
                    label: 'รหัส'
                }, {
                    key: 'NAME',
                    label: 'ชื่อยา'
                }, {
                    key: 'QUANTITY',
                    label: 'จำนวน'
                }],
                drug: {
                    'CODE': '',
                    'NAME': '',
                    'QUANTITY': ''
                },
                refill1vn: { //multiselect2
                    vn: '',
                    opdtime: '',
                    pla: ''
                },
                refill1: '',
                getdrug1: '',
                getdrugdate1: '',
                refill2vn: { //multiselect2
                    vn: '',
                    opdtime: '',
                    pla: ''
                },
                refill2: '',
                getdrug2: '',
                getdrugdate2: '',
                appointdocotor1: '',
                seedoctor1: '',
                seedoctordate1: '',
                addok: '',

                addok2aw: '',
                resultconfirm: '',
                updateok: '',
                idiag: '',
                idrug: '',
                ok: '',
                drugrefill3m: '',
                drugrefill6m: '',
                showdate60120: '',

                    form: {
                    token:'',
         
                        }





            }

        },
        mounted() {
              //เลื่อนไปบนสุดของหน้าจอ
     
                window.scrollTo(0,0);
           
                    // session login
                this.form.token = JSON.parse(localStorage.getItem('token'));
        
            if(this.form.token == undefined){
                  this.$router.push('/login')
            }else{
               
          
            axios.get('http://192.168.4.3/webapp/tee/drugs/person_my_update.php', {
                    params: {
                        num: this.id //num last

                    }
                })
                .then(response => {
                    // JSON responses are automatically parsed.
                    this.updateperson = response.data
                    this.num = this.updateperson[0].num
                    this.hn = this.updateperson[0].hn
                    this.name = this.updateperson[0].name
                    this.sex = this.updateperson[0].sex
                    this.idcard = this.updateperson[0].idcard
                    this.tel = this.updateperson[0].tel
                    this.rounds = this.updateperson[0].rounds
                    this.address = this.updateperson[0].address
                    this.drugstore = this.updateperson[0].drugstore
                    this.doctor.doccode = this.updateperson[0].doctor
                    this.startdrug = this.updateperson[0].startdrug
                    this.startvn.vn = this.updateperson[0].startvn
                    this.refill1vn.vn = this.updateperson[0].refill1vn
                    this.refill1 = this.updateperson[0].refill1
                    this.getdrug1 = this.updateperson[0].getdrug1
                    this.getdrugdate1 = this.updateperson[0].getdrugdate1
                    this.refill2vn.vn = this.updateperson[0].refill2vn
                    this.refill2 = this.updateperson[0].refill2
                    this.getdrug2 = this.updateperson[0].getdrug2
                    this.getdrugdate2 = this.updateperson[0].getdrugdate2
                    this.appointdocotor1 = this.updateperson[0].appointdocotor1
                    this.seedoctor1 = this.updateperson[0].seedoctor1
                    this.seedoctordate1 = this.updateperson[0].seedoctordate1
                    this.drugrefill3m = this.updateperson[0].datemonth3
                    this.drugrefill6m = this.updateperson[0].datemonth6





                    // multiselect vn code
                    axios.get('http://192.168.4.3/webapp/tee/drugs/vn.php', {
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
                .get('http://192.168.4.3/webapp/tee/drugs/doctor.php')
                .then(response => (
                    this.options = response.data
                    // this.options = this.doctor
                ))

            this.getdiag()
            this.getdrug()

            //     //ดึงวันที่จาก + 60 และ +120

            // axios.get('http://192.168.4.3/webapp/tee/drugs//vn60120.php', {
            //     params: {
            //     num:this.id 
            //     }
            //   })
            //   .then(response => {

            //     this.showdate60120 = response.data

            //      this.drugrefill3m = this.showdate60120[0].datemonth3
            //     this.drugrefill6m = this.showdate60120[0].datemonth6
            //     // alert(this.drugrefill3m)
            //   })

            }
        },

        methods: {
            // multiselect doctor 
            nameWithLang({
                doccode,
                name
            }) {
                return `${doccode}  ${name}`
            },
            // multiselect vn 
            nameWithLang2({
                opdtime,
                pla,
                vn
            }) {
                return `${vn}   ${opdtime}    ${pla} `
            },
            // multiselect doctor 
            Selecteddoctor(value) {

                this.doctor.doccode = value.doccode
            },
            //diag 
            getdiag: function () {
                // multiselect
                axios.get('http://192.168.4.3/webapp/tee/drugs/diag_my_update.php', {
                        params: {
                            vn: this.vnuse
                        }
                    })
                    .then(response => {

                        this.diag = response.data
                    })

            },

            getdrug: function () {
                // multiselect
                axios.get('http://192.168.4.3/webapp/tee/drugs/drug_my_update.php', {
                        params: {
                            vn: this.vnuse
                        }
                    })
                    .then(response => {

                        this.drug = response.data
                    })

            },
            //เลือก list box ให้ วันที่ โรค และ ยาเปลี่ยนตาม vn และ hn
            Selectedstartvn(value) {
                //  this.toggleBusy()


                this.startdrug = value.opdtime
                this.drugrefill3m = moment(value.opdtime, 'YYYY/MM/DD ').add('days', 60).format('YYYY/MM/DD ')
                this.drugrefill6m = moment(value.opdtime, 'YYYY/MM/DD ').add('days', 120).format('YYYY/MM/DD ')

                //  alert(this.hn)
                //  alert(value.vn)

                axios.get('http://192.168.4.3/webapp/tee/drugs/diag.php', {
                        params: {
                            hn: this.hn,
                            vn: value.vn
                        }
                    })
                    .then(response => {

                        this.diag = response.data
                    })

                axios.get('http://192.168.4.3/webapp/tee/drugs/drug.php', {
                        params: {
                            hn: this.hn,
                            vn: value.vn
                        }
                    })
                    .then(response => {

                        this.drug = response.data
                    })


            },
            //vn refill
            Selectedrefill1(value) {
                this.refill1 = value.opdtime


            },
            Selectedrefill2(value) {
                this.refill2 = value.opdtime


            },
            //ลบ ข้อมูล
            deleteperson: function () {

                this.resultconfirm = confirm("คุณแน่ใจว่าจะลบข้อมูล");
                if (this.resultconfirm) {



                    //person         
                    // axios.get('http://192.168.4.3/webapp/tee/drugs//person_my_delete.php', {
                    //         params: {
                    //             hn: this.hn,
                    //             vn: this.startvn.opdtime,
                    //             type: '1'
                    //         }
                    //     })
                    //     .then(response => {

                    //         this.ok = response.data
                    //  this.popupdelperson()


                    //     })
                    //services
                    axios.get('http://192.168.4.3/webapp/tee/drugs/service_my_delete.php', {
                            params: {
                                hn: this.hn,
                                vn: this.startvn.opdtime,
                                num: this.id,
                                type: '2'
                            }
                        })
                        .then(response => {

                            this.addok = response.data
                            this.popupdelservice()

                        })

                    //diag
                    axios.get('http://192.168.4.3/webapp/tee/drugs/service_my_delete.php', {
                            params: {
                                hn: this.hn,
                                vn: this.startvn.opdtime,
                                num: this.id,
                                type: '3'
                            }
                        })
                        .then(response => {

                            this.addok = response.data
             
                            this.popupdeldiag()


                        })
                    //drug
                    axios.get('http://192.168.4.3/webapp/tee/drugs/service_my_delete.php', {
                            params: {
                                hn: this.hn,
                                vn: this.startvn.opdtime,
                                num: this.id,
                                type: '4'
                            }
                        })
                        .then(response => {

                            this.addok = response.data
                            this.popupdeldrug()

                        })
                        
                            this.clearform()
                  
                 
                    
                   
                      this.$router.push('/about')
                    
                   

                }
            },
            //update ทั้งหมด
            updateall: function () {
                //  alert(this.id)
                axios.get('http://192.168.4.3/webapp/tee/drugs/update_all.php', {
                        params: {
                            num: this.id,
                            hn: this.hn,
                            name: this.name,
                            sex: this.sex,
                            idcard: this.idcard,
                            tel: this.tel,
                            rounds: this.rounds,
                            drugstore: this.drugstore,
                            doctor: this.doctor.doccode,
                            startdrug: this.startdrug,
                            startvn: this.startvn.vn,
                            refill1vn: this.refill1vn.vn,
                            refill1: this.refill1,
                            getdrug1: this.getdrug1,
                            getdrugdate1: this.getdrugdate1,
                            refill2vn: this.refill2vn.vn,
                            refill2: this.refill2,
                            getdrug2: this.getdrug2,
                            getdrugdate2: this.getdrugdate2,
                            appointdocotor1: this.appointdocotor1,
                            seedoctor1: this.seedoctor1,
                            seedoctordate1: this.seedoctordate1,
                            drugcode: this.drug.CODE,
                            drugname: this.drug.NAME,
                            unit: this.drug.QUANTITY,
                            icdcode: this.diag.ICD_CODE,
                            icdtype: this.diag.NAME



                        }
                    })
                    .then(response => {

                        this.updateok = response.data
                        this.popupupdateperson()
                        this.popupupdateservice()
                        this.popupupdatediag()
                        this.popupupdatedrug()
                            //เลื่อนไปบนสุดของหน้าจอ
     
                                window.scrollTo(0,0);


                    })
                // ลบ diag drug ก่อน
                axios.get('http://192.168.4.3/webapp/tee/drugs/diagdrugdeleteupdate.php', {
                        params: {
                            num: this.id,

                        }
                    })
                    .then(response => {

                        this.ok = response.data

                    })


                // add in diags table
                for (this.idiag = 0; this.idiag < this.diag.length; this.idiag++) {
                    axios.get('http://192.168.4.3/webapp/tee/drugs/adddiag.php', {
                            params: {
                                icdcode: this.diag[this.idiag].ICD_CODE,
                                icdtype: this.diag[this.idiag].NAME,
                                vn: this.startvn.vn,
                                num: this.id
                            }
                        })
                        .then(response => {

                            this.ok = response.data

                        })
                }


                // add in drugs table
                for (this.idrug = 0; this.idrug < this.drug.length; this.idrug++) {
                    axios.get('http://192.168.4.3/webapp/tee/drugs/adddrug.php', {
                            params: {
                                drugcode: this.drug[this.idrug].CODE,
                                drugname: this.drug[this.idrug].NAME,
                                unit: this.drug[this.idrug].QUANTITY,
                                vn: this.startvn.vn,
                                num: this.id
                            }
                        })
                        .then(response => {

                            this.ok = response.data

                        })
                }

            },

            popupupdateperson(append = false) {
                this.toastCount++

                this.$bvToast.toast(this.updateok[0].message, {
                    title: 'แจ้งเตือนการอัพเดทข้อมูล',
                    autoHideDelay: 5000,
                    appendToast: append
                })
            },
            popupupdateservice(append = false) {
                this.toastCount++

                this.$bvToast.toast(this.updateok[1].message2, {
                    title: 'แจ้งเตือนการอัพเดทข้อมูล',
                    autoHideDelay: 5000,
                    appendToast: append
                    
                })
               
            },
            popupupdatediag(append = false) {
                this.toastCount++

                this.$bvToast.toast(this.updateok[2].message3, {
                    title: 'แจ้งเตือนการอัพเดทข้อมูล',
                    autoHideDelay: 5000,
                    appendToast: append
                })
            },
            popupupdatedrug(append = false) {
                this.toastCount++

                this.$bvToast.toast(this.updateok[3].message4, {
                    title: 'แจ้งเตือนการอัพเดทข้อมูล',
                    autoHideDelay: 5000,
                    appendToast: append
                })
            },
            // popupdelperson(append = false) {
            //     this.toastCount++

            //     this.$bvToast.toast(this.addok[0].message, {
            //         title: 'แจ้งเตือนการลบ',
            //         autoHideDelay: 5000,
            //         appendToast: append
            //     })
            // },
            popupdelservice(append = false) {
                this.toastCount++

                this.$bvToast.toast(this.addok[0].message2, {
                    title: 'แจ้งเตือนการลบ',
                    autoHideDelay: 5000,
                    appendToast: append
                })
            },
            popupdeldiag(append = false) {
                this.toastCount++

                this.$bvToast.toast(this.addok[0].message3, {
                    title: 'แจ้งเตือนการลบ',
                    autoHideDelay: 5000,
                    appendToast: append
                })
            },
            popupdeldrug(append = false) {
                this.toastCount++

                this.$bvToast.toast(this.addok[0].message4, {
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
                this.drugstore = ''
                this.doctor.doccode = ''
                this.startdrug = ''
                this.startvn.opdtime = ''
                this.refill1vn.vn = ''
                this.refill1 = ''
                this.getdrug1 = ''
                this.getdrugdate1 = ''
                this.refill2vn.vn = ''
                this.refill2 = ''
                this.getdrug2 = ''
                this.getdrugdate2 = ''
                this.appointdocotor1 = ''
                this.seedoctor1 = ''
                this.seedoctordate1 = ''
                this.diag = ''
                this.drug = ''
                this.drugrefill3m = ''
                this.drugrefill6m = ''
               

                this.$refs.diagtable.refresh()
                this.$refs.drugtable.refresh()
            },
            back: function () {
                this.$router.push('/about')
            },
        }

    }
</script>