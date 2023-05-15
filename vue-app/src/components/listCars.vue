<template>
  <div class="col-12 row px-0 mx-0 justify-content-center">
    <div class="col-12 px-4 pb-4">
      <div class="row">
        <div class="col-6 text-start grey-text pt-3">{{ carsCount }} Results</div>
        <div class="col-6 text-end">
          <span class="grey-text">Sort By</span>

          <el-select v-model="sortValue" class="m-2" placeholder="Select" size="large">
            <el-option
              v-for="item in options"
              :key="item.value"
              :label="item.label"
              :value="item.value"
            />
          </el-select>
        </div>
      </div>
    </div>
    <div
      class="col-4 car-wrapper px-2 py-2 rounded text-center"
      v-for="(car, key) in cars"
      :key="key"
    >
      <div class="col-12"><img :src="car.image" /></div>
      <span class="px-2">{{ car.make }}</span>
    </div>
  </div>
</template>
<script lang="ts">
import { defineComponent, onMounted, ref, watch } from 'vue'
import Catalog from '../api/catalog'

import { ElSelect } from 'element-plus'

export default defineComponent({
  name: 'car-list',
  components: { ElSelect },
  props: {
    selectedMakeFilter: Array
  },
  setup(props) {
    const cars = ref<Array<any> | null>(null)
    const carsCount = ref(0)
    const sortValue = ref('Price ( Low to High )')
    const options = [
      {
        value: 'desc',
        label: 'Price ( High to Low )'
      },
      {
        value: 'asc',
        label: 'Price ( Low to High )'
      }
    ]
    const getCars = async () => {
      const response = await Catalog.listCatelog()
      cars.value = response.data.cars
      carsCount.value = response.data.count
    }

    onMounted(async () => {
      await getCars()
    })

    watch(() => props.selectedMakeFilter, getCars)

    return {
      cars,
      carsCount,
      sortValue,
      options
    }
  }
})
</script>

<style scoped></style>
