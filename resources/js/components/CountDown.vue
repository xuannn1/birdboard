<template>
  <div>
    <div v-if="finished" v-text="finishText"></div>

    <div v-else class="text-sm">
      <span>{{ remaining.days }} Days</span>
      <span>{{ remaining.hours }} Hours</span>
      <span>{{ remaining.minutes }} Minutes</span>
      <span>{{ remaining.seconds }} Seconds</span>
    </div>
  </div>
</template>

<script>
import moment from "moment";

export default {
  props: {
    until: String,
    finishText: String
  },

  data() {
    return {
      now: new Date()
    };
  },

  created() {
    let timer = setInterval(() => {
      this.now = new Date();
    }, 1000);

    this.$on("finished", () => clearInterval(timer));
  },

  computed: {
    finished() {
      return this.remaining.total < 0;
    },

    remaining() {
      let remain = moment.duration(Date.parse(this.until) - this.now);

      if (remain <= 0) {
        this.$emit("finished");
      }

      return {
        total: remain,
        days: remain.days(),
        hours: remain.hours(),
        minutes: remain.minutes(),
        seconds: remain.seconds()
      };
    }
  }
};
</script>

<style>
</style>