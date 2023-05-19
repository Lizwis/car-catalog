<script lang="ts">
import { defineComponent, ref, onMounted, watch } from 'vue'
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
    const selectedCategory = ref(null)

    const yearFilters = ref<Array<any> | null>(null)
    const seletedYearFilter = ref<Array<any> | null>(null)

    const getMakeFilter = async () => {
      const response = await Filter.makeFilter()
      makeFilters.value = response.data
      selectedMakeFilter.value = makeFilters.value.map(() => false)
    }

    const getYearFilter = async () => {
      const response = await Filter.yearFilter()
      yearFilters.value = response.data
      seletedYearFilter.value = yearFilters.value.map(() => false)
    }

    onMounted(async () => {
      await getMakeFilter()
      await getYearFilter()
    })

    const handleYearFilterChange = (newValue: any) => {
      seletedYearFilter.value = newValue
      refreshCarList.value = !refreshCarList.value
    }

    watch(seletedYearFilter, (newValue) => {
      handleYearFilterChange(newValue)
    })

    const handleMakeFilterChange = (newValue: any) => {
      selectedMakeFilter.value = newValue
      refreshCarList.value = !refreshCarList.value
    }

    watch(selectedMakeFilter, (newValue) => {
      handleMakeFilterChange(newValue)
    })

    const handleCategorySelected = (category) => {
      selectedCategory.value = category
    }

    watch(selectedCategory, () => {
      refreshCarList.value = !refreshCarList.value
      console.log('refreshCarList value:', refreshCarList.value)
    })

    return {
      makeFilters,
      selectedMakeFilter,
      ElCheckbox,
      handleMakeFilterChange,
      refreshCarList,
      handleCategorySelected,
      getYearFilter,
      seletedYearFilter,
      yearFilters
    }
  }
})
</script>

<template>
  <div>
    <div class="col-12 category">
      <category @categorySelected="handleCategorySelected" :selectedCategory="selectedCategory" />
    </div>
    <div class="col-12">
      <div class="row">
        <div class="col-12 col-md-3 col-lg-3 shadow-sm px-4 py-4 filter">
          <div class="col-12 fs-5">Filter By</div>
          <div class="col-12 grey-text pt-4">Car Make</div>
          <div class="row">
            <div class="col-2 col-lg-12" v-for="(m, index) in makeFilters" :key="index">
              <el-checkbox v-model="selectedMakeFilter" :label="m.make" :name="index"></el-checkbox>
            </div>
          </div>

          <div class="col-12 grey-text pt-4">Year</div>
          <div class="row">
            <div class="col-2 col-lg-12" v-for="(m, index) in yearFilters" :key="index">
              <el-checkbox v-model="seletedYearFilter" :label="m.year" :name="index"></el-checkbox>
            </div>
          </div>
        </div>
        <div class="col-12 col-lg-9 list-cars py-4 shadow-sm">
          <car-list
            :selectedMakeFilter="selectedMakeFilter"
            :seletedYearFilter="seletedYearFilter"
            :selectedCategory="selectedCategory"
            :refresh="refreshCarList"
          />
        </div>
      </div>
    </div>
  </div>
</template>

<style scoped>
.list-cars {
  background-color: #fbfbfb;
}

.category {
  position: sticky;
  top: 10;
  z-index: 2;
}

@media screen and (max-width: 600px) {
  .category {
    display: none;
  }
}
</style>
