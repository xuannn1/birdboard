<template>
  <modal
    name="project-create"
    classes="p-8 lg:p-10 bg-card rounded-lg"
    height="auto"
    :adaptive="true"
  >
    <form @submit.prevent="submit">
      <h1 class="font-normal mb-6 text-center text-2xl">Let's Start Something New</h1>
      <div class="lg:flex mb-2">
        <div class="flex-1 lg:mr-4">
          <div class="lg:mb-4 mb-2">
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

          <div class="lg:mb-4 mb-2">
            <label for="description" class="text-sm block mb-2">Description</label>
            <textarea
              v-model="form.description"
              id="description"
              class="border p-2 text-xs block w-full rounded-lg"
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
        <div class="flex-1 lg:ml-4">
          <div class="mb-4">
            <label class="text-sm block mb-2">Need Some Tasks?</label>
            <input
              v-for="task in form.tasks"
              :key="task.index"
              v-model="task.body"
              type="text"
              class="border border-muted-light p-2 mb-2 text-xs block w-full rounded-lg"
              placeholder="Task 1"
            />
          </div>

          <button type="button" class="flex w-full my-4 text-accent" @click="addTask()">
            <div class="border p-2 w-6 h-6 rounded-full inline-flex items-center justify-center">
              <font-awesome-icon :icon="['fas', 'plus']"></font-awesome-icon>
            </div>
            <span class="ml-2">Add New Task Field</span>
          </button>
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
  props: ["user_id"],

  data() {
    return {
      form: new BirdboardForm({
        title: "",
        description: "",
        tasks: [{ body: "", owner_id: this.user_id }]
      })
    };
  },

  methods: {
    addTask() {
      this.form.tasks.push({ body: "", owner_id: this.user_id });
    },

    cancel() {
      this.$modal.hide("project-create");
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

      this.form.post("/projects").then(res => (location = res.data.message));
    }
  }
};
</script>

<style>
</style>