<template>
  <div v-if="isVisible" class="snackbar" :class="[type]">
    {{ message }}
  </div>
</template>

<script>
export default {
  data() {
    return {
      isVisible: false,
      message: '',
      type: 'error',
    };
  },
  methods: {
    showSnackbar(message, type = 'error') {
      this.message = message;
      this.type = type;
      this.isVisible = true;

      setTimeout(() => {
        this.isVisible = false;
      }, 3500);
    },
    closeSnackbar() {
      this.isVisible = false;
    },
  },
};
</script>

<style scoped>
.snackbar {
  position: fixed;
  top: 0;
  right: 0;
  z-index: 99999;
  padding: 16px;
  border-radius: 4px;
  color: #fff;
  text-align: center;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  transition: opacity 0.3s ease-in-out;
  margin: 2rem;
}

.error {
  background-color: #b72f26;
}

.success {
  background-color: #2c812f;
}
</style>
