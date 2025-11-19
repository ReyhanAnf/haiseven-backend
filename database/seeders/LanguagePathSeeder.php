<?php

namespace Database\Seeders;

use App\Models\LanguageLesson;
use App\Models\LanguageModule;
use App\Models\LanguageQuestion;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LanguagePathSeeder extends Seeder
{
    /**
     * Seed a curated curriculum for the Language Path feature.
     */
    public function run(): void
    {

$modules = [
    [
        'title' => 'Fondasi Percakapan',
        'description' => 'Mulai dengan sapaan dasar, menanyakan kabar, dan memperkenalkan diri secara sederhana.',
        'order' => 1,
        'lessons' => [
            [
                'title' => 'Sapaan & Perkenalan',
                'order' => 1,
                'questions' => [
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Apa padanan bahasa Inggris untuk "Terima kasih"?',
                        'options' => ['Thank you', 'Sorry', 'Please', 'Good morning'],
                        'correct_answer' => 'Thank you',
                    ],
                    [
                        'question_type' => 'fill_in_blank',
                        'question' => 'Lengkapi kalimat: "My name ___ Sita."',
                        'options' => null,
                        'correct_answer' => 'is',
                    ],
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Manakah yang termasuk sapaan formal?',
                        'options' => ['What\'s up?', 'Hi!', 'Good evening.', 'Hey there!'],
                        'correct_answer' => 'Good evening.',
                    ],
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Bagaimana Anda menyapa seseorang di pagi hari?',
                        'options' => ['Good evening', 'Good night', 'Good morning', 'Good afternoon'],
                        'correct_answer' => 'Good morning',
                    ],
                    [
                        'question_type' => 'fill_in_blank',
                        'question' => 'Lengkapi: "Nice to ___ you."',
                        'options' => null,
                        'correct_answer' => 'meet',
                    ],
                ],
            ],
            [
                'title' => 'Menanyakan Kabar',
                'order' => 2,
                'questions' => [
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Apa arti "How are you?" dalam Bahasa Indonesia?',
                        'options' => ['Siapa kamu?', 'Apa kabar?', 'Di mana kamu?', 'Kapan kamu datang?'],
                        'correct_answer' => 'Apa kabar?',
                    ],
                    [
                        'question_type' => 'fill_in_blank',
                        'question' => 'Lengkapi kalimat: "I\'m ___ great, thank you."',
                        'options' => null,
                        'correct_answer' => 'doing',
                    ],
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Balasan sopan untuk kalimat "Nice to meet you" adalah…',
                        'options' => ['See you!', 'Nice to meet you too.', 'Bye!', 'Later!'],
                        'correct_answer' => 'Nice to meet you too.',
                    ],
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Respon umum untuk "How are you?" selain "I\'m great"?',
                        'options' => ['I am from Indonesia.', 'I am a teacher.', 'Not too bad.', 'My name is...'],
                        'correct_answer' => 'Not too bad.',
                    ],
                    [
                        'question_type' => 'fill_in_blank',
                        'question' => 'Lengkapi: "What about ___?"',
                        'options' => null,
                        'correct_answer' => 'you',
                    ],
                ],
            ],
            [
                'title' => 'Perkenalan Singkat',
                'order' => 3,
                'questions' => [
                    [
                        'question_type' => 'fill_in_blank',
                        'question' => 'Isi kalimat: "I ___ from Indonesia."',
                        'options' => null,
                        'correct_answer' => 'am',
                    ],
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Kalimat mana yang benar untuk memperkenalkan pekerjaan?',
                        'options' => ['I teacher.', 'I am teacher.', 'I am a teacher.', 'I teacher am.'],
                        'correct_answer' => 'I am a teacher.',
                    ],
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Apa arti kalimat "This is my friend"?',
                        'options' => ['Ini teman saya.', 'Itu rumah saya.', 'Saya baik-baik saja.', 'Ini keluarga saya.'],
                        'correct_answer' => 'Ini teman saya.',
                    ],
                    [
                        'question_type' => 'fill_in_blank',
                        'question' => 'Lengkapi: "Where ___ you from?"',
                        'options' => null,
                        'correct_answer' => 'are',
                    ],
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Apa arti "What do you do?"',
                        'options' => ['Apa yang kamu lakukan?', 'Apa pekerjaanmu?', 'Kamu dari mana?', 'Kamu mau kemana?'],
                        'correct_answer' => 'Apa pekerjaanmu?',
                    ],
                ],
            ],
            [
                'title' => 'Perpisahan & Sampai Jumpa',
                'order' => 4,
                'questions' => [
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Apa cara paling umum untuk mengucapkan "selamat tinggal"?',
                        'options' => ['Hello', 'Goodbye', 'Good morning', 'Thank you'],
                        'correct_answer' => 'Goodbye',
                    ],
                    [
                        'question_type' => 'fill_in_blank',
                        'question' => 'Lengkapi: "See you ___!"',
                        'options' => null,
                        'correct_answer' => 'later',
                    ],
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Apa yang Anda ucapkan kepada seseorang di malam hari sebelum tidur?',
                        'options' => ['Good evening', 'Good night', 'Good day', 'So long'],
                        'correct_answer' => 'Good night',
                    ],
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Frasa "Take care" berarti...',
                        'options' => ['Hati-hati', 'Cepatlah', 'Sampai jumpa', 'Tidak masalah'],
                        'correct_answer' => 'Hati-hati',
                    ],
                    [
                        'question_type' => 'fill_in_blank',
                        'question' => 'Lengkapi: "Have a nice ___!"',
                        'options' => null,
                        'correct_answer' => 'day',
                    ],
                ],
            ],
            [
                'title' => 'Frasa Kesopanan (Tolong, Maaf)',
                'order' => 5,
                'questions' => [
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Apa bahasa Inggris untuk "Tolong"?',
                        'options' => ['Please', 'Sorry', 'Thanks', 'Maybe'],
                        'correct_answer' => 'Please',
                    ],
                    [
                        'question_type' => 'fill_in_blank',
                        'question' => 'Lengkapi: "I am ___ for being late."',
                        'options' => null,
                        'correct_answer' => 'sorry',
                    ],
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Bagaimana Anda mengatakan "Sama-sama" sebagai balasan "Thank you"?',
                        'options' => ['You are welcome', 'Yes, please', 'Not at all', 'I am sorry'],
                        'correct_answer' => 'You are welcome',
                    ],
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Apa arti "Excuse me"?',
                        'options' => ['Permisi', 'Tentu saja', 'Saya tidak tahu', 'Tidak apa-apa'],
                        'correct_answer' => 'Permisi',
                    ],
                    [
                        'question_type' => 'fill_in_blank',
                        'question' => 'Lengkapi: "___ you for your help."',
                        'options' => null,
                        'correct_answer' => 'Thank',
                    ],
                ],
            ],
        ],
    ],
    // --- Modul 2 ---
    [
        'title' => 'Rutinitas Sehari-hari',
        'description' => 'Bangun kebiasaan menggunakan bahasa Inggris dalam aktivitas harian seperti ngopi, belanja, dan menjadwalkan rencana.',
        'order' => 2,
        'lessons' => [
            [
                'title' => 'Ngopi di Kafe',
                'order' => 1,
                'questions' => [
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Apa arti kalimat "Can I get a cup of coffee?"',
                        'options' => ['Bisakah saya mendapatkan secangkir kopi?', 'Bolehkah saya duduk di sini?', 'Apakah kopi ini panas?', 'Dimana kasirnya?'],
                        'correct_answer' => 'Bisakah saya mendapatkan secangkir kopi?',
                    ],
                    [
                        'question_type' => 'fill_in_blank',
                        'question' => 'Lengkapi: "I\'d like ___ latte, please."',
                        'options' => null,
                        'correct_answer' => 'a',
                    ],
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Manakah respon barista yang paling sopan?',
                        'options' => ['Here.', 'Sure, coming right up!', 'Wait.', 'No.'],
                        'correct_answer' => 'Sure, coming right up!',
                    ],
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Apa yang Anda tanyakan jika ingin kopi tanpa kafein?',
                        'options' => ['Can I get a decaf?', 'Can I get extra hot?', 'Is this coffee sweet?', 'Do you have sugar?'],
                        'correct_answer' => 'Can I get a decaf?',
                    ],
                    [
                        'question_type' => 'fill_in_blank',
                        'question' => 'Lengkapi: "Is this for here or to ___?"',
                        'options' => null,
                        'correct_answer' => 'go',
                    ],
                ],
            ],
            [
                'title' => 'Belanja Mingguan',
                'order' => 2,
                'questions' => [
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Kalimat mana yang tepat untuk menanyakan harga?',
                        'options' => ['How much is this?', 'Where is this?', 'Who is this?', 'Why is this?'],
                        'correct_answer' => 'How much is this?',
                    ],
                    [
                        'question_type' => 'fill_in_blank',
                        'question' => 'Lengkapi kalimat: "Do you ___ any discounts today?"',
                        'options' => null,
                        'correct_answer' => 'have',
                    ],
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Apa arti "I\'m just looking around"?',
                        'options' => ['Saya sedang mencari sekitar.', 'Saya hanya melihat-lihat.', 'Saya akan membeli ini.', 'Saya sedang menunggu.'],
                        'correct_answer' => 'Saya hanya melihat-lihat.',
                    ],
                    [
                        'question_type' => 'fill_in_blank',
                        'question' => 'Lengkapi: "Where can I find the ___ (susu)?"',
                        'options' => null,
                        'correct_answer' => 'milk',
                    ],
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Apa sebutan untuk tempat Anda membayar belanjaan?',
                        'options' => ['The entrance', 'The aisle', 'The checkout', 'The parking lot'],
                        'correct_answer' => 'The checkout',
                    ],
                ],
            ],
            [
                'title' => 'Menentukan Jadwal',
                'order' => 3,
                'questions' => [
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Kalimat mana yang digunakan untuk mengatur pertemuan?',
                        'options' => ['Let\'s catch up on Friday.', 'Catch you later.', 'Good night.', 'Take care.'],
                        'correct_answer' => 'Let\'s catch up on Friday.',
                    ],
                    [
                        'question_type' => 'fill_in_blank',
                        'question' => 'Lengkapi: "What time ___ best for you?"',
                        'options' => null,
                        'correct_answer' => 'works',
                    ],
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Apa arti "Let\'s reschedule"?',
                        'options' => ['Ayo lanjutkan sekarang.', 'Mari membatalkan selamanya.', 'Mari menjadwalkan ulang.', 'Ayo akhiri rapat ini.'],
                        'correct_answer' => 'Mari menjadwalkan ulang.',
                    ],
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Bagaimana Anda mengatakan "Saya sibuk hari Senin"?',
                        'options' => ['I am busy on Monday.', 'I am free on Monday.', 'I like Monday.', 'Monday is good.'],
                        'correct_answer' => 'I am busy on Monday.',
                    ],
                    [
                        'question_type' => 'fill_in_blank',
                        'question' => 'Lengkapi: "Are you free ___ Tuesday afternoon?"',
                        'options' => null,
                        'correct_answer' => 'on',
                    ],
                ],
            ],
            [
                'title' => 'Aktivitas Pagi Hari',
                'order' => 4,
                'questions' => [
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Apa bahasa Inggris untuk "bangun tidur"?',
                        'options' => ['Go to sleep', 'Wake up', 'Eat breakfast', 'Take a shower'],
                        'correct_answer' => 'Wake up',
                    ],
                    [
                        'question_type' => 'fill_in_blank',
                        'question' => 'Lengkapi: "I ___ my teeth every morning."',
                        'options' => null,
                        'correct_answer' => 'brush',
                    ],
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Apa arti "to get dressed"?',
                        'options' => ['Mandi', 'Sarapan', 'Berpakaian', 'Pergi bekerja'],
                        'correct_answer' => 'Berpakaian',
                    ],
                    [
                        'question_type' => 'fill_in_blank',
                        'question' => 'Lengkapi: "What time do you usually ___ breakfast?"',
                        'options' => null,
                        'correct_answer' => 'have',
                    ],
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Apa arti "commute to work"?',
                        'options' => ['Perjalanan ke tempat kerja', 'Mulai bekerja', 'Selesai bekerja', 'Makan siang di kantor'],
                        'correct_answer' => 'Perjalanan ke tempat kerja',
                    ],
                ],
            ],
            [
                'title' => 'Aktivitas Malam Hari',
                'order' => 5,
                'questions' => [
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Apa bahasa Inggris untuk "makan malam"?',
                        'options' => ['Breakfast', 'Lunch', 'Dinner', 'Snack'],
                        'correct_answer' => 'Dinner',
                    ],
                    [
                        'question_type' => 'fill_in_blank',
                        'question' => 'Lengkapi: "I like to ___ TV in the evening."',
                        'options' => null,
                        'correct_answer' => 'watch',
                    ],
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Apa arti "go to bed"?',
                        'options' => ['Pergi tidur', 'Bangun tidur', 'Membaca buku', 'Makan malam'],
                        'correct_answer' => 'Pergi tidur',
                    ],
                    [
                        'question_type' => 'fill_in_blank',
                        'question' => 'Lengkapi: "Before sleeping, I ___ a book."',
                        'options' => null,
                        'correct_answer' => 'read',
                    ],
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Apa arti "I feel tired"?',
                        'options' => ['Saya merasa lapar.', 'Saya merasa lelah.', 'Saya merasa senang.', 'Saya merasa sedih.'],
                        'correct_answer' => 'Saya merasa lelah.',
                    ],
                ],
            ],
        ],
    ],
    // --- Modul 3 ---
    [
        'title' => 'Cerita & Ekspresi',
        'description' => 'Belajar menggambarkan pengalaman, mengekspresikan opini, dan menceritakan kembali peristiwa penting.',
        'order' => 3,
        'lessons' => [
            [
                'title' => 'Menceritakan Pengalaman',
                'order' => 1,
                'questions' => [
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Kalimat mana yang menggambarkan pengalaman lampau?',
                        'options' => ['I go to Bali.', 'I am going to Bali.', 'I went to Bali last year.', 'I will go to Bali.'],
                        'correct_answer' => 'I went to Bali last year.',
                    ],
                    [
                        'question_type' => 'fill_in_blank',
                        'question' => 'Lengkapi: "We ___ amazing food during the trip."',
                        'options' => null,
                        'correct_answer' => 'had',
                    ],
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Apa arti "It was unforgettable"?',
                        'options' => ['Itu tak terlupakan.', 'Itu biasa saja.', 'Itu sudah terlambat.', 'Itu tidak mungkin.'],
                        'correct_answer' => 'Itu tak terlupakan.',
                    ],
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Kata "before" menunjukkan...',
                        'options' => ['Masa depan', 'Masa kini', 'Masa lalu', 'Sebuah tempat'],
                        'correct_answer' => 'Masa lalu',
                    ],
                    [
                        'question_type' => 'fill_in_blank',
                        'question' => 'Lengkapi: "I ___ (see) that movie last week."',
                        'options' => null,
                        'correct_answer' => 'saw',
                    ],
                ],
            ],
            [
                'title' => 'Mengungkapkan Opini',
                'order' => 2,
                'questions' => [
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Kalimat mana yang menyatakan pendapat pribadi?',
                        'options' => ['In my opinion, we should rest.', 'Could you pass the salt?', 'Do you know the answer?', 'The door is open.'],
                        'correct_answer' => 'In my opinion, we should rest.',
                    ],
                    [
                        'question_type' => 'fill_in_blank',
                        'question' => 'Lengkapi: "I strongly ___ that exercise helps focus."',
                        'options' => null,
                        'correct_answer' => 'believe',
                    ],
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Apa arti "That\'s a great point"?',
                        'options' => ['Itu ide yang buruk.', 'Itu poin yang bagus.', 'Itu terlalu jauh.', 'Itu tidak penting.'],
                        'correct_answer' => 'Itu poin yang bagus.',
                    ],
                    [
                        'question_type' => 'fill_in_blank',
                        'question' => 'Lengkapi: "I ___ with you." (Saya setuju denganmu)',
                        'options' => null,
                        'correct_answer' => 'agree',
                    ],
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Bagaimana cara sopan untuk tidak setuju?',
                        'options' => ['You are wrong.', 'That is stupid.', 'I\'m afraid I disagree.', 'I don\'t like it.'],
                        'correct_answer' => 'I\'m afraid I disagree.',
                    ],
                ],
            ],
            [
                'title' => 'Merangkum Cerita',
                'order' => 3,
                'questions' => [
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Kalimat mana yang tepat untuk mengakhiri cerita?',
                        'options' => ['That\'s why I hate it.', 'And that\'s how it ended.', 'I do not know.', 'Forget about it.'],
                        'correct_answer' => 'And that\'s how it ended.',
                    ],
                    [
                        'question_type' => 'fill_in_blank',
                        'question' => 'Lengkapi: "To ___ up, the event inspired everyone."',
                        'options' => null,
                        'correct_answer' => 'sum',
                    ],
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Apa arti "The main takeaway is…"?',
                        'options' => ['Kesimpulan utamanya adalah…', 'Ini bagian tersulit…', 'Saya lupa bagian utama…', 'Ini bukan bagian penting…'],
                        'correct_answer' => 'Kesimpulan utamanya adalah…',
                    ],
                    [
                        'question_type' => 'fill_in_blank',
                        'question' => 'Lengkapi: "In ___, it was a successful trip." (Singkatnya, ...)',
                        'options' => null,
                        'correct_answer' => 'short',
                    ],
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Kata "Overall" paling sering digunakan di...',
                        'options' => ['Awal cerita', 'Tengah cerita', 'Akhir cerita (kesimpulan)', 'Judul cerita'],
                        'correct_answer' => 'Akhir cerita (kesimpulan)',
                    ],
                ],
            ],
            [
                'title' => 'Mengungkapkan Perasaan',
                'order' => 4,
                'questions' => [
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Jika seseorang memenangkan lotre, mereka merasa...',
                        'options' => ['Sad', 'Angry', 'Excited', 'Bored'],
                        'correct_answer' => 'Excited',
                    ],
                    [
                        'question_type' => 'fill_in_blank',
                        'question' => 'Lengkapi: "I feel ___ because I lost my keys."',
                        'options' => null,
                        'correct_answer' => 'frustrated',
                    ],
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Apa arti "I\'m nervous"?',
                        'options' => ['Saya marah', 'Saya sedih', 'Saya gugup', 'Saya lelah'],
                        'correct_answer' => 'Saya gugup',
                    ],
                    [
                        'question_type' => 'fill_in_blank',
                        'question' => 'Lengkapi: "This movie is so ___. (membosankan)"',
                        'options' => null,
                        'correct_answer' => 'boring',
                    ],
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Apa arti "surprised"?',
                        'options' => ['Terkejut', 'Takut', 'Malu', 'Senang'],
                        'correct_answer' => 'Terkejut',
                    ],
                ],
            ],
            [
                'title' => 'Membuat Perbandingan',
                'order' => 5,
                'questions' => [
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Kalimat mana yang membandingkan dua hal?',
                        'options' => ['This car is fast.', 'This car is faster than that car.', 'This car is very fast.', 'That is a car.'],
                        'correct_answer' => 'This car is faster than that car.',
                    ],
                    [
                        'question_type' => 'fill_in_blank',
                        'question' => 'Lengkapi: "This book is ___ interesting than the movie."',
                        'options' => null,
                        'correct_answer' => 'more',
                    ],
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Bentuk komparatif dari "good" adalah...',
                        'options' => ['Gooder', 'More good', 'Better', 'Best'],
                        'correct_answer' => 'Better',
                    ],
                    [
                        'question_type' => 'fill_in_blank',
                        'question' => 'Lengkapi: "She is as ___ as her sister." (sama tinggi)',
                        'options' => null,
                        'correct_answer' => 'tall',
                    ],
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Apa arti "the same as"?',
                        'options' => ['Berbeda dari', 'Lebih baik dari', 'Lebih buruk dari', 'Sama dengan'],
                        'correct_answer' => 'Sama dengan',
                    ],
                ],
            ],
        ],
    ],
    // --- Modul 4 ---
    [
        'title' => 'Bepergian & Arah',
        'description' => 'Pelajari cara menanyakan arah, menggunakan transportasi umum, dan berinteraksi saat bepergian.',
        'order' => 4,
        'lessons' => [
            [
                'title' => 'Menanyakan Arah',
                'order' => 1,
                'questions' => [
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Apa arti "Excuse me, where is the nearest station?"',
                        'options' => ['Permisi, di mana stasiun terdekat?', 'Permisi, jam berapa kereta datang?', 'Maaf, apakah Anda perlu bantuan?', 'Maaf, stasiun ini tutup.'],
                        'correct_answer' => 'Permisi, di mana stasiun terdekat?',
                    ],
                    [
                        'question_type' => 'fill_in_blank',
                        'question' => 'Lengkapi: "Could you tell me how to ___ to the museum?"',
                        'options' => null,
                        'correct_answer' => 'get',
                    ],
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Kalimat mana yang digunakan untuk memberi arah "belok kiri"?',
                        'options' => ['Go straight.', 'Turn right.', 'It\'s on the corner.', 'Turn left.'],
                        'correct_answer' => 'Turn left.',
                    ],
                    [
                        'question_type' => 'fill_in_blank',
                        'question' => 'Lengkapi: "Go ___ ahead for two blocks."',
                        'options' => null,
                        'correct_answer' => 'straight',
                    ],
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Apa arti "It\'s across the street"?',
                        'options' => ['Itu di tikungan.', 'Itu di seberang jalan.', 'Itu di sebelah bank.', 'Itu di belakang Anda.'],
                        'correct_answer' => 'Itu di seberang jalan.',
                    ],
                ],
            ],
            [
                'title' => 'Menggunakan Transportasi Umum',
                'order' => 2,
                'questions' => [
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Apa arti "A one-way ticket to London, please."?',
                        'options' => ['Tolong, satu tiket pulang-pergi ke London.', 'Tolong, satu tiket sekali jalan ke London.', 'Apakah ini jalan ke London?', 'Saya mau pergi dari London.'],
                        'correct_answer' => 'Tolong, satu tiket sekali jalan ke London.',
                    ],
                    [
                        'question_type' => 'fill_in_blank',
                        'question' => 'Lengkapi: "What time does the next bus ___?"',
                        'options' => null,
                        'correct_answer' => 'arrive',
                    ],
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Di mana Anda biasanya menunggu kereta?',
                        'options' => ['On the platform.', 'In the lobby.', 'At the gate.', 'On the street.'],
                        'correct_answer' => 'On the platform.',
                    ],
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Apa kebalikan dari "one-way ticket"?',
                        'options' => ['A single ticket', 'A return ticket', 'A free ticket', 'An expensive ticket'],
                        'correct_answer' => 'A return ticket',
                    ],
                    [
                        'question_type' => 'fill_in_blank',
                        'question' => 'Lengkapi: "Does this bus ___ to the city center?"',
                        'options' => null,
                        'correct_answer' => 'go',
                    ],
                ],
            ],
            [
                'title' => 'Check-in di Hotel',
                'order' => 3,
                'questions' => [
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Kalimat apa yang Anda gunakan untuk check-in?',
                        'options' => ['I\'d like to check out.', 'I have a reservation under the name... Rian.', 'Can I order room service?', 'What time is breakfast?'],
                        'correct_answer' => 'I have a reservation under the name... Rian.',
                    ],
                    [
                        'question_type' => 'fill_in_blank',
                        'question' => 'Lengkapi: "What time is ___? I need to leave by 11 AM."',
                        'options' => null,
                        'correct_answer' => 'checkout',
                    ],
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Apa arti "Can I have the Wi-Fi password?"',
                        'options' => ['Bolehkah saya minta kata sandi Wi-Fi?', 'Apakah Wi-Fi di sini gratis?', 'Di mana saya bisa menemukan Wi-Fi?', 'Bisakah Anda memperbaiki Wi-Fi?'],
                        'correct_answer' => 'Bolehkah saya minta kata sandi Wi-Fi?',
                    ],
                    [
                        'question_type' => 'fill_in_blank',
                        'question' => 'Lengkapi: "Do you have a room with a ___ view?" (pemandangan laut)',
                        'options' => null,
                        'correct_answer' => 'sea',
                    ],
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Apa arti "room service"?',
                        'options' => ['Layanan kebersihan kamar', 'Layanan antar makanan ke kamar', 'Layanan resepsionis', 'Layanan laundry'],
                        'correct_answer' => 'Layanan antar makanan ke kamar',
                    ],
                ],
            ],
            [
                'title' => 'Di Bandara',
                'order' => 4,
                'questions' => [
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Apa sebutan untuk tas yang Anda bawa ke kabin pesawat?',
                        'options' => ['Baggage', 'Suitcase', 'Carry-on', 'Check-in'],
                        'correct_answer' => 'Carry-on',
                    ],
                    [
                        'question_type' => 'fill_in_blank',
                        'question' => 'Lengkapi: "Here is my ___. (dokumen untuk naik pesawat)"',
                        'options' => null,
                        'correct_answer' => 'boarding pass',
                    ],
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Di mana Anda menunggu pesawat sebelum naik?',
                        'options' => ['At the gate', 'At the check-in counter', 'At security', 'At baggage claim'],
                        'correct_answer' => 'At the gate',
                    ],
                    [
                        'question_type' => 'fill_in_blank',
                        'question' => 'Lengkapi: "My flight has been ___ (ditunda)."',
                        'options' => null,
                        'correct_answer' => 'delayed',
                    ],
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Apa arti "baggage claim"?',
                        'options' => ['Pemeriksaan keamanan', 'Konter check-in', 'Tempat pengambilan bagasi', 'Ruang tunggu'],
                        'correct_answer' => 'Tempat pengambilan bagasi',
                    ],
                ],
            ],
            [
                'title' => 'Menyewa Mobil',
                'order' => 5,
                'questions' => [
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Apa bahasa Inggris untuk "surat izin mengemudi"?',
                        'options' => ['Car key', 'Passport', 'Driver\'s license', 'Insurance'],
                        'correct_answer' => 'Driver\'s license',
                    ],
                    [
                        'question_type' => 'fill_in_blank',
                        'question' => 'Lengkapi: "I\'d like to ___ a car for three days."',
                        'options' => null,
                        'correct_answer' => 'rent',
                    ],
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Apa arti "unlimited mileage"?',
                        'options' => ['Bensin gratis', 'Jarak tempuh tak terbatas', 'Mobil baru', 'Asuransi penuh'],
                        'correct_answer' => 'Jarak tempuh tak terbatas',
                    ],
                    [
                        'question_type' => 'fill_in_blank',
                        'question' => 'Lengkapi: "Does the car come with ___? (GPS)"',
                        'options' => null,
                        'correct_answer' => 'GPS',
                    ],
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Apa yang Anda perlukan untuk mengisi bensin mobil?',
                        'options' => ['A mechanic', 'A gas station', 'A parking lot', 'A car wash'],
                        'correct_answer' => 'A gas station',
                    ],
                ],
            ],
        ],
    ],
    // --- Modul 5 ---
    [
        'title' => 'Makanan & Restoran',
        'description' => 'Percaya diri memesan makanan, membicarakan selera, dan membayar tagihan di restoran.',
        'order' => 5,
        'lessons' => [
            [
                'title' => 'Memesan Makanan',
                'order' => 1,
                'questions' => [
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Apa arti "Can I see the menu, please?"',
                        'options' => ['Bolehkah saya melihat menunya?', 'Bisakah Anda membawakannya untuk saya?', 'Apakah menunya ada di sana?', 'Tolong ambilkan menunya.'],
                        'correct_answer' => 'Bolehkah saya melihat menunya?',
                    ],
                    [
                        'question_type' => 'fill_in_blank',
                        'question' => 'Lengkapi: "I\'d like to ___ the chicken sandwich."',
                        'options' => null,
                        'correct_answer' => 'order',
                    ],
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Kalimat mana yang digunakan jika Anda siap memesan?',
                        'options' => ['We are ready to order.', 'We are finished.', 'We are looking.', 'We want to pay.'],
                        'correct_answer' => 'We are ready to order.',
                    ],
                    [
                        'question_type' => 'fill_in_blank',
                        'question' => 'Lengkapi: "What do you ___? (rekomendasikan)"',
                        'options' => null,
                        'correct_answer' => 'recommend',
                    ],
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Apa arti "appetizer"?',
                        'options' => ['Makanan penutup', 'Minuman', 'Makanan pembuka', 'Makanan utama'],
                        'correct_answer' => 'Makanan pembuka',
                    ],
                ],
            ],
            [
                'title' => 'Membicarakan Makanan',
                'order' => 2,
                'questions' => [
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Apa arti "This soup is delicious!"?',
                        'options' => ['Sup ini panas!', 'Sup ini lezat!', 'Sup ini terlalu asin!', 'Sup ini dingin!'],
                        'correct_answer' => 'Sup ini lezat!',
                    ],
                    [
                        'question_type' => 'fill_in_blank',
                        'question' => 'Lengkapi: "My food is too ___. Can I have some water?"',
                        'options' => null,
                        'correct_answer' => 'spicy',
                    ],
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Bagaimana Anda mengatakan "Saya alergi kacang"?',
                        'options' => ['I don\'t like nuts.', 'I am allergic to nuts.', 'I want nuts.', 'I hate nuts.'],
                        'correct_answer' => 'I am allergic to nuts.',
                    ],
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Apa lawan kata dari "sweet" (manis)?',
                        'options' => ['Sour', 'Salty', 'Spicy', 'Bitter'],
                        'correct_answer' => 'Sour',
                    ],
                    [
                        'question_type' => 'fill_in_blank',
                        'question' => 'Lengkapi: "This meat is very ___. (empuk)"',
                        'options' => null,
                        'correct_answer' => 'tender',
                    ],
                ],
            ],
            [
                'title' => 'Membayar Tagihan',
                'order' => 3,
                'questions' => [
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Kalimat apa untuk meminta tagihan?',
                        'options' => ['Could we have the bill, please?', 'Where is the money?', 'Can I have more food?', 'The food is ready.'],
                        'correct_answer' => 'Could we have the bill, please?',
                    ],
                    [
                        'question_type' => 'fill_in_blank',
                        'question' => 'Lengkapi: "Do you accept credit ___?"',
                        'options' => null,
                        'correct_answer' => 'cards',
                    ],
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Apa arti "Let\'s split the bill"?',
                        'options' => ['Ayo kita bayar masing-masing.', 'Ayo kita pergi dari sini.', 'Tagihannya salah.', 'Kamu yang bayar tagihannya.'],
                        'correct_answer' => 'Ayo kita bayar masing-masing.',
                    ],
                    [
                        'question_type' => 'fill_in_blank',
                        'question' => 'Lengkapi: "Is the ___ included?" (uang jasa)',
                        'options' => null,
                        'correct_answer' => 'service',
                    ],
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Apa sebutan lain untuk "bill" di Amerika?',
                        'options' => ['The check', 'The menu', 'The order', 'The card'],
                        'correct_answer' => 'The check',
                    ],
                ],
            ],
            [
                'title' => 'Peralatan Makan',
                'order' => 4,
                'questions' => [
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Apa yang Anda gunakan untuk memotong steak?',
                        'options' => ['A spoon', 'A fork', 'A knife', 'A napkin'],
                        'correct_answer' => 'A knife',
                    ],
                    [
                        'question_type' => 'fill_in_blank',
                        'question' => 'Lengkapi: "I need a ___ to eat my soup."',
                        'options' => null,
                        'correct_answer' => 'spoon',
                    ],
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Apa bahasa Inggris untuk "garpu"?',
                        'options' => ['Fork', 'Plate', 'Glass', 'Cup'],
                        'correct_answer' => 'Fork',
                    ],
                    [
                        'question_type' => 'fill_in_blank',
                        'question' => 'Lengkapi: "Could I have a ___ of water, please?"',
                        'options' => null,
                        'correct_answer' => 'glass',
                    ],
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Apa arti "napkin"?',
                        'options' => ['Piring', 'Gelas', 'Serbet', 'Sendok'],
                        'correct_answer' => 'Serbet',
                    ],
                ],
            ],
            [
                'title' => 'Memasak di Rumah',
                'order' => 5,
                'questions' => [
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Apa arti "to boil water"?',
                        'options' => ['Mendinginkan air', 'Merebus air', 'Memotong air', 'Menggoreng air'],
                        'correct_answer' => 'Merebus air',
                    ],
                    [
                        'question_type' => 'fill_in_blank',
                        'question' => 'Lengkapi: "You need to ___ the vegetables first." (memotong)',
                        'options' => null,
                        'correct_answer' => 'chop',
                    ],
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Metode memasak apa yang menggunakan minyak panas?',
                        'options' => ['Boil', 'Bake', 'Fry', 'Steam'],
                        'correct_answer' => 'Fry',
                    ],
                    [
                        'question_type' => 'fill_in_blank',
                        'question' => 'Lengkapi: "The ___ (resep) says to add two eggs."',
                        'options' => null,
                        'correct_answer' => 'recipe',
                    ],
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Apa arti "oven"?',
                        'options' => ['Kulkas', 'Kompor', 'Oven (panggangan)', 'Blender'],
                        'correct_answer' => 'Oven (panggangan)',
                    ],
                ],
            ],
        ],
    ],
    // --- Modul 6 ---
    [
        'title' => 'Keluarga & Teman',
        'description' => 'Mendeskripsikan anggota keluarga dan hubungan pertemanan.',
        'order' => 6,
        'lessons' => [
            [
                'title' => 'Anggota Keluarga',
                'order' => 1,
                'questions' => [
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Apa bahasa Inggris untuk "saudara laki-laki"?',
                        'options' => ['Sister', 'Brother', 'Mother', 'Father'],
                        'correct_answer' => 'Brother',
                    ],
                    [
                        'question_type' => 'fill_in_blank',
                        'question' => 'Lengkapi: "My mother and father are my ___."',
                        'options' => null,
                        'correct_answer' => 'parents',
                    ],
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Apa bahasa Inggris untuk "nenek"?',
                        'options' => ['Grandfather', 'Grandmother', 'Mother', 'Aunt'],
                        'correct_answer' => 'Grandmother',
                    ],
                    [
                        'question_type' => 'fill_in_blank',
                        'question' => 'Lengkapi: "Your mother\'s sister is your ___."',
                        'options' => null,
                        'correct_answer' => 'aunt',
                    ],
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Anak dari paman/bibi Anda adalah...',
                        'options' => ['Niece', 'Nephew', 'Cousin', 'Sibling'],
                        'correct_answer' => 'Cousin',
                    ],
                ],
            ],
            [
                'title' => 'Mendeskripsikan Teman',
                'order' => 2,
                'questions' => [
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Apa arti "He is very kind"?',
                        'options' => ['Dia sangat malas.', 'Dia sangat tinggi.', 'Dia sangat baik.', 'Dia sangat lucu.'],
                        'correct_answer' => 'Dia sangat baik.',
                    ],
                    [
                        'question_type' => 'fill_in_blank',
                        'question' => 'Lengkapi: "My best ___ lives next to me."',
                        'options' => null,
                        'correct_answer' => 'friend',
                    ],
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Apa arti "loyal"?',
                        'options' => ['Setia', 'Lucu', 'Pintar', 'Kaya'],
                        'correct_answer' => 'Setia',
                    ],
                    [
                        'question_type' => 'fill_in_blank',
                        'question' => 'Lengkapi: "We have been friends ___ ten years."',
                        'options' => null,
                        'correct_answer' => 'for',
                    ],
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Apa arti "funny"?',
                        'options' => ['Lucu', 'Sedih', 'Marah', 'Serius'],
                        'correct_answer' => 'Lucu',
                    ],
                ],
            ],
            [
                'title' => 'Status Hubungan',
                'order' => 3,
                'questions' => [
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Apa bahasa Inggris untuk "menikah"?',
                        'options' => ['Single', 'Married', 'Engaged', 'Divorced'],
                        'correct_answer' => 'Married',
                    ],
                    [
                        'question_type' => 'fill_in_blank',
                        'question' => 'Lengkapi: "They are ___ (bertunangan)."',
                        'options' => null,
                        'correct_answer' => 'engaged',
                    ],
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Jika seseorang belum menikah, dia...',
                        'options' => ['Single', 'Widowed', 'Married', 'Engaged'],
                        'correct_answer' => 'Single',
                    ],
                    [
                        'question_type' => 'fill_in_blank',
                        'question' => 'Lengkapi: "My ___ (suami) is a doctor."',
                        'options' => null,
                        'correct_answer' => 'husband',
                    ],
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Apa bahasa Inggris untuk "istri"?',
                        'options' => ['Wife', 'Partner', 'Girlfriend', 'Fiancée'],
                        'correct_answer' => 'Wife',
                    ],
                ],
            ],
            [
                'title' => 'Mendeskripsikan Penampilan',
                'order' => 4,
                'questions' => [
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Apa arti "She has long hair"?',
                        'options' => ['Dia memiliki rambut pendek.', 'Dia memiliki rambut panjang.', 'Dia memiliki rambut keriting.', 'Dia memiliki rambut pirang.'],
                        'correct_answer' => 'Dia memiliki rambut panjang.',
                    ],
                    [
                        'question_type' => 'fill_in_blank',
                        'question' => 'Lengkapi: "He is very ___ (tinggi)."',
                        'options' => null,
                        'correct_answer' => 'tall',
                    ],
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Lawan kata dari "young" (muda) adalah...',
                        'options' => ['Old', 'Short', 'Tall', 'Strong'],
                        'correct_answer' => 'Old',
                    ],
                    [
                        'question_type' => 'fill_in_blank',
                        'question' => 'Lengkapi: "What does he ___ like?" (Seperti apa penampilannya?)',
                        'options' => null,
                        'correct_answer' => 'look',
                    ],
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Apa bahasa Inggris untuk "mata biru"?',
                        'options' => ['Blue eyes', 'Red eyes', 'Brown hair', 'Black hair'],
                        'correct_answer' => 'Blue eyes',
                    ],
                ],
            ],
            [
                'title' => 'Mendeskripsikan Kepribadian',
                'order' => 5,
                'questions' => [
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Jika seseorang suka berbicara, dia...',
                        'options' => ['Quiet', 'Shy', 'Talkative', 'Serious'],
                        'correct_answer' => 'Talkative',
                    ],
                    [
                        'question_type' => 'fill_in_blank',
                        'question' => 'Lengkapi: "She is always happy. She is very ___."',
                        'options' => null,
                        'correct_answer' => 'cheerful',
                    ],
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Apa arti "shy"?',
                        'options' => ['Pemalu', 'Percaya diri', 'Ramah', 'Jutek'],
                        'correct_answer' => 'Pemalu',
                    ],
                    [
                        'question_type' => 'fill_in_blank',
                        'question' => 'Lengkapi: "He always tells the truth. He is ___."',
                        'options' => null,
                        'correct_answer' => 'honest',
                    ],
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Lawan kata dari "polite" (sopan) adalah...',
                        'options' => ['Rude', 'Kind', 'Nice', 'Friendly'],
                        'correct_answer' => 'Rude',
                    ],
                ],
            ],
        ],
    ],
    // --- Modul 7 ---
    [
        'title' => 'Angka, Waktu, & Tanggal',
        'description' => 'Belajar menyebutkan angka, jam, dan tanggal dalam bahasa Inggris.',
        'order' => 7,
        'lessons' => [
            [
                'title' => 'Menyebutkan Waktu',
                'order' => 1,
                'questions' => [
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Bagaimana Anda mengatakan "Jam 3:30"?',
                        'options' => ['Three o\'clock', 'Half past three', 'Quarter to three', 'Three fifteen'],
                        'correct_answer' => 'Half past three',
                    ],
                    [
                        'question_type' => 'fill_in_blank',
                        'question' => 'Lengkapi: "The meeting is ___ 10 AM."',
                        'options' => null,
                        'correct_answer' => 'at',
                    ],
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Apa arti "It\'s a quarter past five"?',
                        'options' => ['Jam 5:15', 'Jam 5:45', 'Jam 4:45', 'Jam 5:30'],
                        'correct_answer' => 'Jam 5:15',
                    ],
                    [
                        'question_type' => 'fill_in_blank',
                        'question' => 'Lengkapi: "It\'s ten ___ (kurang) six." (Jam 5:50)',
                        'options' => null,
                        'correct_answer' => 'to',
                    ],
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Apa arti "noon"?',
                        'options' => ['Tengah malam', 'Tengah hari (jam 12 siang)', 'Pagi hari', 'Sore hari'],
                        'correct_answer' => 'Tengah hari (jam 12 siang)',
                    ],
                ],
            ],
            [
                'title' => 'Menyebutkan Tanggal',
                'order' => 2,
                'questions' => [
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Apa bahasa Inggris untuk "1 Januari"?',
                        'options' => ['January one', 'One of January', 'The first of January', 'January firsts'],
                        'correct_answer' => 'The first of January',
                    ],
                    [
                        'question_type' => 'fill_in_blank',
                        'question' => 'Lengkapi: "Today is ___ 10th." (10 Mei)',
                        'options' => null,
                        'correct_answer' => 'May',
                    ],
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Bagaimana Anda menulis "22nd"?',
                        'options' => ['Twenty-two', 'Twenty-second', 'Two-two', 'Twentieth-two'],
                        'correct_answer' => 'Twenty-second',
                    ],
                    [
                        'question_type' => 'fill_in_blank',
                        'question' => 'Lengkapi: "My birthday is ___ July 4th."',
                        'options' => null,
                        'correct_answer' => 'on',
                    ],
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Apa bahasa Inggris untuk "tahun"?',
                        'options' => ['Day', 'Month', 'Year', 'Week'],
                        'correct_answer' => 'Year',
                    ],
                ],
            ],
            [
                'title' => 'Angka 1-100',
                'order' => 3,
                'questions' => [
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Angka setelah "twelve" (12) adalah...',
                        'options' => ['Ten', 'Eleven', 'Thirteen', 'Twenty'],
                        'correct_answer' => 'Thirteen',
                    ],
                    [
                        'question_type' => 'fill_in_blank',
                        'question' => 'Lengkapi: "20" dalam bahasa Inggris adalah...',
                        'options' => null,
                        'correct_answer' => 'twenty',
                    ],
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Bagaimana Anda mengatakan "80"?',
                        'options' => ['Eighteen', 'Eighty', 'Eight', 'Eighth'],
                        'correct_answer' => 'Eighty',
                    ],
                    [
                        'question_type' => 'fill_in_blank',
                        'question' => 'Lengkapi: "55" adalah "fifty-___"',
                        'options' => null,
                        'correct_answer' => 'five',
                    ],
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Apa bahasa Inggris untuk "100"?',
                        'options' => ['One thousand', 'One hundred', 'Ten', 'One million'],
                        'correct_answer' => 'One hundred',
                    ],
                ],
            ],
            [
                'title' => 'Angka Besar (Ratusan, Ribuan)',
                'order' => 4,
                'questions' => [
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Bagaimana Anda mengatakan "500"?',
                        'options' => ['Five hundred', 'Five thousand', 'Fifty', 'Five zero zero'],
                        'correct_answer' => 'Five hundred',
                    ],
                    [
                        'question_type' => 'fill_in_blank',
                        'question' => 'Lengkapi: "1.000" adalah "one ___"',
                        'options' => null,
                        'correct_answer' => 'thousand',
                    ],
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Apa itu "2.500"?',
                        'options' => ['Two thousand fifty', 'Two hundred and fifty', 'Two thousand five hundred', 'Twenty-five thousand'],
                        'correct_answer' => 'Two thousand five hundred',
                    ],
                    [
                        'question_type' => 'fill_in_blank',
                        'question' => 'Lengkapi: "1.000.000" adalah "one ___"',
                        'options' => null,
                        'correct_answer' => 'million',
                    ],
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Bagaimana Anda mengatakan "305"?',
                        'options' => ['Three hundred five', 'Three zero five', 'Thirty-five', 'Three hundred fifty'],
                        'correct_answer' => 'Three hundred five',
                    ],
                ],
            ],
            [
                'title' => 'Hari & Bulan',
                'order' => 5,
                'questions' => [
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Hari setelah "Monday" (Senin) adalah...',
                        'options' => ['Sunday', 'Tuesday', 'Wednesday', 'Friday'],
                        'correct_answer' => 'Tuesday',
                    ],
                    [
                        'question_type' => 'fill_in_blank',
                        'question' => 'Lengkapi: "___ comes before April." (Bulan sebelum April)',
                        'options' => null,
                        'correct_answer' => 'March',
                    ],
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Apa bahasa Inggris untuk "akhir pekan"?',
                        'options' => ['Weekday', 'Weekend', 'Holiday', 'Yesterday'],
                        'correct_answer' => 'Weekend',
                    ],
                    [
                        'question_type' => 'fill_in_blank',
                        'question' => 'Lengkapi: "The last month of the year is ___."',
                        'options' => null,
                        'correct_answer' => 'December',
                    ],
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Bulan apa yang identik dengan "Hari Valentine"?',
                        'options' => ['January', 'February', 'October', 'December'],
                        'correct_answer' => 'February',
                    ],
                ],
            ],
        ],
    ],
    // --- Modul 8 ---
    [
        'title' => 'Hobi & Waktu Luang',
        'description' => 'Membicarakan aktivitas yang Anda nikmati di waktu luang.',
        'order' => 8,
        'lessons' => [
            [
                'title' => 'Aktivitas Populer',
                'order' => 1,
                'questions' => [
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Apa arti "I enjoy reading books"?',
                        'options' => ['Saya suka membaca buku.', 'Saya harus membaca buku.', 'Saya akan membaca buku.', 'Saya sedang membaca buku.'],
                        'correct_answer' => 'Saya suka membaca buku.',
                    ],
                    [
                        'question_type' => 'fill_in_blank',
                        'question' => 'Lengkapi: "What do you like ___ in your free time?"',
                        'options' => null,
                        'correct_answer' => 'doing',
                    ],
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Aktivitas apa yang biasanya dilakukan di dapur?',
                        'options' => ['Gardening', 'Swimming', 'Cooking', 'Hiking'],
                        'correct_answer' => 'Cooking',
                    ],
                    [
                        'question_type' => 'fill_in_blank',
                        'question' => 'Lengkapi: "I like to ___ to music."',
                        'options' => null,
                        'correct_answer' => 'listen',
                    ],
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Apa arti "playing video games"?',
                        'options' => ['Menonton TV', 'Bermain game video', 'Mendengarkan radio', 'Membaca komik'],
                        'correct_answer' => 'Bermain game video',
                    ],
                ],
            ],
            [
                'title' => 'Olahraga & Aktivitas Fisik',
                'order' => 2,
                'questions' => [
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Olahraga apa yang menggunakan bola dan keranjang?',
                        'options' => ['Soccer', 'Basketball', 'Tennis', 'Golf'],
                        'correct_answer' => 'Basketball',
                    ],
                    [
                        'question_type' => 'fill_in_blank',
                        'question' => 'Lengkapi: "I go ___ (berenang) every weekend."',
                        'options' => null,
                        'correct_answer' => 'swimming',
                    ],
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Apa arti "hiking"?',
                        'options' => ['Mendaki gunung/bukit', 'Bersepeda', 'Berlari', 'Berenang'],
                        'correct_answer' => 'Mendaki gunung/bukit',
                    ],
                    [
                        'question_type' => 'fill_in_blank',
                        'question' => 'Lengkapi: "Do you want to ___ soccer with us?"',
                        'options' => null,
                        'correct_answer' => 'play',
                    ],
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Di mana Anda biasanya "go skiing"?',
                        'options' => ['On the beach', 'In the mountains (with snow)', 'In the desert', 'In the city'],
                        'correct_answer' => 'In the mountains (with snow)',
                    ],
                ],
            ],
            [
                'title' => 'Aktivitas Kreatif',
                'order' => 3,
                'questions' => [
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Apa arti "painting"?',
                        'options' => ['Melukis', 'Menyanyi', 'Menari', 'Menulis'],
                        'correct_answer' => 'Melukis',
                    ],
                    [
                        'question_type' => 'fill_in_blank',
                        'question' => 'Lengkapi: "She likes to ___ the guitar."',
                        'options' => null,
                        'correct_answer' => 'play',
                    ],
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Aktivitas apa yang mengambil gambar?',
                        'options' => ['Photography', 'Dancing', 'Singing', 'Acting'],
                        'correct_answer' => 'Photography',
                    ],
                    [
                        'question_type' => 'fill_in_blank',
                        'question' => 'Lengkapi: "My hobby is ___ (menulis) stories."',
                        'options' => null,
                        'correct_answer' => 'writing',
                    ],
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Apa bahasa Inggris untuk "menari"?',
                        'options' => ['Singing', 'Drawing', 'Dancing', 'Cooking'],
                        'correct_answer' => 'Dancing',
                    ],
                ],
            ],
            [
                'title' => 'Aktivitas Relaksasi',
                'order' => 4,
                'questions' => [
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Apa arti "watching movies"?',
                        'options' => ['Menonton film', 'Membaca buku', 'Bermain game', 'Mendengarkan musik'],
                        'correct_answer' => 'Menonton film',
                    ],
                    [
                        'question_type' => 'fill_in_blank',
                        'question' => 'Lengkapi: "I like to ___ a nap in the afternoon." (tidur siang)',
                        'options' => null,
                        'correct_answer' => 'take',
                    ],
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Apa bahasa Inggris untuk "berkebun"?',
                        'options' => ['Gardening', 'Cleaning', 'Working', 'Studying'],
                        'correct_answer' => 'Gardening',
                    ],
                    [
                        'question_type' => 'fill_in_blank',
                        'question' => 'Lengkapi: "He finds yoga very ___."',
                        'options' => null,
                        'correct_answer' => 'relaxing',
                    ],
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Apa arti "hanging out with friends"?',
                        'options' => ['Berkumpul dengan teman', 'Bertengkar dengan teman', 'Bekerja dengan teman', 'Belajar dengan teman'],
                        'correct_answer' => 'Berkumpul dengan teman',
                    ],
                ],
            ],
            [
                'title' => 'Menyatakan Preferensi',
                'order' => 5,
                'questions' => [
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Bagaimana Anda mengatakan "Saya lebih suka teh"?',
                        'options' => ['I prefer tea.', 'I hate tea.', 'I want tea.', 'I have tea.'],
                        'correct_answer' => 'I prefer tea.',
                    ],
                    [
                        'question_type' => 'fill_in_blank',
                        'question' => 'Lengkapi: "I like swimming ___ (lebih dari) running."',
                        'options' => null,
                        'correct_answer' => 'more than',
                    ],
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Apa arti "I don\'t like..."?',
                        'options' => ['Saya tidak suka...', 'Saya sangat suka...', 'Saya benci...', 'Saya tidak peduli...'],
                        'correct_answer' => 'Saya tidak suka...',
                    ],
                    [
                        'question_type' => 'fill_in_blank',
                        'question' => 'Lengkapi: "My favorite hobby ___ painting."',
                        'options' => null,
                        'correct_answer' => 'is',
                    ],
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Apa arti "I\'m keen on..."?',
                        'options' => ['Saya tidak tertarik...', 'Saya sangat tertarik/suka...', 'Saya benci...', 'Saya tidak pernah...'],
                        'correct_answer' => 'Saya sangat tertarik/suka...',
                    ],
                ],
            ],
        ],
    ],
    // --- Modul 9 ---
    [
        'title' => 'Pekerjaan & Profesi',
        'description' => 'Mendeskripsikan apa yang Anda lakukan untuk pekerjaan.',
        'order' => 9,
        'lessons' => [
            [
                'title' => 'Jenis Pekerjaan',
                'order' => 1,
                'questions' => [
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Siapa yang bekerja di rumah sakit?',
                        'options' => ['A teacher', 'A pilot', 'A doctor', 'A chef'],
                        'correct_answer' => 'A doctor',
                    ],
                    [
                        'question_type' => 'fill_in_blank',
                        'question' => 'Lengkapi: "She works ___ an engineer."',
                        'options' => null,
                        'correct_answer' => 'as',
                    ],
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Siapa yang mengajar murid di sekolah?',
                        'options' => ['A farmer', 'A teacher', 'A singer', 'A police officer'],
                        'correct_answer' => 'A teacher',
                    ],
                    [
                        'question_type' => 'fill_in_blank',
                        'question' => 'Lengkapi: "A ___ (koki) works in a restaurant."',
                        'options' => null,
                        'correct_answer' => 'chef',
                    ],
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Siapa yang menerbangkan pesawat?',
                        'options' => ['A pilot', 'A driver', 'A sailor', 'A doctor'],
                        'correct_answer' => 'A pilot',
                    ],
                ],
            ],
            [
                'title' => 'Tempat Kerja',
                'order' => 2,
                'questions' => [
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Apa bahasa Inggris untuk "kantor"?',
                        'options' => ['Office', 'School', 'Hospital', 'Restaurant'],
                        'correct_answer' => 'Office',
                    ],
                    [
                        'question_type' => 'fill_in_blank',
                        'question' => 'Lengkapi: "A teacher works in a ___."',
                        'options' => null,
                        'correct_answer' => 'school',
                    ],
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Di mana "farmer" (petani) bekerja?',
                        'options' => ['On a farm', 'In a factory', 'In an office', 'On a ship'],
                        'correct_answer' => 'On a farm',
                    ],
                    [
                        'question_type' => 'fill_in_blank',
                        'question' => 'Lengkapi: "I work ___ home." (Saya bekerja dari rumah)',
                        'options' => null,
                        'correct_answer' => 'from',
                    ],
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Apa arti "factory"?',
                        'options' => ['Pabrik', 'Toko', 'Pasar', 'Bank'],
                        'correct_answer' => 'Pabrik',
                    ],
                ],
            ],
            [
                'title' => 'Rutinitas Kerja',
                'order' => 3,
                'questions' => [
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Apa arti "I have a meeting at 10 AM"?',
                        'options' => ['Saya ada rapat jam 10 pagi.', 'Saya selesai jam 10 pagi.', 'Saya mulai jam 10 pagi.', 'Saya libur jam 10 pagi.'],
                        'correct_answer' => 'Saya ada rapat jam 10 pagi.',
                    ],
                    [
                        'question_type' => 'fill_in_blank',
                        'question' => 'Lengkapi: "I usually ___ (cek) my emails in the morning."',
                        'options' => null,
                        'correct_answer' => 'check',
                    ],
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Kapan Anda biasanya "have lunch"?',
                        'options' => ['In the morning', 'Around noon', 'In the evening', 'At night'],
                        'correct_answer' => 'Around noon',
                    ],
                    [
                        'question_type' => 'fill_in_blank',
                        'question' => 'Lengkapi: "My ___ (rekan kerja) are very friendly."',
                        'options' => null,
                        'correct_answer' => 'colleagues',
                    ],
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Apa arti "deadline"?',
                        'options' => ['Batas waktu', 'Waktu istirahat', 'Waktu mulai', 'Gaji'],
                        'correct_answer' => 'Batas waktu',
                    ],
                ],
            ],
            [
                'title' => 'Mencari Pekerjaan',
                'order' => 4,
                'questions' => [
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Dokumen apa yang Anda kirim untuk melamar kerja?',
                        'options' => ['A resume (CV)', 'A passport', 'A menu', 'A bill'],
                        'correct_answer' => 'A resume (CV)',
                    ],
                    [
                        'question_type' => 'fill_in_blank',
                        'question' => 'Lengkapi: "I am looking for a ___." (pekerjaan)',
                        'options' => null,
                        'correct_answer' => 'job',
                    ],
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Apa arti "job interview"?',
                        'options' => ['Wawancara kerja', 'Penawaran kerja', 'Kontrak kerja', 'Deskripsi kerja'],
                        'correct_answer' => 'Wawancara kerja',
                    ],
                    [
                        'question_type' => 'fill_in_blank',
                        'question' => 'Lengkapi: "What is your previous ___? (pengalaman)"',
                        'options' => null,
                        'correct_answer' => 'experience',
                    ],
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Apa bahasa Inggris untuk "gaji"?',
                        'options' => ['Salary', 'Tax', 'Bonus', 'Benefit'],
                        'correct_answer' => 'Salary',
                    ],
                ],
            ],
            [
                'title' => 'Keterampilan Kerja',
                'order' => 5,
                'questions' => [
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Apa arti "teamwork"?',
                        'options' => ['Kerja tim', 'Kerja sendiri', 'Manajemen waktu', 'Memimpin'],
                        'correct_answer' => 'Kerja tim',
                    ],
                    [
                        'question_type' => 'fill_in_blank',
                        'question' => 'Lengkapi: "Good ___ (komunikasi) is very important."',
                        'options' => null,
                        'correct_answer' => 'communication',
                    ],
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Apa arti "problem-solving"?',
                        'options' => ['Membuat masalah', 'Menghindari masalah', 'Memecahkan masalah', 'Mencari masalah'],
                        'correct_answer' => 'Memecahkan masalah',
                    ],
                    [
                        'question_type' => 'fill_in_blank',
                        'question' => 'Lengkapi: "She has strong ___ (kepemimpinan) skills."',
                        'options' => null,
                        'correct_answer' => 'leadership',
                    ],
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Apa bahasa Inggris untuk "kreatif"?',
                        'options' => ['Creative', 'Critical', 'Punctual', 'Organized'],
                        'correct_answer' => 'Creative',
                    ],
                ],
            ],
        ],
    ],
    // --- Modul 10 ---
    [
        'title' => 'Cuaca & Musim',
        'description' => 'Membicarakan cuaca harian dan berbagai musim.',
        'order' => 10,
        'lessons' => [
            [
                'title' => 'Mendeskripsikan Cuaca',
                'order' => 1,
                'questions' => [
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Apa arti "It\'s raining outside"?',
                        'options' => ['Di luar berangin.', 'Di luar bersalju.', 'Di luar cerah.', 'Di luar sedang hujan.'],
                        'correct_answer' => 'Di luar sedang hujan.',
                    ],
                    [
                        'question_type' => 'fill_in_blank',
                        'question' => 'Lengkapi: "It\'s very ___ today, I need a jacket."',
                        'options' => null,
                        'correct_answer' => 'cold',
                    ],
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Lawan kata dari "hot" (panas) adalah...',
                        'options' => ['Warm', 'Cold', 'Sunny', 'Dry'],
                        'correct_answer' => 'Cold',
                    ],
                    [
                        'question_type' => 'fill_in_blank',
                        'question' => 'Lengkapi: "What\'s the ___ like today?" (Seperti apa cuacanya?)',
                        'options' => null,
                        'correct_answer' => 'weather',
                    ],
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Apa arti "It\'s sunny"?',
                        'options' => ['Cerah (matahari bersinar)', 'Berawan', 'Berkabut', 'Badai'],
                        'correct_answer' => 'Cerah (matahari bersinar)',
                    ],
                ],
            ],
            [
                'title' => 'Empat Musim',
                'order' => 2,
                'questions' => [
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Musim apa yang identik dengan salju?',
                        'options' => ['Summer', 'Winter', 'Spring', 'Autumn'],
                        'correct_answer' => 'Winter',
                    ],
                    [
                        'question_type' => 'fill_in_blank',
                        'question' => 'Lengkapi: "In ___, the weather is very hot." (musim panas)',
                        'options' => null,
                        'correct_answer' => 'summer',
                    ],
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Musim apa yang identik dengan bunga bermekaran?',
                        'options' => ['Spring', 'Summer', 'Autumn', 'Winter'],
                        'correct_answer' => 'Spring',
                    ],
                    [
                        'question_type' => 'fill_in_blank',
                        'question' => 'Lengkapi: "The leaves fall from the trees in ___." (musim gugur)',
                        'options' => null,
                        'correct_answer' => 'autumn',
                    ],
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Indonesia memiliki dua musim: "rainy" dan...',
                        'options' => ['Dry', 'Snowy', 'Cold', 'Windy'],
                        'correct_answer' => 'Dry',
                    ],
                ],
            ],
            [
                'title' => 'Fenomena Cuaca',
                'order' => 3,
                'questions' => [
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Apa bahasa Inggris untuk "badai"?',
                        'options' => ['Storm', 'Cloud', 'Fog', 'Wind'],
                        'correct_answer' => 'Storm',
                    ],
                    [
                        'question_type' => 'fill_in_blank',
                        'question' => 'Lengkapi: "I can see the ___ (petir)!"',
                        'options' => null,
                        'correct_answer' => 'lightning',
                    ],
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Apa arti "cloudy"?',
                        'options' => ['Berkabut', 'Berawan', 'Cerah', 'Basah'],
                        'correct_answer' => 'Berawan',
                    ],
                    [
                        'question_type' => 'fill_in_blank',
                        'question' => 'Lengkapi: "It is difficult to drive in thick ___ (kabut)."',
                        'options' => null,
                        'correct_answer' => 'fog',
                    ],
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Apa bahasa Inggris untuk "angin"?',
                        'options' => ['Wind', 'Rain', 'Snow', 'Sun'],
                        'correct_answer' => 'Wind',
                    ],
                ],
            ],
            [
                'title' => 'Suhu',
                'order' => 4,
                'questions' => [
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Apa arti "temperature"?',
                        'options' => ['Suhu', 'Cuaca', 'Musim', 'Derajat'],
                        'correct_answer' => 'Suhu',
                    ],
                    [
                        'question_type' => 'fill_in_blank',
                        'question' => 'Lengkapi: "It is 30 ___ (derajat) Celsius."',
                        'options' => null,
                        'correct_answer' => 'degrees',
                    ],
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Jika suhunya 0°C, air akan...',
                        'options' => ['Boil (mendidih)', 'Freeze (membeku)', 'Evaporate (menguap)', 'Melt (meleleh)'],
                        'correct_answer' => 'Freeze (membeku)',
                    ],
                    [
                        'question_type' => 'fill_in_blank',
                        'question' => 'Lengkapi: "It\'s ___ (sangat dingin) outside! Wear a coat."',
                        'options' => null,
                        'correct_answer' => 'freezing',
                    ],
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Apa arti "warm"?',
                        'options' => ['Hangat', 'Dingin', 'Panas', 'Sejuk'],
                        'correct_answer' => 'Hangat',
                    ],
                ],
            ],
            [
                'title' => 'Pakaian & Cuaca',
                'order' => 5,
                'questions' => [
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Apa yang Anda perlukan saat hujan?',
                        'options' => ['An umbrella', 'Sunglasses', 'A hat', 'Sandals'],
                        'correct_answer' => 'An umbrella',
                    ],
                    [
                        'question_type' => 'fill_in_blank',
                        'question' => 'Lengkapi: "You should wear ___ (kacamata hitam) when it\'s sunny."',
                        'options' => null,
                        'correct_answer' => 'sunglasses',
                    ],
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Apa yang Anda kenakan di musim dingin agar tetap hangat?',
                        'options' => ['A T-shirt', 'Shorts', 'A coat', 'A swimsuit'],
                        'correct_answer' => 'A coat',
                    ],
                    [
                        'question_type' => 'fill_in_blank',
                        'question' => 'Lengkapi: "I am wearing ___ (syal) because it\'s cold."',
                        'options' => null,
                        'correct_answer' => 'a scarf',
                    ],
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Apa bahasa Inggris untuk "sepatu bot"?',
                        'options' => ['Sandals', 'Shoes', 'Boots', 'Socks'],
                        'correct_answer' => 'Boots',
                    ],
                ],
            ],
        ],
    ],
    // --- Modul 11-50 (Melanjutkan pola 5x5) ---
    [
        'title' => 'Pakaian & Mode',
        'description' => 'Menjelaskan apa yang Anda kenakan.',
        'order' => 11,
        'lessons' => [
            [
                'title' => 'Jenis Pakaian',
                'order' => 1,
                'questions' => [
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Apa yang Anda kenakan di kaki Anda?',
                        'options' => ['A hat', 'Gloves', 'Socks', 'A scarf'],
                        'correct_answer' => 'Socks',
                    ],
                    [
                        'question_type' => 'fill_in_blank',
                        'question' => 'Lengkapi: "I am ___ a blue shirt today."',
                        'options' => null,
                        'correct_answer' => 'wearing',
                    ],
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Apa bahasa Inggris untuk "rok"?',
                        'options' => ['Skirt', 'Shorts', 'Pants', 'Dress'],
                        'correct_answer' => 'Skirt',
                    ],
                    [
                        'question_type' => 'fill_in_blank',
                        'question' => 'Lengkapi: "He wears ___ (celana jins) every day."',
                        'options' => null,
                        'correct_answer' => 'jeans',
                    ],
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Apa yang Anda kenakan di kepala Anda?',
                        'options' => ['A hat', 'Shoes', 'Gloves', 'A belt'],
                        'correct_answer' => 'A hat',
                    ],
                ],
            ],
            [
                'title' => 'Aksesoris',
                'order' => 2,
                'questions' => [
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Apa yang Anda gunakan untuk melihat waktu?',
                        'options' => ['A necklace', 'A bracelet', 'A watch', 'A ring'],
                        'correct_answer' => 'A watch',
                    ],
                    [
                        'question_type' => 'fill_in_blank',
                        'question' => 'Lengkapi: "She wears a beautiful ___ (kalung)."',
                        'options' => null,
                        'correct_answer' => 'necklace',
                    ],
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Apa bahasa Inggris untuk "cincin"?',
                        'options' => ['Ring', 'Earring', 'Belt', 'Tie'],
                        'correct_answer' => 'Ring',
                    ],
                    [
                        'question_type' => 'fill_in_blank',
                        'question' => 'Lengkapi: "I need a ___ (ikat pinggang) for these pants."',
                        'options' => null,
                        'correct_answer' => 'belt',
                    ],
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Apa bahasa Inggris untuk "dasi"?',
                        'options' => ['Tie', 'Scarf', 'Hat', 'Bag'],
                        'correct_answer' => 'Tie',
                    ],
                ],
            ],
            [
                'title' => 'Membeli Pakaian',
                'order' => 3,
                'questions' => [
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Apa yang Anda lakukan di "fitting room"?',
                        'options' => ['Membayar', 'Mencoba pakaian', 'Melihat-lihat', 'Mengembalikan barang'],
                        'correct_answer' => 'Mencoba pakaian',
                    ],
                    [
                        'question_type' => 'fill_in_blank',
                        'question' => 'Lengkapi: "What ___ (ukuran) are you?"',
                        'options' => null,
                        'correct_answer' => 'size',
                    ],
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Apa arti "It doesn\'t fit"?',
                        'options' => ['Ini tidak cocok (ukuran)', 'Ini tidak mahal', 'Ini tidak bagus', 'Ini tidak gratis'],
                        'correct_answer' => 'Ini tidak cocok (ukuran)',
                    ],
                    [
                        'question_type' => 'fill_in_blank',
                        'question' => 'Lengkapi: "Do you have this in ___ (warna) blue?"',
                        'options' => null,
                        'correct_answer' => 'blue',
                    ],
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Apa arti "on sale"?',
                        'options' => ['Terjual habis', 'Baru datang', 'Sedang diskon', 'Mahal'],
                        'correct_answer' => 'Sedang diskon',
                    ],
                ],
            ],
            [
                'title' => 'Mendeskripsikan Pakaian',
                'order' => 4,
                'questions' => [
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Apa lawan kata dari "tight" (ketat)?',
                        'options' => ['Loose', 'Short', 'Long', 'New'],
                        'correct_answer' => 'Loose',
                    ],
                    [
                        'question_type' => 'fill_in_blank',
                        'question' => 'Lengkapi: "She is wearing a ___ (gaun) with dots."',
                        'options' => null,
                        'correct_answer' => 'dress',
                    ],
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Apa arti "striped"?',
                        'options' => ['Bergaris', 'Polos', 'Kotak-kotak', 'Bercorak'],
                        'correct_answer' => 'Bergaris',
                    ],
                    [
                        'question_type' => 'fill_in_blank',
                        'question' => 'Lengkapi: "I like your shoes. They look ___ (nyaman)."',
                        'options' => null,
                        'correct_answer' => 'comfortable',
                    ],
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Apa arti "formal wear"?',
                        'options' => ['Pakaian santai', 'Pakaian olahraga', 'Pakaian tidur', 'Pakaian resmi'],
                        'correct_answer' => 'Pakaian resmi',
                    ],
                ],
            ],
            [
                'title' => 'Perawatan Pakaian',
                'order' => 5,
                'questions' => [
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Apa arti "laundry"?',
                        'options' => ['Mencuci pakaian', 'Menyetrika pakaian', 'Menjahit pakaian', 'Membeli pakaian'],
                        'correct_answer' => 'Mencuci pakaian',
                    ],
                    [
                        'question_type' => 'fill_in_blank',
                        'question' => 'Lengkapi: "This shirt is dirty. It needs to be ___."',
                        'options' => null,
                        'correct_answer' => 'washed',
                    ],
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Apa bahasa Inggris untuk "menyetrika"?',
                        'options' => ['To iron', 'To fold', 'To hang', 'To dry'],
                        'correct_answer' => 'To iron',
                    ],
                    [
                        'question_type' => 'fill_in_blank',
                        'question' => 'Lengkapi: "I need to ___ (menjahit) this button back on."',
                        'options' => null,
                        'correct_answer' => 'sew',
                    ],
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Apa arti "dry cleaning"?',
                        'options' => ['Cuci kering (laundry khusus)', 'Menjemur', 'Melipat', 'Menyimpan'],
                        'correct_answer' => 'Cuci kering (laundry khusus)',
                    ],
                ],
            ],
        ],
    ],
    // --- Modul 12 ---
    [
        'title' => 'Rumah & Perabotan',
        'description' => 'Mendeskripsikan ruangan dan perabotan di dalam rumah.',
        'order' => 12,
        'lessons' => [
            [
                'title' => 'Ruangan di Rumah',
                'order' => 1,
                'questions' => [
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Di ruangan mana Anda biasanya memasak?',
                        'options' => ['Bedroom', 'Bathroom', 'Living room', 'Kitchen'],
                        'correct_answer' => 'Kitchen',
                    ],
                    [
                        'question_type' => 'fill_in_blank',
                        'question' => 'Lengkapi: "We watch TV in the ___ room."',
                        'options' => null,
                        'correct_answer' => 'living',
                    ],
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Di ruangan mana Anda tidur?',
                        'options' => ['Bedroom', 'Kitchen', 'Garage', 'Dining room'],
                        'correct_answer' => 'Bedroom',
                    ],
                    [
                        'question_type' => 'fill_in_blank',
                        'question' => 'Lengkapi: "You take a shower in the ___."',
                        'options' => null,
                        'correct_answer' => 'bathroom',
                    ],
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Di mana Anda biasanya memarkir mobil?',
                        'options' => ['Garage', 'Garden', 'Attic', 'Basement'],
                        'correct_answer' => 'Garage',
                    ],
                ],
            ],
            [
                'title' => 'Perabotan Ruang Tamu',
                'order' => 2,
                'questions' => [
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Apa bahasa Inggris untuk "sofa"?',
                        'options' => ['Sofa / Couch', 'Bed', 'Table', 'Chair'],
                        'correct_answer' => 'Sofa / Couch',
                    ],
                    [
                        'question_type' => 'fill_in_blank',
                        'question' => 'Lengkapi: "The books are on the ___ (rak buku)."',
                        'options' => null,
                        'correct_answer' => 'bookshelf',
                    ],
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Apa yang ada di lantai?',
                        'options' => ['Ceiling', 'Window', 'Carpet', 'Lamp'],
                        'correct_answer' => 'Carpet',
                    ],
                    [
                        'question_type' => 'fill_in_blank',
                        'question' => 'Lengkapi: "We put coffee cups on the ___ table."',
                        'options' => null,
                        'correct_answer' => 'coffee',
                    ],
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Apa bahasa Inggris untuk "kursi lengan"?',
                        'options' => ['Armchair', 'Stool', 'Bench', 'Sofa'],
                        'correct_answer' => 'Armchair',
                    ],
                ],
            ],
            [
                'title' => 'Perabotan Kamar Tidur',
                'order' => 3,
                'questions' => [
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Apa bahasa Inggris untuk "tempat tidur"?',
                        'options' => ['Bed', 'Desk', 'Chair', 'Wardrobe'],
                        'correct_answer' => 'Bed',
                    ],
                    [
                        'question_type' => 'fill_in_blank',
                        'question' => 'Lengkapi: "I put my clothes in the ___ (lemari pakaian)."',
                        'options' => null,
                        'correct_answer' => 'wardrobe',
                    ],
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Apa yang Anda gunakan untuk tidur?',
                        'options' => ['Pillow', 'Blanket', 'Both A and B', 'Desk'],
                        'correct_answer' => 'Both A and B',
                    ],
                    [
                        'question_type' => 'fill_in_blank',
                        'question' => 'Lengkapi: "I do my homework at my ___ (meja tulis)."',
                        'options' => null,
                        'correct_answer' => 'desk',
                    ],
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Apa yang ada di sebelah tempat tidur?',
                        'options' => ['Nightstand', 'Sofa', 'Sink', 'Stove'],
                        'correct_answer' => 'Nightstand',
                    ],
                ],
            ],
            [
                'title' => 'Perabotan Dapur',
                'order' => 4,
                'questions' => [
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Di mana Anda menyimpan makanan agar tetap dingin?',
                        'options' => ['Oven', 'Microwave', 'Refrigerator (Fridge)', 'Sink'],
                        'correct_answer' => 'Refrigerator (Fridge)',
                    ],
                    [
                        'question_type' => 'fill_in_blank',
                        'question' => 'Lengkapi: "We cook food on the ___ (kompor)."',
                        'options' => null,
                        'correct_answer' => 'stove',
                    ],
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Apa untuk memanaskan makanan dengan cepat?',
                        'options' => ['Microwave', 'Blender', 'Toaster', 'Kettle'],
                        'correct_answer' => 'Microwave',
                    ],
                    [
                        'question_type' => 'fill_in_blank',
                        'question' => 'Lengkapi: "I wash dishes in the ___ (bak cuci)."',
                        'options' => null,
                        'correct_answer' => 'sink',
                    ],
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Apa bahasa Inggris untuk "lemari dapur"?',
                        'options' => ['Cupboard', 'Wardrobe', 'Bookshelf', 'Drawer'],
                        'correct_answer' => 'Cupboard',
                    ],
                ],
            ],
            [
                'title' => 'Pekerjaan Rumah Tangga',
                'order' => 5,
                'questions' => [
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Apa arti "to clean the house"?',
                        'options' => ['Membersihkan rumah', 'Mengecat rumah', 'Membangun rumah', 'Membeli rumah'],
                        'correct_answer' => 'Membersihkan rumah',
                    ],
                    [
                        'question_type' => 'fill_in_blank',
                        'question' => 'Lengkapi: "I need to ___ the floor." (menyapu)',
                        'options' => null,
                        'correct_answer' => 'sweep',
                    ],
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Apa yang Anda gunakan untuk membersihkan debu?',
                        'options' => ['A vacuum cleaner', 'A mop', 'A broom', 'A duster'],
                        'correct_answer' => 'A duster',
                    ],
                    [
                        'question_type' => 'fill_in_blank',
                        'question' => 'Lengkapi: "It\'s your turn to take out the ___ (sampah)."',
                        'options' => null,
                        'correct_answer' => 'trash',
                    ],
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Apa arti "to do the dishes"?',
                        'options' => ['Memasak', 'Mencuci piring', 'Membeli piring', 'Memecahkan piring'],
                        'correct_answer' => 'Mencuci piring',
                    ],
                ],
            ],
        ],
    ],
    // --- Modul 13 ---
    [
        'title' => 'Hewan & Peliharaan',
        'description' => 'Membicarakan tentang hewan peliharaan dan hewan liar.',
        'order' => 13,
        'lessons' => [
            [
                'title' => 'Hewan Peliharaan',
                'order' => 1,
                'questions' => [
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Hewan apa yang mengeong?',
                        'options' => ['A dog', 'A cat', 'A bird', 'A fish'],
                        'correct_answer' => 'A cat',
                    ],
                    [
                        'question_type' => 'fill_in_blank',
                        'question' => 'Lengkapi: "Do you have any ___?"',
                        'options' => null,
                        'correct_answer' => 'pets',
                    ],
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Hewan apa yang menggonggong?',
                        'options' => ['A dog', 'A cat', 'A hamster', 'A rabbit'],
                        'correct_answer' => 'A dog',
                    ],
                    [
                        'question_type' => 'fill_in_blank',
                        'question' => 'Lengkapi: "A ___ (burung) can sing."',
                        'options' => null,
                        'correct_answer' => 'bird',
                    ],
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Hewan apa yang berenang di akuarium?',
                        'options' => ['A fish', 'A lizard', 'A snake', 'A mouse'],
                        'correct_answer' => 'A fish',
                    ],
                ],
            ],
            [
                'title' => 'Hewan Ternak',
                'order' => 2,
                'questions' => [
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Hewan apa yang memberi kita susu?',
                        'options' => ['A chicken', 'A pig', 'A cow', 'A sheep'],
                        'correct_answer' => 'A cow',
                    ],
                    [
                        'question_type' => 'fill_in_blank',
                        'question' => 'Lengkapi: "A ___ (ayam) lays eggs."',
                        'options' => null,
                        'correct_answer' => 'chicken',
                    ],
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Apa bahasa Inggris untuk "domba"?',
                        'options' => ['Goat', 'Sheep', 'Horse', 'Donkey'],
                        'correct_answer' => 'Sheep',
                    ],
                    [
                        'question_type' => 'fill_in_blank',
                        'question' => 'Lengkapi: "You can ride a ___ (kuda)."',
                        'options' => null,
                        'correct_answer' => 'horse',
                    ],
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Hewan apa yang oink?',
                        'options' => ['A pig', 'A duck', 'A turkey', 'A cow'],
                        'correct_answer' => 'A pig',
                    ],
                ],
            ],
            [
                'title' => 'Hewan Liar (Darat)',
                'order' => 3,
                'questions' => [
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Siapa raja hutan?',
                        'options' => ['A tiger', 'A lion', 'An elephant', 'A bear'],
                        'correct_answer' => 'A lion',
                    ],
                    [
                        'question_type' => 'fill_in_blank',
                        'question' => 'Lengkapi: "A ___ (monyet) likes bananas."',
                        'options' => null,
                        'correct_answer' => 'monkey',
                    ],
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Hewan apa yang memiliki leher sangat panjang?',
                        'options' => ['A giraffe', 'A zebra', 'A hippo', 'A rhino'],
                        'correct_answer' => 'A giraffe',
                    ],
                    [
                        'question_type' => 'fill_in_blank',
                        'question' => 'Lengkapi: "A ___ (gajah) is very big."',
                        'options' => null,
                        'correct_answer' => 'elephant',
                    ],
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Apa bahasa Inggris untuk "beruang"?',
                        'options' => ['Bear', 'Deer', 'Wolf', 'Fox'],
                        'correct_answer' => 'Bear',
                    ],
                ],
            ],
            [
                'title' => 'Hewan Liar (Air & Udara)',
                'order' => 4,
                'questions' => [
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Hewan apa yang berenang di laut dan berbahaya?',
                        'options' => ['A dolphin', 'A whale', 'A shark', 'A turtle'],
                        'correct_answer' => 'A shark',
                    ],
                    [
                        'question_type' => 'fill_in_blank',
                        'question' => 'Lengkapi: "A ___ (lumba-lumba) is very smart."',
                        'options' => null,
                        'correct_answer' => 'dolphin',
                    ],
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Hewan laut terbesar adalah...',
                        'options' => ['A whale', 'An octopus', 'A starfish', 'A seal'],
                        'correct_answer' => 'A whale',
                    ],
                    [
                        'question_type' => 'fill_in_blank',
                        'question' => 'Lengkapi: "An ___ (elang) can fly very high."',
                        'options' => null,
                        'correct_answer' => 'eagle',
                    ],
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Apa bahasa Inggris untuk "burung hantu"?',
                        'options' => ['Owl', 'Penguin', 'Parrot', 'Duck'],
                        'correct_answer' => 'Owl',
                    ],
                ],
            ],
            [
                'title' => 'Serangga & Reptil',
                'order' => 5,
                'questions' => [
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Apa bahasa Inggris untuk "ular"?',
                        'options' => ['Snake', 'Lizard', 'Frog', 'Crocodile'],
                        'correct_answer' => 'Snake',
                    ],
                    [
                        'question_type' => 'fill_in_blank',
                        'question' => 'Lengkapi: "A ___ (laba-laba) has eight legs."',
                        'options' => null,
                        'correct_answer' => 'spider',
                    ],
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Serangga apa yang membuat madu?',
                        'options' => ['A bee', 'An ant', 'A butterfly', 'A mosquito'],
                        'correct_answer' => 'A bee',
                    ],
                    [
                        'question_type' => 'fill_in_blank',
                        'question' => 'Lengkapi: "A ___ (kupu-kupu) is beautiful."',
                        'options' => null,
                        'correct_answer' => 'butterfly',
                    ],
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Apa bahasa Inggris untuk "semut"?',
                        'options' => ['Ant', 'Fly', 'Bug', 'Wasp'],
                        'correct_answer' => 'Ant',
                    ],
                ],
            ],
        ],
    ],
    // --- Modul 14 ---
    [
        'title' => 'Tubuh & Kesehatan',
        'description' => 'Menjelaskan bagian tubuh dan membicarakan kesehatan.',
        'order' => 14,
        'lessons' => [
            [
                'title' => 'Bagian Tubuh (Kepala & Wajah)',
                'order' => 1,
                'questions' => [
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Anda menggunakan apa untuk melihat?',
                        'options' => ['Ears', 'Nose', 'Eyes', 'Mouth'],
                        'correct_answer' => 'Eyes',
                    ],
                    [
                        'question_type' => 'fill_in_blank',
                        'question' => 'Lengkapi: "You use your ___ (telinga) to hear."',
                        'options' => null,
                        'correct_answer' => 'ears',
                    ],
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Apa bahasa Inggris untuk "hidung"?',
                        'options' => ['Nose', 'Mouth', 'Chin', 'Cheek'],
                        'correct_answer' => 'Nose',
                    ],
                    [
                        'question_type' => 'fill_in_blank',
                        'question' => 'Lengkapi: "You eat with your ___ (mulut)."',
                        'options' => null,
                        'correct_answer' => 'mouth',
                    ],
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Rambut tumbuh di...',
                        'options' => ['Head', 'Face', 'Neck', 'Arm'],
                        'correct_answer' => 'Head',
                    ],
                ],
            ],
            [
                'title' => 'Bagian Tubuh (Badan & Tangan)',
                'order' => 2,
                'questions' => [
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Apa bahasa Inggris untuk "tangan"?',
                        'options' => ['Hand', 'Foot', 'Leg', 'Arm'],
                        'correct_answer' => 'Hand',
                    ],
                    [
                        'question_type' => 'fill_in_blank',
                        'question' => 'Lengkapi: "You have ten ___ (jari tangan)."',
                        'options' => null,
                        'correct_answer' => 'fingers',
                    ],
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Apa bahasa Inggris untuk "lengan"?',
                        'options' => ['Arm', 'Leg', 'Back', 'Chest'],
                        'correct_answer' => 'Arm',
                    ],
                    [
                        'question_type' => 'fill_in_blank',
                        'question' => 'Lengkapi: "My ___ (punggung) hurts."',
                        'options' => null,
                        'correct_answer' => 'back',
                    ],
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Hati (jantung) ada di...',
                        'options' => ['Chest', 'Stomach', 'Head', 'Hand'],
                        'correct_answer' => 'Chest',
                    ],
                ],
            ],
            [
                'title' => 'Bagian Tubuh (Kaki & Lainnya)',
                'order' => 3,
                'questions' => [
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Apa bahasa Inggris untuk "kaki" (untuk berjalan)?',
                        'options' => ['Leg', 'Arm', 'Hand', 'Head'],
                        'correct_answer' => 'Leg',
                    ],
                    [
                        'question_type' => 'fill_in_blank',
                        'question' => 'Lengkapi: "You wear shoes on your ___ (kaki)."',
                        'options' => null,
                        'correct_answer' => 'feet',
                    ],
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Apa bahasa Inggris untuk "lutut"?',
                        'options' => ['Knee', 'Elbow', 'Shoulder', 'Ankle'],
                        'correct_answer' => 'Knee',
                    ],
                    [
                        'question_type' => 'fill_in_blank',
                        'question' => 'Lengkapi: "You have ten ___ (jari kaki)."',
                        'options' => null,
                        'correct_answer' => 'toes',
                    ],
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Apa arti "stomach"?',
                        'options' => ['Perut', 'Dada', 'Punggung', 'Leher'],
                        'correct_answer' => 'Perut',
                    ],
                ],
            ],
            [
                'title' => 'Merasa Sakit',
                'order' => 4,
                'questions' => [
                    [
                        'question_type' => 'fill_in_blank',
                        'question' => 'Lengkapi: "I don\'t feel well. I have a ___."',
                        'options' => null,
                        'correct_answer' => 'headache',
                    ],
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Apa arti "I have a fever"?',
                        'options' => ['Saya demam.', 'Saya batuk.', 'Saya pilek.', 'Saya sakit perut.'],
                        'correct_answer' => 'Saya demam.',
                    ],
                    [
                        'question_type' => 'fill_in_blank',
                        'question' => 'Lengkapi: "My stomach ___ (sakit)."',
                        'options' => null,
                        'correct_answer' => 'hurts',
                    ],
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Apa bahasa Inggris untuk "batuk"?',
                        'options' => ['Cough', 'Cold', 'Flu', 'Pain'],
                        'correct_answer' => 'Cough',
                    ],
                    [
                        'question_type' => 'fill_in_blank',
                        'question' => 'Lengkapi: "You should ___ a doctor."',
                        'options' => null,
                        'correct_answer' => 'see',
                    ],
                ],
            ],
            [
                'title' => 'Kesehatan & Kebiasaan Sehat',
                'order' => 5,
                'questions' => [
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Apa arti "exercise"?',
                        'options' => ['Olahraga', 'Makan', 'Tidur', 'Bekerja'],
                        'correct_answer' => 'Olahraga',
                    ],
                    [
                        'question_type' => 'fill_in_blank',
                        'question' => 'Lengkapi: "You should eat healthy ___ (makanan)."',
                        'options' => null,
                        'correct_answer' => 'food',
                    ],
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Apa yang penting untuk kebersihan?',
                        'options' => ['Wash your hands', 'Eat candy', 'Stay up late', 'Watch TV'],
                        'correct_answer' => 'Wash your hands',
                    ],
                    [
                        'question_type' => 'fill_in_blank',
                        'question' => 'Lengkapi: "It is important to get enough ___ (tidur)."',
                        'options' => null,
                        'correct_answer' => 'sleep',
                    ],
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Apa bahasa Inggris untuk "obat"?',
                        'options' => ['Medicine', 'Water', 'Food', 'Poison'],
                        'correct_answer' => 'Medicine',
                    ],
                ],
            ],
        ],
    ],
    // --- Modul 15 ---
    [
        'title' => 'Tata Bahasa: Present Tense',
        'description' => 'Menguasai Simple Present dan Present Continuous tense.',
        'order' => 15,
        'lessons' => [
            [
                'title' => 'Simple Present (Bentuk Positif)',
                'order' => 1,
                'questions' => [
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Kalimat mana yang benar?',
                        'options' => ['She play guitar.', 'She playing guitar.', 'She plays guitar.', 'She guitar play.'],
                        'correct_answer' => 'She plays guitar.',
                    ],
                    [
                        'question_type' => 'fill_in_blank',
                        'question' => 'Lengkapi: "I ___ (bekerja) in an office."',
                        'options' => null,
                        'correct_answer' => 'work',
                    ],
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Kalimat mana yang benar?',
                        'options' => ['They lives in London.', 'They live in London.', 'They living in London.', 'They is live in London.'],
                        'correct_answer' => 'They live in London.',
                    ],
                    [
                        'question_type' => 'fill_in_blank',
                        'question' => 'Lengkapi: "He ___ (berbicara) English."',
                        'options' => null,
                        'correct_answer' => 'speaks',
                    ],
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Simple Present digunakan untuk...',
                        'options' => ['Hanya sekarang', 'Hanya masa lalu', 'Kebiasaan & Fakta', 'Hanya masa depan'],
                        'correct_answer' => 'Kebiasaan & Fakta',
                    ],
                ],
            ],
            [
                'title' => 'Simple Present (Bentuk Negatif & Tanya)',
                'order' => 2,
                'questions' => [
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Kalimat negatif yang benar?',
                        'options' => ['I no like coffee.', 'I don\'t like coffee.', 'I am not like coffee.', 'I not like coffee.'],
                        'correct_answer' => 'I don\'t like coffee.',
                    ],
                    [
                        'question_type' => 'fill_in_blank',
                        'question' => 'Lengkapi: "She ___ (tidak bekerja) on weekends."',
                        'options' => null,
                        'correct_answer' => 'doesn\'t work',
                    ],
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Kalimat tanya yang benar?',
                        'options' => ['You live here?', 'Do you live here?', 'Are you live here?', 'Does you live here?'],
                        'correct_answer' => 'Do you live here?',
                    ],
                    [
                        'question_type' => 'fill_in_blank',
                        'question' => 'Lengkapi: "___ he speak French?"',
                        'options' => null,
                        'correct_answer' => 'Does',
                    ],
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Jawaban singkat untuk "Do you like
 ice cream?"',
                        'options' => ['Yes, I do.', 'Yes, I like.', 'Yes, I am.', 'Yes, it is.'],
                        'correct_answer' => 'Yes, I do.',
                    ],
                ],
            ],
            [
                'title' => 'Present Continuous (Bentuk Positif)',
                'order' => 3,
                'questions' => [
                    [
                        'question_type' => 'fill_in_blank',
                        'question' => 'Lengkapi: "They ___ watching TV right now."',
                        'options' => null,
                        'correct_answer' => 'are',
                    ],
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Kalimat mana yang benar?',
                        'options' => ['I am read a book.', 'I read a book now.', 'I am reading a book.', 'I reading a book.'],
                        'correct_answer' => 'I am reading a book.',
                    ],
                    [
                        'question_type' => 'fill_in_blank',
                        'question' => 'Lengkapi: "He is ___ (tidur)."',
                        'options' => null,
                        'correct_answer' => 'sleeping',
                    ],
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Kalimat mana yang benar?',
                        'options' => ['She is driveing.', 'She is driving.', 'She is drives.', 'She driving.'],
                        'correct_answer' => 'She is driving.',
                    ],
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Present Continuous digunakan untuk...',
                        'options' => ['Aksi yang terjadi sekarang', 'Kebiasaan', 'Masa lalu', 'Fakta umum'],
                        'correct_answer' => 'Aksi yang terjadi sekarang',
                    ],
                ],
            ],
            [
                'title' => 'Present Continuous (Negatif & Tanya)',
                'order' => 4,
                'questions' => [
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Kalimat negatif yang benar?',
                        'options' => ['He no is working.', 'He doesn\'t working.', 'He isn\'t working.', 'He not working.'],
                        'correct_answer' => 'He isn\'t working.',
                    ],
                    [
                        'question_type' => 'fill_in_blank',
                        'question' => 'Lengkapi: "We ___ (tidak) going to the party."',
                        'options' => null,
                        'correct_answer' => 'aren\'t',
                    ],
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Kalimat tanya yang benar?',
                        'options' => ['What you are doing?', 'What are you doing?', 'What do you doing?', 'What you do?'],
                        'correct_answer' => 'What are you doing?',
                    ],
                    [
                        'question_type' => 'fill_in_blank',
                        'question' => 'Lengkapi: "___ she sleeping?"',
                        'options' => null,
                        'correct_answer' => 'Is',
                    ],
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Jawaban singkat untuk "Are they studying?"',
                        'options' => ['Yes, they are.', 'Yes, they do.', 'Yes, they study.', 'Yes, are.'],
                        'correct_answer' => 'Yes, they are.',
                    ],
                ],
            ],
            [
                'title' => 'Simple Present vs Present Continuous',
                'order' => 5,
                'questions' => [
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Pilih kalimat yang tepat: (kebiasaan)',
                        'options' => ['I am drinking coffee every morning.', 'I drink coffee every morning.', 'I am drink coffee.', 'I drinks coffee.'],
                        'correct_answer' => 'I drink coffee every morning.',
                    ],
                    [
                        'question_type' => 'fill_in_blank',
                        'question' => 'Lengkapi: "Listen! The baby ___ (menangis)."',
                        'options' => null,
                        'correct_answer' => 'is crying',
                    ],
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Pilih kalimat yang tepat: (sekarang)',
                        'options' => ['She usually cooks dinner.', 'She is cooking dinner right now.', 'She cook dinner now.', 'She cooking dinner.'],
                        'correct_answer' => 'She is cooking dinner right now.',
                    ],
                    [
                        'question_type' => 'fill_in_blank',
                        'question' => 'Lengkapi: "Water ___ (mendidih) at 100 degrees Celsius."',
                        'options' => null,
                        'correct_answer' => 'boils',
                    ],
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Pilih kalimat yang tepat:',
                        'options' => ['I am not understanding you.', 'I do not understand you.', 'I am not understand you.', 'I not understand.'],
                        'correct_answer' => 'I do not understand you.',
                    ],
                ],
            ],
        ],
    ],
    // --- Modul 16 ---
    [
        'title' => 'Tata Bahasa: Past Tense',
        'description' => 'Menggunakan Simple Past Tense untuk kejadian di masa lalu.',
        'order' => 16,
        'lessons' => [
            [
                'title' => 'Simple Past (Regular Verbs)',
                'order' => 1,
                'questions' => [
                    [
                        'question_type' => 'fill_in_blank',
                        'question' => 'Lengkapi: "I ___ (berjalan) to the store yesterday."',
                        'options' => null,
                        'correct_answer' => 'walked',
                    ],
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Kalimat mana yang benar?',
                        'options' => ['She watch TV last night.', 'She watching TV last night.', 'She watched TV last night.', 'She watches TV last night.'],
                        'correct_answer' => 'She watched TV last night.',
                    ],
                    [
                        'question_type' => 'fill_in_blank',
                        'question' => 'Lengkapi: "They ___ (tinggal) in Paris for two years."',
                        'options' => null,
                        'correct_answer' => 'lived',
                    ],
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Kata "yesterday" menunjukkan...',
                        'options' => ['Masa lalu', 'Masa kini', 'Masa depan', 'Kebiasaan'],
                        'correct_answer' => 'Masa lalu',
                    ],
                    [
                        'question_type' => 'fill_in_blank',
                        'question' => 'Lengkapi: "He ___ (berhenti) smoking last year."',
                        'options' => null,
                        'correct_answer' => 'stopped',
                    ],
                ],
            ],
            [
                'title' => 'Simple Past (Irregular Verbs)',
                'order' => 2,
                'questions' => [
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Apa bentuk lampau dari "go"?',
                        'options' => ['Goed', 'Gone', 'Went', 'Going'],
                        'correct_answer' => 'Went',
                    ],
                    [
                        'question_type' => 'fill_in_blank',
                        'question' => 'Lengkapi: "I ___ (melihat) him at the party."',
                        'options' => null,
                        'correct_answer' => 'saw',
                    ],
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Apa bentuk lampau dari "eat"?',
                        'options' => ['Eated', 'Ate', 'Eaten', 'Eating'],
                        'correct_answer' => 'Ate',
                    ],
                    [
                        'question_type' => 'fill_in_blank',
                        'question' => 'Lengkapi: "She ___ (membeli) a new car."',
                        'options' => null,
                        'correct_answer' => 'bought',
                    ],
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Kalimat mana yang benar?',
                        'options' => ['He take my book.', 'He taken my book.', 'He took my book.', 'He taked my book.'],
                        'correct_answer' => 'He took my book.',
                    ],
                ],
            ],
            [
                'title' => 'Simple Past (To Be: Was/Were)',
                'order' => 3,
                'questions' => [
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Pilih yang benar:',
                        'options' => ['I was happy.', 'I were happy.', 'I am happy yesterday.', 'I be happy.'],
                        'correct_answer' => 'I was happy.',
                    ],
                    [
                        'question_type' => 'fill_in_blank',
                        'question' => 'Lengkapi: "They ___ (tidak) at home last night."',
                        'options' => null,
                        'correct_answer' => 'weren\'t',
                    ],
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Pilih yang benar:',
                        'options' => ['She was late?', 'Was she late?', 'Did she be late?', 'Were she late?'],
                        'correct_answer' => 'Was she late?',
                    ],
                    [
                        'question_type' => 'fill_in_blank',
                        'question' => 'Lengkapi: "We ___ (adalah) students in 2010."',
                        'options' => null,
                        'correct_answer' => 'were',
                    ],
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Pilih yang benar:',
                        'options' => ['He was not hungry.', 'He were not hungry.', 'He did not be hungry.', 'He not was hungry.'],
                        'correct_answer' => 'He was not hungry.',
                    ],
                ],
            ],
            [
                'title' => 'Simple Past (Negatif & Tanya dengan "Did")',
                'order' => 4,
                'questions' => [
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Kalimat negatif yang benar?',
                        'options' => ['I not went.', 'I didn\'t went.', 'I didn\'t go.', 'I don\'t go yesterday.'],
                        'correct_answer' => 'I didn\'t go.',
                    ],
                    [
                        'question_type' => 'fill_in_blank',
                        'question' => 'Lengkapi: "She ___ (tidak) see the movie."',
                        'options' => null,
                        'correct_answer' => 'didn\'t',
                    ],
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Kalimat tanya yang benar?',
                        'options' => ['Did you ate breakfast?', 'Did you eat breakfast?', 'You ate breakfast?', 'Do you ate breakfast?'],
                        'correct_answer' => 'Did you eat breakfast?',
                    ],
                    [
                        'question_type' => 'fill_in_blank',
                        'question' => 'Lengkapi: "What ___ you do last weekend?"',
                        'options' => null,
                        'correct_answer' => 'did',
                    ],
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Jawaban singkat untuk "Did he call you?"',
                        'options' => ['Yes, he did.', 'Yes, he called.', 'Yes, he was.', 'Yes, he does.'],
                        'correct_answer' => 'Yes, he did.',
                    ],
                ],
            ],
            [
                'title' => 'Past Continuous',
                'order' => 5,
                'questions' => [
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Pilih yang benar:',
                        'options' => ['I was studying when she called.', 'I studied when she was calling.', 'I was study when she called.', 'I studying when she called.'],
                        'correct_answer' => 'I was studying when she called.',
                    ],
                    [
                        'question_type' => 'fill_in_blank',
                        'question' => 'Lengkapi: "They ___ (sedang bermain) soccer at 5 PM yesterday."',
                        'options' => null,
                        'correct_answer' => 'were playing',
                    ],
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Pilih yang benar:',
                        'options' => ['What you were doing?', 'What was you doing?', 'What were you doing?', 'What did you doing?'],
                        'correct_answer' => 'What were you doing?',
                    ],
                    [
                        'question_type' => 'fill_in_blank',
                        'question' => 'Lengkapi: "It ___ (sedang hujan) all night."',
                        'options' => null,
                        'correct_answer' => 'was raining',
                    ],
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Pilih yang benar:',
                        'options' => ['He wasn\'t sleeping.', 'He didn\'t sleeping.', 'He not was sleeping.', 'He weren\'t sleeping.'],
                        'correct_answer' => 'He wasn\'t sleeping.',
                    ],
                ],
            ],
        ],
    ],
    // --- Modul 17 ---
    [
        'title' => 'Tata Bahasa: Future Tense',
        'description' => 'Membicarakan masa depan menggunakan "will" dan "going to".',
        'order' => 17,
        'lessons' => [
            [
                'title' => 'Menggunakan "Will" (Prediksi & Spontan)',
                'order' => 1,
                'questions' => [
                    [
                        'question_type' => 'fill_in_blank',
                        'question' => 'Lengkapi: "I think it ___ rain tomorrow."',
                        'options' => null,
                        'correct_answer' => 'will',
                    ],
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Pilih yang benar (keputusan spontan): "The phone is ringing..."',
                        'options' => ['I get it.', 'I\'ll get it.', 'I am getting it.', 'I go get it.'],
                        'correct_answer' => 'I\'ll get it.',
                    ],
                    [
                        'question_type' => 'fill_in_blank',
                        'question' => 'Lengkapi: "I promise I ___ (tidak akan) tell anyone."',
                        'options' => null,
                        'correct_answer' => 'won\'t',
                    ],
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Bentuk tanya yang benar?',
                        'options' => ['Will you be at the party?', 'You will be at the party?', 'Are you be at the party?', 'Do you will be at the party?'],
                        'correct_answer' => 'Will you be at the party?',
                    ],
                    [
                        'question_type' => 'multiple_choice',
                        'question' => '"Will" sering digunakan untuk...',
                        'options' => ['Prediksi', 'Janji', 'Keputusan spontan', 'Semua di atas'],
                        'correct_answer' => 'Semua di atas',
                    ],
                ],
            ],
            [
                'title' => 'Menggunakan "Going to" (Rencana & Niat)',
                'order' => 2,
                'questions' => [
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Kalimat mana yang menunjukkan rencana pasti?',
                        'options' => ['I am going to visit my aunt.', 'I will visit my aunt.', 'I visit my aunt.', 'I visited my aunt.'],
                        'correct_answer' => 'I am going to visit my aunt.',
                    ],
                    [
                        'question_type' => 'fill_in_blank',
                        'question' => 'Lengkapi: "Look at those dark clouds! It\'s ___ rain."',
                        'options' => null,
                        'correct_answer' => 'going to',
                    ],
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Pilih yang benar:',
                        'options' => ['He is going to study medicine.', 'He will study medicine.', 'He studies medicine.', 'He study medicine.'],
                        'correct_answer' => 'He is going to study medicine.',
                    ],
                    [
                        'question_type' => 'fill_in_blank',
                        'question' => 'Lengkapi: "What ___ you ___ to do after class?"',
                        'options' => null,
                        'correct_answer' => 'are / going',
                    ],
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Bentuk negatif dari "going to":',
                        'options' => ['I am not going to go.', 'I will not going to go.', 'I don\'t going to go.', 'I not going to go.'],
                        'correct_answer' => 'I am not going to go.',
                    ],
                ],
            ],
            [
                'title' => 'Will vs. Going to',
                'order' => 3,
                'questions' => [
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Untuk rencana yang sudah diputuskan, gunakan...',
                        'options' => ['will', 'going to', 'keduanya bisa', 'simple present'],
                        'correct_answer' => 'going to',
                    ],
                    [
                        'question_type' => 'fill_in_blank',
                        'question' => 'Lengkapi: "I\'ve already bought the tickets. We ___ (akan) see the movie tonight."',
                        'options' => null,
                        'correct_answer' => 'are going to',
                    ],
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Untuk prediksi berdasarkan opini, gunakan...',
                        'options' => ['will', 'going to', 'keduanya bisa', 'simple past'],
                        'correct_answer' => 'will',
                    ],
                    [
                        'question_type' => 'fill_in_blank',
                        'question' => 'Lengkapi: "Oh no, I dropped my pen. I ___ (akan) get it."',
                        'options' => null,
                        'correct_answer' => 'will',
                    ],
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Untuk prediksi berdasarkan bukti (awan gelap), gunakan...',
                        'options' => ['will', 'going to', 'keduanya bisa', 'simple present'],
                        'correct_answer' => 'going to',
                    ],
                ],
            ],
            [
                'title' => 'Masa Depan dengan Present Continuous',
                'order' => 4,
                'questions' => [
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Kalimat mana yang menunjukkan rencana masa depan?',
                        'options' => ['I am playing tennis tomorrow.', 'I play tennis every day.', 'I am playing tennis right now.', 'I played tennis.'],
                        'correct_answer' => 'I am playing tennis tomorrow.',
                    ],
                    [
                        'question_type' => 'fill_in_blank',
                        'question' => 'Lengkapi: "We ___ (akan) having dinner with them on Friday."',
                        'options' => null,
                        'correct_answer' => 'are',
                    ],
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Present Continuous untuk masa depan biasanya digunakan untuk...',
                        'options' => ['Rencana yang sudah pasti (arrangement)', 'Prediksi', 'Harapan', 'Janji'],
                        'correct_answer' => 'Rencana yang sudah pasti (arrangement)',
                    ],
                    [
                        'question_type' => 'fill_in_blank',
                        'question' => 'Lengkapi: "What are you ___ (melakukan) this weekend?"',
                        'options' => null,
                        'correct_answer' => 'doing',
                    ],
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Pilih yang benar:',
                        'options' => ['He is leaving next week.', 'He leaves next week. (jarang)', 'He will leave next week.', 'Semua bisa benar tergantung konteks'],
                        'correct_answer' => 'Semua bisa benar tergantung konteks',
                    ],
                ],
            ],
            [
                'title' => 'Masa Depan dengan Simple Present',
                'order' => 5,
                'questions' => [
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Kalimat mana yang menunjukkan jadwal tetap?',
                        'options' => ['The train leaves at 9 AM tomorrow.', 'The train is leaving at 9 AM.', 'The train will leave at 9 AM.', 'The train left at 9 AM.'],
                        'correct_answer' => 'The train leaves at 9 AM tomorrow.',
                    ],
                    [
                        'question_type' => 'fill_in_blank',
                        'question' => 'Lengkapi: "The movie ___ (dimulai) at 7:30 PM tonight."',
                        'options' => null,
                        'correct_answer' => 'starts',
                    ],
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Simple Present untuk masa depan digunakan untuk...',
                        'options' => ['Jadwal (timetables, schedules)', 'Rencana pribadi', 'Prediksi', 'Janji'],
                        'correct_answer' => 'Jadwal (timetables, schedules)',
                    ],
                    [
                        'question_type' => 'fill_in_blank',
                        'question' => 'Lengkapi: "Our flight ___ (mendarat) at noon."',
                        'options' => null,
                        'correct_answer' => 'lands',
                    ],
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Pilih yang benar:',
                        'options' => ['The store opens at 10 AM tomorrow.', 'The store will open at 10 AM.', 'The store is opening at 10 AM.', 'Semua benar (tergantung konteks)'],
                        'correct_answer' => 'The store opens at 10 AM tomorrow.',
                    ],
                ],
            ],
        ],
    ],
    // --- Modul 18 ---
    [
        'title' => 'Tata Bahasa: Modals (Dasar)',
        'description' => 'Menggunakan "can", "should", dan "must".',
        'order' => 18,
        'lessons' => [
            [
                'title' => 'Can / Can\'t (Kemampuan)',
                'order' => 1,
                'questions' => [
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Apa arti "I can swim"?',
                        'options' => ['Saya harus berenang.', 'Saya akan berenang.', 'Saya bisa berenang.', 'Saya suka berenang.'],
                        'correct_answer' => 'Saya bisa berenang.',
                    ],
                    [
                        'question_type' => 'fill_in_blank',
                        'question' => 'Lengkapi: "A fish ___ (tidak bisa) fly."',
                        'options' => null,
                        'correct_answer' => 'can\'t',
                    ],
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Pilih yang benar:',
                        'options' => ['He can speaks French.', 'He can speak French.', 'He can to speak French.', 'He cans speak French.'],
                        'correct_answer' => 'He can speak French.',
                    ],
                    [
                        'question_type' => 'fill_in_blank',
                        'question' => 'Lengkapi: "___ you play the piano?"',
                        'options' => null,
                        'correct_answer' => 'Can',
                    ],
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Apa bentuk lampau dari "can"?',
                        'options' => ['Could', 'Canned', 'Was can', 'Caned'],
                        'correct_answer' => 'Could',
                    ],
                ],
            ],
            [
                'title' => 'Can / May (Izin & Permintaan)',
                'order' => 2,
                'questions' => [
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Mana yang lebih formal untuk meminta izin?',
                        'options' => ['Can I go?', 'May I go?', 'Will I go?', 'Do I go?'],
                        'correct_answer' => 'May I go?',
                    ],
                    [
                        'question_type' => 'fill_in_blank',
                        'question' => 'Lengkapi: "___ I use your phone?" (informal)',
                        'options' => null,
                        'correct_answer' => 'Can',
                    ],
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Pilih yang benar (meminta tolong):',
                        'options' => ['Can you help me?', 'May you help me?', 'Do you help me?', 'Are you help me?'],
                        'correct_answer' => 'Can you help me?',
                    ],
                    [
                        'question_type' => 'fill_in_blank',
                        'question' => 'Lengkapi: "You ___ (boleh) leave now."',
                        'options' => null,
                        'correct_answer' => 'can',
                    ],
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Bentuk lampau dari "may" (izin) adalah...',
                        'options' => ['Might', 'Could', 'Was allowed to', 'Had to'],
                        'correct_answer' => 'Could',
                    ],
                ],
            ],
            [
                'title' => 'Should / Shouldn\'t (Saran)',
                'order' => 3,
                'questions' => [
                    [
                        'question_type' => 'fill_in_blank',
                        'question' => 'Lengkapi: "You ___ (sebaiknya) stop smoking. It\'s bad for you."',
                        'options' => null,
                        'correct_answer' => 'should',
                    ],
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Pilih yang benar:',
                        'options' => ['You should to go.', 'You should going.', 'You should go.', 'You should went.'],
                        'correct_answer' => 'You should go.',
                    ],
                    [
                        'question_type' => 'fill_in_blank',
                        'question' => 'Lengkapi: "He ___ (sebaiknya tidak) eat so much sugar."',
                        'options' => null,
                        'correct_answer' => 'shouldn\'t',
                    ],
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Bentuk tanya yang benar?',
                        'options' => ['What should I do?', 'What I should do?', 'What do I should?', 'What should I to do?'],
                        'correct_answer' => 'What should I do?',
                    ],
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Sinonim dari "should" adalah...',
                        'options' => ['Must', 'Can', 'Ought to', 'May'],
                        'correct_answer' => 'Ought to',
                    ],
                ],
            ],
            [
                'title' => 'Must / Have to (Kewajiban)',
                'order' => 4,
                'questions' => [
                    [
                        'question_type' => 'fill_in_blank',
                        'question' => 'Lengkapi: "You ___ stop at a red light. It\'s the law."',
                        'options' => null,
                        'correct_answer' => 'must',
                    ],
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Pilih yang benar:',
                        'options' => ['I must to go now.', 'I must going now.', 'I must go now.', 'I must went now.'],
                        'correct_answer' => 'I must go now.',
                    ],
                    [
                        'question_type' => 'fill_in_blank',
                        'question' => 'Lengkapi: "I ___ (harus) get up early for work tomorrow."',
                        'options' => null,
                        'correct_answer' => 'have to',
                    ],
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Pilih yang benar:',
                        'options' => ['She has to work.', 'She have to work.', 'She must to work.', 'She has work.'],
                        'correct_answer' => 'She has to work.',
                    ],
                    [
                        'question_type' => 'multiple_choice',
                        'question' => '"Must" sering digunakan untuk kewajiban dari...',
                        'options' => ['Pembicara (internal)', 'Orang lain (eksternal)', 'Pilihan', 'Saran'],
                        'correct_answer' => 'Pembicara (internal)',
                    ],
                ],
            ],
            [
                'title' => 'Mustn\'t / Don\'t Have to (Larangan & Pilihan)',
                'order' => 5,
                'questions' => [
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Mana yang berarti "dilarang"?',
                        'options' => ['You mustn\'t smoke here.', 'You don\'t have to smoke here.', 'You shouldn\'t smoke here.', 'You can\'t smoke here.'],
                        'correct_answer' => 'You mustn\'t smoke here.',
                    ],
                    [
                        'question_type' => 'fill_in_blank',
                        'question' => 'Lengkapi: "You ___ (tidak harus) come if you don\'t want to." (pilihan)',
                        'options' => null,
                        'correct_answer' => 'don\'t have to',
                    ],
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Pilih yang benar:',
                        'options' => ['She doesn\'t have to work.', 'She mustn\'t work.', 'She don\'t have to work.', 'She hasn\'t to work.'],
                        'correct_answer' => 'She doesn\'t have to work.',
                    ],
                    [
                        'question_type' => 'fill_in_blank',
                        'question' => 'Lengkapi: "You ___ (dilarang) touch that. It\'s dangerous."',
                        'options' => null,
                        'correct_answer' => 'mustn\'t',
                    ],
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Apa arti "You don\'t have to pay"?',
                        'options' => ['Anda dilarang bayar.', 'Anda tidak perlu bayar (gratis).', 'Anda harus bayar.', 'Anda sebaiknya bayar.'],
                        'correct_answer' => 'Anda tidak perlu bayar (gratis).',
                    ],
                ],
            ],
        ],
    ],
    // --- Modul 19 ---
    [
        'title' => 'Tata Bahasa: Preposisi',
        'description' => 'Menggunakan "in", "on", dan "at" dengan benar.',
        'order' => 19,
        'lessons' => [
            [
                'title' => 'Preposisi Waktu (At, On, In)',
                'order' => 1,
                'questions' => [
                    [
                        'question_type' => 'fill_in_blank',
                        'question' => 'Lengkapi: "My birthday is ___ March."',
                        'options' => null,
                        'correct_answer' => 'in',
                    ],
                    [
                        'question_type' => 'fill_in_blank',
                        'question' => 'Lengkapi: "The class starts ___ 9 o\'clock."',
                        'options' => null,
                        'correct_answer' => 'at',
                    ],
                    [
                        'question_type' => 'fill_in_blank',
                        'question' => 'Lengkapi: "The meeting is ___ Friday."',
                        'options' => null,
                        'correct_answer' => 'on',
                    ],
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Gunakan "in" untuk...',
                        'options' => ['Jam', 'Hari', 'Bulan & Tahun', 'Akhir pekan'],
                        'correct_answer' => 'Bulan & Tahun',
                    ],
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Pilih yang benar:',
                        'options' => ['in the morning', 'at the morning', 'on the morning', 'from the morning'],
                        'correct_answer' => 'in the morning',
                    ],
                ],
            ],
            [
                'title' => 'Preposisi Tempat (At, On, In)',
                'order' => 2,
                'questions' => [
                    [
                        'question_type' => 'fill_in_blank',
                        'question' => 'Lengkapi: "The book is ___ the table."',
                        'options' => null,
                        'correct_answer' => 'on',
                    ],
                    [
                        'question_type' => 'fill_in_blank',
                        'question' => 'Lengkapi: "He is waiting ___ the bus stop."',
                        'options' => null,
                        'correct_answer' => 'at',
                    ],
                    [
                        'question_type' => 'fill_in_blank',
                        'question' => 'Lengkapi: "The milk is ___ the fridge."',
                        'options' => null,
                        'correct_answer' => 'in',
                    ],
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Pilih yang benar:',
                        'options' => ['She lives in London.', 'She lives at London.', 'She lives on London.', 'She lives to London.'],
                        'correct_answer' => 'She lives in London.',
                    ],
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Pilih yang benar:',
                        'options' => ['The map is on the wall.', 'The map is in the wall.', 'The map is at the wall.', 'The map is to the wall.'],
                        'correct_answer' => 'The map is on the wall.',
                    ],
                ],
            ],
            [
                'title' => 'Preposisi Arah (To, From, Into, Out of)',
                'order' => 3,
                'questions' => [
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Pilih yang benar:',
                        'options' => ['I am going to the store.', 'I am going at the store.', 'I am going in the store.', 'I am going on the store.'],
                        'correct_answer' => 'I am going to the store.',
                    ],
                    [
                        'question_type' => 'fill_in_blank',
                        'question' => 'Lengkapi: "She came ___ (dari) Japan."',
                        'options' => null,
                        'correct_answer' => 'from',
                    ],
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Pilih yang benar (gerakan ke dalam):',
                        'options' => ['He walked into the room.', 'He walked in the room.', 'He walked on the room.', 'He walked at the room.'],
                        'correct_answer' => 'He walked into the room.',
                    ],
                    [
                        'question_type' => 'fill_in_blank',
                        'question' => 'Lengkapi: "Take the book ___ (keluar dari) the bag."',
                        'options' => null,
                        'correct_answer' => 'out of',
                    ],
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Pilih yang benar:',
                        'options' => ['The cat jumped onto the roof.', 'The cat jumped to the roof.', 'The cat jumped at the roof.', 'The cat jumped in the roof.'],
                        'correct_answer' => 'The cat jumped onto the roof.',
                    ],
                ],
            ],
            [
                'title' => 'Preposisi Lainnya (With, For, About)',
                'order' => 4,
                'questions' => [
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Pilih yang benar:',
                        'options' => ['I am writing with a pen.', 'I am writing on a pen.', 'I am writing by a pen.', 'I am writing at a pen.'],
                        'correct_answer' => 'I am writing with a pen.',
                    ],
                    [
                        'question_type' => 'fill_in_blank',
                        'question' => 'Lengkapi: "This gift is ___ (untuk) you."',
                        'options' => null,
                        'correct_answer' => 'for',
                    ],
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Pilih yang benar:',
                        'options' => ['We are talking about the movie.', 'We are talking on the movie.', 'We are talking for the movie.', 'We are talking with the movie.'],
                        'correct_answer' => 'We are talking about the movie.',
                    ],
                    [
                        'question_type' => 'fill_in_blank',
                        'question' => 'Lengkapi: "I agree ___ (dengan) you."',
                        'options' => null,
                        'correct_answer' => 'with',
                    ],
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Pilih yang benar:',
                        'options' => ['He is waiting for the bus.', 'He is waiting to the bus.', 'He is waiting at the bus.', 'He is waiting on the bus.'],
                        'correct_answer' => 'He is waiting for the bus.',
                    ],
                ],
            ],
            [
                'title' => 'Preposisi Lainnya (By, Under, Over, Between)',
                'order' => 5,
                'questions' => [
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Pilih yang benar:',
                        'options' => ['The ball is under the table.', 'The ball is on the table.', 'The ball is in the table.', 'The ball is at the table.'],
                        'correct_answer' => 'The ball is under the table.',
                    ],
                    [
                        'question_type' => 'fill_in_blank',
                        'question' => 'Lengkapi: "The plane flew ___ (di atas) the city."',
                        'options' => null,
                        'correct_answer' => 'over',
                    ],
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Pilih yang benar (di antara dua):',
                        'options' => ['I am sitting between Tom and Jerry.', 'I am sitting among Tom and Jerry.', 'I am sitting with Tom and Jerry.', 'I am sitting under Tom and Jerry.'],
                        'correct_answer' => 'I am sitting between Tom and Jerry.',
                    ],
                    [
                        'question_type' => 'fill_in_blank',
                        'question' => 'Lengkapi: "I will go ___ (naik) car."',
                        'options' => null,
                        'correct_answer' => 'by',
                    ],
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Pilih yang benar:',
                        'options' => ['The cat is behind the door.', 'The cat is in front the door.', 'The cat is next the door.', 'The cat is by the door.'],
                        'correct_answer' => 'The cat is behind the door.',
                    ],
                ],
            ],
        ],
    ],
    // --- Modul 20 ---
    [
        'title' => 'Tata Bahasa: Comparatives & Superlatives',
        'description' => 'Membandingkan dua hal atau lebih.',
        'order' => 20,
        'lessons' => [
            [
                'title' => 'Bentuk Komparatif (Pendek)',
                'order' => 1,
                'questions' => [
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Kalimat mana yang benar?',
                        'options' => ['This car is faster that car.', 'This car is faster than that car.', 'This car is more fast that car.', 'This car is fast than that car.'],
                        'correct_answer' => 'This car is faster than that car.',
                    ],
                    [
                        'question_type' => 'fill_in_blank',
                        'question' => 'Lengkapi: "She is ___ (tinggi) than her brother."',
                        'options' => null,
                        'correct_answer' => 'taller',
                    ],
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Pilih yang benar:',
                        'options' => ['He is happyer than me.', 'He is happier than me.', 'He is more happy than me.', 'He is happy than me.'],
                        'correct_answer' => 'He is happier than me.',
                    ],
                    [
                        'question_type' => 'fill_in_blank',
                        'question' => 'Lengkapi: "This box is ___ (berat) than that one."',
                        'options' => null,
                        'correct_answer' => 'heavier',
                    ],
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Pilih yang benar:',
                        'options' => ['Today is hotter than yesterday.', 'Today is more hot than yesterday.', 'Today is hot than yesterday.', 'Today is hottier than yesterday.'],
                        'correct_answer' => 'Today is hotter than yesterday.',
                    ],
                ],
            ],
            [
                'title' => 'Bentuk Komparatif (Panjang)',
                'order' => 2,
                'questions' => [
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Pilih yang benar:',
                        'options' => ['This book is interestinger than the movie.', 'This book is interesting than the movie.', 'This book is more interesting than the movie.', 'This book is more interesting the movie.'],
                        'correct_answer' => 'This book is more interesting than the movie.',
                    ],
                    [
                        'question_type' => 'fill_in_blank',
                        'question' => 'Lengkapi: "A car is ___ (mahal) than a bicycle."',
                        'options' => null,
                        'correct_answer' => 'more expensive',
                    ],
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Pilih yang benar:',
                        'options' => ['She is beautifuler than her sister.', 'She is more beautiful than her sister.', 'She is beautiful than her sister.', 'She is more beautiful that her sister.'],
                        'correct_answer' => 'She is more beautiful than her sister.',
                    ],
                    [
                        'question_type' => 'fill_in_blank',
                        'question' => 'Lengkapi: "This test was ___ (sulit) than the last one."',
                        'options' => null,
                        'correct_answer' => 'more difficult',
                    ],
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Pilih yang benar:',
                        'options' => ['He is more careful now.', 'He is carefuler now.', 'He is careful now.', 'He is more carefully.'],
                        'correct_answer' => 'He is more careful now.',
                    ],
                ],
            ],
            [
                'title' => 'Bentuk Superlatif (Pendek)',
                'order' => 3,
                'questions' => [
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Pilih yang benar:',
                        'options' => ['He is the tallest boy in the class.', 'He is the taller boy in the class.', 'He is the most tall boy in the class.', 'He is tallest boy in the class.'],
                        'correct_answer' => 'He is the tallest boy in the class.',
                    ],
                    [
                        'question_type' => 'fill_in_blank',
                        'question' => 'Lengkapi: "Mount Everest is the ___ (tinggi) mountain."',
                        'options' => null,
                        'correct_answer' => 'highest',
                    ],
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Pilih yang benar:',
                        'options' => ['This is the bigger house.', 'This is the biggest house.', 'This is the more big house.', 'This is the bigest house.'],
                        'correct_answer' => 'This is the biggest house.',
                    ],
                    [
                        'question_type' => 'fill_in_blank',
                        'question' => 'Lengkapi: "She is the ___ (lucu) person I know."',
                        'options' => null,
                        'correct_answer' => 'funniest',
                    ],
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Pilih yang benar:',
                        'options' => ['It was the hotest day.', 'It was the hottest day.', 'It was the most hot day.', 'It was the hotter day.'],
                        'correct_answer' => 'It was the hottest day.',
                    ],
                ],
            ],
            [
                'title' => 'Bentuk Superlatif (Panjang)',
                'order' => 4,
                'questions' => [
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Pilih yang benar:',
                        'options' => ['This is the most expensive car.', 'This is the expensivest car.', 'This is the more expensive car.', 'This is the expensive car.'],
                        'correct_answer' => 'This is the most expensive car.',
                    ],
                    [
                        'question_type' => 'fill_in_blank',
                        'question' => 'Lengkapi: "She is the ___ (paling) intelligent student."',
                        'options' => null,
                        'correct_answer' => 'most',
                    ],
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Pilih yang benar:',
                        'options' => ['This is the most beautiful painting.', 'This is the beautifulest painting.', 'This is the beautiful painting.', 'This is the more beautiful painting.'],
                        'correct_answer' => 'This is the most beautiful painting.',
                    ],
                    [
                        'question_type' => 'fill_in_blank',
                        'question' => 'Lengkapi: "That was the ___ (paling) difficult exam."',
                        'options' => null,
                        'correct_answer' => 'most',
                    ],
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Pilih yang benar:',
                        'options' => ['He is the most careful driver.', 'He is the carefulest driver.', 'He is the careful driver.', 'He is the more careful driver.'],
                        'correct_answer' => 'He is the most careful driver.',
                    ],
                ],
            ],
            [
                'title' => 'Komparatif & Superlatif (Irregular)',
                'order' => 5,
                'questions' => [
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Bentuk komparatif dari "good" adalah...',
                        'options' => ['Gooder', 'Better', 'More good', 'Best'],
                        'correct_answer' => 'Better',
                    ],
                    [
                        'question_type' => 'fill_in_blank',
                        'question' => 'Lengkapi: "This is the ___ (terbaik) movie I have ever seen."',
                        'options' => null,
                        'correct_answer' => 'best',
                    ],
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Bentuk komparatif dari "bad" adalah...',
                        'options' => ['Bader', 'More bad', 'Worse', 'Worst'],
                        'correct_answer' => 'Worse',
                    ],
                    [
                        'question_type' => 'fill_in_blank',
                        'question' => 'Lengkapi: "That was the ___ (terburuk) day of my life."',
                        'options' => null,
                        'correct_answer' => 'worst',
                    ],
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Pilih yang benar:',
                        'options' => ['I have more money than you.', 'I have mucher money than you.', 'I have moneyer than you.', 'I have most money than you.'],
                        'correct_answer' => 'I have more money than you.',
                    ],
                ],
            ],
        ],
    ],
    // --- Modul 21 ---
    [
        'title' => 'Situasi Darurat',
        'description' => 'Belajar frasa penting untuk situasi darurat.',
        'order' => 21,
        'lessons' => [
            [
                'title' => 'Meminta Bantuan',
                'order' => 1,
                'questions' => [
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Apa yang Anda katakan jika Anda tersesat?',
                        'options' => ['I am lost.', 'I am hungry.', 'I am tired.', 'I am happy.'],
                        'correct_answer' => 'I am lost.',
                    ],
                    [
                        'question_type' => 'fill_in_blank',
                        'question' => 'Lengkapi: "Help! Somebody ___ my wallet!"',
                        'options' => null,
                        'correct_answer' => 'stole',
                    ],
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Apa bahasa Inggris untuk "Tolong!"?',
                        'options' => ['Help!', 'Hello!', 'Sorry!', 'Thanks!'],
                        'correct_answer' => 'Help!',
                    ],
                    [
                        'question_type' => 'fill_in_blank',
                        'question' => 'Lengkapi: "Please call the ___ (polisi)."',
                        'options' => null,
                        'correct_answer' => 'police',
                    ],
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Apa arti "It\'s an emergency"?',
                        'options' => ['Ini darurat.', 'Ini pesta.', 'Ini lelucon.', 'Ini liburan.'],
                        'correct_answer' => 'Ini darurat.',
                    ],
                ],
            ],
            [
                'title' => 'Darurat Medis',
                'order' => 2,
                'questions' => [
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Apa yang Anda panggil jika seseorang terluka parah?',
                        'options' => ['An ambulance', 'A taxi', 'A bus', 'A police car'],
                        'correct_answer' => 'An ambulance',
                    ],
                    [
                        'question_type' => 'fill_in_blank',
                        'question' => 'Lengkapi: "I need a ___ (dokter)."',
                        'options' => null,
                        'correct_answer' => 'doctor',
                    ],
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Apa arti "I can\'t breathe"?',
                        'options' => ['Saya tidak bisa bernapas.', 'Saya tidak bisa melihat.', 'Saya tidak bisa mendengar.', 'Saya tidak bisa berjalan.'],
                        'correct_answer' => 'Saya tidak bisa bernapas.',
                    ],
                    [
                        'question_type' => 'fill_in_blank',
                        'question' => 'Lengkapi: "He is ___ (berdarah) a lot."',
                        'options' => null,
                        'correct_answer' => 'bleeding',
                    ],
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Apa bahasa Inggris untuk "rumah sakit"?',
                        'options' => ['Hospital', 'Hotel', 'School', 'Station'],
                        'correct_answer' => 'Hospital',
                    ],
                ],
            ],
            [
                'title' => 'Kebakaran & Bencana',
                'order' => 3,
                'questions' => [
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Apa bahasa Inggris untuk "api"?',
                        'options' => ['Fire', 'Water', 'Earth', 'Air'],
                        'correct_answer' => 'Fire',
                    ],
                    [
                        'question_type' => 'fill_in_blank',
                        'question' => 'Lengkapi: "Call the ___ (pemadam kebakaran)!"',
                        'options' => null,
                        'correct_answer' => 'fire department',
                    ],
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Apa arti "earthquake"?',
                        'options' => ['Gempa bumi', 'Banjir', 'Badai', 'Tsunami'],
                        'correct_answer' => 'Gempa bumi',
                    ],
                    [
                        'question_type' => 'fill_in_blank',
                        'question' => 'Lengkapi: "Everyone needs to ___ (evakuasi) the building."',
                        'options' => null,
                        'correct_answer' => 'evacuate',
                    ],
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Apa bahasa Inggris untuk "banjir"?',
                        'options' => ['Flood', 'Drought', 'Storm', 'Fog'],
                        'correct_answer' => 'Flood',
                    ],
                ],
            ],
            [
                'title' => 'Kehilangan Sesuatu',
                'order' => 4,
                'questions' => [
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Apa arti "I lost my passport"?',
                        'options' => ['Saya kehilangan paspor saya.', 'Saya menemukan paspor saya.', 'Saya membeli paspor saya.', 'Saya tidak perlu paspor.'],
                        'correct_answer' => 'Saya kehilangan paspor saya.',
                    ],
                    [
                        'question_type' => 'fill_in_blank',
                        'question' => 'Lengkapi: "Have you ___ (melihat) my keys?"',
                        'options' => null,
                        'correct_answer' => 'seen',
                    ],
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Di mana Anda melaporkan barang hilang?',
                        'options' => ['Lost and Found', 'Restaurant', 'Restroom', 'Lobby'],
                        'correct_answer' => 'Lost and Found',
                    ],
                    [
                        'question_type' => 'fill_in_blank',
                        'question' => 'Lengkapi: "My ___ (tas) is missing."',
                        'options' => null,
                        'correct_answer' => 'bag',
                    ],
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Apa arti "I can\'t find..."?',
                        'options' => ['Saya tidak bisa menemukan...', 'Saya tidak mau...', 'Saya tidak punya...', 'Saya tidak suka...'],
                        'correct_answer' => 'Saya tidak bisa menemukan...',
                    ],
                ],
            ],
            [
                'title' => 'Masalah Mobil',
                'order' => 5,
                'questions' => [
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Apa arti "My car broke down"?',
                        'options' => ['Mobil saya rusak (mogok).', 'Mobil saya baru.', 'Mobil saya cepat.', 'Mobil saya dicuci.'],
                        'correct_answer' => 'Mobil saya rusak (mogok).',
                    ],
                    [
                        'question_type' => 'fill_in_blank',
                        'question' => 'Lengkapi: "I have a ___ (ban kempes)."',
                        'options' => null,
                        'correct_answer' => 'flat tire',
                    ],
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Apa yang terjadi jika Anda kehabisan bensin?',
                        'options' => ['You run out of gas.', 'You run on gas.', 'You run with gas.', 'You run gas.'],
                        'correct_answer' => 'You run out of gas.',
                    ],
                    [
                        'question_type' => 'fill_in_blank',
                        'question' => 'Lengkapi: "I need to call a ___ (truk derek)."',
                        'options' => null,
                        'correct_answer' => 'tow truck',
                    ],
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Apa bahasa Inggris untuk "mesin"?',
                        'options' => ['Engine', 'Wheel', 'Door', 'Window'],
                        'correct_answer' => 'Engine',
                    ],
                ],
            ],
        ],
    ],
    // --- Modul 22 ---
    [
        'title' => 'Telepon & Komunikasi',
        'description' => 'Etika dasar berbicara di telepon.',
        'order' => 22,
        'lessons' => [
            [
                'title' => 'Memulai Panggilan',
                'order' => 1,
                'questions' => [
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Bagaimana cara sopan meminta berbicara dengan seseorang?',
                        'options' => ['Where is John?', 'I want John.', 'May I speak to John, please?', 'Is John there?'],
                        'correct_answer' => 'May I speak to John, please?',
                    ],
                    [
                        'question_type' => 'fill_in_blank',
                        'question' => 'Lengkapi: "Hello, ___ is Rian calling."',
                        'options' => null,
                        'correct_answer' => 'this',
                    ],
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Apa arti "Who\'s calling, please?"',
                        'options' => ['Anda menelepon siapa?', 'Ini siapa ya (yang menelepon)?', 'Mau kemana?', 'Ada masalah apa?'],
                        'correct_answer' => 'Ini siapa ya (yang menelepon)?',
                    ],
                    [
                        'question_type' => 'fill_in_blank',
                        'question' => 'Lengkapi: "I\'m calling ___ (tentang) the job advertisement."',
                        'options' => null,
                        'correct_answer' => 'about',
                    ],
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Pilih yang benar:',
                        'options' => ['Is John available?', 'Is John busy?', 'Is John there?', 'Semua benar tergantung konteks'],
                        'correct_answer' => 'Is John available?',
                    ],
                ],
            ],
            [
                'title' => 'Menjawab Panggilan',
                'order' => 2,
                'questions' => [
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Apa yang Anda katakan jika Anda adalah John?',
                        'options' => ['This is he/she.', 'Speaking.', 'Keduanya benar', 'John is not here.'],
                        'correct_answer' => 'Keduanya benar',
                    ],
                    [
                        'question_type' => 'fill_in_blank',
                        'question' => 'Lengkapi: "Please ___ (tunggu) a moment."',
                        'options' => null,
                        'correct_answer' => 'hold',
                    ],
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Apa arti "I\'m afraid he\'s not in"?',
                        'options' => ['Saya takut dia di dalam.', 'Sayangnya dia sedang tidak ada.', 'Dia ada di sini.', 'Dia tidak mau bicara.'],
                        'correct_answer' => 'Sayangnya dia sedang tidak ada.',
                    ],
                    [
                        'question_type' => 'fill_in_blank',
                        'question' => 'Lengkapi: "Can I ___ (mengambil) a message?"',
                        'options' => null,
                        'correct_answer' => 'take',
                    ],
                    [
                        'question_type' => 'multiple_choice',
                        'question' => 'Apa arti "The line is busy"?',
                        'options' => ['Teleponnya sibuk.', 'Teleponnya rusak.', 'Teleponnya gratis.', 'Teleponnya ada.'],
                        'correct_answer' => 'Teleponnya sibuk.',
                    ],
                ],
            ],
        ],
    ]
];

        DB::transaction(function () use ($modules) {
            LanguageQuestion::query()->delete();
            LanguageLesson::query()->delete();
            LanguageModule::query()->delete();

            foreach ($modules as $moduleData) {
                $lessons = $moduleData['lessons'] ?? [];
                unset($moduleData['lessons']);

                /** @var \App\Models\LanguageModule $module */
                $module = LanguageModule::create($moduleData);

                foreach ($lessons as $lessonData) {
                    $questions = $lessonData['questions'] ?? [];
                    unset($lessonData['questions']);

                    /** @var \App\Models\LanguageLesson $lesson */
                    $lesson = $module->lessons()->create($lessonData);

                    foreach ($questions as $question) {
                        $lesson->questions()->create([
                            'question_type' => $question['question_type'],
                            'question' => $question['question'],
                            'options' => $question['options'],
                            'correct_answer' => $question['correct_answer'],
                        ]);
                    }
                }
            }
        });
    }
}
