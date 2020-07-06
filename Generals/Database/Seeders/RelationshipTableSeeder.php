<?php

namespace Modules\Generals\Database\Seeders;

use Modules\Generals\Entities\Relationships\Relationship;
use Illuminate\Database\Seeder;

class RelationshipTableSeeder extends Seeder
{
    public function run()
    {
        factory(Relationship::class)->create([
            'relationship'  => 'Madre',
            'reference_type_id' => 1
        ]);

        factory(Relationship::class)->create([
            'relationship'  => 'Padre',
            'reference_type_id' => 1
        ]);

        factory(Relationship::class)->create([
            'relationship'  => 'Herman@',
            'reference_type_id' => 1
        ]);

        factory(Relationship::class)->create([
            'relationship'  => 'Ti@',
            'reference_type_id' => 1
        ]);

        factory(Relationship::class)->create([
            'relationship'  => 'Abuel@',
            'reference_type_id' => 1
        ]);

        factory(Relationship::class)->create([
            'relationship'  => 'Cónyuge',
            'reference_type_id' => 1
        ]);

        factory(Relationship::class)->create([
            'relationship'  => 'Prim@',
            'reference_type_id' => 1
        ]);

        factory(Relationship::class)->create([
            'relationship'  => 'Amig@',
            'reference_type_id' => 2
        ]);

        factory(Relationship::class)->create([
            'relationship'  => 'Hij@',
            'reference_type_id' => 1
        ]);

        factory(Relationship::class)->create([
            'relationship'  => 'Yern@',
            'reference_type_id' => 1
        ]);

        factory(Relationship::class)->create([
            'relationship'  => 'Sobrin@',
            'reference_type_id' => 1
        ]);

        factory(Relationship::class)->create([
            'relationship'  => 'Cuñad@',
            'reference_type_id' => 1
        ]);

        factory(Relationship::class)->create([
            'relationship'  => 'Suegr@',
            'reference_type_id' => 1
        ]);

        factory(Relationship::class)->create([
            'relationship'  => 'Otro',
            'reference_type_id' => 1
        ]);
    }
}
