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
            'value' => 'S',
            'description' => 'Pequeño',
            'attribute_id' => $sizeAttr->id,
            'sort_order' => 1
        ]);

        factory(AttributeValue::class)->create([
            'value' => 'M',
            'description' => 'Mediano',
            'attribute_id' => $sizeAttr->id,
            'sort_order' => 2
        ]);

        factory(AttributeValue::class)->create([
            'value' => 'L',
            'description' => 'Grande',
            'attribute_id' => $sizeAttr->id,
            'sort_order' => 3
        ]);

        $tallaAttr = factory(Attribute::class)->create(['name' => 'Talla']);
        factory(AttributeValue::class)->create([
            'value' => 19,
            'attribute_id' => $tallaAttr->id,
            'sort_order' => 1
        ]);

        factory(AttributeValue::class)->create([
            'value' => 20,
            'attribute_id' => $tallaAttr->id,
            'sort_order' => 2
        ]);

        factory(AttributeValue::class)->create([
            'value' => 21,
            'attribute_id' => $tallaAttr->id,
            'sort_order' => 3
        ]);

        factory(AttributeValue::class)->create([
            'value' => 22,
            'attribute_id' => $tallaAttr->id,
            'sort_order' => 4
        ]);

        factory(AttributeValue::class)->create([
            'value' => 23,
            'attribute_id' => $tallaAttr->id,
            'sort_order' => 5
        ]);

        factory(AttributeValue::class)->create([
            'value' => 24,
            'attribute_id' => $tallaAttr->id,
            'sort_order' => 6
        ]);

        factory(AttributeValue::class)->create([
            'value' => 25,
            'attribute_id' => $tallaAttr->id,
            'sort_order' => 7
        ]);

        factory(AttributeValue::class)->create([
            'value' => 26,
            'attribute_id' => $tallaAttr->id,
            'sort_order' => 8
        ]);

        $colorAttr = factory(Attribute::class)->create(['name' => 'Color']);
        factory(AttributeValue::class)->create([
            'value' => 'Rojo',
            'description' => 'ff0000',
            'attribute_id' => $colorAttr->id,
            'sort_order' => 1
        ]);

        factory(AttributeValue::class)->create([
            'value' => 'Amarillo',
            'description' => 'ffff00',
            'attribute_id' => $colorAttr->id,
            'sort_order' => 2
        ]);

        factory(AttributeValue::class)->create([
            'value' => 'Azul',
            'description' => '0000ff',
            'attribute_id' => $colorAttr->id,
            'sort_order' => 3
        ]);

        factory(AttributeValue::class)->create([
            'value' => 'Negro',
            'description' => '000000',
            'attribute_id' => $colorAttr->id,
            'sort_order' => 4
        ]);

        factory(AttributeValue::class)->create([
            'value' => 'Verde',
            'description' => '008000',
            'attribute_id' => $colorAttr->id,
            'sort_order' => 5
        ]);

        factory(AttributeValue::class)->create([
            'value' => 'Marrón',
            'description' => 'a52a2a',
            'attribute_id' => $colorAttr->id,
            'sort_order' => 6
        ]);

        factory(AttributeValue::class)->create([
            'value' => 'Violeta',
            'description' => 'ee82ee',
            'attribute_id' => $colorAttr->id,
            'sort_order' => 7
        ]);

        factory(AttributeValue::class)->create([
            'value' => 'Naranja',
            'description' => 'ffa500',
            'attribute_id' => $colorAttr->id,
            'sort_order' => 8
        ]);

        factory(AttributeValue::class)->create([
            'value' => 'Rosa',
            'description' => 'ffc0cb',
            'attribute_id' => $colorAttr->id,
            'sort_order' => 9
        ]);

        factory(AttributeValue::class)->create([
            'value' => 'Purpura',
            'description' => '800080',
            'attribute_id' => $colorAttr->id,
            'sort_order' => 10
        ]);

        factory(AttributeValue::class)->create([
            'value' => 'Gris',
            'description' => '808080',
            'attribute_id' => $colorAttr->id,
            'sort_order' => 11
        ]);

        factory(AttributeValue::class)->create([
            'value' => 'Blanco',
            'description' => 'ffffff',
            'attribute_id' => $colorAttr->id,
            'sort_order' => 12
        ]);
    }
}
