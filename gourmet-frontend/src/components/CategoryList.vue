<script setup>
import { useRouter } from 'vue-router'
import Card from './Card.vue'

defineProps({
  categories: Array,
})

const router = useRouter()

const goToCategory = (id) => {
  router.push(`/category/${id}`)
}
</script>

<template>
  <div class="category-grid">
    <Card
      v-for="category in categories"
      :key="category.id"
      :title="category.name"
      :description="category.description"
    >
      <button @click="goToCategory(category.id)" class="btn-cat">Voir les livres</button>
    </Card>
  </div>
</template>

<style scoped>
.category-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
  gap: 20px;
}
.btn-cat {
  background-color: #333;
  color: white;
  border: none;
  padding: 8px 15px;
  border-radius: 4px;
  cursor: pointer;
  margin-top: 15px;
  width: 100%;
}
.btn-cat:hover {
  background-color: #555;
}
</style>
