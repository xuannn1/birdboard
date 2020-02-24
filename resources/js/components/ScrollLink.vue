<template>
  <button
    type="button"
    :href="href"
    @click="scroll"
    class="z-10 border border-accent text-accent rounded-full w-10 h-10 focus:outline-none hover:bg-active"
    style="box-shadow: 0 2px 7px 0 #b0eaff;"
  >
    <slot></slot>
  </button>
</template>

<script>
export default {
  props: ["href"],

  methods: {
    scroll() {
      document.querySelector(this.href).scrollIntoView({ behavior: "smooth" });
    }
  }
};
</script>

<style>
</style>>