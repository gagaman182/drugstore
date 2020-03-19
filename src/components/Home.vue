<template>

  <div>
    <vue-scroll-progress-bar @complete="handleComplete" />



    <b-container class="bv-example-row">


      <b-col cols="12">
        <div class="mt-3">
          <b-button-group size="lg">


            <b-button type="reset" variant="outline-warning" @click='back()'>
              <b-icon icon="skip-end-fill"></b-icon>กลับหน้าหลัก
            </b-button>




          </b-button-group>
        </div>
        <div>
          <b-form @submit="onSubmit" @reset="onReset" v-if="show">
            <b-card class="mt-3 ">
              <template v-slot:header>
                <h5 class="mb-0">ข้อมูลบุคคล</h5>
              </template>
              <b-row>
                <b-col cols="2">
                  <b-form-group id="input-group-1" label="ค้นหา HN รพ." label-for="input-2">
                    <b-input-group size="sm" class="mb-2">
                      <b-input-group-prepend is-text>
                        <b-icon icon="search"></b-icon>

                      </b-input-group-prepend>
                      <b-form-input type="search" placeholder="--/--" id="input-1" v-model="search"></b-form-input>
                    </b-input-group>

                  </b-form-group>
                  <b-col>
                    <b-form-group>
                      <b-button pill variant="outline-secondary" @click='searchHN()'>
                        ค้นหา</b-button>

                    </b-form-group>
                  </b-col>
                </b-col>
                <b-col>
                  <b-col>
                    <b-form-group id="input-group-2" label="HN:" label-for="input-2">
                      <b-form-input v-model="hn" required placeholder="HN" disabled></b-form-input>



                    </b-form-group>
                  </b-col>
                </b-col>
                <b-col>
                  <b-form-group id="input-group-3" label="ชื่อ-นามสกุล:" label-for="input-3">
                    <b-form-input v-model="name" required placeholder="ชื่อ-นามสกุล" disabled></b-form-input>

                  </b-form-group>
                </b-col>

                <b-col cols="1.5">
                  <b-form-group id="input-group-5" label="เพศ:" label-for="input-5">
                    <b-form-input v-model="sex" required placeholder="เพศ" disabled></b-form-input>

                  </b-form-group>
                </b-col>
                <b-col>
                  <b-form-group id="input-group-6" label="เลขบัตร บปช:" label-for="input-6">
                    <b-form-input v-model="idcard" required placeholder="บปช" disabled></b-form-input>

                  </b-form-group>
                </b-col>
              </b-row>
              <b-row>

                <b-col>
                  <b-form-group id="input-group-7" label="เบอร์โทรผู้ป่วย:" label-for="input-7">
                    <b-form-input v-model="tel" required placeholder="เบอร์โทรผู้ป่วย" ></b-form-input>

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
                  ข้อมูลการรับบริการ</h5>
              </template>
              <b-row>
                <b-col sm="2">

                  <!-- <b-form-group id="input-group-17" label="รอบที่ร่วมโครงการ:" label-for="input-17">
                    <b-form-radio v-model="form.rounds" value="รอบ1">รอบ1</b-form-radio>
                    <b-form-radio v-model="form.rounds" value="รอบ2">รอบ2 </b-form-radio>
                  </b-form-group> -->
                    <b-form-group id="input-group-17" label="ปีงบ:" label-for="input-17">
                  <b-form-select v-model="year" :options="years" placeholder="ปี" ></b-form-select>
                   </b-form-group> 
                </b-col>
                <b-col>
                  <b-form-group id="input-group-0" label="แพทย์ที่ส่งตัว:" label-for="input-8">
                    <multiselect v-model="form.doctor" :options="options" :custom-label="nameWithLang"
                      placeholder="เลือกรายชื่อหมอ" label="name" track-by="name" id="input-8" @input="Selecteddoctor">
                    </multiselect>
                  </b-form-group>
                </b-col>
                <b-col>
                  <b-form-group id="input-group-9" label="ร้านยาที่ร่วมให้บริการ:" label-for="input-3">
                    <b-form-select id="input-3" v-model="form.drugstore" :options="drugstores"></b-form-select>
                  </b-form-group>
                </b-col>
              </b-row>
            </b-card>
            <div>


              <b-card class="mt-3" sub-title="วันที่เริ่มรับยา ">

                <b-row>
                  <b-col>
                    <b-form-group id="input-group-11" label="VN จ่ายยา รพ:" label-for="input-11">
                      <multiselect v-model="form.startvn" :options="optionsvn" :custom-label="nameWithLang2"
                        placeholder="vn-วันที่รับบริการ-โรค" label="vn" track-by="vn" id="input-11"
                        @input="Selectedstartvn" required></multiselect>
                    </b-form-group>
                    <div>
                      <h4>
                        <b-badge variant="danger">วันที่จะ refill ครั้งที่1</b-badge>
                      </h4>
                    </div>
                    <h4> {{nextdrug.drugrefill3m}}</h4>

                  </b-col>
                  <b-col>
                    <b-form-group id="input-group-10" label="วันที่เริ่มรับยาที่ รพ:" label-for="input-10">
                      <b-form-input type="date" id="input-10" v-model="form.startdrug" placeholder="ชื่อ">
                      </b-form-input>
                    </b-form-group>
                    <div>
                      <h4>
                        <b-badge variant="danger">วันที่จะ refill ครั้งที่2</b-badge>
                      </h4>
                    </div>
                    <h4> {{nextdrug.drugrefill6m}}</h4>

                  </b-col>
                  <b-col>
                    <div>
                      <b-form-group label="ICD10">
                        <b-table :fields="fieldsdiag" :items="diag" :label="label" sticky-header head-variant="light"
                          ref="diagtable">
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
                        <b-table :fields="fieldsdrug" :items="drug" :label="label" sticky-header head-variant="light"
                          ref="drugtable">
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

                      <multiselect v-model="form.refill1vn" :options="optionsvn" :custom-label="nameWithLang2"
                        placeholder="vn-วันที่รับบริการ-โรค" label="vn" track-by="vn" id="input-13"
                        @input="Selectedrefill1"></multiselect>
                    </b-form-group>
                  </b-col>
                  <b-col>
                    <b-form-group id="input-group-12" label="วันที่ refill :" label-for="input-12">
                      <b-form-input type="date" id="input-12" v-model="form.refill1" placeholder="ชื่อ">
                      </b-form-input>
                    </b-form-group>
                  </b-col>
                  <b-col>

                    <b-form-group>
                      <h4>
                        <b-badge variant="success">สถานะการรับยา</b-badge>
                      </h4>
                      <b-form-radio v-model="form.getdrug1" value="รับยา">รับยา</b-form-radio>
                      <b-form-radio v-model="form.getdrug1" value="ไม่มารับยา">ไม่มารับยา </b-form-radio>
                    </b-form-group>

                  </b-col>
                  <b-col>
                    <b-form-group id="input-group-18" label=" วันที่รับยา:" label-for="input-18">
                      <b-form-input type="date" id="input-18" v-model="form.getdrugdate1" placeholder="วันที่">
                      </b-form-input>
                    </b-form-group>

                  </b-col>

                </b-row>
              </b-card>

              <b-card class="mt-3" sub-title="refillยา ครั้งที่2">
                <b-row>
                  <b-col>
                    <b-form-group id="input-group-13" label="VN จ่ายยารพ :" label-for="input-13">

                      <multiselect v-model="form.refill2vn" :options="optionsvn" :custom-label="nameWithLang2"
                        placeholder="vn-วันที่รับบริการ-โรค" label="vn" track-by="vn" id="input-13"
                        @input="Selectedrefill2"></multiselect>
                    </b-form-group>
                  </b-col>
                  <b-col>
                    <b-form-group id="input-group-12" label="วันที่ refill:" label-for="input-12">
                      <b-form-input type="date" id="input-12" v-model="form.refill2" placeholder="ชื่อ">
                      </b-form-input>
                    </b-form-group>
                  </b-col>
                  <b-col>

                    <b-form-group>
                      <h4>
                        <b-badge variant="success">สถานะการรับยา</b-badge>
                      </h4>
                      <b-form-radio v-model="form.getdrug2" value="รับยา">รับยา</b-form-radio>
                      <b-form-radio v-model="form.getdrug2" value="ไม่มารับยา">ไม่มารับยา </b-form-radio>
                    </b-form-group>

                  </b-col>
                  <b-col>
                    <b-form-group id="input-group-18" label=" วันที่รับยา:" label-for="input-18">
                      <b-form-input type="date" id="input-18" v-model="form.getdrugdate2" placeholder="วันที่">
                      </b-form-input>
                    </b-form-group>

                  </b-col>

                </b-row>
              </b-card>
              <b-card class="mt-3" sub-title="พบแพทย์">
                <b-row>
                  <b-col>
                    <b-form-group id="input-group-16" label="วันที่ต้องพบแพทย์:" label-for="input-16">
                      <b-form-input type="date" id="input-16" placeholder="ชื่อ" v-model="form.appointdocotor1">
                      </b-form-input>

                    </b-form-group>
                  </b-col>

                  <b-col>

                    <b-form-group id="input-group-19" label="มาพบแพทย์:" label-for="input-19">
                      <b-form-radio v-model="form.seedoctor1" name="seedoctor" value="พบ">พบ</b-form-radio>
                      <b-form-radio v-model="form.seedoctor1" name="seedoctor" value="ไม่พบ">ไม่พบ</b-form-radio>
                    </b-form-group>

                  </b-col>

                  <b-col>

                    <b-form-group id="input-group-20" label="วันที่มาพบแพทย์:" label-for="input-20">
                      <b-form-input type="date" id="input-20" v-model="form.seedoctordate1" placeholder="ชื่อ">
                      </b-form-input>
                    </b-form-group>
                  </b-col>

                </b-row>
              </b-card>

            </div>
            <div class="mt-3">
              <b-form inline>
                <b-button-group size="lg">

                  <b-button type="submit" variant="outline-success" @click='addperson()' class="mb-2 mr-sm-2 mb-sm-0">
                    <b-icon icon="person"></b-icon>เพิ่ม
                  </b-button>


                  <b-button type="reset" variant="outline-primary" @click='clearform()' class="mb-2 mr-sm-2 mb-sm-0">
                    <b-icon icon="forward-fill"></b-icon>เริ่มใหม่
                  </b-button>

                </b-button-group>
              </b-form>
            </div>





          </b-form>




          <!-- <b-card class="mt-3" header="Form Data Result">
            <pre class="m-0">{{form.drugrefill3m}}</pre>


          </b-card> -->

        </div>
      </b-col>

    </b-container>

  </div>

