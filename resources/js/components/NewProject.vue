<template>
  <modal name="new-project" classes="p-10 bg-card rounded-lg" height="auto">
    <form @submit.prevent="submit">
      <h1 class="font-normal mb-16 text-center text-2xl">Let's Start Something New</h1>
      <div class="flex">
        <div class="flex-1 mr-4">
          <div class="mb-4">
            <label for="title" class="text-sm block mb-2">Title</label>
            <input
              v-model="form.title"
              type="text"
              id="title"
              class="border p-2 text-xs block w-full rounded"
              :class="errors.title ? 'border-red' : 'border-muted-light'"
            />
            <span class="text-xs italic text-red" v-if="errors.title" v-text="errors.title[0]"></span>
          </div>

          <div class="mb-4">
            <label for="description" class="text-sm block mb-2">Description</label>
            <textarea
              v-model="form.description"
              id="description"
              class="border p-2 text-xs block w-full rounded"
              :class="errors.description ? 'border-red' : 'border-muted-light'"
              rows="7"
            ></textarea>
            <span
              class="text-xs italic text-red"
              v-if="errors.description"
              v-text="errors.description[0]"
            ></span>
          </div>
        </div>
        <div class="flex-1 ml-4">
          <div class="mb-4">
            <label class="text-sm block mb-2">Need Some Tasks?</label>
            <input
              v-for="task in form.tasks"
              :key="task.index"
              v-model="task.value"
              type="text"
              class="border border-muted-light mb-2 p-2 text-xs block w-full rounded"
              placeholder="Task 1"
            />
          </div>

          <button @click="addTask()">Add New Task Field</button>
        </div>
      </div>

      <footer class="flex justify-end">
        <button class="btn-white mr-4" @click="$modal.hide('new-project')">Cancel</button>
        <button class="btn-blue">Create Project</button>
      </footer>
    </form>
  </modal>
</template>

<script>
export default {
  data() {
    return {
      form: {
        title: "",
        description: "",
        tasks: [{ value: "" }]
      },
      errors: {}
    };
  },

  methods: {
    addTask() {
      this.form.tasks.push({ value: "" });
    },

    async submit() {
      try {
        let response = await axios.post("/projects", this.form);
        // 重定向到详情页
        location = response.data.message;
      } catch (error) {
        this.errors = error.response.data.errors;
      }
    }
  }
};
</script>

<style>
</style>