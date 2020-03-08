<template>
  <transition name="fade">
    <div v-show="isDisplay">
      <button
        type="button"
        :href="href"
        v-show="isDisplay"
        @click="submit"
        class="z-10 border border-accent text-accent rounded-full w-10 h-10 hover:bg-active"
        style="box-shadow: 0 2px 7px 0 #b0eaff;"
      >
        <slot></slot>
      </button>
    </div>
  </transition>
</template>

<script>
import inViewport from "in-viewport";

export default {
  props: ["href", "whenHidden", "action"],

  data() {
    return {
      isDisplay: false
    };
  },

  mounted() {
    window.addEventListener(
      "scroll",
      () => {
        this.isDisplay = !inViewport(document.querySelector(this.whenHidden));
      },
      { passive: true }
    );
  },

  methods: {
    submit() {
      if (this.action === "add") {
        this.add();
      }
      if (this.action === "edit") {
        this.edit();
      }
      this.scroll();
    },

    scroll() {
      document.querySelector(this.href).scrollIntoView({ behavior: "smooth" });
    },

    add() {
      this.$modal.show("project-create");
    },

    edit() {
      this.$modal.show("project-edit");
    }
  }
};
</script>

<style>
.fade-enter-active,
.fade-leave-active {
  transition: all 0.3s ease;
}

.fade-enter,
.fade-leave-to {
  transform: translateX(1rem);
  opacity: 0;
}
</style>