</template>


<script>
  import axios from 'axios'
  import moment from 'moment'

  // import SearchHnCom from './components/SearchHnCom.vue'
  export default {
    data() {
      return {
        // head field diag
        fieldsdiag: [{
          key: 'ICD_CODE',
          label: 'ICD10'
        }, {
          key: 'NAME',
          label: 'ประเภท DX'
        }],
        // head field drug
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

        ok: '',
        addok: '',
        users: [],
        search: '',
        searchs: '', // พัก hn for loop
        searchss: '', // พัก hn for loop
        options: '', //multiselect1
        optionsvn: '', // multiselect2
        info: null,
        diag: {
          'ROWNUM': '',
          'ICD_CODE': '',
          'NAME': ''
        },

        drug: {
          'CODE': '',
          'NAME': '',
          'QUANTITY': ''
        },

        diaguse: {
          'OPD_FINANCE_NO': '',
          'DIAGNOSIS_TYPE': '',
          'NAME': '',
          'ICD_CODE': ''
        },

        hn: '',
        name: '',
        sex: '',
        tel: '',
        idcard: '',
        address: '',
        year: null,
        years: [
          { value: null, text: 'ปี' },
          { value: '2563', text: '2563' },
          { value: '2564', text: '2564' },
          { value: '2565', text: '2565' },
          { value: '2566', text: '2566' },
          { value: '2567', text: '2567' },
        
        ],
        nextdrug:{
            drugrefill3m: '',
          drugrefill6m: '',
        },
        form: {
          doctor: { //multiselect1
            doccode: 'เลข ว.',
            name: 'ชื่อ-สกุล'
          },
          doctoruse: '',
          drugstore: null,
          startdrug: '',
        
          startdrug2: '',
          startvn: { //multiselect2
            vn: 'vn',
            opdtime: 'วัน',
            pla: 'ห้องตรวจ'
          },
          startvnuse: '',
          startvn2: { //multiselect2
            vn: 'vn',
            opdtime: 'วัน',
            pla: 'ห้องตรวจ'
          },
          refill1: '',
          refill1vn: { //multiselect2
            vn: 'vn',
            opdtime: 'วัน',
            pla: 'ห้องตรวจ'
          },
          refill1vnuse: '',
          refill2: '',
          refill2vn: { //multiselect2
            vn: 'vn',
            opdtime: 'วัน',
            pla: 'ห้องตรวจ'
          },
          refill2vnuse: '',
          appointdocotor1: '',
          getdrug1: '',
          getdrugdate1: '',
          getdrug2: '',
          getdrugdate2: '',
          seedoctor1: '',
          seedoctordate1: '',
          rounds: '',
          token:'',
        },
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
        idiag: '',
        idrug: '',
        show: true,
        pshow: true,
        dd: { //multiselect2
          icd_code: 'i10',
          name: 'Principal Diagnosis',
          vn: '444444444'
        },
        servicenum: '',
        showdate60120: ''

      }
    },
    methods: {
      //เลื่อนไปบนสุดของหน้าจอ
      scrollToTop() {
                window.scrollTo(0,0);
           },
      // table resfresh
      toggleBusy() {
        this.isBusy = !this.isBusy
      },

      //  multiselect เลือกค่าในช่อง ใช่คู่กับ @input 
      // รอบ1
      Selectedstartvn(value) {

        this.toggleBusy()
        this.form.startdrug = value.opdtime

        this.nextdrug.drugrefill3m = moment(value.opdtime, 'YYYY/MM/DD ').add('days', 60).format('YYYY/MM/DD ')
        this.nextdrug.drugrefill6m = moment(value.opdtime, 'YYYY/MM/DD ').add('days', 120).format('YYYY/MM/DD ')
        this.form.startvnuse = value.vn

        axios.get('http://192.168.4.3/webapp/tee/drugs/diag.php', {
            params: {
              hn: this.search,
              vn: value.vn
            }
          })
          .then(response => {

            this.diag = response.data
          })
          .catch(e => {
            this.errors.push(e)
          })
        axios.get('http://192.168.4.3/webapp/tee/drugs/drug.php', {
            params: {
              hn: this.search,
              vn: value.vn
            }
          })
          .then(response => {

            this.drug = response.data
          })
          .catch(e => {
            this.errors.push(e)
          })

      },

      //เลข ว หมอ
      Selecteddoctor(value) {
        this.form.doctoruse = value.doccode
      },
      Selectedrefill1(value) {
        this.form.refill1 = value.opdtime
        this.form.refill1vnuse = value.vn

      },
      Selectedrefill2(value) {
        this.form.refill2 = value.opdtime
        this.form.refill2vnuse = value.vn

      },
      moment: function (date) {
        return moment(date).format('YYYY-MM-DD');
      },
      onSubmit(evt) {
        evt.preventDefault()
        // alert(JSON.stringify(this.form))
      },
      onReset(evt) {
        evt.preventDefault()
        // Reset our form values
        this.form.email = ''
        this.form.name = ''
        this.todo2.name = ''
        this.form.food = null
        this.form.checked = []
        // Trick to reset/clear native browser form validation state
        this.show = false
        this.$nextTick(() => {
          this.show = true
        })
      },
      //clear form
      clearform: function () {
        this.scrollToTop()
        this.search = ''
        this.hn = ''
        this.name = ''
        this.sex = ''
        this.idcard = ''
        this.tel = ''
        this.address = ''
        this.form.rounds = ''
        this.year=''
        //  this.form.doctor = ''
         this.form.doctor.doccode = 'เลข ว.'
        this.form.doctor.name = 'ชื่อ-สกุล'
        this.form.drugstore = ''
        // this.form.startvn = ''
         this.form.startvn.vn = 'vn'
         this.form.startvn.opdtime = 'วัน'
         this.form.startvn.pla = 'ห้องตรวจ'
        this.form.startdrug = ''
        // this.diag = ''
        // this.drug = ''
        this.diag.ROWNUM = ''
        this.diag.ICD_CODE = ''
        this.diag.NAME = ''
        this.drug.CODE = ''
        this.drug.NAME = ''
        this.drug.QUANTITY= ''
        this.form.refill1 = ''
        //  this.form.refill1vn = ''
         this.form.refill1vn.vn = 'vn'
         this.form.refill1vn.opdtime = 'วัน'
         this.form.refill1vn.pla = 'ห้องตรวจ'
        this.form.getdrug1 = ''
        this.form.getdrugdate1 = ''
        this.form.refill2 = ''
        //  this.form.refill2vn = ''
         this.form.refill2vn.vn = 'vn'
         this.form.refill2vn.opdtime = 'วัน'
         this.form.refill2vn.pla = 'ห้องตรวจ'
        this.form.getdrug2 = ''
        this.form.getdrugdate2 = ''
        this.form.appointdocotor1 = ''
        this.form.seedoctor1 = ''
        this.form.seedoctordate1 = ''
        this.nextdrug.drugrefill3m = ''
        this.nextdrug.drugrefill6m = ''
        this.$router.push('/about')
        this.allRecords();

     

        // this.$refs.diagtable.refresh()
        // this.$refs.drugtable.refresh()





      },
      // หา hn 
      searchHN: function () {
        if (this.search != '') {
          axios.get('http://192.168.4.3/webapp/tee/drugs/data.php', {
              params: {
                hn: this.search
              }
            })
            .then(response => {

              this.searchs = response.data
              this.hn = this.searchs[0].hn
              this.name = this.searchs[0].name
              this.sex = this.searchs[0].sex
              this.idcard = this.searchs[0].idcard
              this.tel = this.searchs[0].tel
              this.address = this.searchs[0].address
              this.pshow = false
              this.vns()
              // this.search = ''
              this.popupsearch()
            })
            .catch(e => {
              this.errors.push(e)
            })
        } else {

          this.popuphn()
        }
      },
      //เพิ่มผู้ป่วย
      addperson: function () {
        if (this.hn != '') {
          axios.get('http://192.168.4.3/webapp/tee/drugs/addperson.php', {
              params: {
                hn: this.searchs[0].hn,
                name: this.searchs[0].name,
                sex: this.searchs[0].sex,
                idcard: this.searchs[0].idcard,
                tel: this.searchs[0].tel,
                address: this.searchs[0].address,
                doctor: this.form.doctoruse,
                drugstore: this.form.drugstore,
                startdrug: this.form.startdrug,
                startvn: this.form.startvnuse,
                refill1: this.form.refill1,
                refill1vnuse: this.form.refill1vnuse,
                refill2: this.form.refill2,
                refill2vnuse: this.form.refill2vnuse,
                appointdocotor1: this.form.appointdocotor1,
                getdrug1: this.form.getdrug1,
                getdrug2: this.form.getdrug2,
                getdrugdate1: this.form.getdrugdate1,
                getdrugdate2: this.form.getdrugdate2,
                seedoctor1: this.form.seedoctor1,
                seedoctordate1: this.form.seedoctordate1,
                // rounds: this.form.rounds,
                year:this.year,
                drugrefill3m: this.nextdrug.drugrefill3m,
                drugrefill6m: this.nextdrug.drugrefill6m

              }
            })
            .then(response => {
              this.addok = response.data
              this.popupadd()
              this.popupaddservice()
              this.clearform()
               this.$router.push('/about')


            })


          // add in diags table
          for (this.idiag = 0; this.idiag < this.diag.length; this.idiag++) {
            axios.get('http://192.168.4.3/webapp/tee/drugs/adddiag.php', {
                params: {
                  icdcode: this.diag[this.idiag].ICD_CODE,
                  icdtype: this.diag[this.idiag].NAME,
                  vn: this.form.startvnuse,
                  num: this.servicenum
                }
              })
              .then(response => {

                this.ok = response.data
                this.clearform()
              })
          }
          // add in drugs table
          for (this.idrug = 0; this.idrug < this.drug.length; this.idrug++) {
            axios.get('http://192.168.4.3/webapp/tee/drugs/adddrug.php', {
                params: {
                  drugcode: this.drug[this.idrug].CODE,
                  drugname: this.drug[this.idrug].NAME,
                  unit: this.drug[this.idrug].QUANTITY,
                  vn: this.form.startvnuse,
                  num: this.servicenum

                }
              })
              .then(response => {

                this.ok = response.data
                this.clearform()
              })
          }

          // get num services
          axios.get('http://192.168.4.3/webapp/tee/drugs/servicenum.php', {
              params: {
                vn: this.form.startvnuse
              }
            })
            .then(response => {

              this.servicenum = response.data

            })

         

        } else {

          this.popuphn()
        }
      },
      // multiselect
      nameWithLang({
        doccode,
        name
      }) {
        return `${doccode}  ${name}`
      },
      // multiselect
      nameWithLang2({
        opdtime,
        pla,
        vn
      }) {
        return `${vn} / ${opdtime}  / ${pla} `
      },
      vns: function () {
        // multiselect
        axios.get('http://192.168.4.3/webapp/tee/drugs/vn.php', {
            params: {
              hn: this.search
            }
          })
          .then(response => {

            this.optionsvn = response.data
          })
        
      },
      //ข้อความตอน ค้นหา hn
      popupsearch(append = false) {
        this.toastCount++
        this.$bvToast.toast('HN' + ' ' + this.searchs[0].hn + ' ชื่อ-สกุล ' + this.searchs[0].name, {
          title: 'ค้นหาข้อมูล',
          autoHideDelay: 5000,
          appendToast: append
        })
      },
      popupadd(append = false) {
        this.toastCount++

        this.$bvToast.toast(this.addok[0].message, {
          title: 'แจ้งเตือนการเพิ่มข้อมูลบุุคคล',
          autoHideDelay: 5000,
          appendToast: append
        })
      },
      popupaddservice(append = false) {
        this.toastCount++

        this.$bvToast.toast(this.addok[1].message2, {
          title: 'แจ้งเตือนการเพิ่มข้อมูลการรับบริการ',
          autoHideDelay: 5000,
          appendToast: append
        })
      },
      popuphn(append = false) {
        this.toastCount++

        this.$bvToast.toast('กรุณาระบุ HN', {
          title: 'แจ้งเตือน',
          autoHideDelay: 5000,
          appendToast: append
        })
      },
      back: function () {
        this.$router.push('/about')
      },
      allRecords(){

        axios.get('http://192.168.4.3/webapp/tee/drugs/diagdrugrefresh.php', {
            params: {
              vn:'refresh'
            }
          })
          .then(response => {

            this.diag = response.data
          })
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
              
          
      // multiselect1
      axios
        .get('http://192.168.4.3/webapp/tee/drugs/doctor.php')
        .then(response => (this.options = response.data))
      // multiselect2
      this.vns()
       }
    },
    created: function(){
					this.allRecords();
				}

    //  components: {
    //   SearchHnCom
    // }
  }
</script>
