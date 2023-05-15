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
</style>
