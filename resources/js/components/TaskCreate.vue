<template>
  <div class="card mb-4">
    <form @submit.prevent="submit" method="POST">
      <input
        placeholder="Begin adding tasks..."
        class="bg-card text-default w-full p-2 rounded-lg"
        name="body"
        ref="taskCreate"
        v-model="form.body"
      />
    </form>
  </div>
</template>

<script>
import BirdboardForm from "../BirdboardForm";
export default {
  props: ["path"],

  data() {
    return {
      form: new BirdboardForm({
        body: "",
        completed: false
      })
    };
  },

  methods: {
    submit() {
      this.form.post(this.path).then(res => {
        this.$refs.taskCreate.blur();
        this.$emit("added", res.data);
      });
      this.form = new BirdboardForm({
        body: "",
        completed: false
      });
    }
  }
};
</script>

<style>
</style>