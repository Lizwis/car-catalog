<template>
  <div class="col-12 pt-3">
    <div class="row mx-0">
      <div class="col-1 px-0 mx-0 pt-2">
        <el-button class="homeButton px-0" :icon="ElemeFilled"></el-button>
      </div>
      <div class="col-11 mx-0 px-0">
        <div class="d-flex justify-content-end">
          <div
            class="category-wrapper mx-1 px-2 py-2 rounded text-center"
            v-for="(category, key) in categories"
            :key="key"
          >
            <span>
              <img :src="'src/assets/' + category.name + '.svg'" />
            </span>
            <span class="px-2"> {{ category.name }} </span>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script lang="ts">
import { defineComponent, onMounted, ref } from 'vue'
import Catalog from '../api/catalog'
import { ElButton } from 'element-plus'

import { ElemeFilled } from '@element-plus/icons-vue'

export default defineComponent({
  name: 'NavBar',
  components: { ElButton },

  setup() {
    const categories = ref<Array<any> | null>(null)

    const getCategories = async () => {
      const response = await Catalog.listCategories()
      categories.value = response.data
    }

    onMounted(async () => {
      await getCategories()
    })
    return {
      categories,
      ElemeFilled
    }
  }
})
</script>

<style scoped>
.no-border {
  border: none !important;
  text-decoration: none !important;
  color: #000;
}

.btn-font-size {
  font-size: 15px;
}
.category-wrapper {
  background-color: #f2f2f2;
  font-weight: 600;
  width: 200px;
  font-size: 15px;
  cursor: pointer;
}
.homeButton {
  border: none;
  color: #409eff;
  font-size: 50px;
}
</style>
