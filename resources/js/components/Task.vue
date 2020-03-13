<template>
  <div class="card mb-4">
    <form @submit.prevent="submit">
      <div class="flex items-center">
        <input
          type="text"
          name="body"
          ref="taskBody"
          v-model="form.body"
          class="bg-card w-full p-2 rounded-lg"
          :class="form.completed ? 'text-grey line-through' : ''"
        />
        <input
          name="completed"
          type="checkbox"
          class="ml-4"
          v-model="form.completed"
          @click="form.completed = !form.completed; submit();"
        />
      </div>
    </form>
  </div>
</template>

<script>
import BirdboardForm from "../BirdboardForm";
export default {
  props: ["body", "owner_id", "path", "completed"],

  data() {
    return {
      form: new BirdboardForm({
        body: this.body,
        completed: this.completed
      })
    };
  },

  methods: {
    async submit() {
      this.form.patch(this.path).then(res => {
        this.$refs.taskBody.blur();
      });
    }
  }
};
</script>

<style>
</style>