<template>
  <div>
    <!-- task列表 -->
    <task
      v-for="task in tasks"
      :key="task.id"
      :body="task.body"
      :owner_id="task.owner_id"
      :completed="task.completed"
      :path="path+'/tasks/'+task.id"
    ></task>

    <!-- 创建task -->
    <task-create :path="path+'/tasks'" @added="addTask"></task-create>
  </div>
</template>

<script>
Vue.component("task", require("./Task.vue").default);
Vue.component("taskCreate", require("./TaskCreate.vue").default);
export default {
  props: ["path"],

  data() {
    return {
      tasks: []
    };
  },

  methods: {
    addTask(val) {
      this.getTasks();
    },

    getTasks() {
      let curPath = this.path + "/tasks";
      axios.get(curPath).then(res => (this.tasks = res.data));
    }
  },

  created() {
    this.getTasks();
  }
};
</script>

<style>
</style>