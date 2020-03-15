<template>
  <div>
    <b-row>
      <b-col cols="6">
        <b-form-group>
          <b-card class="mt-3 ">
            <template v-slot:header>
              <h5 class="mb-0">ข้อมูลบุคคล</h5>
            </template>

            <vue-good-table :columns="columnperson" :rows="rowperson" :search-options="{ enabled: true }"
              @on-row-click="PersonClick" @on-row-dblclick="onRowDoubleClickperson" ref="persontableref"
              :pagination-options="{ enabled: true,}" :totalRows="totalRecords" :isLoading.sync="isLoading" />

          </b-card>
          <b-alert show variant="primary">
            <b-badge>Click</b-badge> ที่ข้อมูลเพื่อแสดงข้อมูลบริการ<br>
            <b-badge>Double Click</b-badge> เพื่อดูรายละเอียดบุคล
          </b-alert>
        </b-form-group>
      </b-col>
      <b-col cols="6">
        <b-card class="mt-3 ">
            <template v-slot:header>
              <h5 class="mb-0">กราฟแสดงจำนวนคนไข้</h5>
            </template>
          <apexchart type="bar" height="350" :options="chartOptions" :series="series"></apexchart>
        </b-card>
      </b-col>
    </b-row>


    <!-- Content here -->
    <b-form-group>
      <b-card>
        <b-row>
          <b-col cols="12">
            <b-form-group label="ข้อมูลบริการ">

              <vue-good-table :columns="columnservice" :rows="rowservice" @on-row-click="ServiceClick"
                @on-row-dblclick="onRowDoubleClick" />
              <b-alert show variant="warning">
                <b-badge>Click</b-badge> ที่ข้อมูลเพื่อแสดงรายละเอียดการรับริการ<br>
                <b-badge>Double Click</b-badge> แก้ไขข้อมูล
              </b-alert>
            </b-form-group>
          </b-col>

        </b-row>
        <b-row>
          <b-col cols="6">
            <b-col>
              <b-form-group label="โรคที่วินิฉัย">

                <vue-good-table :columns="columndiag" :rows="rowdiag" />
              </b-form-group>
            </b-col>

          </b-col>
          <b-col cols="6">
            <b-col>
              <b-form-group label="ยาที่ได้รับ">

                <vue-good-table :columns="columndrug" :rows="rowdrug" />
              </b-form-group>
            </b-col>

          </b-col>

        </b-row>
        <b-row>
          <b-col cols="6">
            <b-col>
              <b-form-group label="refillครั้งที่1">

                <vue-good-table :columns="columnrefill1" :rows="rowrefill1" />
              </b-form-group>
            </b-col>

          </b-col>
          <b-col cols="6">
            <b-col>
              <b-form-group label="refillครั้งที่2">

                <vue-good-table :columns="columnrefill2" :rows="rowrefill2" />





              </b-form-group>
            </b-col>

          </b-col>

        </b-row>


      </b-card>
    </b-form-group>



  </div>
</template>

