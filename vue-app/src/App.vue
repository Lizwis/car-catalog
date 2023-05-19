<script setup lang="ts">
import { RouterView } from 'vue-router'

import navBar from './components/navBar.vue'
</script>

<template>
  <navBar />
  <div class="col-12 px-4">
    <RouterView />
  </div>
</template>

<style>
.grey-text {
  color: #b9b7b8;
}
.main-color {
  color: #409eff !important;
}
.grey-text-light {
  color: #d6d3d3;
}
/* html,
body {
  margin: 0;
  height: 100%;
  overflow: hidden;
} */

.img {
  background-color: #f2f2f2;
}

.price {
  font-weight: 600;
}
</style>
