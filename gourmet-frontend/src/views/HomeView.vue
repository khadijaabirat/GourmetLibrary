<script setup>
import { ref } from 'vue'
import { useRouter } from 'vue-router'
import { categories, books } from '../data/mockData.js'
import CategoryList from '../components/CategoryList.vue'
import Card from '../components/Card.vue'
const router = useRouter()
const allCategories = ref(categories)
const featuredBooks = ref(books.slice(0, 3))
const goToDetail = (id) => {
  router.push(`/book/${id}`)
}
</script>

<template>
  <div class="home">
    <section class="hero">
      <h2>Bienvenue dans notre Médiathèque Culinaire</h2>
      <p>Découvrez les meilleures recettes et livres de cuisine.</p>
    </section>

    <section class="section">
      <h3 class="section-title">Catégories Principales</h3>
      <CategoryList :categories="allCategories" />
    </section>

    <section class="section">
      <h3 class="section-title">Livres Mis en Avant</h3>
      <div class="books-grid">
        <Card
          v-for="book in featuredBooks"
          :key="book.id"
          :title="book.title"
          :subtitle="book.author"
          :description="book.description"
        >
          <button @click="goToDetail(book.id)" class="btn-detail">Voir détails</button>
        </Card>
      </div>
    </section>
  </div>
</template>

<style scoped>
.home {
  padding: 10px 0;
}
.hero {
  text-align: center;
  margin-bottom: 40px;
}
.hero h2 {
  color: #333;
  font-size: 2rem;
}
.section {
  margin-bottom: 50px;
}
.section-title {
  border-bottom: 2px solid #ff9800;
  padding-bottom: 10px;
  margin-bottom: 20px;
  color: #ff9800;
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
  font-weight: bold;
}
.btn-detail:hover {
  background-color: #e65100;
}
</style>
