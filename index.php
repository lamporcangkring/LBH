<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>LawyerApp - Manajemen Pengacara</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        [x-cloak] { display: none !important; }
        html { scroll-behavior: smooth; }
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    </style>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#1e293b',
                        secondary: '#334155',
                        accent: '#2563eb',
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-gray-50 text-slate-800 font-sans antialiased" x-data="app()">

    <!-- LANDING PAGE -->
    <div x-show="!isLoggedIn" class="min-h-screen bg-white flex flex-col font-sans" x-init="fetch('api.php').then(r=>r.json()).then(d=>{articles=d.articles||[];teams=d.teams||[];gallery=d.gallery||[]})">
        
        <!-- Header -->
        <header class="bg-slate-900/95 backdrop-blur-md fixed w-full top-0 z-50 border-b border-yellow-700/30 shadow-lg transition-all duration-300">
            <div class="max-w-7xl mx-auto px-6 h-20 flex justify-between items-center">
                <div class="flex items-center gap-3">
                    <img src="logo lbh.jpeg" alt="Logo LBH PK" class="h-12 w-12 rounded-full object-cover border-2 border-yellow-600">
                    <div>
                        <h1 class="text-lg font-bold text-yellow-500 tracking-tight leading-tight">PUNGGAWA KEADILAN</h1>
                        <p class="text-[10px] text-yellow-600/80 tracking-widest italic">Pro Justitia</p>
                    </div>
                </div>
                <nav class="hidden md:flex gap-6 font-medium text-gray-300 text-sm">
                    <a href="#home" class="hover:text-yellow-400 transition">Beranda</a>
                    <a href="#layanan" class="hover:text-yellow-400 transition">Layanan</a>
                    <a href="#tim" class="hover:text-yellow-400 transition">Tim Kami</a>
                    <a href="#legalitas" class="hover:text-yellow-400 transition">Legalitas</a>
                    <a href="#artikel" class="hover:text-yellow-400 transition">Artikel</a>
                    <a href="#galeri" class="hover:text-yellow-400 transition">Galeri</a>
                    <a href="#kontak" class="hover:text-yellow-400 transition">Kontak</a>
                </nav>
                <button @click="showLogin = true" class="bg-yellow-600 text-slate-900 px-5 py-2 rounded font-bold text-sm hover:bg-yellow-500 transition shadow-lg">Masuk Portal</button>
            </div>
        </header>

        <!-- Hero Section -->
        <section id="home" class="relative pt-20 flex items-center justify-center min-h-screen">
            <div class="absolute inset-0 z-0">
                <img src="galeri/WhatsApp Image 2026-09-21 at 19.12.05 (2).jpeg" class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-b from-slate-900/90 via-slate-900/70 to-slate-900/95"></div>
            </div>
            <div class="relative z-10 text-center px-6 max-w-4xl mx-auto text-white">
                <img src="logo lbh.jpeg" alt="Logo" class="h-28 w-28 mx-auto rounded-full border-4 border-yellow-600 shadow-2xl mb-8 object-cover">
                <div class="inline-block px-4 py-1.5 rounded-full bg-yellow-600/20 border border-yellow-600/50 text-yellow-300 text-xs font-bold tracking-[0.3em] uppercase mb-6">Lembaga Bantuan Hukum</div>
                <h2 class="text-5xl md:text-7xl font-bold mb-4 font-serif leading-tight" style="font-family:'Playfair Display',serif">PUNGGAWA KEADILAN</h2>
                <p class="text-2xl text-yellow-400 italic mb-8 font-serif">Pro Justitia</p>
                <p class="text-lg text-gray-300 mb-10 max-w-2xl mx-auto leading-relaxed">&ldquo;Pembela Rakyat, Penegak Keadilan&rdquo; &mdash; Memberikan layanan bantuan hukum yang independen, profesional, dan terpercaya.</p>
                <div class="flex flex-col sm:flex-row justify-center gap-4">
                    <a href="https://wa.me/628820003620210" target="_blank" class="flex items-center justify-center gap-2 bg-green-600 text-white px-8 py-4 rounded font-bold hover:bg-green-500 transition">
                        <i class="fab fa-whatsapp text-xl"></i> Konsultasi Gratis
                    </a>
                    <a href="#layanan" class="bg-yellow-600/20 backdrop-blur-md text-yellow-300 border border-yellow-600/50 px-8 py-4 rounded font-bold hover:bg-yellow-600/40 transition text-lg">Lihat Layanan</a>
                </div>
            </div>
        </section>

        <!-- Stats -->
        <section class="bg-slate-900 py-10 border-y border-yellow-700/30">
            <div class="max-w-7xl mx-auto px-6 grid grid-cols-2 md:grid-cols-4 gap-6 text-center">
                <div class="p-4">
                    <div class="text-3xl font-bold text-yellow-500 mb-1"><i class="fas fa-map-marker-alt mr-2"></i>2</div>
                    <div class="text-gray-400 text-xs uppercase tracking-wider font-medium">Kantor Wilayah</div>
                    <div class="text-gray-500 text-[11px] mt-1">Purbalingga & Lampung</div>
                </div>
                <div class="p-4">
                    <div class="text-3xl font-bold text-yellow-500 mb-1"><i class="fas fa-users mr-2"></i>10+</div>
                    <div class="text-gray-400 text-xs uppercase tracking-wider font-medium">Tenaga Hukum</div>
                    <div class="text-gray-500 text-[11px] mt-1">Profesional & Berdedikasi</div>
                </div>
                <div class="p-4">
                    <div class="text-3xl font-bold text-yellow-500 mb-1"><i class="fas fa-gavel mr-2"></i>9</div>
                    <div class="text-gray-400 text-xs uppercase tracking-wider font-medium">Layanan Hukum</div>
                    <div class="text-gray-500 text-[11px] mt-1">Pidana, Perdata & Lainnya</div>
                </div>
                <div class="p-4">
                    <div class="text-3xl font-bold text-yellow-500 mb-1"><i class="fas fa-phone-alt mr-2"></i>24/7</div>
                    <div class="text-gray-400 text-xs uppercase tracking-wider font-medium">Konsultasi</div>
                    <div class="text-gray-500 text-[11px] mt-1">Siap Melayani Anda</div>
                </div>
            </div>
        </section>

        <!-- Layanan Hukum -->
        <section id="layanan" class="py-20 bg-gray-50 px-6">
            <div class="max-w-7xl mx-auto">
                <div class="text-center mb-14">
                    <h3 class="text-yellow-600 text-xs font-bold tracking-[0.3em] uppercase mb-2">Pelayanan Hukum</h3>
                    <h2 class="text-4xl font-bold text-slate-800 font-serif">Layanan Kami</h2>
                    <div class="w-20 h-1 bg-yellow-600 mx-auto mt-5"></div>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    <div class="bg-white p-7 rounded-lg border border-gray-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 group">
                        <div class="w-14 h-14 bg-yellow-50 text-yellow-600 flex items-center justify-center rounded-full text-xl mb-5 group-hover:bg-yellow-600 group-hover:text-white transition"><i class="fas fa-phone"></i></div>
                        <h4 class="text-lg font-bold text-slate-800 mb-2">Konsultasi Hukum Segala Perkara</h4>
                        <p class="text-gray-500 text-sm leading-relaxed">Layanan konsultasi hukum komprehensif untuk semua jenis permasalahan hukum yang Anda hadapi.</p>
                    </div>
                    <div class="bg-white p-7 rounded-lg border border-gray-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 group">
                        <div class="w-14 h-14 bg-yellow-50 text-yellow-600 flex items-center justify-center rounded-full text-xl mb-5 group-hover:bg-yellow-600 group-hover:text-white transition"><i class="fas fa-handshake"></i></div>
                        <h4 class="text-lg font-bold text-slate-800 mb-2">Pendampingan & Pembelaan</h4>
                        <p class="text-gray-500 text-sm leading-relaxed">Pendampingan dan pembelaan di semua tingkat pengadilan, mulai dari PN hingga MA.</p>
                    </div>
                    <div class="bg-white p-7 rounded-lg border border-gray-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 group">
                        <div class="w-14 h-14 bg-yellow-50 text-yellow-600 flex items-center justify-center rounded-full text-xl mb-5 group-hover:bg-yellow-600 group-hover:text-white transition"><i class="fas fa-file-contract"></i></div>
                        <h4 class="text-lg font-bold text-slate-800 mb-2">Penyusunan Dokumen Hukum</h4>
                        <p class="text-gray-500 text-sm leading-relaxed">Surat Kuasa, Perjanjian, Somasi, Akta, dan dokumen hukum lainnya yang Anda butuhkan.</p>
                    </div>
                    <div class="bg-white p-7 rounded-lg border border-gray-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 group">
                        <div class="w-14 h-14 bg-yellow-50 text-yellow-600 flex items-center justify-center rounded-full text-xl mb-5 group-hover:bg-yellow-600 group-hover:text-white transition"><i class="fas fa-exclamation-triangle"></i></div>
                        <h4 class="text-lg font-bold text-slate-800 mb-2">Pengaduan & Laporan</h4>
                        <p class="text-gray-500 text-sm leading-relaxed">Pengaduan dan laporan ke Kepolisian, Kejaksaan, dan instansi terkait lainnya.</p>
                    </div>
                    <div class="bg-white p-7 rounded-lg border border-gray-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 group">
                        <div class="w-14 h-14 bg-yellow-50 text-yellow-600 flex items-center justify-center rounded-full text-xl mb-5 group-hover:bg-yellow-600 group-hover:text-white transition"><i class="fas fa-people-arrows"></i></div>
                        <h4 class="text-lg font-bold text-slate-800 mb-2">Penyelesaian Sengketa</h4>
                        <p class="text-gray-500 text-sm leading-relaxed">Mediasi, Negosiasi, dan Arbitrase sebagai alternatif penyelesaian sengketa di luar pengadilan.</p>
                    </div>
                    <div class="bg-white p-7 rounded-lg border border-gray-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 group">
                        <div class="w-14 h-14 bg-yellow-50 text-yellow-600 flex items-center justify-center rounded-full text-xl mb-5 group-hover:bg-yellow-600 group-hover:text-white transition"><i class="fas fa-leaf"></i></div>
                        <h4 class="text-lg font-bold text-slate-800 mb-2">Hukum Agraria & SDA</h4>
                        <p class="text-gray-500 text-sm leading-relaxed">Bantuan hukum bidang agraria, pertanahan, dan sumber daya alam.</p>
                    </div>
                    <div class="bg-white p-7 rounded-lg border border-gray-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 group">
                        <div class="w-14 h-14 bg-yellow-50 text-yellow-600 flex items-center justify-center rounded-full text-xl mb-5 group-hover:bg-yellow-600 group-hover:text-white transition"><i class="fas fa-chalkboard-user"></i></div>
                        <h4 class="text-lg font-bold text-slate-800 mb-2">Pendidikan & Penyuluhan Hukum</h4>
                        <p class="text-gray-500 text-sm leading-relaxed">Sosialisasi dan penyuluhan hukum ke masyarakat agar sadar, paham, dan mampu menggunakan hak hukumnya.</p>
                    </div>
                    <div class="bg-white p-7 rounded-lg border border-gray-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 group">
                        <div class="w-14 h-14 bg-yellow-50 text-yellow-600 flex items-center justify-center rounded-full text-xl mb-5 group-hover:bg-yellow-600 group-hover:text-white transition"><i class="fas fa-shield-alt"></i></div>
                        <h4 class="text-lg font-bold text-slate-800 mb-2">Pendampingan Khusus</h4>
                        <p class="text-gray-500 text-sm leading-relaxed">Masyarakat tidak mampu, mantan narapidana, dan kelompok rentan lainnya.</p>
                    </div>
                    <div class="bg-white p-7 rounded-lg border border-gray-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 group">
                        <div class="w-14 h-14 bg-yellow-50 text-yellow-600 flex items-center justify-center rounded-full text-xl mb-5 group-hover:bg-yellow-600 group-hover:text-white transition"><i class="fas fa-heart"></i></div>
                        <h4 class="text-lg font-bold text-slate-800 mb-2">Gugatan Perceraian & Konseling</h4>
                        <p class="text-gray-500 text-sm leading-relaxed">Penanganan kasus perceraian, hak asuh anak, dan konseling keluarga secara profesional.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Tim Kami -->
        <style>
            .marquee-container {
                overflow: hidden;
                white-space: nowrap;
                width: 100%;
                position: relative;
            }
            .marquee-content {
                display: inline-flex;
                animation: marquee 30s linear infinite;
            }
            .marquee-content:hover {
                animation-play-state: paused;
            }
            @keyframes marquee {
                0% { transform: translateX(0); }
                100% { transform: translateX(-50%); }
            }
            .team-card {
                width: 220px;
                flex-shrink: 0;
                white-space: normal;
                padding: 0 15px;
            }
        </style>
        <section id="tim" class="py-20 bg-slate-900 px-0">
            <div class="max-w-7xl mx-auto px-6">
                <div class="text-center mb-14">
                    <h3 class="text-yellow-500 text-xs font-bold tracking-[0.3em] uppercase mb-2">Struktur Organisasi</h3>
                    <h2 class="text-4xl font-bold text-white font-serif">Tim Kami</h2>
                    <div class="w-20 h-1 bg-yellow-600 mx-auto mt-5"></div>
                </div>
            </div>
            
            <!-- Dynamic Marquee -->
            <div class="marquee-container" x-ref="teamMarquee">
                <div class="marquee-content" x-ref="teamMarqueeContent">
                    <!-- First Set (dynamic) -->
                    <template x-for="t in teams" :key="'a'+t.id">
                        <div class="team-card text-center group">
                            <div class="w-32 h-32 mx-auto rounded-full overflow-hidden border-3 border-yellow-600/50 shadow-lg mb-4 group-hover:border-yellow-400 transition">
                                <img :src="normalizeImage(t.image) || 'https://ui-avatars.com/api/?name=' + encodeURIComponent(t.name) + '&background=1e293b&color=eab308&size=128'" class="w-full h-full object-cover">
                            </div>
                            <h4 class="text-white font-bold text-sm" x-text="t.name"></h4>
                            <p class="text-yellow-500 text-xs mt-1" x-text="t.position"></p>
                            <p class="text-gray-500 text-[10px]" x-text="t.region" x-show="t.region"></p>
                        </div>
                    </template>
                    <!-- Duplicated Set for Infinite Scroll -->
                    <template x-for="t in teams" :key="'b'+t.id">
                        <div class="team-card text-center group">
                            <div class="w-32 h-32 mx-auto rounded-full overflow-hidden border-3 border-yellow-600/50 shadow-lg mb-4 group-hover:border-yellow-400 transition">
                                <img :src="normalizeImage(t.image) || 'https://ui-avatars.com/api/?name=' + encodeURIComponent(t.name) + '&background=1e293b&color=eab308&size=128'" class="w-full h-full object-cover">
                            </div>
                            <h4 class="text-white font-bold text-sm" x-text="t.name"></h4>
                            <p class="text-yellow-500 text-xs mt-1" x-text="t.position"></p>
                            <p class="text-gray-500 text-[10px]" x-text="t.region" x-show="t.region"></p>
                        </div>
                    </template>
                </div>
            </div>

            <!-- Fallback: jika belum ada data tim -->
            <div x-show="teams.length === 0" class="text-center py-12 text-gray-500">
                <i class="fas fa-users text-4xl mb-3 block opacity-30"></i>
                <p class="text-sm">Data tim sedang dimuat...</p>
            </div>
        </section>

        <!-- Legalitas -->
        <section id="legalitas" class="py-20 bg-white px-6">
            <div class="max-w-7xl mx-auto">
                <div class="text-center mb-14">
                    <h3 class="text-yellow-600 text-xs font-bold tracking-[0.3em] uppercase mb-2">Terdaftar & Resmi</h3>
                    <h2 class="text-4xl font-bold text-slate-800 font-serif">Legalitas Kami</h2>
                    <div class="w-20 h-1 bg-yellow-600 mx-auto mt-5"></div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">
                    <div class="bg-gradient-to-br from-slate-900 to-slate-800 p-8 rounded-xl text-center shadow-xl border border-yellow-700/30">
                        <div class="w-16 h-16 bg-yellow-600/20 text-yellow-500 flex items-center justify-center rounded-full text-2xl mb-5 mx-auto"><i class="fas fa-stamp"></i></div>
                        <h4 class="text-lg font-bold text-yellow-400 mb-3">Akta Notaris</h4>
                        <p class="text-gray-300 text-sm leading-relaxed">Notaris <strong>Deni Nurhayati, S.H., M.Kn.</strong></p>
                        <p class="text-gray-400 text-sm">No. 03 Tanggal 22 Desember 2022</p>
                    </div>
                    <div class="bg-gradient-to-br from-slate-900 to-slate-800 p-8 rounded-xl text-center shadow-xl border border-yellow-700/30">
                        <div class="w-16 h-16 bg-yellow-600/20 text-yellow-500 flex items-center justify-center rounded-full text-2xl mb-5 mx-auto"><i class="fas fa-certificate"></i></div>
                        <h4 class="text-lg font-bold text-yellow-400 mb-3">SK Menkumham</h4>
                        <p class="text-gray-300 text-sm leading-relaxed">No. <strong>AHU-0000128-AH.01.22</strong></p>
                        <p class="text-gray-400 text-sm">Tahun 2023</p>
                    </div>
                    <div class="bg-gradient-to-br from-slate-900 to-slate-800 p-8 rounded-xl text-center shadow-xl border border-yellow-700/30">
                        <div class="w-16 h-16 bg-yellow-600/20 text-yellow-500 flex items-center justify-center rounded-full text-2xl mb-5 mx-auto"><i class="fas fa-landmark"></i></div>
                        <h4 class="text-lg font-bold text-yellow-400 mb-3">Legal Standing</h4>
                        <p class="text-gray-300 text-sm leading-relaxed">UU No. 16 Tahun 2011 (Bantuan Hukum)</p>
                        <p class="text-gray-400 text-sm">UU No. 18 Tahun 2003 (Advokat)</p>
                    </div>
                </div>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    <div class="rounded-lg overflow-hidden shadow-md hover:shadow-xl transition cursor-pointer"><img src="legalitas/WhatsApp Image 2026-09-21 at 19.11.59 (2).jpeg" class="w-full h-48 object-cover"></div>
                    <div class="rounded-lg overflow-hidden shadow-md hover:shadow-xl transition cursor-pointer"><img src="legalitas/WhatsApp Image 2026-09-21 at 19.11.59 (1).jpeg" class="w-full h-48 object-cover"></div>
                    <div class="rounded-lg overflow-hidden shadow-md hover:shadow-xl transition cursor-pointer"><img src="legalitas/WhatsApp Image 2026-09-21 at 19.11.59.jpeg" class="w-full h-48 object-cover"></div>
                    <div class="rounded-lg overflow-hidden shadow-md hover:shadow-xl transition cursor-pointer"><img src="legalitas/WhatsApp Image 2026-09-21 at 19.12.02.jpeg" class="w-full h-48 object-cover"></div>
                </div>
            </div>
        </section>

        <!-- Artikel -->
        <section id="artikel" class="py-20 px-6 bg-gray-50">
            <div class="max-w-7xl mx-auto">
                <div class="text-center mb-14">
                    <h3 class="text-yellow-600 text-xs font-bold tracking-[0.3em] uppercase mb-2">Berita & Wawasan</h3>
                    <h2 class="text-4xl font-bold text-slate-800 font-serif">Artikel Hukum</h2>
                    <div class="w-20 h-1 bg-yellow-600 mx-auto mt-5"></div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <template x-for="art in articles" :key="art.id">
                        <div class="bg-white rounded-lg overflow-hidden shadow-sm hover:shadow-xl transition border border-gray-100 flex flex-col text-left group">
                            <div class="h-52 bg-gray-200 overflow-hidden"><img :src="normalizeImage(art.image) || 'law2.jpg'" class="w-full h-full object-cover group-hover:scale-105 transition duration-500"></div>
                            <div class="p-6 flex-1 flex flex-col">
                                <div class="text-xs text-yellow-600 font-bold mb-2 uppercase tracking-wider" x-text="art.category"></div>
                                <h4 class="text-lg font-bold mb-2 text-slate-800 leading-snug group-hover:text-yellow-700 transition" x-text="art.title"></h4>
                                <p class="text-gray-500 text-sm flex-1 leading-relaxed" x-text="art.content.length > 120 ? art.content.substring(0,120)+'...' : art.content"></p>
                                <div class="mt-4 pt-4 border-t border-gray-100 flex justify-between items-center">
                                    <span class="text-gray-400 text-xs" x-text="art.created_at"></span>
                                    <a href="#" class="text-yellow-600 font-medium text-sm hover:underline">Baca &rarr;</a>
                                </div>
                            </div>
                        </div>
                    </template>
                    <template x-if="articles.length === 0">
                        <div class="col-span-3 text-center py-16 text-gray-400"><i class="fas fa-newspaper text-4xl mb-4 block"></i>Artikel akan segera hadir.</div>
                    </template>
                </div>
            </div>
        </section>

        <!-- Galeri -->
        <section id="galeri" class="py-20 bg-white px-6">
            <div class="max-w-7xl mx-auto">
                <div class="text-center mb-14">
                    <h3 class="text-yellow-600 text-xs font-bold tracking-[0.3em] uppercase mb-2">Dokumentasi</h3>
                    <h2 class="text-4xl font-bold text-slate-800 font-serif">Galeri Kegiatan</h2>
                    <div class="w-20 h-1 bg-yellow-600 mx-auto mt-5"></div>
                </div>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    <template x-for="g in gallery" :key="g.id">
                        <div class="rounded-lg overflow-hidden shadow-md hover:shadow-xl transition cursor-pointer" :class="g.css_class || ''">
                            <img :src="normalizeImage(g.image)" class="w-full h-full object-cover hover:scale-105 transition duration-500" :class="g.css_class ? '' : 'h-64'">
                        </div>
                    </template>
                </div>
            </div>
        </section>

        <!-- Visi Misi -->
        <section class="py-20 bg-slate-900 px-6 relative overflow-hidden">
            <div class="absolute inset-0 opacity-5"><img src="galeri/WhatsApp Image 2026-09-21 at 19.12.05 (2).jpeg" class="w-full h-full object-cover"></div>
            <div class="max-w-5xl mx-auto relative z-10">
                <div class="text-center mb-14">
                    <h3 class="text-yellow-500 text-xs font-bold tracking-[0.3em] uppercase mb-2">Tujuan Kami</h3>
                    <h2 class="text-4xl font-bold text-white font-serif">Visi & Misi</h2>
                    <div class="w-20 h-1 bg-yellow-600 mx-auto mt-5"></div>
                </div>
                <div class="bg-white/5 backdrop-blur-sm border border-yellow-700/20 rounded-xl p-8 mb-8">
                    <h3 class="text-yellow-400 font-bold text-lg mb-4 flex items-center gap-2"><i class="fas fa-eye"></i> Visi</h3>
                    <p class="text-gray-300 leading-relaxed">Menjadi Lembaga Bantuan Hukum yang independen, profesional, dan terpercaya sebagai benteng perlindungan hukum bagi seluruh lapisan masyarakat Indonesia tanpa memandang latar belakang sosial ekonomi.</p>
                </div>
                <div class="bg-white/5 backdrop-blur-sm border border-yellow-700/20 rounded-xl p-8">
                    <h3 class="text-yellow-400 font-bold text-lg mb-4 flex items-center gap-2"><i class="fas fa-bullseye"></i> Misi</h3>
                    <div class="space-y-4 text-gray-300 text-sm leading-relaxed">
                        <div class="flex gap-3"><span class="bg-yellow-600 text-slate-900 w-6 h-6 flex items-center justify-center rounded-full text-xs font-bold shrink-0 mt-0.5">1</span><p><strong>Memberikan akses keadilan</strong> kepada masyarakat luas, terutama yang tidak mampu secara finansial.</p></div>
                        <div class="flex gap-3"><span class="bg-yellow-600 text-slate-900 w-6 h-6 flex items-center justify-center rounded-full text-xs font-bold shrink-0 mt-0.5">2</span><p><strong>Melakukan advokasi hukum</strong> untuk melindungi hak-hak asasi manusia dan keadilan sosial.</p></div>
                        <div class="flex gap-3"><span class="bg-yellow-600 text-slate-900 w-6 h-6 flex items-center justify-center rounded-full text-xs font-bold shrink-0 mt-0.5">3</span><p><strong>Melakukan penyuluhan hukum</strong> untuk meningkatkan kesadaran hukum masyarakat.</p></div>
                        <div class="flex gap-3"><span class="bg-yellow-600 text-slate-900 w-6 h-6 flex items-center justify-center rounded-full text-xs font-bold shrink-0 mt-0.5">4</span><p><strong>Bekerja sama dengan berbagai pihak</strong> untuk memperkuat sistem peradilan yang adil dan bermartabat.</p></div>
                    </div>
                </div>
            </div>
        </section>

        <!-- CTA / Contact -->
        <section id="kontak" class="py-20 px-6 bg-yellow-600 relative">
            <div class="max-w-4xl mx-auto text-center text-slate-900">
                <h2 class="text-4xl font-bold mb-4 font-serif">Butuh Bantuan Hukum?</h2>
                <p class="text-xl text-slate-800/80 mb-10 leading-relaxed">Jangan hadapi masalah hukum sendirian. Hubungi kami sekarang untuk konsultasi gratis.</p>
                <div class="flex flex-col md:flex-row justify-center items-center gap-4">
                    <a href="tel:+6208820003620210" class="flex items-center gap-3 bg-slate-900 text-yellow-400 px-8 py-4 rounded font-bold hover:bg-slate-800 transition shadow-xl text-lg w-full md:w-auto justify-center">
                        <i class="fas fa-phone-alt"></i> 0882 003 620 210
                    </a>
                    <a href="https://wa.me/6208137876191" target="_blank" class="flex items-center gap-3 bg-green-600 text-white px-8 py-4 rounded font-bold hover:bg-green-500 transition shadow-xl text-lg w-full md:w-auto justify-center">
                        <i class="fab fa-whatsapp text-xl"></i> 0813 7876 1915
                    </a>
                    <a href="mailto:lbhpungawakeadilan.eka@gmail.com" class="flex items-center gap-3 bg-white text-slate-900 px-8 py-4 rounded font-bold hover:bg-gray-100 transition shadow-xl text-lg w-full md:w-auto justify-center">
                        <i class="fas fa-envelope"></i> Email Kami
                    </a>
                </div>
            </div>
        </section>

        <!-- Footer -->
        <footer class="bg-slate-900 pt-14 pb-6 px-6 text-gray-400">
            <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-10 mb-10">
                <div>
                    <div class="flex items-center gap-3 mb-5">
                        <img src="logo lbh.jpeg" alt="Logo" class="h-10 w-10 rounded-full object-cover border border-yellow-700">
                        <div>
                            <h2 class="text-lg font-bold text-yellow-500">Punggawa Keadilan</h2>
                            <p class="text-[10px] text-yellow-600/70 italic">Pro Justitia</p>
                        </div>
                    </div>
                    <p class="text-sm leading-relaxed mb-4">Pembela Rakyat, Penegak Keadilan. Mendedikasikan ilmu dan pengalaman untuk memberikan bantuan hukum berkualitas bagi seluruh lapisan masyarakat.</p>
                    <div class="flex gap-3">
                        <a href="#" class="w-9 h-9 rounded-full bg-slate-800 flex items-center justify-center hover:bg-yellow-600 hover:text-slate-900 transition text-sm"><i class="fab fa-facebook"></i></a>
                        <a href="#" class="w-9 h-9 rounded-full bg-slate-800 flex items-center justify-center hover:bg-yellow-600 hover:text-slate-900 transition text-sm"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="w-9 h-9 rounded-full bg-slate-800 flex items-center justify-center hover:bg-yellow-600 hover:text-slate-900 transition text-sm"><i class="fab fa-tiktok"></i></a>
                    </div>
                </div>
                <div>
                    <h4 class="text-yellow-500 font-bold mb-5 text-sm">Sekretariat Pusat</h4>
                    <ul class="space-y-3 text-sm">
                        <li class="flex items-start gap-2"><i class="fas fa-map-marker-alt mt-1 text-yellow-600 text-xs"></i><span>Jl. Amarta Raya Blok D4 No. 2<br/>Bojanegara, Padamara<br/>Purbalingga, Jawa Tengah</span></li>
                        <li class="flex items-center gap-2"><i class="fas fa-phone text-yellow-600 text-xs"></i><span>085732101212</span></li>
                        <li class="flex items-center gap-2"><i class="fas fa-envelope text-yellow-600 text-xs"></i><span>lbhpungawakeadilan.eka@gmail.com</span></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-yellow-500 font-bold mb-5 text-sm">Kantor Cabang Lampung</h4>
                    <ul class="space-y-3 text-sm">
                        <li class="flex items-start gap-2"><i class="fas fa-map-marker-alt mt-1 text-yellow-600 text-xs"></i><span>Jl. Wan Abdul Rahman Perum Villa Jasmin Blok B No.2 LK.II, RT 008, RW 003, Kota Bandar Lampung</span></li>
                    </ul>
                    <h4 class="text-yellow-500 font-bold mb-3 mt-6 text-sm">Korwil II OKU Raya</h4>
                    <ul class="text-sm">
                        <li class="flex items-start gap-2"><i class="fas fa-map-marker-alt mt-1 text-yellow-600 text-xs"></i><span>Jln. Raya Rasuan Ruko Cempaka Indah<br/>Desa Lubuk Harjo, Kab. OKU Raya, Sumatera Selatan</span></li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-slate-800 pt-6 text-center text-xs">
                <p>&copy; 2026 LBH Punggawa Keadilan - Pro Justitia. Hak Cipta Dilindungi Undang-Undang.</p>
                <p class="text-gray-600 mt-1">Direktur: Ganjar Gesang Nugroho, S.H.</p>
            </div>
        </footer>
    </div>

    <!-- LOGIN SCREEN MODAL -->
    <div x-show="showLogin" class="fixed inset-0 z-[100] bg-black bg-opacity-50 backdrop-blur-sm flex items-center justify-center p-4" x-cloak>
        <div class="bg-white w-full max-w-md p-8 rounded-2xl shadow-xl relative" @click.away="!isLoggedIn ? showLogin = false : null">
            <button @click="showLogin = false" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600">
                <i class="fas fa-times text-xl"></i>
            </button>
            <div class="text-center mb-8 mt-2">
                <div class="mb-4">
                    <img src="logo lbh.jpeg" alt="Logo LBH" class="h-24 mx-auto object-contain">
                </div>
                <h1 class="text-2xl font-bold text-slate-800">Lembaga Bantuan Hukum</h1>
                <p class="text-slate-500 text-sm">Punggawa Keadilan</p>
            </div>

            <form @submit.prevent="login">
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Username</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                            <i class="fas fa-user"></i>
                        </span>
                        <input type="text" x-model="loginForm.username" class="w-full pl-10 pr-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" placeholder="Username" required>
                    </div>
                </div>
                
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                            <i class="fas fa-lock"></i>
                        </span>
                        <input type="password" x-model="loginForm.password" class="w-full pl-10 pr-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" placeholder="Password" required>
                    </div>
                </div>

                <div x-show="loginError" class="mb-4 p-3 bg-red-50 text-red-600 text-sm rounded-lg flex items-center">
                    <i class="fas fa-exclamation-circle mr-2"></i>
                    <span x-text="loginError"></span>
                </div>

                <button type="submit" class="w-full bg-primary text-white py-3 rounded-xl font-bold text-lg shadow-lg hover:bg-slate-700 transition">
                    <span x-show="!isLoading">Masuk</span>
                    <span x-show="isLoading"><i class="fas fa-spinner fa-spin"></i></span>
                </button>
            </form>

            <div class="mt-6 text-center text-xs text-gray-400">
                <p>Demo Credentials:</p>
                <p>Admin: admin / admin123</p>
                <p>Lawyer: lawyer1 / password123</p>
                <p>Client: client1 / client123</p>
            </div>
        </div>
    </div>

    <script>
        function app() {
            return {
                isLoggedIn: false,
                showLogin: false,
                loginError: '',
                isLoading: false,
                loginForm: { username: '', password: '' },
                articles: [],
                teams: [],
                gallery: [],
                currentUser: null,
                tab: 'home',

                // Helper function to normalize image paths
                normalizeImage(imagePath) {
                    if (!imagePath) return '';
                    // If already a full URL (http/https), return as-is
                    if (/^https?:\/\//i.test(imagePath)) return imagePath;
                    // If data URL, return as-is
                    if (/^data:/i.test(imagePath)) return imagePath;
                    // If relative path like 'uploads/...', ensure it's accessible
                    if (imagePath.startsWith('/')) return imagePath;
                    return '/' + imagePath;
                },

                async login() {
                    this.isLoading = true;
                    this.loginError = '';
                    try {
                        const res = await fetch('api.php', {
                            method: 'POST',
                            headers: { 'Content-Type': 'application/json' },
                            body: JSON.stringify({
                                action: 'login',
                                username: this.loginForm.username,
                                password: this.loginForm.password
                            })
                        });
                        const result = await res.json();
                        if (result.success) {
                            this.currentUser = result.user;
                            this.isLoggedIn = true;
                            this.showLogin = false;
                            this.loginForm = { username: '', password: '' };
                        } else {
                            this.loginError = result.message || 'Login gagal';
                        }
                    } catch (e) {
                        this.loginError = 'Terjadi kesalahan saat login';
                        console.error(e);
                    } finally {
                        this.isLoading = false;
                    }
                },

                logout() {
                    this.isLoggedIn = false;
                    this.currentUser = null;
                    this.tab = 'home';
                },

                setTab(tabName) {
                    this.tab = tabName;
                }
            };
        }
    </script>
</body>
</html>
