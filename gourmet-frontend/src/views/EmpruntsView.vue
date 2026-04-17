<script setup>
import { mesEmprunts } from '../data/mockData.js'
</script>

<template>
  <div class="emprunts-page">
    <h2>Mes Emprunts</h2>
    <p>Voici la liste des livres que vous avez actuellement empruntés :</p>

    <div v-if="mesEmprunts.length === 0" class="empty-state">
      <p>Vous n'avez aucun livre en cours d'emprunt.</p>
      <RouterLink to="/books" class="btn-browse">Parcourir les livres</RouterLink>
    </div>

    <div class="borrowed-list" v-else>
      <div v-for="emprunt in mesEmprunts" :key="emprunt.id" class="borrowed-item">
        <h3>{{ emprunt.book_title }}</h3>
        <p><strong>Emprunté le :</strong> {{ emprunt.borrow_date }}</p>
        <p>
          <strong>À rendre avant le :</strong>
          <span class="text-red">{{ emprunt.return_date }}</span>
        </p>
        <span class="status">En cours</span>
      </div>
    </div>
  </div>
</template>

<style scoped>
.empty-state {
  text-align: center;
  padding: 40px;
  background: #fff;
  border-radius: 8px;
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}
.btn-browse {
  display: inline-block;
  margin-top: 15px;
  background: #ff9800;
  color: white;
  padding: 10px 20px;
  text-decoration: none;
  border-radius: 4px;
}
.borrowed-list {
  margin-top: 20px;
}
.borrowed-item {
  border-left: 4px solid #4caf50;
  background: white;
  padding: 15px;
  margin-bottom: 15px;
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}
.borrowed-item h3 {
  margin: 0 0 10px 0;
  color: #333;
}
.status {
  display: inline-block;
  background: #e8f5e9;
  color: #4caf50;
  padding: 4px 8px;
  border-radius: 4px;
  font-weight: bold;
  font-size: 0.9rem;
}
.text-red {
  color: #d32f2f;
  font-weight: bold;
}
</style>
