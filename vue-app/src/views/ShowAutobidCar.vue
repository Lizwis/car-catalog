<template>
  <div class="container">
    <div class="col-12 px-4 py-3">
      <div class="col-12"><el-button @click="autobidCarList">Back</el-button></div>

      <div class="col-12" v-if="car">
        <div class="d-flex justify-content-center">
          <div class="col-12 col-lg-8 px-2 py-2 rounded text-center mb-4 shadow-sm">
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
              <div class="col-12 text-start pt-2">Mileage : {{ car.mileage }} km</div>
              <div class="col-12 text-start pt-2">Color : {{ car.color }}</div>
              <div class="col-12 text-start pt-2">Interior Color : {{ car.inColor }}</div>

              <div class="col-12 text-start pt-2">Engine : {{ car.engine }}</div>
              <div class="col-12 text-start pt-2">{{ car.extras }}</div>
            </div>
            <div class="row col-12 px-2 py-4 px-0">
              <div class="col-6 text-start price">Service history : {{ car.service_history }}</div>
            </div>
            <div class="row col-12 px-2 py-4 px-0">
              <div class="col-6 text-start price">R {{ car.price }}</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script lang="ts">
import { defineComponent, ref, onMounted } from 'vue'
import { ElCarousel, ElCarouselItem, ElButton } from 'element-plus'
import { useRouter } from 'vue-router'

export default defineComponent({
  name: 'Autobid-car-show',
  components: { ElCarousel, ElCarouselItem, ElButton },

  setup() {
    const car = ref<Array<any> | null>(null)
    const router = useRouter()

    onMounted(async () => {
      const storedCar = localStorage.getItem('selectedCar')
      car.value = JSON.parse(storedCar || '[]')

      console.log(car.value)
    })

    const autobidCarList = async () => {
      await router.push({ path: `/autobid/list` })
    }

    return { car, autobidCarList }
  }
})
</script>

<style scoped></style>
