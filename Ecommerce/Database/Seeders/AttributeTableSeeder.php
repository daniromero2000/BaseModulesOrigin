<?php

namespace Modules\Ecommerce\Database\Seeders;

use Modules\Ecommerce\Entities\Attributes\Attribute;
use Modules\Ecommerce\Entities\AttributeValues\AttributeValue;
use Illuminate\Database\Seeder;

class AttributeTableSeeder extends Seeder
{
    public function run()
    {
        $sizeAttr = factory(Attribute::class)->create(['name' => 'Tamaño']);
        factory(AttributeValue::class)->create([
            'value' => 'Pequeño',
            'attribute_id' => $sizeAttr->id
        ]);

        factory(AttributeValue::class)->create([
            'value' => 'Mediano',
            'attribute_id' => $sizeAttr->id
        ]);

        factory(AttributeValue::class)->create([
            'value' => 'Largo',
            'attribute_id' => $sizeAttr->id
        ]);

        $tallaAttr = factory(Attribute::class)->create(['name' => 'Talla']);
        factory(AttributeValue::class)->create([
            'value' => 19,
            'attribute_id' => $tallaAttr->id
        ]);

        factory(AttributeValue::class)->create([
            'value' => 20,
            'attribute_id' => $tallaAttr->id
        ]);

        factory(AttributeValue::class)->create([
            'value' => 21,
            'attribute_id' => $tallaAttr->id
        ]);

        factory(AttributeValue::class)->create([
            'value' => 22,
            'attribute_id' => $tallaAttr->id
        ]);

        factory(AttributeValue::class)->create([
            'value' => 22,
            'attribute_id' => $tallaAttr->id
        ]);

        factory(AttributeValue::class)->create([
            'value' => 23,
            'attribute_id' => $tallaAttr->id
        ]);

        factory(AttributeValue::class)->create([
            'value' => 24,
            'attribute_id' => $tallaAttr->id
        ]);

        factory(AttributeValue::class)->create([
            'value' => 25,
            'attribute_id' => $tallaAttr->id
        ]);

        factory(AttributeValue::class)->create([
            'value' => 26,
            'attribute_id' => $tallaAttr->id
        ]);

        $colorAttr = factory(Attribute::class)->create(['name' => 'Color']);
        factory(AttributeValue::class)->create([
            'value' => 'Rojo',
            'attribute_id' => $colorAttr->id
        ]);

        factory(AttributeValue::class)->create([
            'value' => 'Amarillo',
            'attribute_id' => $colorAttr->id
        ]);

        factory(AttributeValue::class)->create([
            'value' => 'Azul',
            'attribute_id' => $colorAttr->id
        ]);

        factory(AttributeValue::class)->create([
            'value' => 'Negro',
            'attribute_id' => $colorAttr->id
        ]);

        factory(AttributeValue::class)->create([
            'value' => 'Verde',
            'attribute_id' => $colorAttr->id
        ]);

        factory(AttributeValue::class)->create([
            'value' => 'Café',
            'attribute_id' => $colorAttr->id
        ]);

        factory(AttributeValue::class)->create([
            'value' => 'Violeta',
            'attribute_id' => $colorAttr->id
        ]);

        factory(AttributeValue::class)->create([
            'value' => 'Naranja',
            'attribute_id' => $colorAttr->id
        ]);
    }
}
