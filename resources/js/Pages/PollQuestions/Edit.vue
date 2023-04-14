<template>
  <div>
    <Head :title="form.question" />
    <h1 class="mb-8 text-3xl font-bold">
      <Link class="text-indigo-400 hover:text-indigo-600" href="/poll_questions">Poll Questions</Link>
      <span class="text-indigo-400 font-medium">/</span>
      {{ form.name }}
    </h1>
    <trashed-message v-if="poll_question.deleted_at" class="mb-6" @restore="restore"> This poll question has been deleted. </trashed-message>
    <div class="max-w-3xl bg-white rounded-md shadow overflow-hidden">
      <form @submit.prevent="update">
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
        <div class="flex items-center px-8 py-4 bg-gray-50 border-t border-gray-100">
          <button v-if="!poll_question.deleted_at" class="text-red-600 hover:underline" tabindex="-1" type="button" @click="destroy">Delete Poll Question</button>
          <loading-button :loading="form.processing" class="btn-indigo ml-auto" type="submit">Update Poll Question</loading-button>
        </div>
      </form>
    </div>
    <h2 class="mt-12 text-2xl font-bold">Poll Answers</h2>
    <div class="mt-6 bg-white rounded shadow overflow-x-auto">
      <table class="w-full whitespace-nowrap">
        <tr class="text-left font-bold">
          <th class="pb-4 pt-6 px-6">Answer</th>
          <th class="pb-4 pt-6 px-6" colspan="2">Active?</th>
        </tr>
        <tr v-for="poll_answer in poll_question.pollAnswers" :key="poll_answer.id" class="hover:bg-gray-100 focus-within:bg-gray-100">
          <td class="border-t">
            <Link class="flex items-center px-6 py-4 focus:text-indigo-500" :href="`/poll_answers/${poll_answer.id}/edit`">
              <icon v-if="poll_answer.deleted_at" name="trash" class="flex-shrink-0 ml-2 w-3 h-3 fill-gray-400" />
              {{ poll_answer.answer }}              
            </Link>
          </td>
          <td class="border-t">
            <Link class="flex items-center px-6 py-4" :href="`/poll_answers/${poll_answer.id}/edit`" tabindex="-1">
              {{ poll_answer.is_active }}
            </Link>
          </td>
          <td class="w-px border-t">
            <Link class="flex items-center px-4" :href="`/poll_answers/${poll_answer.id}/edit`" tabindex="-1">
              <icon name="cheveron-right" class="block w-6 h-6 fill-gray-400" />
            </Link>
          </td>
        </tr>
        <tr v-if="poll_question.pollAnswers.length === 0">
          <td class="px-6 py-4 border-t" colspan="4">No answers found for this question.</td>
        </tr>
  
      </table>
    </div>
  </div>
</template>

<script>
import { Head, Link } from '@inertiajs/inertia-vue3'
import Icon from '@/Shared/Icon'
import Layout from '@/Shared/Layout'
import TextInput from '@/Shared/TextInput'
import TextareaInput from '@/Shared/TextareaInput'
import SelectInput from '@/Shared/SelectInput'
import LoadingButton from '@/Shared/LoadingButton'
import TrashedMessage from '@/Shared/TrashedMessage'

export default {
  components: {
    Head,
    Icon,
    Link,
    LoadingButton,
    SelectInput,
    TextInput,
    TextareaInput,
    TrashedMessage,
  },
  layout: Layout,
  props: {
    poll_question: Object,
    polls: Object,
  },
  remember: 'form',
  data() {
    return {
      form: this.$inertia.form({
        question: this.poll_question.question,
        poll_id: this.poll_question.poll_id,
        is_active: this.poll_question.is_active,
      }),
    }
  },
  methods: {
    update() {
      this.form.put(`/poll_questions/${this.poll_question.id}`)
    },
    destroy() {
      if (confirm('Are you sure you want to delete this poll question?')) {
        this.$inertia.delete(`/poll_questions/${this.poll_question.id}`)
      }
    },
    restore() {
      if (confirm('Are you sure you want to restore this poll question?')) {
        this.$inertia.put(`/poll_questions/${this.poll_question.id}/restore`)
      }
    },
  },
}
</script>
