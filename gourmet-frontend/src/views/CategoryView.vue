<script setup>
import { computed } from 'vue'
import { useRoute, useRouter } from 'vue-router'
import { categories, books } from '../data/mockData.js'
import Card from '../components/Card.vue'

const route = useRoute()
const router = useRouter()

const categoryId = parseInt(route.params.id)

const category = categories.find((c) => c.id === categoryId)

const categoryBooks = computed(() => {
  return books.filter((book) => book.category_id === categoryId)
})

const goToDetail = (id) => {
  router.push(`/book/${id}`)
}
</script>

<template>
  <div class="category-page">
    <div v-if="category">
      <h2>
        Livres de la catégorie : <span class="text-orange">{{ category.name }}</span>
      </h2>
      <p class="desc">{{ category.description }}</p>

      <p v-if="categoryBooks.length === 0">Aucun livre dans cette catégorie pour le moment.</p>

      <div class="books-grid" v-else>
        <Card
          v-for="book in categoryBooks"
          :key="book.id"
          :title="book.title"
          :subtitle="book.author"
        >
          <button @click="goToDetail(book.id)" class="btn-detail">Voir détails</button>
        </Card>
      </div>
    </div>

    <div v-else>
      <p>Catégorie introuvable.</p>
    </div>
  </div>
</template>

<style scoped>
.text-orange {
  color: #ff9800;
}
.desc {
  margin-bottom: 30px;
  font-style: italic;
  color: #555;
}
.books-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
  gap: 20px;
}
.btn-detail {
  background-color: #ff9800;
  color: white;
  border: none;
  padding: 8px 15px;
  border-radius: 4px;
  cursor: pointer;
  margin-top: 15px;
  width: 100%;
}
</style>
