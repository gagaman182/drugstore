<template>
    <div>

        <b-container class="bv-example-row">

            <div class="mt-3">
                <b-button-group size="lg">


                    <b-button type="reset" variant="outline-warning" @click='back()'>
                        <b-icon icon="skip-end-fill"></b-icon>กลับหน้าหลัก
                    </b-button>




                </b-button-group>
            </div> <br>

            <b-form-group>

                <b-card>
                    <template v-slot:header>
                        <h5 class="mb-0">ครบกำหนดวัน Refill ยา</h5>
                    </template>
                    <b-form inline>

                        <b-input type="date" class="mb-2 mr-sm-2 mb-sm-0" placeholder="Jane Doe" v-model="date1">
                        </b-input>

                        <b-input type="date" class="mb-2 mr-sm-2 mb-sm-0" placeholder="Jane Doe" v-model="date2">
                        </b-input>




                        <b-button variant="primary" @click='addperson()' class="mb-2 mr-sm-2 mb-sm-0">
                            <b-icon icon="power"></b-icon>ตกลง
                        </b-button>


                    </b-form>
                </b-card>

            </b-form-group>



            <!-- Content here -->
            <b-form-group>
                <b-card>
                    <b-row>
                        <b-col cols="12">
                            <b-form-group label="ข้อมูลบริการ">

                                <vue-good-table :columns="columnservice" :rows="rowservice" @on-row-click="ServiceClick"
                                    @on-row-dblclick="onRowDoubleClick" />

                            </b-form-group>
                        </b-col>

                    </b-row>




                </b-card>
            </b-form-group>

        </b-container>

    </div>
</template>
<script>
    import axios from 'axios'

    export default {
        name: 'maintable',
        data() {
            return {

                // table service
                columnservice: [{
                        label: 'HN',
                        field: 'hn',
                    },
                    {
                        label: 'ชื่อ-สกุล',
                        field: 'name',

                    },

                    {
                        label: 'วันที่ครบ refill ครั้งที่1',
                        field: 'datemonth3',
                    },
                    {
                        label: 'วันที่ครบ refill ครั้งที่2',
                        field: 'datemonth6',
                       

                    }
                    


                ],
                rowservice: [],
                date1: '',
                date2: '',
               
              

        form: {
            token:'',
         
        }



            }
        },
        mounted() {
        this.form.token = JSON.parse(localStorage.getItem('token'));
        
         

            if(this.form.token == undefined){
                  this.$router.push('/login')
            }else{
               this.persontable()
           }
       
        },
        methods: {
            persontable() {
                axios
                    .get('http://192.168.4.3/webapp/tee/drugs/person_my.php')
                    .then(response => (this.rowperson = response.data))
            },

            addperson: function () {
                  if (this.date1 != '' && this.date2 != '') {
                axios.get('http://192.168.4.3/webapp/tee/drugs/refill_report.php', {
                            params: {
                                date1: this.date1,
                                date2: this.date2
                                
                            }
                        })
                        .then(response => {

                            this.rowservice = response.data


                        })
                  }else{
                       alert('กรุณาระบุวันที่')
                  }
            },
            back: function () {
                this.$router.push('/about')
            },




        }
    };
</script>