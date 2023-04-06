<template>
  <div>
    <Head :title="`${form.first_name} ${form.last_name}`" />
    <h1 class="mb-8 text-3xl font-bold">
      <Link class="text-indigo-400 hover:text-indigo-600" href="/poll_answers">Poll Answers</Link>
      <span class="text-indigo-400 font-medium">/</span>
      {{ form.answer }}
    </h1>
    <trashed-message v-if="poll_answer.deleted_at" class="mb-6" @restore="restore"> This answer has been deleted. </trashed-message>
    <div class="max-w-3xl bg-white rounded-md shadow overflow-hidden">
      <form @submit.prevent="update">
        <div class="flex flex-wrap -mb-8 -mr-6 p-8">
          <select-input v-model="form.poll_question_id" :error="form.errors.poll_question_id" class="pb-8 pr-6 w-full" label="Question">
            <option :value="null" />
            <option v-for="poll_question in poll_questions" :key="poll_question.id" :value="poll_question.id">Poll {{ poll_question.poll_id }} - {{ poll_question.question }}</option>
          </select-input>
          <textarea-input v-model="form.answer" :error="form.errors.answer" class="pb-8 pr-6 w-full" label="Answer"/>
          <text-input v-model="form.is_active" :error="form.errors.is_active" class="pb-8 pr-6 w-full lg:w-1/2" label="Active?" />
        </div>
        <div class="flex items-center px-8 py-4 bg-gray-50 border-t border-gray-100">
          <button v-if="!poll_answer.deleted_at" class="text-red-600 hover:underline" tabindex="-1" type="button" @click="destroy">Delete Answer</button>
          <loading-button :loading="form.processing" class="btn-indigo ml-auto" type="submit">Update Answer</loading-button>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
import { Head, Link } from '@inertiajs/inertia-vue3'
import Layout from '@/Shared/Layout'
import TextInput from '@/Shared/TextInput'
import TextareaInput from '@/Shared/TextInput'
import SelectInput from '@/Shared/SelectInput'
import LoadingButton from '@/Shared/LoadingButton'
import TrashedMessage from '@/Shared/TrashedMessage'

export default {
  components: {
    Head,
    Link,
    LoadingButton,
    SelectInput,
    TextInput,
    TextareaInput,
    TrashedMessage,
  },
  layout: Layout,
  props: {
    poll_answer: Object,
    poll_questions: Array,
  },
  remember: 'form',
  data() {
    return {
      form: this.$inertia.form({
        answer: this.poll_answer.answer,
        account_id: 1,
        is_active: this.poll_answer.is_active,
        poll_question_id: this.poll_answer.poll_question_id,
      }),
    }
  },
  methods: {
    update() {
      this.form.put(`/poll_answers/${this.poll_answer.id}`)
    },
    destroy() {
      if (confirm('Are you sure you want to delete this answer?')) {
        this.$inertia.delete(`/poll_answers/${this.poll_answer.id}`)
      }
    },
    restore() {
      if (confirm('Are you sure you want to restore this answer?')) {
        this.$inertia.put(`/poll_answers/${this.poll_answer.id}/restore`)
      }
    },
  },
}
</script>
