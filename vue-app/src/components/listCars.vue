<template>
  <div class="col-12 px-0 mx-0 justify-content-center">
    <div class="col-12 px-2 px-lg-4 pb-4">
      <div class="row">
        <div class="col-6 text-start grey-text pt-2 mx-0 px-0">{{ carsCount }} Results</div>
        <div class="col-6 text-end mx-0 px-0">
          <span class="grey-text">Sort By </span>

          <el-select v-model="sortValue" class="m-2 mx-0 px-0" placeholder="Select" size="small">
            <el-option
              v-for="item in options"
              :key="item.value"
              :label="item.label"
              :value="item.value"
              @click="getCars"
            />
          </el-select>
        </div>
      </div>
    </div>

    <div class="row">
      <div
        class="col-6 col-lg-4 px-2 py-2 rounded text-center mb-4"
        v-for="(car, key) in cars"
        :key="key"
      >
        <div class="col-12 img text-start" v-if="authStore.user">
          <el-button type="primary" :icon="Edit" plain @click="dialogVisible = true" size="small"
            >$</el-button
          >

          <el-dialog
            :show-close="false"
            v-model="dialogVisible"
            title="Edit Price of Car"
            width="50%"
          >
            <input
              type="text"
              v-model="new_price"
              class="form-control input-height mt-2 font-weight-light"
            />
            <div class="col-12 text-danger" v-if="errorPrice">{{ errorPrice[0] }}</div>

            <template #footer>
              <span class="dialog-footer">
                <el-button @click="Cancel">Cancel</el-button>
                <el-button type="primary" @click="SavePrice(car.id)"> Save </el-button>
              </span>
            </template>
          </el-dialog>
        </div>
        <div class="col-12 img py-4"><img :src="car.image" /></div>
        <div class="col-12 shadow-sm">
          <div class="row px-2">
            <div class="col-6 fs-5 text-start pt-4">{{ car.make }}</div>
            <div class="col-6 text-end pt-4 grey-text">{{ car.year }}</div>
          </div>
          <div class="px-2 col-12 grey-text text-start fs-6 pb-2">{{ car.model }}</div>

          <div class="px-2 col-12 grey-text py-2 text-start text-sm">Features</div>
          <div class="row px-2">
            <div class="col-6 text-start">
              <img src="../assets/gas.png" height="18" /> {{ car.fuel_type }}
            </div>
            <div class="col-6 text-start">
              <img src="../assets/gear.png" height="18" /> {{ car.transmission }}
            </div>
            <div class="col-12 text-start pt-2">
              <img src="../assets/milage.png" height="15" /> {{ car.mileage }} km
            </div>
          </div>
          <div class="row col-12 px-2 py-4 px-0">
            <div class="col-6 text-start price">R {{ car.price }}</div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script lang="ts">
import { defineComponent, onMounted, ref, watch, computed } from 'vue'
import Catalog from '../api/catalog'

import { ElSelect, ElButton, ElDialog } from 'element-plus'
import { useAuthStore } from '../stores/auth'
import { Edit } from '@element-plus/icons-vue'

export default defineComponent({
  name: 'car-list',
  components: { ElSelect, ElButton, ElDialog },
  props: {
    selectedMakeFilter: Array,
    seletedYearFilter: Array,
    selectedCategory: Array
  },
  setup(props) {
    const cars = ref<Array<any> | null>(null)
    const carsCount = ref(0)
    const sortValue = ref('asc')
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
    const authStore = useAuthStore()
    const dialogVisible = ref(false)
    const new_price = ref('')
    const errorPrice = ref('')

    const getCars = async () => {
      cars.value = null
      const response = await Catalog.listCatelog({
        makeFilter: props.selectedMakeFilter,
        sortPrice: sortValue.value,
        yearFilter: props.seletedYearFilter
      })
      cars.value = response.data.cars
      carsCount.value = response.data.count
    }

    const SavePrice = (id: any) => {
      errorPrice.value = ''
      Catalog.updatePrice(id, { price: new_price.value })
        .then(() => {
          dialogVisible.value = false
          new_price.value = ''
          getCars()
        })
        .catch((error: any) => {
          dialogVisible.value = true
          errorPrice.value = error.response.data.errors.price
        })
    }
    const Cancel = () => {
      errorPrice.value = ''
      dialogVisible.value = false
    }

    onMounted(async () => {
      await getCars()
    })

    const selectedCategory = computed(() => props.selectedCategory)
    const selectedMakeFilter = computed(() => props.selectedMakeFilter)
    const seletedYearFilter = computed(() => props.seletedYearFilter)
    const selectedCategoryRef = ref(null)
    const selectedMakeFilterRef = ref(null)
    const selectedYearFilterRef = ref(null)

    watch(
      [selectedCategory, selectedMakeFilter, seletedYearFilter],
      ([newSelectedCategory, newSelectedMakeFilter]) => {
        selectedCategoryRef.value = newSelectedCategory
        ;(selectedMakeFilterRef.value = newSelectedMakeFilter),
          (selectedYearFilterRef.value = seletedYearFilter)
        getCars()
      },
      { deep: true }
    )

    return {
      cars,
      carsCount,
      sortValue,
      options,
      getCars,
      authStore,
      Edit,
      dialogVisible,
      new_price,
      SavePrice,
      errorPrice,
      Cancel
    }
  }
})
</script>

<style scoped></style>
