
<template>
  <div>
    <b-navbar type="dark" variant="dark">
      <b-navbar-nav>
        <b-nav-item href="#">Home</b-nav-item>
        <b-nav-item href="#">About</b-nav-item>
      </b-navbar-nav>
    </b-navbar>
    <b-container class="bv-example-row">
      <b-row>
        <b-col cols="2">
          <b-form-group id="input-group-1" label="HN:" label-for="input-2">
            <b-input-group size="sm" class="mb-2">
              <b-input-group-prepend is-text>
                <b-icon icon="search"></b-icon>
              </b-input-group-prepend>
              <b-form-input type="search" placeholder="หา HN"  id="input-1" v-model="search"  ></b-form-input>
            </b-input-group>
          </b-form-group>
          <b-col>
            <b-form-group>
  
              <b-button pill variant="outline-secondary" @click='recordByID()'>
                ค้นหา</b-button>
            </b-form-group>
          </b-col>
        </b-col>
        <b-col cols="10">
  
          <div>
            <b-form @submit="onSubmit" @reset="onReset" v-if="show">
  
  
              <b-row>
                <b-col>
                  <b-col>
                    <b-form-group id="input-group-2" label="HN:" label-for="input-2">
                      <b-form-input id="input-2" v-model="form.hn" required placeholder="HN"></b-form-input>
                    </b-form-group>
                  </b-col>
                </b-col>
                <b-col>
                  <b-form-group id="input-group-3" label="ชื่อ:" label-for="input-3">
                    <b-form-input id="input-3" v-model="form.name" required placeholder="ชื่อ"></b-form-input>
                  </b-form-group>
                </b-col>
                <b-col>
                  <b-form-group id="input-group-4" label="นามสกุล:" label-for="input-4">
                    <b-form-input id="input-4" v-model="form.lname" required placeholder="นามสกุล"></b-form-input>
                  </b-form-group>
                </b-col>
              </b-row>
              <b-row>
                <b-col>
                  <b-form-group id="input-group-5" label="เพศ:" label-for="input-5">
                    <b-form-input id="input-5" v-model="form.sex" required placeholder="เพศ"></b-form-input>
                  </b-form-group>
                </b-col>
                <b-col>
                  <b-form-group id="input-group-6" label="เบอร์โทรผู้ป่วย:" label-for="input-6">
                    <b-form-input id="input-6" v-model="form.tel" required placeholder="เบอร์โทร"></b-form-input>
                  </b-form-group>
                </b-col>
                <b-col>
                  <b-form-group id="input-group-7" label="เลข 13 หลัก:" label-for="input-7">
                    <b-form-input id="input-7" v-model="form.cid" required placeholder="13 หลัก"></b-form-input>
                  </b-form-group>
                </b-col>
              </b-row>
              <b-row>
                <b-col>
                  <b-form-group id="input-group-8" label="แพทย์ที่ส่งตัว:" label-for="input-8">
                    <b-form-input id="input-8" v-model="form.doctor" required placeholder="แพทย์"></b-form-input>
                  </b-form-group>
                </b-col>
                <b-col>
                  <b-form-group id="input-group-9" label="รับยาที่ร้านยา:" label-for="input-3">
                    <b-form-select id="input-3" v-model="form.drugstore" :options="drugstores" required></b-form-select>
                  </b-form-group>
                </b-col>
  
                <b-col>
                  <b-form-group id="input-group-10" label="เริ่มรับยาที่ รพ:" label-for="input-10">
                    <b-form-input id="input-10" v-model="form.startdrug" required placeholder="ชื่อ"></b-form-input>
                  </b-form-group>
                </b-col>
              </b-row>
              <b-row>
                <b-col>
                  <b-form-group id="input-group-11" label="VN จ่ายยา รพ:" label-for="input-11">
                    <b-form-input id="input-11" v-model="form.startvn" required placeholder="HN"></b-form-input>
                  </b-form-group>
                </b-col>
                <b-col>
                  <b-form-group id="input-group-12" label="refill ครั้งที่1:" label-for="input-12">
                    <b-form-input id="input-12" v-model="form.refill1" required placeholder="ชื่อ"></b-form-input>
                  </b-form-group>
                </b-col>
                <b-col>
                  <b-form-group id="input-group-13" label="VN จ่ายยา รพ ครั้งที่1 :" label-for="input-13">
                    <b-form-input id="input-13" v-model="form.refill1vn" required placeholder="ชื่อ"></b-form-input>
                  </b-form-group>
                </b-col>
              </b-row>
              <b-row>
                <b-col>
                  <b-form-group id="input-group-14" label="refill ครั้งที่2:" label-for="input-14">
                    <b-form-input id="input-14" v-model="form.refill2" required placeholder="HN"></b-form-input>
                  </b-form-group>
                </b-col>
                <b-col>
                  <b-form-group id="input-group-15" label="VN จ่ายยา รพ ครั้งที่2:" label-for="input-15">
                    <b-form-input id="input-15" v-model="form.refill2vn" required placeholder="ชื่อ"></b-form-input>
                  </b-form-group>
                </b-col>
                <b-col>
                  <b-form-group id="input-group-16" label="Your Name:" label-for="input-16">
                    <b-form-input id="input-16" v-model="form.name" required placeholder="ชื่อ"></b-form-input>
                  </b-form-group>
                </b-col>
              </b-row>
              <b-row>
                <b-col>
                  <b-form-group id="input-group-17" label="HN:" label-for="input-17">
                    <b-form-input id="input-17" v-model="form.hn" required placeholder="HN"></b-form-input>
                  </b-form-group>
                </b-col>
                <b-col>
                  <b-form-group id="input-group-18" label="Your Name:" label-for="input-18">
                    <b-form-input id="input-18" v-model="form.name" required placeholder="ชื่อ"></b-form-input>
                  </b-form-group>
                </b-col>
                <b-col>
                  <b-form-group id="input-group-19" label="Your Name:" label-for="input-19">
                    <b-form-input id="input-19" v-model="form.name" required placeholder="ชื่อ"></b-form-input>
                  </b-form-group>
                </b-col>
              </b-row>
  
  
  
              <b-button type="submit" variant="primary">Submit</b-button>
              <b-button type="reset" variant="danger">Reset</b-button>
            </b-form>
            <b-card class="mt-3" header="Form Data Result">
              <pre class="m-0">{{ form }}</pre>
            </b-card>
          </div>
  
        </b-col>
  
      </b-row>
    </b-container>
  </div>
</template>


<script>
  export default {
    data() {
      return {
        search:'',
        form: {
  
          hn: '',
          name: '',
          lname: '',
          sex: '',
          tel: '',
          cid: '',
          doctor: '',
          drugstore: null,
          startdrug: '',
          startvn: '',
          refill1: '',
          refill1vn: '',
          refill2: '',
          refill2vn: ''
       
  
        },
        
        drugstores: [{
            text: '--ร้านยา--',
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
        show: true
      }
    },
    methods: {
      onSubmit(evt) {
        evt.preventDefault()
        alert(JSON.stringify(this.form))
        
      },
      onReset(evt) {
        evt.preventDefault()
        // Reset our form values
        this.form.email = ''
        this.form.name = ''
        this.form.food = null
        this.form.checked = []
        // Trick to reset/clear native browser form validation state
        this.show = false
        this.$nextTick(() => {
          this.show = true
        })
      },
      recordByID: function(){
      
      alert( this.search )
        //  axios.get('database/data.php', {
        // //    params: {
        // //      userid: this.userid
        // //    }
        //  })
        // .then(function (response) {
        //    this.search = response.data;
        // })
        // .catch(function (error) {
            
        //  });
           
    }
    }
   
  } 
</script>

