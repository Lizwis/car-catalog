<script lang="ts">
import { defineComponent, ref, onMounted } from 'vue'
import Category from '../components/category.vue'
import CarList from '../components/listCars.vue'
import { ElCheckbox } from 'element-plus'
import Filter from '../api/filter'

export default defineComponent({
  name: 'Home-view',
  components: { Category, CarList },

  setup() {
    const makeFilters = ref<Array<any> | null>(null)
    const selectedMakeFilter = ref<Array<any> | null>(null)
    const refreshCarList = ref(false)

    const getMakeFilter = async () => {
      const response = await Filter.makeFilter()
      makeFilters.value = response.data
      selectedMakeFilter.value = makeFilters.value.map(() => false)
    }

    onMounted(async () => {
      await getMakeFilter()
    })

    const handleMakeFilterChange = (newValue: any) => {
      // Perform some action when the selected make filters change
      selectedMakeFilter.value = newValue
      refreshCarList.value = !refreshCarList.value
    }
    return {
      makeFilters,
      selectedMakeFilter,
      ElCheckbox,
      handleMakeFilterChange,
      refreshCarList
    }
  },
  watch: {
    selectedMakeFilter(newValue: any) {
      this.handleMakeFilterChange(newValue)
    }
  }
})
</script>

<template>
  <div>
    <div class="col-12">
      <category />
    </div>
    <div class="col-12 pt-5">
      <div class="row">
        <div class="col-3 shadow px-4 py-4">
          <div class="col-12 fs-5">Filter By</div>
          <div class="col-12 grey-text pt-4">Car Make</div>
          <div class="col-12" v-for="(m, index) in makeFilters" :key="index">
            <el-checkbox v-model="selectedMakeFilter" :label="m.make" :name="index"></el-checkbox>
          </div>
        </div>
        <div class="col-9 list-cars py-4">
          <car-list :selectedMakeFilter="selectedMakeFilter" :refresh="refreshCarList" />
        </div>
      </div>
    </div>
  </div>
</template>

<style scoped>
.list-cars {
  background-color: #fbfbfb;
}
</style>
