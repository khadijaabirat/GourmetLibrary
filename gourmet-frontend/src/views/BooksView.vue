<script setup>
import { ref, computed } from 'vue'
import { useRouter } from 'vue-router'
import { books } from '../data/mockData.js'
import Card from '../components/Card.vue'

const router = useRouter()
const searchQuery = ref('')

const filteredBooks = computed(() => {
  return books.filter(
    (book) =>
      book.title.toLowerCase().includes(searchQuery.value.toLowerCase()) ||
      book.author.toLowerCase().includes(searchQuery.value.toLowerCase()),
  )
})

const goToDetail = (id) => {
  router.push(`/book/${id}`)
}
</script>

<template>
  <div class="books-page">
    <h2>Tous les livres</h2>

    <div class="search-bar">
      <input type="text" v-model="searchQuery" placeholder="Rechercher par titre ou auteur..." />
    </div>

    <p v-if="filteredBooks.length === 0" class="no-results">Aucun livre trouvé.</p>

    <div class="books-grid" v-else>
      <Card
        v-for="book in filteredBooks"
        :key="book.id"
        :title="book.title"
        :subtitle="book.author"
      >
        <button @click="goToDetail(book.id)" class="btn-detail">Voir détails</button>
      </Card>
    </div>
  </div>
</template>

<style scoped>
.search-bar {
  margin-bottom: 30px;
  text-align: center;
}
.search-bar input {
  width: 100%;
  max-width: 500px;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 8px;
  font-size: 1rem;
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
.no-results {
  text-align: center;
  color: #777;
  font-size: 1.2rem;
}
</style>
