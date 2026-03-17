<?php
namespace App\Traits;

trait HateoasTrait
{

    public function generateHateoasLinks($routeName)
    {
        return [
            'self' => [
                'href' => route("{$routeName}.show", $this->id),
                'method' => 'GET'
            ],
            'update' => [
                'href' => route("{$routeName}.update", $this->id),
                'method' => 'PUT'
            ],
            'delete' => [
                'href' => route("{$routeName}.destroy", $this->id),
                'method' => 'DELETE'
            ]
        ];
    }
}







// namespace App\Traits;

// trait HateoasLinks
// {

//     public function withHateoas(string $routeName, $id): array
//     {
//         return [
//             '_links' => [
//                 'self' => [
//                     'href' => route("{$routeName}.show", $id),
//                     'method' => 'GET'
//                 ],
//                 'update' => [
//                     'href' => route("{$routeName}.update", $id),
//                     'method' => 'PUT'
//                 ],
//                 'delete' => [
//                     'href' => route("{$routeName}.destroy", $id),
//                     'method' => 'DELETE'
//                 ]
//             ]
//         ];
//     }

    // public function withHateoas(string $routeName, $id): array
    // {
    //      $links = [
    //         'self' => [
    //             'href' => route("{$routeName}.show", $id),
    //             'method' => 'GET'
    //         ]
    //     ];

    //      if (auth()->check() && auth()->user()->role === 'admin') {

    //         $links['update'] = [
    //             'href' => route("{$routeName}.update", $id),
    //             'method' => 'PUT'
    //         ];

    //         $links['delete'] = [
    //             'href' => route("{$routeName}.destroy", $id),
    //             'method' => 'DELETE'
    //         ];
    //     }

    //      return ['_links' => $links];
    // }
//}
