<script setup>
import { RouterLink } from 'vue-router'
</script>

<template>
  <header class="header">
    <div class="logo">
      <h1>🍽️ Médiathèque Culinaire</h1>
    </div>
    <nav>
      <RouterLink to="/">Accueil</RouterLink>
      <RouterLink to="/books">Tous les Livres</RouterLink>
      <RouterLink to="/emprunts">Mes Emprunts</RouterLink>
    </nav>
  </header>
</template>

<style scoped>
.header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  background-color: #ff9800;
  padding: 15px 30px;
  color: white;
  border-radius: 8px;
  margin-bottom: 20px;
}
.logo h1 {
  margin: 0;
  font-size: 1.5rem;
}
nav {
  display: flex;
  gap: 20px;
}
nav a {
  color: white;
  text-decoration: none;
  font-weight: bold;
  padding: 5px 10px;
  border-radius: 4px;
}
nav a:hover,
nav a.router-link-active {
  background-color: #e65100;
}
</style>
