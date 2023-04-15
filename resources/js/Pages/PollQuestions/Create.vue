<template>
  <div>
    <Head title="Create Poll Questions" />
    <h1 class="mb-8 text-3xl font-bold">
      <Link class="text-indigo-400 hover:text-indigo-600" href="/poll_questions">Poll Questions</Link>
      <span class="text-indigo-400 font-medium">/</span> Create
    </h1>
    <div class="max-w-3xl bg-white rounded-md shadow overflow-hidden">
      <form @submit.prevent="store">
        <div class="flex flex-wrap -mb-8 -mr-6 p-8">
          <textarea-input v-model="form.question" :error="form.errors.question" class="pb-8 pr-6 w-full" label="Question"/>
          <select-input v-model="form.poll_id" :error="form.errors.poll_id" class="pb-8 pr-6 w-full" label="Poll">
            <option :value="null" />
            <option v-for="poll in polls" :key="poll.id" :value="poll.id">
              ({{ (poll.is_active) == '1' ? 'Active' : 'Closed'  }}) - {{ poll.title }}
            </option>
          </select-input>
          <text-input v-model="form.is_active" :error="form.errors.is_active" class="pb-8 pr-6 w-full lg:w-1/2" label="Active ?" />
        </div>
        <div class="flex items-center justify-end px-8 py-4 bg-gray-50 border-t border-gray-100">
          <loading-button :loading="form.processing" class="btn-indigo" type="submit">Create Poll Question</loading-button>
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
    TextInput,
    TextareaInput,
    SelectInput,
  },
  layout: Layout,
  remember: 'form',
  props: {
    polls: Object,
  },
  data() {
    return {
      form: this.$inertia.form({
            question: null,
            is_active: null,
            poll_id: null,
      }),
    }
  },
  methods: {
    store() {
      this.form.post('/poll_questions')
    },
  },
}
</script>
