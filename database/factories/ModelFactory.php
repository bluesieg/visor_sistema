<?php



/** @var \Illuminate\Database\Eloquent\Factory $factory */
//$factory->define(App\User::class, function (Faker\Generator $faker) {
//    static $password;
//
//    return [
//        'dni' => $faker->name,
//        'email' => $faker->unique()->safeEmail,
//        'password' => $password ?: $password = bcrypt('secret'),
//        'fch_nac' => date('d-m-Y H:i:s'),
//        'remember_token' => str_random(10),
//    ];
//});

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'dni'       => str_random(8),
        'ape_nom'   => strtoUpper(str_random(10)),
        'usuario'   => str_random(10),
        'password'  => bcrypt(str_random(10)),
        'nivel'     => 1,
        'fch_nac'   => date('d-m-Y H:i:s'),
        'cad_lar'   => str_random(10)
    ];
});
