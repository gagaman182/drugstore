<template>
  <div>
  
  
  
  
  
    <b-container class="bv-example-row">
  
  
  
      <b-row class="justify-content-md-center">
  
  
  
        <b-col col lg="2"></b-col>
  
  
  
        <b-col cols="12" md="auto">
  
          <b-form>
  
            <div>
  
  
  
              <h3>ระบบดูและผู้ป่วยเรื้อรังรับยาต่อเนื่อง
  
                <b-badge> ร้านยา</b-badge>
  
              </h3>
  
  
  
            </div>
  
  
  
            <b-form-group label="ยูสเซอร์:">
  
  
  
  
  
              <b-form-input v-model="form.username" required placeholder="User"></b-form-input>
  
  
  
  
  
            </b-form-group>
  
  
  
  
  
            <b-form-group label="รหัสผ่าน:">
  
  
  
              <b-form-input v-model="form.password" required placeholder="Pass" type="password"></b-form-input>
  
  
  
            </b-form-group>
  
  
  
  
  
            <b-button type="submit" variant="primary" class="mb-2 mr-sm-2 mb-sm-0" @click='login()'>เข้าสู่ระบบ</b-button>
  
  
  
            <b-button type="reset" variant="danger" class="mb-2 mr-sm-2 mb-sm-0">รีเซ็ต</b-button>
  
  
  
          </b-form>
  
        </b-col>
  
        <b-col col lg="2"></b-col>
  
      </b-row>
  
  
  
      <b-row>
  
        <b-col></b-col>
  
        <b-col cols="12" md="auto"></b-col>
  
        <b-col col lg="2"></b-col>
  
      </b-row>
  
    </b-container>
  
  
  
  
  
  
  
  
  
  
  
  
    <!-- <b-card class="mt-3" header="Form Data Result">
  
  
  
          <pre class="m-0">{{ form }}</pre>
  
  
  
        </b-card>  -->
  
  
  
  
  
  
  
  
  
  
  
  </div>
</template>

<script>
  import axios from 'axios'
  
  export default {
  
  
  
    name: 'maintable',
  
  
  
    data() {
  
  
  
      return {
  
  
  
        form: {
  
  
  
          username: '',
  
  
  
          password: '',
  
  
  
  
  
          token: '',
  
  
  
        },

        loginok:''
  
  
  
  
  
  
  
      }
  
  
  
    },
  
  
  
  
  
    methods: {
  
      login() {
  
  
  
  
  
        axios.get('http://192.168.4.3/webapp/tee/drugs//logincheck.php', {
  
  
  
            params: {
  
  
  
              username: this.form.username,
  
  
  
              password: this.form.password
  
  
  
            }
  
  
  
          })
  
  
  
          .then(response => {
  
  
            
  
  
  
  
            this.form.tokens = response.data
  
  
  
            localStorage.setItem('token', JSON.stringify(this.form.tokens));
  
  
  
            this.form.token = JSON.parse(localStorage.getItem('token'));
  
  

  
  
            if (this.form.token[0].state == 'no') {
  
  
   this.popuplogin()
              // this.$router.push('/login')
  
            } else {
  
              this.$router.push('/about')
  
            }
  
  
  
  
  
  
  
  
  
          })
  
  
  
      },
  
      popuplogin(append = false) {
  
        this.toastCount++
  
  
  
          this.$bvToast.toast(this.form.tokens[0].message, {
  
            title: 'แจ้งเตือนการเพิ่มข้อมูลบุุคคล',
  
            autoHideDelay: 5000,
  
            appendToast: append
  
          })
  
      },
  
  
  
  
  
    }
  
  
  
  };
</script>
