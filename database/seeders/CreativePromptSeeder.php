<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CreativePrompt;

class CreativePromptSeeder extends Seeder
{
    public function run(): void
    {
        $prompts = [
            "Gambarkan robot yang sedang mengantuk sambil memegang cangkir kopi.",
            "Tulis 3 kalimat tentang kopi dari perspektif seekor semut.",
            "Desain logo untuk perusahaan fiktif bernama 'Awan Instan'.",
            "Bayangkan kursi yang bisa berbicara, apa keluhannya?",
            "Tuliskan iklan singkat untuk payung yang bisa memutar musik jazz.",
            "Jika pensil punya mimpi, apa mimpinya?",
            "Gambar peta kota yang seluruhnya terbuat dari makanan.",
            "Buat nama dan slogan untuk aplikasi pengingat minum air yang dramatis.",
            "Tulis haiku tentang charger HP yang hilang.",
            "Deskripsikan jam dinding yang iri pada jam tangan pintar.",
            "Buat sketsa konsep alat yang bisa menangkap ide sebelum lupa.",
            "Tulis 4 baris rap tentang hujan gerimis di pagi Senin.",
            "Bayangkan awan bisa dikemas dan dijual: tulis deskripsi produknya.",
            "Ciptakan tantangan viral seputar sepatu yang terlalu bersemangat.",
            "Jelaskan rasa 'warna ungu' pada orang yang belum pernah melihatnya.",
            "Tuliskan ucapan selamat ulang tahun dari seekor kaktus.",
            "Buat nama-nama menu minuman futuristik di kedai cyberpunk.",
            "Tulis 2 paragraf tentang kulkas yang ingin jalan-jalan.",
            "Desain poster film tentang sendok terakhir di laci dapur.",
            "Tuliskan surat resign lucu dari boneka di rak toko mainan.",
            "Gambarkan helm yang membuat penggunanya bisa mendengar tanaman berbicara.",
            "Buat tagline untuk bank emosi (deposit rasa, tarik inspirasi).",
            "Tuliskan catatan harian pertama seekor ikan yang baru bisa terbang.",
            "Jelaskan feature 'mode malas' pada sepeda pintar.",
            "Tuliskan pitch startup yang menjual 'keheningan instan'.",
            "Buat 5 nama aroma lilin wangi abstrak (misal: 'Optimisme Basah').",
            "Bayangkan cermin hanya bisa memantulkan masa depan 5 menit lagi.",
            "Deskripsikan sarung tangan yang bisa menerjemahkan sentuhan jadi teks.",
            "Tuliskan puisi bebas tentang baterai 1%.",
            "Buat instruksi manual untuk gulali anti-gravitasi.",
            "Jelaskan fungsi 'tombol undo' di kehidupan nyata versi kamu.",
            "Tuliskan monolog dari sudut pandang sandal hotel.",
            "Desain paket snack rasa nostalgia masa kecil.",
            "Tulis iklan lowongan kerja untuk 'Pengelola Awan Harian'.",
            "Ciptakan 10 nama domain unik untuk blog serangga modern.",
            "Tuliskan thread edukatif tentang 'ritme kipas angin'.",
            "Bayangkan kalender yang menolak akhir pekan.",
            "Buat 3 variasi dialog antara kopi dan teh saling debat.",
            "Tuliskan deskripsi museum yang memamerkan tawa manusia.",
            "Jelaskan cara kerja pena yang menulis perasaan bukan kata.",
            "Desain interface aplikasi yang mengukur kedalaman ide.",
            "Tulis email reminder yang dikirim oleh meja kerja berantakan.",
            "Bayangkan headphone bisa menyaring pikiran sendiri.",
            "Tuliskan 8 nama level 'game merapikan kamar'.",
            "Deskripsikan toko oleh-oleh dari dimensi sebelah.",
            "Tulis pitch singkat NFT 'Suara Ketika Tidur'.",
            "Gambarkan jam alarm yang bisa bernegosiasi dengan penggunanya.",
            "Tuliskan tweet viral dari pohon yang baru belajar internet.",
            "Buat tagline untuk sepeda yang bisa mengubah emosi jadi kecepatan.",
            "Deskripsikan rasa 'senin produktif' sebagai makanan.",
            "Tuliskan tutorial 'cara memelihara ide liar'.",
            "Bayangkan elevator yang memilih lantai berdasarkan mood penumpang.",
            "Tulis 3 kalimat tentang tas ransel yang takut hujan.",
            "Buat daftar fitur 'jam pasir digital'.",
            "Tuliskan iklan promo diskon untuk 'paket inspirasi kilat'.",
            "Jelaskan sofa yang bisa menyimpan rahasia percakapan.",
            "Buat nama program TV tentang kehidupan colokan listrik.",
            "Tuliskan doa lucu dari baterai remote hampir habis.",
            "Bayangkan koper yang memilih destinasi sendiri.",
            "Deskripsikan perangkat yang bisa mengedit mimpi sebelum tidur.",
            "Tulis 3 slogan alternatif untuk 'Waktu Adalah Uang'.",
            "Buat nama festival untuk benda-benda yang hilang di rumah.",
            "Tuliskan catatan kecil dari sudut ruangan paling sepi.",
            "Desain UI jam yang menampilkan 'intensitas kreativitas'.",
            "Tulis jurnal satu paragraf tentang ide yang gagal lahir.",
            "Bayangkan lampu tidur yang memproyeksikan pikiran positif.",
            "Buat 6 judul playlist musik untuk fokus absurd.",
            "Tuliskan resep 'kue motivasi panggang'.",
            "Deskripsikan pena yang menghapus rasa ragu.",
            "Tulis catatan sistem 'error: imajinasi overload'.",
        ];

        CreativePrompt::insert(array_map(fn($p) => [
            'prompt_text' => $p,
            'created_at' => now(),
            'updated_at' => now(),
        ], $prompts));
    }
}
