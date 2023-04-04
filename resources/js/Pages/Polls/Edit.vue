<template>
  <div>

    <Head :title="form.title" />
    <h1 class="mb-8 text-3xl font-bold">
      <Link class="text-indigo-400 hover:text-indigo-600" href="/polls">Polls</Link>
      <span class="text-indigo-400 font-medium">/</span>
      {{ form.title }}
    </h1>
    <trashed-message v-if="poll.deleted_at" class="mb-6" @restore="restore"> This poll has been deleted.
    </trashed-message>
    <div class="max-w-3xl bg-white rounded-md shadow overflow-hidden">
      <form @submit.prevent="update">
        <div class="flex flex-wrap -mb-8 -mr-6 p-8">
          <text-input v-model="form.title" :error="form.errors.title" class="pb-8 pr-6 w-full" label="Title" />
          <textarea-input v-model="form.description" :error="form.errors.description" class="pb-8 pr-6 w-full" label="Description"/>
          <text-input v-model="form.start_date" :error="form.errors.start_date" class="pb-8 pr-6 w-full lg:w-1/2"
            label="Start Date" />
          <text-input v-model="form.end_date" :error="form.errors.end_date" class="pb-8 pr-6 w-full lg:w-1/2"
            label="End Date" />
          <!-- <text-input v-model="form.is_active" :error="form.errors.is_active" class="pb-8 pr-6 w-full lg:w-1/2" label="Active ?" /> -->
        </div>
        <div class="flex items-center px-8 py-4 bg-gray-50 border-t border-gray-100">
          <button v-if="!poll.deleted_at" class="text-red-600 hover:underline" tabindex="-1" type="button"
            @click="destroy">Delete Poll</button>
          <loading-button :loading="form.processing" class="btn-indigo ml-auto" type="submit">Update Poll</loading-button>
        </div>
      </form>
    </div>
    <h2 class="mt-12 text-2xl font-bold">Poll Questions</h2>
    <div class="mt-6 bg-white rounded shadow overflow-x-auto">
      <table class="w-full whitespace-nowrap">
        <tr class="text-left font-bold">
          <th class="pb-4 pt-6 px-6">Question</th>
          <th class="pb-4 pt-6 px-6" colspan="2">Active?</th>
        </tr>
        <tr v-for="pollQuestion in poll.pollQuestions" :key="pollQuestion.id"
          class="hover:bg-gray-100 focus-within:bg-gray-100">
          <td class="border-t">
            <Link class="flex items-center px-6 py-4 focus:text-indigo-500"
              :href="`/pollQuestions/${pollQuestion.id}/edit`">
            {{ pollQuestion.question }}
            <icon v-if="pollQuestion.deleted_at" name="trash" class="flex-shrink-0 ml-2 w-3 h-3 fill-gray-400" />
            </Link>
          </td>
          <td class="border-t">
            <Link class="flex items-center px-6 py-4" :href="`/pollQuestions/${pollQuestion.id}/edit`" tabindex="-1">
            {{ (pollQuestion.is_active) == '1' ? 'Active' : 'Disabled' }}
            </Link>
          </td>
          <td class="w-px border-t">
            <Link class="flex items-center px-4" :href="`/pollQuestions/${pollQuestion.id}/edit`" tabindex="-1">
            <icon name="cheveron-right" class="block w-6 h-6 fill-gray-400" />
            </Link>
          </td>
        </tr>
        <tr v-if="poll.pollQuestions.length === 0">
          <td class="px-6 py-4 border-t" colspan="4">No questions found.</td>
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
    poll: Object,
  },
  remember: 'form',
  data() {
    return {
      form: this.$inertia.form({
        title: this.poll.title,
        description: this.poll.description,
        start_date: this.poll.start_date,
        end_date: this.poll.end_date,
        is_active: this.poll.is_active,
      }),
    }
  },
  methods: {
    update() {
      this.form.put(`/polls/${this.poll.id}`)
    },
    destroy() {
      if (confirm('Are you sure you want to delete this poll?')) {
        this.$inertia.delete(`/polls/${this.poll.id}`)
      }
    },
    restore() {
      if (confirm('Are you sure you want to restore this poll?')) {
        this.$inertia.put(`/polls/${this.poll.id}/restore`)
      }
    },
  },
}
</script>
