<template>
  <div class="dropdown relative">
    <!-- trigger -->
    <div @click.prevent="isOpen = !isOpen" aria-haspopup="true" :aria-expanded="isOpen">
      <slot name="trigger"></slot>
    </div>

    <!-- menu links -->
    <div
      v-show="isOpen"
      class="dropdown-menu absolute flex flex-col items-center bg-card mt-2 rounded shadow"
      :style="{ width }"
    >
      <slot></slot>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    width: { default: "auto" }
  },

  data() {
    return {
      isOpen: false
    };
  },

  watch: {
    isOpen(isOpen) {
      if (isOpen) {
        document.addEventListener("click", this.closeIfClickOutside);
      }
    }
  },

  methods: {
    closeIfClickOutside(event) {
      if (!event.target.closest(".dropdown")) {
        this.isOpen = false;

        document.removeEventListener("click", this.closeIfClickOutside);
      }
    }
  }
};
</script>

<style>
</style>