<template>
  <div class="col-12 px-4 nav py-3 nav">
    <div class="col-12 row">
      <div class="col-lg-4 col-4">
        <div class="row">
          <div class="col-3 mx-2 px-0">
            <el-rate v-model="RateValue" disabled text-color="#ff9900" />
          </div>
          <div class="col-8 text-start mx-0 px-0 pt-2 rate">
            4 out of 5 <span class="grey-text">based on 2500+ reviews</span>
          </div>
        </div>
      </div>
      <div class="col-8 col-lg-8 text-end pt-2">
        <div class="row justify-conten-end">
          <div class="col-lg-8 col-6 text-end px-0 mx-0">
            <el-button class="no-border btn-font-size" :icon="Location">South Africa</el-button>
          </div>

          <div class="col-lg-4 col-6 px-0 mx-0">
            <template v-if="!authStore.user">
              <a class="nav-link">
                <el-button type="primary" plain @click="login">Login</el-button>
              </a>
            </template>
            <template v-else>
              <a class="nav-link"
                ><el-button type="primary" @click="authStore.logout" plain>Logout</el-button>
              </a>
            </template>
          </div>
        </div>
      </div>
      <div class="col-12 text-end pt-2">
        <div class="col-lg-6 col-12">
          <el-button type="primary" @click="catalog">Catalog</el-button>
          <el-button type="primary" @click="autobidCarList">Autobid Car List</el-button>
        </div>
      </div>
    </div>
  </div>
</template>

<script lang="ts">
import { defineComponent, ref } from 'vue'
import { ElButton, ElRate } from 'element-plus'

import { Location, GoodsFilled } from '@element-plus/icons-vue'
import { useRouter } from 'vue-router'
import { useAuthStore } from '../stores/auth'

export default defineComponent({
  name: 'NavBar',
  components: { ElButton, ElRate },

  setup() {
    const RateValue = ref(3.7)
    const router = useRouter()

    const authStore = useAuthStore()

    const login = () => {
      router.push({ path: '/login' })
    }

    const autobidCarList = async () => {
      await router.push({ path: '/autobid/list' })
    }

    const catalog = async () => {
      await router.push({ path: '/' })
    }
    return {
      Location,
      GoodsFilled,
      RateValue,
      autobidCarList,
      catalog,
      authStore,
      login
    }
  }
})
</script>

<style scoped>
.nav {
  background-color: #fff;
  color: #000;
  font-weight: 500;
}

.no-border {
  border: none !important;
  text-decoration: none !important;
  color: #000;
}

.btn-font-size {
  font-size: 15px;
}

.nav {
  position: sticky;
  top: 0;
  z-index: 1;
}
/* 
@media screen and (max-width: 600px) {
  .rate {
    display: none;
  }
} */

@media (max-width: 1100px) {
  .rate {
    display: none !important;
  }
}
</style>
