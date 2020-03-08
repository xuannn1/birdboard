<template>
  <modal name="project-edit" classes="p-8 bg-card rounded-lg" height="auto" :adaptive="true">
    <form @submit.prevent="submit">
      <h1 class="font-normal mb-6 text-center text-2xl">Edit Your Project</h1>
      <div class="flex flex-col mb-2">
        <div class="lg:mb-4 mb-2">
          <label for="title" class="block mb-2">Title:</label>
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
          <label for="description" class="block mb-2">Description:</label>
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

      <footer class="flex justify-end">
        <button type="button" class="btn-white mr-4" @click="cancel()">Cancel</button>
        <button class="btn-blue">Update Project</button>
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
        description: ""
      })
    };
  },

  methods: {
    cancel() {
      this.$modal.hide("project-edit");
      this.form = new BirdboardForm({
        title: "",
        description: ""
      });
    },

    async submit() {
      this.form.patch("/projects/13").then(res => {
        this.$modal.hide("project-edit");
        window.location.reload();
      });
    }
  }
};
</script>

<style>
</style>