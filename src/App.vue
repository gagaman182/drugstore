<template>
  <div id="app">
 <div>
  <b-navbar toggleable="lg" type="dark" variant="info" class="routing" v-if="this.$route.path !== '/login'">
   <h3> <b-navbar-brand ><router-link to="/about" :class="$style.myLink" >หน้าหลัก</router-link></b-navbar-brand></h3>

    <b-navbar-toggle target="nav-collapse"></b-navbar-toggle>

    <b-collapse id="nav-collapse" is-nav>
      <b-navbar-nav>
        <h6><b-nav-item ><router-link to="/" :class="$style.myLink" :active-class="$style.active">เพิ่มข้อมูล</router-link></b-nav-item></h6>
        <h6><b-nav-item ><router-link to="/report" :class="$style.myLink" :active-class="$style.active">รายงาน</router-link></b-nav-item></h6>
        <!-- <b-nav-item href="#" disabled>Disabled</b-nav-item> -->
      </b-navbar-nav>

   
      <b-navbar-nav class="ml-auto">
       
        <b-nav-item-dropdown right>
          <!-- Using 'button-content' slot -->
          <template v-slot:button-content>
           <b-icon icon="person-fill"></b-icon> <em>{{form.token[0].fullname}}</em>
          </template>
         
          <b-dropdown-item @click='signout()'>ออกจากระบบ</b-dropdown-item>
        </b-nav-item-dropdown>
      </b-navbar-nav>
    </b-collapse>
  </b-navbar>
</div>
    <b-navbar variant="faded" type="light" >


      <div style="font-size: 5rem;" class="routing" v-if="this.$route.path !== '/login'" >
        <b-icon icon="house" class="rounded bg-primary p-1" variant="light"></b-icon>

      </div>
      <div style="font-size: 1.5rem;" class="routing" v-if="this.$route.path !== '/login'">

        ระบบดูและผู้ป่วยเรื้อรังรับยาต่อเนื่องร้านยา
      </div>
   </b-navbar>
    <router-view></router-view>
<!-- <div >
    <b-nav class="routing" v-if="this.$route.path !== '/login'" >
      <b-nav-item active>
        <h4>
          <router-link to="/about">หน้าหลัก</router-link>
        </h4>
      </b-nav-item>
      <b-nav-item>
        <h4>
          <router-link to="/">เพิ่มข้อมูล</router-link>
        </h4>
      </b-nav-item>

      <b-nav-item>
        <h4>
          <router-link to="/report">รายงาน</router-link>
        </h4>
      </b-nav-item>
    </b-nav>
    <router-view></router-view>
   </div>  -->
  </div>
</template>

<script>

  
  export default {
  
  
    data() {
  
      return {
  
        form: {

          token: '',
  
        },
        user:''

      }
  
  
  
    },
  
  
  
    methods: {
  
     signout: function () {
      
       localStorage.removeItem('token');
       localStorage.clear();
       this.$router.push('/login')
     }
  
    },
     mounted() {
        this.form.token = JSON.parse(localStorage.getItem('token'));
      
        this.user = this.form.token[0].fullname
      
        },
  
  
  
  };
</script>
<style module>
.myLink {
	color: #ffffff;
}

active {
	color: #ffff1a;
}

</style>

   