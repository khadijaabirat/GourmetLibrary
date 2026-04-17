<script setup>
// كنستقبلو الداتا (props) باش الـ Component يكون réutilisable
defineProps({
  title: String,
  subtitle: String,
  description: String,
})
</script>

<template>
  <div class="card">
    <h3>{{ title }}</h3>
    <h4 v-if="subtitle" class="subtitle">{{ subtitle }}</h4>
    <p>{{ description }}</p>
    <slot></slot>
  </div>
</template>

<style scoped>
.card {
  border: 1px solid #ddd;
  border-radius: 8px;
  padding: 20px;
  background-color: white;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  transition: transform 0.2s;
}
.card:hover {
  transform: translateY(-5px);
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
}
.card h3 {
  margin-top: 0;
  color: #d84315;
}
.subtitle {
  color: #666;
  font-style: italic;
  margin-top: -10px;
}
</style>
