<script setup>
import { useRoute, useRouter } from 'vue-router'
import { books, mesEmprunts } from '../data/mockData.js'

const route = useRoute()
const router = useRouter()

const bookId = parseInt(route.params.id)
const book = books.find((b) => b.id === bookId)

const goBack = () => {
  router.push('/books')
}
const emprunterLivre = () => {
  if (book.available_copies > 0) {
    book.available_copies--

    mesEmprunts.push({
      id: Date.now(),
      book_title: book.title,
      borrow_date: new Date().toLocaleDateString('fr-FR'),
      return_date: new Date(Date.now() + 14 * 24 * 60 * 60 * 1000).toLocaleDateString('fr-FR'),
    })

    alert('Livre emprunté avec succès !')

    router.push('/emprunts')
  }
}
</script>

<template>
  <div class="book-detail">
    <button @click="goBack" class="btn-back">⬅ Retour à la liste</button>

    <div v-if="book" class="detail-card">
      <h2>{{ book.title }}</h2>
      <h3 class="author">Par : {{ book.author }}</h3>
      <p class="desc">{{ book.description }}</p>

      <div class="stats">
        <p><strong>Total des exemplaires :</strong> {{ book.total_copies }}</p>
        <p>
          <strong>Exemplaires disponibles :</strong>
          <span :class="book.available_copies > 0 ? 'text-green' : 'text-red'">
            {{ book.available_copies }}
          </span>
        </p>
        <p><strong>État de la collection :</strong> {{ book.status }}</p>
      </div>

      <button @click="emprunterLivre" :disabled="book.available_copies === 0" class="btn-emprunt">
        {{ book.available_copies > 0 ? 'Emprunter ce livre' : 'Indisponible' }}
      </button>
    </div>

    <div v-else>
      <p>Livre introuvable.</p>
    </div>
  </div>
</template>

<style scoped>
.book-detail {
  max-width: 800px;
  margin: 0 auto;
}
.btn-back {
  background: none;
  border: none;
  color: #ff9800;
  cursor: pointer;
  font-weight: bold;
  margin-bottom: 20px;
  font-size: 1rem;
}
.detail-card {
  background: white;
  padding: 30px;
  border-radius: 8px;
  box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
}
.author {
  color: #555;
}
.desc {
  font-size: 1.1rem;
  line-height: 1.6;
  margin: 20px 0;
}
.stats {
  background: #f8f9fa;
  padding: 15px;
  border-radius: 8px;
  margin-bottom: 20px;
}
.text-green {
  color: green;
  font-weight: bold;
}
.text-red {
  color: red;
  font-weight: bold;
}
.btn-emprunt {
  background-color: #4caf50;
  color: white;
  padding: 12px 24px;
  border: none;
  border-radius: 4px;
  font-size: 1.1rem;
  cursor: pointer;
}
.btn-emprunt:disabled {
  background-color: #ccc;
  cursor: not-allowed;
}
</style>
