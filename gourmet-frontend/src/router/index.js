import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'
import BooksView from '../views/BooksView.vue'
import BookDetailView from '../views/BookDetailView.vue'
import CategoryView from '../views/CategoryView.vue'
import EmpruntsView from '../views/EmpruntsView.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: HomeView,
    },
    {
      path: '/books',
      name: 'books',
      component: BooksView,
    },
    {
      path: '/book/:id',
      name: 'book-detail',
      component: BookDetailView,
    },
    { path: '/category/:id', name: 'category', component: CategoryView },
    { path: '/emprunts', name: 'emprunts', component: EmpruntsView },
  ],
})

export default router
