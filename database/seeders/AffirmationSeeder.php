<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Affirmation;

class AffirmationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $phrases = [
            "Saya mampu mencapai hal-hal besar.",
            "Hari ini adalah hari yang produktif.",
            "Saya belajar dan bertumbuh setiap hari.",
            "Saya pantas untuk sukses.",
            "Saya bersyukur atas kesempatan baru.",
            "Saya fokus pada hal-hal yang bisa saya kontrol.",
            "Saya layak dicintai dan mencintai.",
            "Saya percaya pada proses hidup.",
            "Saya berani mengambil langkah pertama.",
            "Saya hadir penuh di momen ini.",
            "Saya memilih tenang dan jernih.",
            "Saya konsisten melakukan hal kecil yang benar.",
            "Saya selalu menemukan jalan.",
            "Saya memaafkan diri dan melangkah maju.",
            "Saya kreatif dan solutif.",
            "Saya membawa nilai bagi orang lain.",
            "Saya punya waktu untuk yang penting.",
            "Saya disiplin dan fleksibel sekaligus.",
            "Saya sehat, kuat, dan berenergi.",
            "Saya percaya diri dan rendah hati.",
            "Saya membuat kemajuan setiap hari.",
            "Saya terbuka pada peluang baru.",
            "Saya fokus pada solusi, bukan masalah.",
            "Saya mengelola emosi dengan bijak.",
            "Saya menarik hal-hal baik ke dalam hidup saya.",
            "Saya bangga dengan diri saya hari ini.",
            "Saya mampu menyelesaikan apa yang saya mulai.",
            "Saya dikelilingi dukungan dan kebaikan.",
            "Saya memilih kata-kata yang membangun.",
            "Saya menginspirasi dengan tindakan.",
            "Saya selaras dengan tujuan saya.",
            "Saya menghormati batasan diri dan orang lain.",
            "Saya hadir utuh untuk orang yang saya sayang.",
            "Saya mempraktikkan rasa syukur setiap hari.",
            "Saya bertanggung jawab atas hidup saya.",
            "Saya mampu belajar apa pun yang saya butuhkan.",
            "Saya tetap tenang di tengah perubahan.",
            "Saya menikmati proses, bukan hanya hasil.",
            "Saya membuat keputusan dengan yakin.",
            "Saya memelihara tubuh dan pikiran saya.",
            "Saya memilih fokus, bukan distraksi.",
            "Saya menyambut tantangan sebagai kesempatan.",
            "Saya konsisten menjadi versi terbaik diri saya.",
            "Saya berdamai dengan masa lalu dan penuh harapan.",
            "Saya tulus dan autentik.",
            "Saya berani meminta bantuan saat perlu.",
            "Saya menata hidup saya dengan sederhana.",
            "Saya punya kapasitas untuk lebih baik.",
            "Saya merayakan progres kecil hari ini.",
            "Saya menutup hari dengan rasa syukur.",
            "Saya memulai hari dengan niat baik.",
            "Saya bergerak satu langkah demi satu.",
            "Saya membangun kebiasaan positif.",
            "Saya menghargai waktu dan energi saya.",
            "Saya siap menerima kebaikan tak terduga.",
            "Saya melihat sisi terang setiap situasi.",
            "Saya memilih keberanian daripada ketakutan.",
            "Saya berharga apa adanya.",
            "Saya mampu mengubah hari ini menjadi lebih baik.",
            "Saya menyelesaikan prioritas terpenting.",
            "Saya mendengarkan intuisi dan data.",
            "Saya ringan tangan membantu orang lain.",
            "Saya tidak perlu sempurna untuk mulai.",
            "Saya menikmati napas dan ketenangan.",
            "Saya adalah pembelajar seumur hidup.",
            "Saya selalu ada cara untuk bertumbuh.",
            "Saya memberi ruang untuk istirahat.",
            "Saya menjaga komitmen pada diri sendiri.",
            "Saya layak meraih mimpi saya.",
            "Saya memercayai perjalanan unik saya.",
            "Saya hadir dengan rasa ingin tahu.",
            "Saya cukup, dan saya berkembang.",
        ];

        $rows = array_map(fn($t) => ['text' => $t, 'created_at' => now(), 'updated_at' => now()], $phrases);
        Affirmation::insert($rows);
    }
}
