import { reactive } from 'vue'
export const categories = [
  {
    id: 1,
    name: 'Pâtisserie Française',
    slug: 'patisserie-francaise',
    description: 'Les meilleurs desserts et gâteaux traditionnels.',
  },
  {
    id: 2,
    name: 'Cuisine Italienne',
    slug: 'cuisine-italienne',
    description: 'Les secrets des pâtes et des pizzas réussies.',
  },
]

export const books = reactive([
  {
    id: 1,
    category_id: 1,
    title: "L'art du Macaron",
    author: 'Chef Pierre Hermé',
    slug: 'art-du-macaron',
    description: 'Tout pour réussir vos macarons à la maison.',
    total_copies: 5,
    available_copies: 3,
    status: 'Bon état',
  },
  {
    id: 2,
    category_id: 1,
    title: 'Tartes Inratables',
    author: 'Cyril Lignac',
    slug: 'tartes-inratables',
    description: 'Des tartes simples et délicieuses.',
    total_copies: 2,
    available_copies: 0,
    status: 'Rupture',
  },
  {
    id: 3,
    category_id: 2,
    title: 'Pasta Perfetta',
    author: 'Chef Luigi',
    slug: 'pasta-perfetta',
    description: 'Les vraies recettes de pâtes italiennes.',
    total_copies: 4,
    available_copies: 4,
    status: 'Bon état',
  },
])
export const mesEmprunts = reactive([])
