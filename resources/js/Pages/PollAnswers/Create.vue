<template>
  <div>
    <Head title="Create Poll Answer" />
    <h1 class="mb-8 text-3xl font-bold">
      <Link class="text-indigo-400 hover:text-indigo-600" href="/poll_answers">Poll Answers</Link>
      <span class="text-indigo-400 font-medium">/</span> Create
    </h1>
    <div class="max-w-3xl bg-white rounded-md shadow overflow-hidden">
      <form @submit.prevent="store">
        <div class="flex flex-wrap -mb-8 -mr-6 p-8">
          <select-input v-model="form.poll_question_id" :error="form.errors.poll_question_id" class="pb-8 pr-6 w-full" label="Question">
            <option :value="null" />
            <option v-for="poll_question in poll_questions" :key="poll_question.id" :value="poll_question.id">Poll {{ poll_question.poll_id }} - {{ poll_question.question }}</option>
          </select-input>
          <textarea-input v-model="form.answer" :error="form.errors.answer" class="pb-8 pr-6 w-full" label="Answer"/>
          <text-input v-model="form.is_active" :error="form.errors.is_active" class="pb-8 pr-6 w-full lg:w-1/2" label="Active?" />
        </div>
        <div class="flex items-center justify-end px-8 py-4 bg-gray-50 border-t border-gray-100">
          <loading-button :loading="form.processing" class="btn-indigo" type="submit">Create Poll Answer</loading-button>
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
  props: {
    poll_questions: Array,
  },
  remember: 'form',
  data() {
    return {
      form: this.$inertia.form({
        poll_question_id: null,
        answer: '',
        is_active: '',
      }),
    }
  },
  methods: {
    store() {
      this.form.post('/poll_answers')
    },
  },
}
</script>
