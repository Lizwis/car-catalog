<template>
  <div>
    <div class="row justify-content-center pt-0 mt-2">
      <div class="row justify-content-center pt-0 mt-2">
        <div class="col-lg-4 col-12 border shadow-sm py-4 px-2">
          <div class="col-12 py-4 px-0 mx-0">
            <el-alert
              title="Please resolve errors"
              type="error"
              show-icon
              :closable="false"
              v-show="errorAlert"
            />
          </div>
          <div class="col-12 text-center py-4 bg-login">
            <router-link to="/">
              <el-button class="homeButton px-0" :icon="ElemeFilled"></el-button>
            </router-link>
            <h6 class="font-weight-light" style="font-size: 15px">Sign in to your account.</h6>
          </div>

          <form @submit.prevent="submit()">
            <div class="col-md-12 font-weight-bold px-4" style="font-size: 14px">
              <h6 class="label">Email</h6>
              <el-input v-model="form.email" :prefix-icon="Message" />

              <span class="text-danger font-weight-light" v-if="errors.email">{{
                errors.email[0]
              }}</span>
            </div>

            <div class="col-md-12 font-weight-bold pt-3 px-4" style="font-size: 14px">
              <h6 class="label">Password</h6>

              <el-input v-model="form.password" type="password" :prefix-icon="Lock" />

              <span class="text-danger font-weight-light" v-if="errors.password">{{
                errors.password[0]
              }}</span>
            </div>

            <div class="col-12 px-4 py-4 text-center">
              <el-button type="primary" @click="submit">Login</el-button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script lang="ts">
import { defineComponent, ref } from 'vue'
import User from '../api/auth'
import { useRouter } from 'vue-router'
import { ElInput, ElButton, ElAlert } from 'element-plus'
import { Message, Lock } from '@element-plus/icons-vue'
import { useAuthStore } from '../stores/auth'
import { ElemeFilled } from '@element-plus/icons-vue'

export default defineComponent({
  name: 'Login-user',
  components: { ElInput, ElButton, ElAlert, ElemeFilled },
  setup() {
    const form = ref({
      email: '',
      password: ''
    })

    const errors = ref<string[]>([])
    const router = useRouter()
    const authStore = useAuthStore()

    const errorAlert = ref(false)

    const submit = async () => {
      try {
        await User.crsfToken()
        await User.login(form.value)
        errorAlert.value = false
        authStore.getUser()
        router.push({ path: '/' })
      } catch (error: any) {
        errors.value = error.response.data.errors
        errorAlert.value = true
      }
    }

    return {
      form,
      submit,
      errors,
      router,
      errorAlert,
      Message,
      Lock,
      ElemeFilled,
      authStore
    }
  }
})
</script>

<style></style>
