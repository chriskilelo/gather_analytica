<template>
  <div>
    <Head title="Create Poll" />
    <h1 class="mb-8 text-3xl font-bold">
      <Link class="text-indigo-400 hover:text-indigo-600" href="/polls">Polls</Link>
      <span class="text-indigo-400 font-medium">/</span> Create
    </h1>
    <div class="max-w-3xl bg-white rounded-md shadow overflow-hidden">
      <form @submit.prevent="store">
        <div class="flex flex-wrap -mb-8 -mr-6 p-8">
          <text-input v-model="form.title" :error="form.errors.title" class="pb-8 pr-6 w-full" label="Title" />
          <textarea-input v-model="form.description" :error="form.errors.description" class="pb-8 pr-6 w-full" label="Description"/>
          <text-input v-model="form.start_date" :error="form.errors.start_date" class="pb-8 pr-6 w-full lg:w-1/2" label="Start Date" />
          <text-input v-model="form.end_date" :error="form.errors.end_date" class="pb-8 pr-6 w-full lg:w-1/2" label="End Date" />
          <text-input v-model="form.is_active" :error="form.errors.is_active" class="pb-8 pr-6 w-full lg:w-1/2" label="Active?" />
        </div>
        <div class="flex items-center justify-end px-8 py-4 bg-gray-50 border-t border-gray-100">
          <loading-button :loading="form.processing" class="btn-indigo" type="submit">Create Poll</loading-button>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
import { Head, Link } from '@inertiajs/inertia-vue3'
import Layout from '@/Shared/Layout'
import TextInput from '@/Shared/TextInput'
import TextareaInput from '@/Shared/TextareaInput'
import SelectInput from '@/Shared/SelectInput'
import LoadingButton from '@/Shared/LoadingButton'

export default {
  components: {
    Head,
    Link,
    LoadingButton,
    SelectInput,
    TextInput,
    TextareaInput,
  },
  layout: Layout,
  remember: 'form',
  data() {
    return {
      form: this.$inertia.form({
        title: null,
        description: null,
        start_date: null,
        end_date: null,
        is_active: null,
      }),
    }
  },
  methods: {
    store() {
      this.form.post('/polls')
    },
  },
}
</script>
