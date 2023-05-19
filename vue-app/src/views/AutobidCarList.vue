<template>
  <div class="container">
    <div class="col-12 px-4 py-3">
      <div class="col-12" v-if="vehicleList">
        <div class="row">
          <div
            class="col-12 col-lg-4 px-2 py-2 rounded text-center mb-4 shadow-sm"
            v-for="(car, key) in vehicleList"
            :key="key"
          >
            <el-carousel :interval="500000" arrow="always">
              <el-carousel-item v-for="item in car.photos" :key="item">
                <div class="col-12 img py-4"><img :src="item" height="250" /></div>
              </el-carousel-item>
            </el-carousel>
            <div class="row px-2">
              <div class="col-6 fs-5 text-start pt-4">{{ car.make }}</div>
              <div class="col-6 text-end pt-4 grey-text">{{ car.year }}</div>
            </div>
            <div class="px-2 col-12 grey-text text-start fs-6 pb-2">{{ car.model }}</div>
            <div class="px-2 col-12 grey-text py-2 text-start text-sm">Features</div>
            <div class="row px-2">
              <div class="col-12 text-start pt-2">
                <img src="../assets/milage.png" height="15" /> {{ car.mileage }} km
              </div>
            </div>
            <div class="row col-12 px-2 py-4 px-0">
              <div class="col-6 text-start price">R {{ car.price }}</div>
              <div class="col-6 text-end px-0">
                <el-button class="mx-0 mx-0" type="primary" @click="viewCar(car)">
                  View Car</el-button
                >
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-12 text-center" v-else>
        <img src="../assets/loading-gif2.gif" height="" />
      </div>
    </div>
  </div>
</template>

<script lang="ts">
import { defineComponent, ref, onMounted } from 'vue'
import vehicles from '../api/soap'
import { ElCarousel, ElCarouselItem } from 'element-plus'
import { useRouter } from 'vue-router'

export default defineComponent({
  name: 'Autobid-car-list',
  components: { ElCarousel, ElCarouselItem },

  setup() {
    const vehicleList = ref<Array<any> | null>(null)

    const getVehicles = async () => {
      const response = await vehicles.listcars()
      vehicleList.value = response.data
    }

    const router = useRouter()

    const viewCar = async (car: Array<any>) => {
      const arrayString = JSON.stringify(car)
      localStorage.setItem('selectedCar', arrayString)

      await router.push({ path: `/autobid/show/vehicle` })
    }

    onMounted(async () => {
      await getVehicles()
    })

    return {
      vehicleList,
      viewCar
    }
  }
})
</script>

<style scoped></style>
