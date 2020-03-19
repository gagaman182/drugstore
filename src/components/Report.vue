<template>
    <div>

        <b-container class="bv-example-row">

            <div class="mt-3">
                  <b-row>
                      <b-col>
                <b-button-group size="lg">
                     <b-button type="reset" variant="outline-warning" @click='back()'>
                        <b-icon icon="skip-end-fill"></b-icon>กลับหน้าหลัก
                    </b-button>
                  </b-button-group>
                  </b-col>
                  
                      </b-row>
                      <b-row>
                           <b-col>
                    <b-alert show>ระบุวันที่ ร้านยา และ สถานะ เพื่อเรียกข้อมูล</b-alert>
                     </b-col>
                      </b-row>
            </div> 

            <b-form-group>

                <b-card>
                    <template v-slot:header>
                        <h5 class="mb-0">ครบกำหนดวัน Refill ยา</h5>
                    </template>
                    <b-form inline>
                         <b-row>
                                  <b-form-group id="input-group-9" label=" ระบุวันที่: " label-for="input-3"
                            class="mb-2 mr-sm-2 mb-sm-0">
                        <b-input type="date" class="mb-2 mr-sm-2 mb-sm-0"  v-model="date1">
                        </b-input>

                        <b-input type="date" class="mb-2 mr-sm-2 mb-sm-0"  v-model="date2">
                        </b-input>
                        </b-form-group>

                        <b-form-group id="input-group-9" label=" ร้านยา: " label-for="input-3"
                            class="mb-2 mr-sm-2 mb-sm-0">
                            <b-form-select id="input-3" v-model="drugstore" :options="drugstores"></b-form-select>
                        </b-form-group>

                        <b-form-group id="input-group-9" label=" สถานะ: " label-for="input-3"
                            class="mb-2 mr-sm-2 mb-sm-0">
                            <b-form-select id="input-3" v-model="state" :options="states"></b-form-select>
                        </b-form-group>



                       
                           
                                <b-button variant="primary" @click='addperson()' class="mb-2 mr-sm-2 mb-sm-0">
                                    <b-icon icon="power"></b-icon>ตกลง
                                </b-button>
                           
                        </b-row>

                    </b-form>
                </b-card>

            </b-form-group>



            <!-- Content here -->
            <b-form-group>
                <b-card v-show="tb_1">
                    <b-row>
                        <b-col cols="12">
                            <b-form-group label="ข้อมูลจากสถานะเริ่มรับยา">

                                <vue-good-table :columns="columnservice1" :rows="rowservice1"
                                    @on-row-click="ServiceClick" @on-row-dblclick="onRowDoubleClick" />

                            </b-form-group>
                        </b-col>

                    </b-row>
                </b-card>

                <b-card v-show="tb_2">
                    <b-row>
                        <b-col cols="12">
                            <b-form-group label="ข้อมูลจากสถานะ Refill ครั้งที่1">

                                <vue-good-table :columns="columnservice2" :rows="rowservice2"
                                    @on-row-click="ServiceClick" @on-row-dblclick="onRowDoubleClick" />

                            </b-form-group>
                        </b-col>

                    </b-row>
                </b-card>

                <b-card v-show="tb_3">
                    <b-row>
                        <b-col cols="12">
                            <b-form-group label="ข้อมูลจากสถานะ Refill ครั้งที่2">

                                <vue-good-table :columns="columnservice3" :rows="rowservice3"
                                    @on-row-click="ServiceClick" @on-row-dblclick="onRowDoubleClick" />

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

                tb_1: false,
                tb_2: false,
                tb_3: false,
                rowservice: [],

                // table service1
                columnservice1: [{
                        label: 'HN',
                        field: 'hn',
                    },
                    {
                        label: 'ชื่อ',
                        field: 'name',

                    },

                    {
                        label: 'วันที่รับยา',
                        field: 'startdrug',


                    },

                    {
                        label: 'ร้านยา',
                        field: 'drugstore',


                    }




                ],
                rowservice1: [],

                // table service2
                columnservice2: [{
                        label: 'HN',
                        field: 'hn',
                    },
                    {
                        label: 'ชื่อ',
                        field: 'name',

                    },

                    {
                        label: 'วันที่ Refill ครั้งที่1',
                        field: 'datemonth3',


                    },

                    {
                        label: 'ร้านยา',
                        field: 'drugstore',


                    }




                ],
                rowservice2: [],

                // table service3
                columnservice3: [{
                        label: 'HN',
                        field: 'hn',
                    },
                    {
                        label: 'ชื่อ',
                        field: 'name',

                    },

                    {
                        label: 'วันที่ Refill ครั้งที่2',
                        field: 'datemonth6',


                    },

                    {
                        label: 'ร้านยา',
                        field: 'drugstore',


                    }




                ],
                rowservice3: [],
                date1: '',
                date2: '',



                form: {
                    token: '',

                },
                drugstore: null,
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
                state: null,
                states: [{
                        text: 'สถานะ',
                        value: null
                    },
                    {
                        text: 'สถานะเริ่มรับยา',
                        value: '1'
                    },
                    {
                        text: 'สถานะ Refill ครั้งที่1',
                        value: '2'
                    },
                    {
                        text: 'สถานะ Refill ครั้งที่2',
                        value: '3'
                    }



                ],



            }
        },
        mounted() {
            this.form.token = JSON.parse(localStorage.getItem('token'));



            if (this.form.token == undefined) {
                this.$router.push('/login')
            } else {
                this.persontable()
            }

        },
        methods: {
            // persontable() {
            //     axios
            //         .get('http://192.168.4.3/webapp/tee/drugs/person_my.php')
            //         .then(response => (this.rowperson = response.data))
            // },

            addperson: function () {

                if (this.date1 != '' && this.date2 != '' && this.drugstore != '' && this.state != null) {
                    axios.get('http://192.168.4.3/webapp/tee/drugs/refill_report.php', {
                            params: {
                                date1: this.date1,
                                date2: this.date2,
                                drugstore: this.drugstore,
                                type: this.state
                            }
                        })
                        .then(response => {

                                  
                            this.rowservice = response.data
                            if (this.rowservice[0].states == '1') {
                                this.rowservice1 = this.rowservice
                                this.tb_1 = true
                                this.tb_2 = false
                                this.tb_3 = false
                            } else if (this.rowservice[0].states == '2') {
                                this.rowservice2 = this.rowservice
                                this.tb_1 = false
                                this.tb_2 = true
                                this.tb_3 = false
                            } else if (this.rowservice[0].states == '3') {
                                this.rowservice3 = this.rowservice
                                this.tb_1 = false
                                this.tb_2 = false
                                this.tb_3 = true
                                
                            }




                        })
                } else {
                    alert('ระบุข้อมูลยังไม่ครบ')
                     this.tb_1 = false
                     this.tb_2 = false
                     this.tb_3 = false
                }
            },
            back: function () {
                this.$router.push('/about')
            },




        }
    };
</script>