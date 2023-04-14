<template>
  <div>

    <Head title="Poll Questions" />
    <h1 class="mb-8 text-3xl font-bold">Poll Questions</h1>
    <div class="flex items-center justify-between mb-6">
      <search-filter v-model="form.search" class="mr-4 w-full max-w-md" @reset="reset">
        <label class="block text-gray-700">Trashed:</label>
        <select v-model="form.trashed" class="form-select mt-1 w-full">
          <option :value="null" />
          <option value="with">With Trashed</option>
          <option value="only">Only Trashed</option>
        </select>
      </search-filter>
      <Link class="btn-indigo" href="/poll_questions/create">
      <span>Create</span>
      <span class="hidden md:inline">&nbsp;Poll Questions</span>
      </Link>
    </div>
    <div class="bg-white rounded-md shadow overflow-x-auto">
      <table class="w-full whitespace-nowrap">
        <thead>
          <tr class="text-left font-bold">
            <th class="pb-4 pt-6 px-6">Question</th>
            <th class="pb-4 pt-6 px-6">Poll</th>
            <th class="pb-4 pt-6 px-6" colspan="2">Active?</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="poll_question in poll_questions.data" :key="poll_question.id"
            class="hover:bg-gray-100 focus-within:bg-gray-100">
            <td class="border-t">
              <Link class="flex items-center px-6 py-4 focus:text-indigo-500"
                :href="`/poll_questions/${poll_question.id}/edit`">
              <icon v-if="poll_question.deleted_at" name="trash" class="flex-shrink-0 ml-2 w-3 h-3 mr-1 fill-red-400" />
              {{ poll_question.question }}
              </Link>
            </td>
            <td class="border-t">
              <Link class="flex items-center px-6 py-4" :href="`/poll_questions/${poll_question.id}/edit`" tabindex="-1">
                Poll {{ poll_question.poll.id }} - {{ poll_question.poll.title }}
              </Link>
            </td>
            <td class="border-t">
              <Link class="flex items-center px-6 py-4" :href="`/poll_questions/${poll_question.id}/edit`" tabindex="-1">
              {{ (poll_question.is_active == 1) ? 'Active' : 'Disabled' }}
              </Link>
            </td>
            <td class="w-px border-t">
              <Link class="flex items-center px-4" :href="`/poll_questions/${poll_question.id}/edit`" tabindex="-1">
              <icon name="cheveron-right" class="block w-6 h-6 fill-gray-400" />
              </Link>
            </td>
          </tr>
          <tr v-if="poll_questions.data.length === 0">
            <td class="px-6 py-4 border-t" colspan="4">No poll questions found!</td>
          </tr>
        </tbody>
      </table>
    </div>
    <pagination class="mt-6" :links="poll_questions.links" />
  </div>
</template>

<script>
import { Head, Link } from '@inertiajs/inertia-vue3'
import Icon from '@/Shared/Icon'
import pickBy from 'lodash/pickBy'
import Layout from '@/Shared/Layout'
import throttle from 'lodash/throttle'
import mapValues from 'lodash/mapValues'
import Pagination from '@/Shared/Pagination'
import SearchFilter from '@/Shared/SearchFilter'

export default {
  components: {
    Head,
    Icon,
    Link,
    Pagination,
    SearchFilter,
  },
  layout: Layout,
  props: {
    filters: Object,
    poll_questions: Object,
  },
  data() {
    return {
      form: {
        search: this.filters.search,
        trashed: this.filters.trashed,
      },
    }
  },
  watch: {
    form: {
      deep: true,
      handler: throttle(function () {
        this.$inertia.get('/poll_questions', pickBy(this.form), { preserveState: true })
      }, 150),
    },
  },
  methods: {
    reset() {
      this.form = mapValues(this.form, () => null)
    },
  },
}
</script>
