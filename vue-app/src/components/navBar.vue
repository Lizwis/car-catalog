<template>
  <div class="col-12 px-4 nav py-3">
    <div class="col-12 d-flex">
      <div class="col-4">
        <div class="row">
          <div class="col-3 mx-2 px-0">
            <el-rate v-model="RateValue" disabled text-color="#ff9900" />
          </div>
          <div class="col-8 text-start mx-0 px-0 pt-2">
            4 out of 5 <span class="grey-text">based on 2500+ reviews</span>
          </div>
        </div>
      </div>
      <div class="col-8 text-end pt-2">
        <div class="d-flex justify-conten-end">
          <div class="col-8 text-end">
            <el-button class="no-border btn-font-size" :icon="Location">South Africa</el-button>
          </div>
          <div class="col-2">
            <el-button class="no-border fs-5" :icon="GoodsFilled"></el-button>
          </div>
          <div class="col-2">
            <el-button class="no-border main-color btn-font-size">Login</el-button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script lang="ts">
import { defineComponent, ref } from 'vue'
import { ElButton, ElRate } from 'element-plus'

import { Location, GoodsFilled } from '@element-plus/icons-vue'

export default defineComponent({
  name: 'NavBar',
  components: { ElButton, ElRate },

  setup() {
    const RateValue = ref(3.7)
    return {
      Location,
      GoodsFilled,
      RateValue
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
</style>
