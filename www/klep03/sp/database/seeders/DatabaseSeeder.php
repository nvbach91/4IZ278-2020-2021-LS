<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{


    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'name'              => 'Petr Klepetko',
                'email'             => 'klepetkope@gmail.com',
                'password'          => '$2y$10$xBFXBAXgWH1m.EOY7LTQfuAGIx5ojVmHdDCGAjFsXHmXQTf359ejG',
                'instruments'       => 'Piano, guitar and singing',
                'user_info'         => 'I am the best author of this website.\r\n\r\nDo not need to look it up!\r\n\r\nStay safe :)',
                'created_at'        => now(),
                'updated_at'        => now(),
                'activation_code'   => 111111,
            ],
            [
                'name'              => 'Kristýna Hrubarová',
                'email'             => 'kristyna.hrubarova@seznam.cz',
                'password'          => '$2y$10$yN8.5tiVCNzKJf3X75chFuJQtalNKxFnGcP5hdry4\/wrr0Gom6UUq',
                'instruments'       => 'negraju',
                'user_info'         => 'Já je tajneka redhart',
                'created_at'        => now(),
                'updated_at'        => now(),
                'activation_code'   => 111111,
            ], [
                'name'              => 'Klepi jr.',
                'email'             => 'pavel.klepi@gmail.com',
                'password'          => '$2y$10$t1oBImZ4YzvoeiAEd\/HAJO\/O0XwYoLfZPMXqm2\/NGbh31yAcwLIcO',
                'instruments'       => 'Multi',
                'user_info'         => 'Frajer a první oficiální uživatel',
                'created_at'        => now(),
                'updated_at'        => now(),
                'activation_code'   => 111111,
            ],
        ];

        // \App\Models\User::factory(10)->create();
        foreach ($users as $user) {
            DB::table('users')->insert([$user]);
        }

        $songs = [
            [
                "id" => "1",
                "name" => "Start Again",
                "lyrics_w_chords" => "I know, I am not perfect\r\nNot who I was meant to be",
                "artist" => "Petr Klepetko",
                "difficulty" => "beginner",
                "created_by" => "1",
                "created_at" => null,
                "updated_at" => "2021-05-26 00:40:45",
                "stars" => null
            ],
            [
                "id" => "3",
                "name" => "Love Yourself",
                "lyrics_w_chords" => "[Verse 1]\r\n \r\n            C              G\/B          Am\r\nFor all the times that you rain on my parade\r\n            Dm               C        G\/B\r\nAnd all the clubs you get in using my name\r\n              C                  G\/B         Am\r\nYou think you broke my heart, oh girl for goodness sake\r\n              Dm            C           G\/B\r\nYou think I'm crying, on my own, well I ain't\r\n                   C           G\/B                  Am\r\nAnd I didn't wanna write a song cause I didn't want anyone thinking I still care\r\n   Dm        C                G\/B\r\nI don't but, you still hit my phone up\r\n                 C        G\/B              Am\r\nAnd baby I'll be movin' on and I think you should be somethin'\r\n              Dm         C                G\/B\r\nI don't wanna hold back, maybe you should know that\r\n \r\n \r\n[Pre-Chorus]\r\n \r\n              Am           F              C\r\nMy mama don't like you and she likes everyone\r\n            Am      F                C\r\nAnd I never like to admit that I was wrong\r\n                 Am          F               C                G\r\nAnd I've been so caught up in my job, didn't see what's going on\r\n          Am  F            G\r\nAnd now I know, I'm better sleeping on my own\r\n \r\n \r\n[Chorus]\r\n \r\n             C        G       Am        F\r\nCause if you like the way you look that much\r\n        C                 G        C\r\nOh baby you should go and love yourself\r\n           C          G         Am      F\r\nAnd if you think that I'm still holdin' on to somethin'\r\nC                 G        C\r\nYou should go and love yourself\r\n \r\n \r\n[Verse 2]\r\n \r\n             C                G\/B      Am\r\nBut when you told me that you hated my friends\r\n         Dm               C           G\/B\r\nThe only problem was with you and not them\r\n          C             G\/B            Am\r\nAnd every time you told me my opinion was wrong\r\n             Dm             C            G\/B\r\nAnd tried to make me forget where I came from\r\n                   C           G\/B                  Am\r\nAnd I didn't wanna write a song cause I didn't want anyone thinking I still care\r\n   Dm        C                G\/B\r\nI don't but, you still hit my phone up\r\n                 C        G\/B              Am\r\nAnd baby I'll be movin' on and I think you should be somethin'\r\n              Dm         C                G\/B\r\nI don't wanna hold back, maybe you should know that\r\n \r\n \r\n[Pre-Chorus]\r\n \r\n              Am           F              C\r\nMy mama don't like you and she likes everyone\r\n            Am      F                C\r\nAnd I never like to admit that I was wrong\r\n                 Am          F               C                G\r\nAnd I've been so caught up in my job, didn't see what's going on\r\n          Am  F            G\r\nAnd now I know, I'm better sleeping on my own\r\n \r\n \r\n[Chorus]\r\n \r\n             C        G       Am        F\r\nCause if you like the way you look that much\r\n        C                 G        C\r\nOh baby you should go and love yourself\r\n           C          G         Am      F\r\nAnd if you think that I'm still holdin' on to somethin'\r\nC                 G        C\r\nYou should go and love yourself\r\n \r\n \r\n[Instrumental]\r\n \r\nC G Am F\r\nC G C\r\nC G Am F\r\nC G C\r\n \r\n \r\n[Verse 3]\r\n \r\n            C              G\/B          Am\r\nFor all the times that you made me feel small\r\n          Dm               C          G\/B\r\nI fell in love, now I feel nothin' at all\r\n        C                G\/B          Am\r\nI never felt so low when I was vulnerable\r\n        Dm              C             G\/B\r\nWas I a fool to let you break down my walls?\r\n \r\n \r\n[Chorus]\r\n \r\n             C        G       Am        F\r\nCause if you like the way you look that much\r\n        C                 G        C\r\nOh baby you should go and love yourself\r\n           C          G         Am      F\r\nAnd if you think that I'm still holdin' on to somethin'\r\nC                 G        C\r\nYou should go and love yourself\r\n             C        G       Am        F\r\nCause if you like the way you look that much\r\n        C                 G        C\r\nOh baby you should go and love yourself\r\n           C          G         Am      F\r\nAnd if you think that I'm still holdin' on to somethin'\r\nC                 G        C\r\nYou should go and love yourself",
                "artist" => "Justin Bieber",
                "difficulty" => "hard",
                "created_by" => "1",
                "created_at" => null,
                "updated_at" => "2021-05-26 00:46:32",
                "stars" => null
            ],
            [
                "id" => "7",
                "name" => "Start Again",
                "lyrics_w_chords" => "I know, I am not perfect\r\nNot who I was meant to be",
                "artist" => "Petr Klepetko",
                "difficulty" => "easy",
                "created_by" => "1",
                "created_at" => "2021-05-26 00:40:20",
                "updated_at" => "2021-05-26 00:40:45",
                "stars" => null
            ],
            [
                "id" => "8",
                "name" => "Song",
                "lyrics_w_chords" => "Ahoj ahoj ahoj ahoj \r\nAhoj ahoj ahoj ahoj Ahoj ahoj ahoj ahoj Ahoj ahoj ahoj ahoj \r\nAhoj ahoj ahoj ahoj \r\nAhoj ahoj ahoj ahoj \r\nAhoj ahoj ahoj ahoj \r\nAhoj ahoj ahoj ahoj \r\nAhoj ahoj ahoj ahoj \r\nAhoj ahoj ahoj ahoj \r\nAhoj ahoj ahoj ahoj \r\nAhoj ahoj ahoj ahoj \r\nAhoj ahoj ahoj ahoj \r\nAhoj ahoj ahoj ahoj \r\nAhoj ahoj ahoj ahoj \r\nAhoj ahoj ahoj ahoj \r\nAhoj ahoj ahoj ahoj \r\nAhoj ahoj ahoj ahoj",
                "artist" => "Peta",
                "difficulty" => "easy",
                "created_by" => "2",
                "created_at" => "2021-05-26 13:08:13",
                "updated_at" => "2021-05-26 13:08:32",
                "stars" => null
            ],
            [
                "id" => "10",
                "name" => "Julie",
                "lyrics_w_chords" => "Tak se podívej\r\nZákon mluví jasně\r\nAni nedýchej\r\nA neskládej básně\r\n\r\nS tebou cítil jsem se\r\nMoc dobře ty blázne\r\nVšak spolu, nemůžem být\r\nMěj se krásně\r\n\r\nRef:\r\n[Musíš být statečná, Jůlie\r\nKdyž měsíc slunce zakryje\r\nA až když stín mysl tvou překryje\r\nŘekni, cos dělala včera\r\n\r\nMusíš být statečná, Jůlie\r\nTenhle ten kolotoč, tě zabije\r\nTak doufej že se rozbije\r\nA doufej v to zas a znova]\r\n\r\nByla jsi mou a já byl tvým\r\nTak co se stalo?\r\nVolal jsem do tmy a neslyšel zpět\r\njediné tvé haló\r\n\r\nZato já se ozval vždy\r\nKdyž ty sis pískla\r\nTuhle křivdu nenapraví\r\nSklenka vína\r\n\r\nŘíkám si jaký svět by byl\r\nKdybychom spolu zůstali,\r\nMožná potom mohli bychom\r\nLežet celé dny v posteli\r\n\r\nKaždou noc říkam si\r\nJaké by to bylo\r\nDali jsme tomu šanci\r\nA máme co zbylo\r\n\r\nRef:\r\n\/\/:[Musíš být statečná, Jůlie\r\nKdyž měsíc slunce zakryje\r\nA až když stín mysl tvou překryje\r\nŘekni, cos dělala včera\r\n\r\nMusíš být statečná, Jůlie\r\nTenhle ten kolotoč, tě zabije\r\nTak doufej že se rozbije\r\nA doufej v to zas a znova]:\/\/",
                "artist" => "Youlie",
                "difficulty" => "easy",
                "created_by" => "3",
                "created_at" => "2021-05-29 11:17:36",
                "updated_at" => "2021-05-29 11:19:32",
                "stars" => null
            ],
        ];

        foreach ($songs as $song) {
            DB::table('songs')->insert($song);
        }

    }
}
