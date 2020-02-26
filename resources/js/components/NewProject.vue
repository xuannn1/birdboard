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
              class="border p-2 text-xs block w-full rounded-lg"
              :class="form.errors.title ? 'border-red' : 'border-muted-light'"
              autofocus
            />
            <span
              class="text-xs italic text-red"
              v-if="form.errors.title"
              v-text="form.errors.title[0]"
            ></span>
          </div>

          <div class="mb-4">
            <label for="description" class="text-sm block mb-2">Description</label>
            <textarea
              v-model="form.description"
              id="description"
              class="border p-2 text-xs block w-full rounded"
              :class="form.errors.description ? 'border-red' : 'border-muted-light'"
              rows="7"
            ></textarea>
            <span
              class="text-xs italic text-red"
              v-if="form.errors.description"
              v-text="form.errors.description[0]"
            ></span>
          </div>
        </div>
        <div class="flex-1 ml-4">
          <div class="mb-4">
            <label class="text-sm block mb-2">Need Some Tasks?</label>
            <input
              v-for="task in form.tasks"
              :key="task.index"
              v-model="task.body"
              type="text"
              class="border border-muted-light mb-2 p-2 text-xs block w-full rounded"
              placeholder="Task 1"
            />
          </div>

          <button type="button" @click="addTask()">Add New Task Field</button>
        </div>
      </div>

      <footer class="flex justify-end">
        <button type="button" class="btn-white mr-4" @click="cancel()">Cancel</button>
        <button class="btn-blue">Create Project</button>
      </footer>
    </form>
  </modal>
</template>

<script>
import BirdboardForm from "../BirdboardForm";
export default {
  data() {
    return {
      form: new BirdboardForm({
        title: "",
        description: "",
        tasks: [{ body: "" }]
      })
    };
  },

  methods: {
    addTask() {
      this.form.tasks.push({ body: "" });
    },

    cancel() {
      this.$modal.hide("new-project");
      this.form = new BirdboardForm({
        title: "",
        description: "",
        tasks: [{ body: "" }]
      });
    },

    async submit() {
      // task有一个默认值，为了呈现一个input框方便输入
      // 如果用户没有添加过task，则需要将默认值移除掉
      if (!this.form.tasks[0].body) {
        delete this.form.originalData.tasks;
      }

      this.form.submit("/projects").then(res => (location = res.data.message));
    }
  }
};
</script>

<style>
</style>