<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Repository
 *
 * @OA\Schema(
 *     schema="Repository",
 *     type="object",
 *     title="Repository",
 *     required={"id", "name", "url", "createdAt"},
 *     @OA\Property(property="id", type="integer", format="int64", description="Repository ID"),
 *     @OA\Property(property="name", type="string", description="Repository Name"),
 *     @OA\Property(property="url", type="string", description="Repository URL"),
 *     @OA\Property(property="owner_id", type="string", description="Owner id"),
 * )
 */
class Repository extends Model
{
    protected $table = 'repositories';

    protected $fillable = [
        'name',
        'url',
        'owner_id'
    ];

    public $timestamps = true;

}
