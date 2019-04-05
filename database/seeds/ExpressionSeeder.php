<?php

use Illuminate\Database\Seeder;
use Faker\Generator;


class ExpressionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker\Generator $faker)
    {
        $groupCount = 10;

        //.. Seed ExpressionGroup
        for($x = 0; $x < $groupCount; $x++){
            DB::table('expression_groups')->insert([
                'group_name' => $faker->sentence()
            ]);
        }

        //.. Seed Expression
        for($x = 0; $x < 200; $x++){
            DB::table('expressions')->insert([
                'value' => $faker->sentence(),
                'group_id' => $faker->numberBetween(1,$groupCount)
            ]);
        }

    }
}
