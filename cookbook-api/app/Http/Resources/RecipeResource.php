<?php

// namespace App\Http\Resources;

// use Illuminate\Http\Request;
// use Illuminate\Http\Resources\Json\JsonResource;

// class RecipeResource extends JsonResource
// {
//     /**
//      * Transform the resource into an array.
//      *
//      * @return array<string, mixed>
//      */
//     public function toArray(Request $request): array
//     {
//         return parent::toArray($request);
//     }
// }


// class RecipeResource extends JsonResource
// {
//     public function toArray(Request $request): array
//     {
//         return [
//             'id' => $this->id,
//             'title' => $this->title,
//             'description' => $this->description,
//             'status' => $this->status,
//              '_links' => [
//                 'self' => [
//                     'href' => route('recipes.show', $this->id),
//                     'method' => 'GET'
//                 ],
//                 'update' => [
//                     'href' => route('recipes.update', $this->id),
//                     'method' => 'PUT'
//                 ],
//                 'delete' => [
//                     'href' => route('recipes.destroy', $this->id),
//                     'method' => 'DELETE'
//                 ]
//             ]
//         ];
//     }
// }


//2 méthode
// use App\Traits\HateoasLinks;

// class BusResource extends JsonResource
// {
//     use HateoasLinks;

//     public function toArray(Request $request): array
//     {
//          return array_merge([
//             'id' => $this->id,
//             'title' => $this->title,
//             'description' => $this->description,
//         ], $this->withHateoas('categories', $this->id));
//      }
// }
