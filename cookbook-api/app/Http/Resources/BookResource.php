<?php
namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
{
    public function toArray(Request $request): array
    {
         return [
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'author' => $this->author,
            'description' => $this->description,
            'category_id' => $this->category_id,
            'created_at' => $this->created_at,

             '_links' => [
                'self' => [
                    'href' => url("/api/books/{$this->id}"),
                    'method' => 'GET',
                    'description' => 'Voir les détails de ce livre'
                ],
                'update' => [
                    'href' => url("/api/books/{$this->id}"),
                    'method' => 'PUT',
                    'description' => 'Modifier ce livre (Admin)'
                ],
                'delete' => [
                    'href' => url("/api/books/{$this->id}"),
                    'method' => 'DELETE',
                    'description' => 'Supprimer ce livre (Admin)'
                ],
                'category' => [
                    'href' => url("/api/categories/{$this->category_id}"),
                    'method' => 'GET',
                    'description' => 'Voir la catégorie de ce livre'
                ]
            ]
        ];
    }
}