<script>
  import axios from 'axios'

  export default {
    name: 'maintable',

    data() {
      return {
        // chart
        series: [{
          name: '',
          data: [0]
        }, {
          name: '',
          data: [0]
        }, {
          name: '',
          data: [0]
        }],
        chartOptions: {
          chart: {
            type: 'bar',
            height: 350
          },
          plotOptions: {
            bar: {
              horizontal: false,
              columnWidth: '55%',
              endingShape: 'rounded'
            },
          },
          dataLabels: {
            enabled: false
          },
          stroke: {
            show: true,
            width: 2,
            colors: ['transparent']
          },
          xaxis: {
            categories: ['สถานะการรับยา'],
          },
          yaxis: {
            title: {
              text: 'จำนวนคนไข้'
            }
          },
          fill: {
            opacity: 1
          },
          tooltip: {
            y: {
              formatter: function (val) {
                return "$ " + val + " thousands"
              }
            }
          }
        },


        totalRecords: 0,
        // table person
        columnperson: [{
            label: 'ID',
            field: 'id',
          },
          {
            label: 'HN',
            field: 'hn',
          },
          {
            label: 'ชื่อ-สกุล',
            field: 'name',
          }, {
            label: 'เพศ',
            field: 'sex',
          }, {
            label: 'เลข13หลัก',
            field: 'idcard',
          }, {
            label: 'เบอร์โทร',
            field: 'tel',
          }
        ],

        rowperson: [],
        // table service
        columnservice: [{
            label: 'ID',
            field: 'num',
          },
          {
            label: 'HN',
            field: 'hn',

          },

          {
            label: 'รอบที่',
            field: 'rounds',
          },
          {
            label: 'วันที่เริ่มรับยาที่ รพ.',
            field: 'startdrug',
            type: 'date',
            dateInputFormat: 'yyyy-MM-dd', // expects 2018-03-16
            dateOutputFormat: 'LL-MM-yyyy',

          },
          {
            label: 'VN จ่ายยารพ.',
            field: 'startvn',

          },
          {
            label: 'ครบกำหนดrefillครั้งที่1',
            field: 'datemonth3',



          },
          {
            label: 'ครบกำหนดrefillครั้งที่2',
            field: 'datemonth6',



          },

          {
            label: 'วันที่ต้องพบแพทย์',
            field: 'appointdocotor1',
          },
          {
            label: 'มาพบแพทย์',
            field: 'seedoctor1',
          },
          {
            label: 'วันที่มาพบแพทย์',
            field: 'seedoctordate1',
          }





        ],
        rowservice: [],
        // table diag
        columndiag: [{
            label: 'ICD10',
            field: 'icdcode',
          },
          {
            label: 'ประเภท DX',
            field: 'icdtype',
          }

        ],
        rowdiag: [],
        columndrug: [{
            label: 'รหัส',
            field: 'drugcode',
          },
          {
            label: 'ชื่อยา',
            field: 'drugname',
          },
          {
            label: 'ชื่อยา',
            field: 'unit',
          }

        ],
        rowdrug: [],
        columnrefill1: [{
            label: 'วันที่refill',
            field: 'refill1',
            type: 'date',
            dateInputFormat: 'yyyy-MM-dd', // expects 2018-03-16
            dateOutputFormat: 'LL-MM-yyyy',

          },
          {
            label: 'VNจ่ายยา',
            field: 'refill1vn',
          },
          {
            label: 'สถานะการรับยา',
            field: 'getdrug1',
          },
          {
            label: 'วันที่รับยา',
            field: 'getdrugdate1',
            type: 'date',
            dateInputFormat: 'yyyy-MM-dd', // expects 2018-03-16
            dateOutputFormat: 'LL-MM-yyyy',

          }


        ],
        rowrefill1: [],
        columnrefill2: [{
            label: 'วันที่refill',
            field: 'refill2',
            type: 'date',
            dateInputFormat: 'yyyy-MM-dd', // expects 2018-03-16
            dateOutputFormat: 'LL-MM-yyyy',

          },
          {
            label: 'VNจ่ายยา',
            field: 'refill2vn',
          },


          {
            label: 'สถานะการรับยา',
            field: 'getdrug2',
          },
          {
            label: 'วันที่รับยา',
            field: 'getdrugdate2',
            type: 'date',
            dateInputFormat: 'yyyy-MM-dd', // expects 2018-03-16
            dateOutputFormat: 'LL-MM-yyyy',

          }


        ],
        rowrefill2: [],
        addok: '',
        form: {
          token: '',

        }


      }
    },
    mounted() {
      // chart
      axios.get('http://localhost/0161/vue/drugs/charts.php')
        .then(response => {
          // JSON responses are automatically parsed.
          this.series = response.data

        })
      //เลื่อนไปบนสุดของหน้าจอ

      window.scrollTo(0, 0);

      // session login
      this.form.token = JSON.parse(localStorage.getItem('token'));

      if (this.form.token == undefined) {
        this.$router.push('/login')
      } else {
        this.persontable()
      }
    },
    methods: {
      persontable() {
        axios
          .get('http://192.168.4.3/webapp/tee/drugs/person_my.php')
          .then(response => (this.rowperson = response.data))
      },



      PersonClick(params) {

        axios.get('http://192.168.4.3/webapp/tee/drugs/service_my.php', {
            params: {
              hn: params.row.hn

            }
          })
          .then(response => {
            // JSON responses are automatically parsed.
            this.rowservice = response.data
          })

        // params.row - row object 
        // params.pageIndex - index of this row on the current page.
        // params.selected - if selection is enabled this argument 
        // indicates selected or not
        // params.event - click event
      },

      ServiceClick(params) {

        axios.get('http://192.168.4.3/webapp/tee/drugs/diag_my.php', {
            params: {
              startvn: params.row.startvn

            }
          })
          .then(response => {
            // JSON responses are automatically parsed.
            this.rowdiag = response.data

          })

        axios.get('http://192.168.4.3/webapp/tee/drugs/drug_my.php', {
            params: {
              startvn: params.row.startvn

            }
          })
          .then(response => {
            // JSON responses are automatically parsed.
            this.rowdrug = response.data

          })

        axios.get('http://192.168.4.3/webapp/tee/drugs/refill_my.php', {
            params: {
              startvn: params.row.startvn


            }
          })
          .then(response => {
            // JSON responses are automatically parsed.
            this.rowrefill1 = response.data

          })

        axios.get('http://192.168.4.3/webapp/tee/drugs/refill2_my.php', {
            params: {
              startvn: params.row.startvn



            }
          })
          .then(response => {
            // JSON responses are automatically parsed.
            this.rowrefill2 = response.data

          })





      },

      onRowDoubleClick(params) {

        // alert(params.row.num)

        // params.row - row object 
        // params.pageIndex - index of this row on the current page.
        // params.selected - if selection is enabled this argument 
        // indicates selected or not
        // params.event - click event

        //  this.$router.push('/edit/'+params.row.startvn)  get = this.$route.params.num
        //  this.$router.push({ path: 'person/vn', query: { vn: params.row.startvn} }) get = this.$route.query.vn

        //  this.$router.push({ path: 'person/vn', query: { vn: params.row.startvn} }) 

        // this.$router.push({ path: 'edit/vn', query: { vn: params.row.startvn,hn:'44'} }) get this.$route.query.vn this.$route.query.hn
        this.$router.push({
          path: 'edit/vn',
          query: {
            vn: params.row.startvn,
            num: params.row.num
          }
        })
        //this.$router.push('/edit/' + params.row.num)
      },
      onRowDoubleClickperson(params) {



        this.$router.push('/person/' + params.row.id)

      },


    }
  };
</script>