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
        /* Smooth scrolling */
        html { scroll-behavior: smooth; }
        /* Hide scrollbar for clean mobile look */
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    </style>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#1e293b', // Slate 800
                        secondary: '#334155', // Slate 700
                        accent: '#2563eb', // Blue 600
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
                <p class="text-lg text-gray-300 mb-10 max-w-2xl mx-auto leading-relaxed">&ldquo;Pembela Rakyat, Penegak Keadilan&rdquo; &mdash; Memberikan layanan bantuan hukum yang independen, profesional, dan terpercaya bagi seluruh lapisan masyarakat.</p>
                <div class="flex flex-col sm:flex-row justify-center gap-4">
                    <a href="https://wa.me/628820003620210" target="_blank" class="flex items-center justify-center gap-2 bg-green-600 text-white px-8 py-4 rounded font-bold hover:bg-green-500 transition shadow-xl text-lg">
                        <i class="fab fa-whatsapp text-xl"></i> Konsultasi Gratis
                    </a>
                    <a href="#layanan" class="bg-yellow-600/20 backdrop-blur-md text-yellow-300 border border-yellow-600/50 px-8 py-4 rounded font-bold hover:bg-yellow-600/40 transition text-lg">Layanan Kami</a>
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
                        <div class="w-14 h-14 bg-yellow-50 text-yellow-600 flex items-center justify-center rounded-full text-xl mb-5 group-hover:bg-yellow-600 group-hover:text-white transition"><i class="fas fa-comments"></i></div>
                        <h4 class="text-lg font-bold text-slate-800 mb-2">Konsultasi Hukum Segala Perkara</h4>
                        <p class="text-gray-500 text-sm leading-relaxed">Layanan konsultasi hukum komprehensif untuk semua jenis permasalahan hukum yang Anda hadapi.</p>
                    </div>
                    <div class="bg-white p-7 rounded-lg border border-gray-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 group">
                        <div class="w-14 h-14 bg-yellow-50 text-yellow-600 flex items-center justify-center rounded-full text-xl mb-5 group-hover:bg-yellow-600 group-hover:text-white transition"><i class="fas fa-balance-scale"></i></div>
                        <h4 class="text-lg font-bold text-slate-800 mb-2">Pendampingan & Pembelaan</h4>
                        <p class="text-gray-500 text-sm leading-relaxed">Pendampingan dan pembelaan di semua tingkat pengadilan, mulai dari PN hingga MA.</p>
                    </div>
                    <div class="bg-white p-7 rounded-lg border border-gray-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 group">
                        <div class="w-14 h-14 bg-yellow-50 text-yellow-600 flex items-center justify-center rounded-full text-xl mb-5 group-hover:bg-yellow-600 group-hover:text-white transition"><i class="fas fa-file-contract"></i></div>
                        <h4 class="text-lg font-bold text-slate-800 mb-2">Penyusunan Dokumen Hukum</h4>
                        <p class="text-gray-500 text-sm leading-relaxed">Surat Kuasa, Perjanjian, Somasi, Akta, dan dokumen hukum lainnya yang Anda butuhkan.</p>
                    </div>
                    <div class="bg-white p-7 rounded-lg border border-gray-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 group">
                        <div class="w-14 h-14 bg-yellow-50 text-yellow-600 flex items-center justify-center rounded-full text-xl mb-5 group-hover:bg-yellow-600 group-hover:text-white transition"><i class="fas fa-bullhorn"></i></div>
                        <h4 class="text-lg font-bold text-slate-800 mb-2">Pengaduan & Laporan</h4>
                        <p class="text-gray-500 text-sm leading-relaxed">Pengaduan dan laporan ke Kepolisian, Kejaksaan, dan instansi terkait lainnya.</p>
                    </div>
                    <div class="bg-white p-7 rounded-lg border border-gray-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 group">
                        <div class="w-14 h-14 bg-yellow-50 text-yellow-600 flex items-center justify-center rounded-full text-xl mb-5 group-hover:bg-yellow-600 group-hover:text-white transition"><i class="fas fa-handshake"></i></div>
                        <h4 class="text-lg font-bold text-slate-800 mb-2">Penyelesaian Sengketa</h4>
                        <p class="text-gray-500 text-sm leading-relaxed">Mediasi, Negosiasi, dan Arbitrase sebagai alternatif penyelesaian sengketa di luar pengadilan.</p>
                    </div>
                    <div class="bg-white p-7 rounded-lg border border-gray-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 group">
                        <div class="w-14 h-14 bg-yellow-50 text-yellow-600 flex items-center justify-center rounded-full text-xl mb-5 group-hover:bg-yellow-600 group-hover:text-white transition"><i class="fas fa-tree"></i></div>
                        <h4 class="text-lg font-bold text-slate-800 mb-2">Hukum Agraria & SDA</h4>
                        <p class="text-gray-500 text-sm leading-relaxed">Bantuan hukum bidang agraria, pertanahan, dan sumber daya alam.</p>
                    </div>
                    <div class="bg-white p-7 rounded-lg border border-gray-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 group">
                        <div class="w-14 h-14 bg-yellow-50 text-yellow-600 flex items-center justify-center rounded-full text-xl mb-5 group-hover:bg-yellow-600 group-hover:text-white transition"><i class="fas fa-chalkboard-teacher"></i></div>
                        <h4 class="text-lg font-bold text-slate-800 mb-2">Pendidikan & Penyuluhan Hukum</h4>
                        <p class="text-gray-500 text-sm leading-relaxed">Sosialisasi dan penyuluhan hukum ke masyarakat agar sadar, paham, dan mampu menggunakan hak hukumnya.</p>
                    </div>
                    <div class="bg-white p-7 rounded-lg border border-gray-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 group">
                        <div class="w-14 h-14 bg-yellow-50 text-yellow-600 flex items-center justify-center rounded-full text-xl mb-5 group-hover:bg-yellow-600 group-hover:text-white transition"><i class="fas fa-hand-holding-heart"></i></div>
                        <h4 class="text-lg font-bold text-slate-800 mb-2">Pendampingan Khusus</h4>
                        <p class="text-gray-500 text-sm leading-relaxed">Masyarakat tidak mampu, mantan narapidana, dan kelompok rentan lainnya.</p>
                    </div>
                    <div class="bg-white p-7 rounded-lg border border-gray-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 group">
                        <div class="w-14 h-14 bg-yellow-50 text-yellow-600 flex items-center justify-center rounded-full text-xl mb-5 group-hover:bg-yellow-600 group-hover:text-white transition"><i class="fas fa-heart-broken"></i></div>
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
            
            <!-- Dynamic Marquee: rendered via JS after teams data loads -->
            <div class="marquee-container" x-ref="teamMarquee">
                <div class="marquee-content" x-ref="teamMarqueeContent">
                    <!-- First Set (dynamic) -->
                    <template x-for="t in teams" :key="'a'+t.id">
                        <div class="team-card text-center group">
                            <div class="w-32 h-32 mx-auto rounded-full overflow-hidden border-3 border-yellow-600/50 shadow-lg mb-4 group-hover:border-yellow-400 transition">
                                <img :src="t.image || 'https://ui-avatars.com/api/?name=' + encodeURIComponent(t.name) + '&background=1e293b&color=eab308&size=128'" class="w-full h-full object-cover object-top">
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
                                <img :src="t.image || 'https://ui-avatars.com/api/?name=' + encodeURIComponent(t.name) + '&background=1e293b&color=eab308&size=128'" class="w-full h-full object-cover object-top">
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
                    <div class="rounded-lg overflow-hidden shadow-md hover:shadow-xl transition cursor-pointer"><img src="legalitas/WhatsApp Image 2026-09-21 at 19.11.59 (2).jpeg" class="w-full h-48 object-cover object-top hover:scale-105 transition duration-500"></div>
                    <div class="rounded-lg overflow-hidden shadow-md hover:shadow-xl transition cursor-pointer"><img src="legalitas/WhatsApp Image 2026-09-21 at 19.11.59 (1).jpeg" class="w-full h-48 object-cover object-top hover:scale-105 transition duration-500"></div>
                    <div class="rounded-lg overflow-hidden shadow-md hover:shadow-xl transition cursor-pointer"><img src="legalitas/WhatsApp Image 2026-09-21 at 19.11.59.jpeg" class="w-full h-48 object-cover hover:scale-105 transition duration-500"></div>
                    <div class="rounded-lg overflow-hidden shadow-md hover:shadow-xl transition cursor-pointer"><img src="legalitas/WhatsApp Image 2026-09-21 at 19.12.02.jpeg" class="w-full h-48 object-cover hover:scale-105 transition duration-500"></div>
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
                            <div class="h-52 bg-gray-200 overflow-hidden"><img :src="art.image || 'law2.jpg'" class="w-full h-full object-cover group-hover:scale-105 transition duration-500"></div>
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
                            <img :src="g.image" class="w-full h-full object-cover hover:scale-105 transition duration-500" :class="g.css_class ? '' : 'h-64'">
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
                    <p class="text-gray-300 leading-relaxed">Menjadi Lembaga Bantuan Hukum yang independen, profesional, dan terpercaya sebagai benteng perlindungan hukum bagi seluruh lapisan masyarakat, guna mewujudkan keadilan sejati, supremasi hukum, dan kesejahteraan bersama di seluruh wilayah Negara Kesatuan Republik Indonesia.</p>
                </div>
                <div class="bg-white/5 backdrop-blur-sm border border-yellow-700/20 rounded-xl p-8">
                    <h3 class="text-yellow-400 font-bold text-lg mb-4 flex items-center gap-2"><i class="fas fa-bullseye"></i> Misi</h3>
                    <div class="space-y-4 text-gray-300 text-sm leading-relaxed">
                        <div class="flex gap-3"><span class="bg-yellow-600 text-slate-900 w-6 h-6 flex items-center justify-center rounded-full text-xs font-bold shrink-0 mt-0.5">1</span><p><strong class="text-yellow-400">Bantuan Hukum Merata:</strong> Memberikan layanan bantuan hukum secara cuma-cuma bagi masyarakat kurang mampu, petani, nelayan, dan kelompok rentan.</p></div>
                        <div class="flex gap-3"><span class="bg-yellow-600 text-slate-900 w-6 h-6 flex items-center justify-center rounded-full text-xs font-bold shrink-0 mt-0.5">2</span><p><strong class="text-yellow-400">Pengawasan Sosial:</strong> Melaksanakan fungsi kontrol sosial terhadap penyelenggaraan negara dan pelayanan publik.</p></div>
                        <div class="flex gap-3"><span class="bg-yellow-600 text-slate-900 w-6 h-6 flex items-center justify-center rounded-full text-xs font-bold shrink-0 mt-0.5">3</span><p><strong class="text-yellow-400">Pendidikan Hukum Masyarakat:</strong> Melakukan sosialisasi dan penyuluhan agar masyarakat sadar dan mampu menggunakan hak hukumnya.</p></div>
                        <div class="flex gap-3"><span class="bg-yellow-600 text-slate-900 w-6 h-6 flex items-center justify-center rounded-full text-xs font-bold shrink-0 mt-0.5">4</span><p><strong class="text-yellow-400">Penegakan Hukum Berkeadilan:</strong> Melakukan penelitian, pengkajian, dan advokasi kebijakan guna meluruskan ketimpangan hukum.</p></div>
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
                        <a href="#" class="w-9 h-9 rounded-full bg-slate-800 flex items-center justify-center hover:bg-yellow-600 hover:text-slate-900 transition text-sm"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="w-9 h-9 rounded-full bg-slate-800 flex items-center justify-center hover:bg-yellow-600 hover:text-slate-900 transition text-sm"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="w-9 h-9 rounded-full bg-slate-800 flex items-center justify-center hover:bg-yellow-600 hover:text-slate-900 transition text-sm"><i class="fab fa-tiktok"></i></a>
                    </div>
                </div>
                <div>
                    <h4 class="text-yellow-500 font-bold mb-5 text-sm">Sekretariat Pusat</h4>
                    <ul class="space-y-3 text-sm">
                        <li class="flex items-start gap-2"><i class="fas fa-map-marker-alt mt-1 text-yellow-600 text-xs"></i><span>Jl. Amarta Raya Blok D4 No. 2<br/>Bojanegara, Padamara<br/>Purbalingga - Jawa Tengah 53372</span></li>
                        <li class="flex items-center gap-2"><i class="fas fa-phone text-yellow-600 text-xs"></i><span>085732101212</span></li>
                        <li class="flex items-center gap-2"><i class="fas fa-envelope text-yellow-600 text-xs"></i><span>lbhpungawakeadilan.eka@gmail.com</span></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-yellow-500 font-bold mb-5 text-sm">Kantor Cabang Lampung</h4>
                    <ul class="space-y-3 text-sm">
                        <li class="flex items-start gap-2"><i class="fas fa-map-marker-alt mt-1 text-yellow-600 text-xs"></i><span>Jl. Wan Abdul Rahman Perum Villa Jasmin Blok B No.2 LK.II, RT 005/RW 000<br/>Kel. Sumber Agung, Kec. Kemiling<br/>Kota Bandar Lampung</span></li>
                    </ul>
                    <h4 class="text-yellow-500 font-bold mb-3 mt-6 text-sm">Korwil II OKU Raya</h4>
                    <ul class="text-sm">
                        <li class="flex items-start gap-2"><i class="fas fa-map-marker-alt mt-1 text-yellow-600 text-xs"></i><span>Jln. Raya Rasuan Ruko Cempaka Indah<br/>Desa Lubuk Harjo, Kab. OKU Timur</span></li>
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
                    <img src="lawyer-attorney-logo-vector.jpg" alt="Logo" class="h-24 mx-auto rounded-full object-cover">
                </div>
                <h1 class="text-2xl font-bold text-slate-800">LawyerApp</h1>
                <p class="text-slate-500 text-sm">Sistem Manajemen Kantor Hukum</p>
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

    <!-- MAIN APP (Only visible when logged in) -->
    <div x-show="isLoggedIn" x-cloak class="min-h-screen flex">
    
    <!-- DESKTOP SIDEBAR (Hidden on Mobile) -->
    <aside class="hidden md:flex flex-col w-64 h-screen fixed bg-primary text-white shadow-xl z-50">
        <div class="p-6 text-center border-b border-slate-700">
            <div class="flex justify-center mb-2">
                <img src="lawyer-attorney-logo-vector.jpg" alt="Logo" class="h-16 w-16 rounded-full object-cover">
            </div>
            <h1 class="text-2xl font-bold tracking-wider">LawyerApp</h1>
            <p class="text-xs text-slate-400 mt-1">Sistem Manajemen Hukum</p>
            <div class="mt-2 text-xs bg-slate-700 py-1 px-2 rounded inline-block uppercase tracking-wide" x-text="currentUser?.role"></div>
        </div>
        <nav class="flex-1 overflow-y-auto py-4">
            <a href="#" @click.prevent="setTab('home')" :class="tab === 'home' ? 'bg-slate-700 border-r-4 border-blue-500' : 'hover:bg-slate-700'" class="block px-6 py-3 transition-all">
                <i class="fas fa-home w-6 text-center"></i> Beranda
            </a>
            <a href="#" @click.prevent="setTab('tasks')" :class="tab === 'tasks' ? 'bg-slate-700 border-r-4 border-blue-500' : 'hover:bg-slate-700'" class="block px-6 py-3 transition-all">
                <i class="fas fa-tasks w-6 text-center"></i> Tugas & Sidang
            </a>
            <a href="#" @click.prevent="setTab('cases')" :class="tab === 'cases' ? 'bg-slate-700 border-r-4 border-blue-500' : 'hover:bg-slate-700'" class="block px-6 py-3 transition-all">
                <i class="fas fa-briefcase w-6 text-center"></i> Manajemen Kasus
            </a>
             <a href="#" @click.prevent="setTab('documents')" :class="tab === 'documents' ? 'bg-slate-700 border-r-4 border-blue-500' : 'hover:bg-slate-700'" class="block px-6 py-3 transition-all">
                <i class="fas fa-file-alt w-6 text-center"></i> Dokumentasi
            </a>
            <a href="#" @click.prevent="setTab('profile')" :class="tab === 'profile' ? 'bg-slate-700 border-r-4 border-blue-500' : 'hover:bg-slate-700'" class="block px-6 py-3 transition-all">
                <i class="fas fa-user-tie w-6 text-center"></i> Profil
            </a>
            
            <template x-if="currentUser && currentUser.role === 'admin'">
                <a href="#" @click.prevent="setTab('web')" :class="tab === 'web' ? 'bg-slate-700 border-r-4 border-blue-500' : 'hover:bg-slate-700'" class="block px-6 py-3 transition-all">
                    <i class="fas fa-globe w-6 text-center"></i> Manajemen Web
                </a>
            </template>

            <template x-if="currentUser && currentUser.role === 'admin'">
                <a href="#" @click.prevent="setTab('master')" :class="tab === 'master' ? 'bg-slate-700 border-r-4 border-blue-500' : 'hover:bg-slate-700'" class="block px-6 py-3 transition-all">
                    <i class="fas fa-database w-6 text-center"></i> Master Data
                </a>
            </template>
            <template x-if="currentUser && currentUser.role === 'admin'">
                <a href="#" @click.prevent="setTab('content')" :class="tab === 'content' ? 'bg-slate-700 border-r-4 border-blue-500' : 'hover:bg-slate-700'" class="block px-6 py-3 transition-all">
                    <i class="fas fa-newspaper w-6 text-center"></i> Konten Web
                </a>
            </template>
        </nav>
        <div class="p-4 border-t border-slate-700">
            <button @click="logout" class="w-full py-2 px-4 bg-red-600 hover:bg-red-700 rounded text-sm transition">Keluar</button>
        </div>
    </aside>

    <!-- MAIN CONTENT -->
    <main class="md:ml-64 min-h-screen pb-20 md:pb-0 transition-all duration-300 w-full">
        
        <!-- HEADER (Mobile & Desktop) -->
        <header class="bg-white shadow-sm sticky top-0 z-40 px-4 py-3 flex justify-between items-center">
            <div class="flex items-center">
                <!-- Mobile Logo -->
                <div class="md:hidden mr-2">
                    <img src="lawyer-attorney-logo-vector.jpg" alt="Logo" class="h-8 w-8 rounded-full object-cover">
                </div>
                <h2 class="text-xl font-semibold text-slate-800" x-text="pageTitle"></h2>
            </div>
            <div class="flex items-center space-x-3">
                <button class="p-2 rounded-full hover:bg-gray-100 relative">
                    <i class="fas fa-bell text-slate-600"></i>
                    <span class="absolute top-1 right-1 w-2 h-2 bg-red-500 rounded-full"></span>
                </button>
                <button class="p-2 rounded-full hover:bg-gray-100" @click="logout" title="Keluar">
                    <i class="fas fa-power-off text-red-500"></i>
                </button>
                <div class="w-8 h-8 rounded-full bg-slate-300 overflow-hidden border border-slate-400">
                    <img :src="currentUser && currentUser.avatar ? currentUser.avatar : ('https://ui-avatars.com/api/?name=' + (currentUser ? currentUser.full_name : 'User') + '&background=random')" alt="User">
                </div>
            </div>
        </header>

        <!-- CONTENT AREA -->
        <div class="p-4 md:p-8 max-w-7xl mx-auto">
            
            <!-- HOME / DASHBOARD TAB -->
            <div x-show="tab === 'home'" x-transition.opacity>
                <!-- Welcome Banner -->
                <div class="relative bg-gradient-to-r from-blue-600 to-indigo-700 rounded-2xl p-6 md:p-8 mb-8 text-white shadow-xl overflow-hidden">
                    <div class="relative z-10">
                        <h2 class="text-2xl md:text-3xl font-bold mb-2">Selamat datang kembali, <span x-text="currentUser?.full_name || 'Admin'"></span>! 👋</h2>
                        <p class="text-blue-100 max-w-xl">Ini adalah ringkasan aktivitas kantor hukum Anda hari ini. Tetap semangat dalam menegakkan keadilan.</p>
                    </div>
                    <div class="absolute top-0 right-0 -mt-4 -mr-4 opacity-20">
                        <i class="fas fa-balance-scale text-9xl"></i>
                    </div>
                </div>

                <!-- Stats Cards -->
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 md:gap-6 mb-8">
                    <!-- Total Tugas -->
                    <div class="bg-white p-5 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition-shadow relative overflow-hidden group">
                        <div class="absolute right-0 top-0 w-16 h-16 bg-blue-50 rounded-bl-full flex items-start justify-end p-3 transition-transform group-hover:scale-110">
                            <i class="fas fa-tasks text-blue-500"></i>
                        </div>
                        <div class="text-slate-400 text-xs font-semibold uppercase tracking-wider mb-1">Total Tugas</div>
                        <div class="text-3xl font-bold text-slate-800" x-text="tasks.length">0</div>
                        <div class="mt-2 text-xs text-slate-500"><span class="text-green-500 font-medium" x-text="tasks.filter(t => t.status === 'completed').length"></span> selesai</div>
                    </div>
                    
                    <!-- Kasus Aktif -->
                    <div class="bg-white p-5 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition-shadow relative overflow-hidden group">
                        <div class="absolute right-0 top-0 w-16 h-16 bg-indigo-50 rounded-bl-full flex items-start justify-end p-3 transition-transform group-hover:scale-110">
                            <i class="fas fa-briefcase text-indigo-500"></i>
                        </div>
                        <div class="text-slate-400 text-xs font-semibold uppercase tracking-wider mb-1">Kasus Aktif</div>
                        <div class="text-3xl font-bold text-slate-800" x-text="cases.filter(c => c.status === 'Open').length">0</div>
                        <div class="mt-2 text-xs text-slate-500"><span class="text-indigo-500 font-medium" x-text="cases.length"></span> total kasus</div>
                    </div>

                    <!-- Dokumen -->
                    <div class="bg-white p-5 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition-shadow relative overflow-hidden group">
                        <div class="absolute right-0 top-0 w-16 h-16 bg-amber-50 rounded-bl-full flex items-start justify-end p-3 transition-transform group-hover:scale-110">
                            <i class="fas fa-file-alt text-amber-500"></i>
                        </div>
                        <div class="text-slate-400 text-xs font-semibold uppercase tracking-wider mb-1">Total Dokumen</div>
                        <div class="text-3xl font-bold text-slate-800" x-text="documents.length">0</div>
                        <div class="mt-2 text-xs text-slate-500">Tersimpan di sistem</div>
                    </div>

                    <!-- Klien -->
                    <div class="bg-white p-5 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition-shadow relative overflow-hidden group">
                        <div class="absolute right-0 top-0 w-16 h-16 bg-emerald-50 rounded-bl-full flex items-start justify-end p-3 transition-transform group-hover:scale-110">
                            <i class="fas fa-users text-emerald-500"></i>
                        </div>
                        <div class="text-slate-400 text-xs font-semibold uppercase tracking-wider mb-1">Total Klien</div>
                        <div class="text-3xl font-bold text-slate-800" x-text="users.filter(u => u.role === 'client').length">0</div>
                        <div class="mt-2 text-xs text-slate-500">Terdaftar aktif</div>
                    </div>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
                    <!-- Kasus Terbaru -->
                    <div class="lg:col-span-2 bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                        <div class="flex justify-between items-center mb-6">
                            <h3 class="font-bold text-lg text-slate-800">Kasus Terbaru</h3>
                            <button @click="setTab('cases')" class="text-sm font-medium text-blue-600 hover:text-blue-700">Lihat Semua</button>
                        </div>
                        <div class="space-y-4">
                            <template x-for="c in cases.slice(-4).reverse()" :key="c.id">
                                <div class="flex items-center justify-between p-4 rounded-xl border border-gray-50 hover:bg-slate-50 transition cursor-pointer" @click="viewCaseDetail(c)">
                                    <div class="flex items-center gap-4">
                                        <div class="w-10 h-10 rounded-lg flex items-center justify-center font-bold text-sm"
                                            :class="c.status === 'Open' ? 'bg-green-100 text-green-600' : (c.status === 'On Hold' ? 'bg-yellow-100 text-yellow-600' : 'bg-gray-100 text-gray-600')">
                                            <i class="fas fa-gavel"></i>
                                        </div>
                                        <div>
                                            <div class="font-bold text-slate-800 text-sm" x-text="c.title"></div>
                                            <div class="text-xs text-slate-500" x-text="c.client_name"></div>
                                        </div>
                                    </div>
                                    <span class="px-3 py-1 rounded-full text-xs font-medium" 
                                        :class="c.status === 'Open' ? 'bg-green-50 text-green-700 border border-green-200' : (c.status === 'On Hold' ? 'bg-yellow-50 text-yellow-700 border border-yellow-200' : 'bg-gray-50 text-gray-700 border border-gray-200')"
                                        x-text="c.status"></span>
                                </div>
                            </template>
                            <div x-show="cases.length === 0" class="text-center py-6 text-slate-400">Belum ada kasus tercatat.</div>
                        </div>
                    </div>

                    <!-- Upcoming Priority Tasks -->
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                        <div class="flex justify-between items-center mb-6">
                            <h3 class="font-bold text-lg text-slate-800 flex items-center">
                                <i class="fas fa-fire text-red-500 mr-2"></i> Tugas Prioritas
                            </h3>
                        </div>
                        <div class="space-y-4">
                            <template x-for="task in priorityTasks.slice(0, 5)" :key="task.id">
                                <div class="relative pl-6 before:absolute before:left-2 before:top-2 before:bottom-0 before:w-0.5 before:bg-gray-100 last:before:hidden">
                                    <div class="absolute left-0 top-1 w-4 h-4 rounded-full bg-red-500 border-4 border-white shadow-sm z-10"></div>
                                    <div class="bg-gray-50 p-4 rounded-xl border border-gray-100 group hover:border-red-200 transition">
                                        <div class="flex justify-between items-start mb-1">
                                            <div class="font-bold text-sm text-slate-800" x-text="task.title"></div>
                                            <button @click="toggleTask(task.id)" class="text-gray-300 hover:text-green-500 transition">
                                                <i class="fas fa-check-circle"></i>
                                            </button>
                                        </div>
                                        <div class="text-xs text-slate-500 flex items-center gap-2">
                                            <span><i class="far fa-clock mr-1"></i> <span x-text="formatDate(task.date)"></span></span>
                                        </div>
                                    </div>
                                </div>
                            </template>
                            <div x-show="priorityTasks.length === 0" class="text-center py-8 text-slate-400 border border-dashed border-gray-200 rounded-xl">
                                Tidak ada tugas prioritas tinggi.
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- TASKS TAB -->
            <div x-show="tab === 'tasks'" x-transition.opacity x-cloak>
                <div class="flex justify-between items-center mb-4">
                    <div class="flex space-x-2 overflow-x-auto no-scrollbar pb-2">
                        <button @click="filter = 'all'" :class="filter === 'all' ? 'bg-primary text-white' : 'bg-white text-slate-600'" class="px-4 py-2 rounded-lg text-sm font-medium shadow-sm whitespace-nowrap">Semua</button>
                        <button @click="filter = 'pending'" :class="filter === 'pending' ? 'bg-primary text-white' : 'bg-white text-slate-600'" class="px-4 py-2 rounded-lg text-sm font-medium shadow-sm whitespace-nowrap">Belum Selesai</button>
                        <button @click="filter = 'completed'" :class="filter === 'completed' ? 'bg-primary text-white' : 'bg-white text-slate-600'" class="px-4 py-2 rounded-lg text-sm font-medium shadow-sm whitespace-nowrap">Selesai</button>
                    </div>
                </div>

                <div class="space-y-3 pb-20">
                    <template x-for="task in filteredTasks" :key="task.id">
                        <div class="bg-white p-4 rounded-xl shadow-sm flex justify-between items-start transition-all" :class="task.status === 'completed' ? 'opacity-60' : ''">
                            <div class="flex-1">
                                <div class="flex items-center mb-1">
                                    <span x-show="task.priority === 'Tinggi'" class="w-2 h-2 rounded-full bg-red-500 mr-2"></span>
                                    <span x-show="task.priority === 'Sedang'" class="w-2 h-2 rounded-full bg-yellow-500 mr-2"></span>
                                    <span x-show="task.priority === 'Rendah'" class="w-2 h-2 rounded-full bg-green-500 mr-2"></span>
                                    <h4 class="font-bold text-slate-800" :class="task.status === 'completed' ? 'line-through' : ''" x-text="task.title"></h4>
                                </div>
                                <div class="text-sm text-slate-500 flex flex-wrap gap-2">
                                    <span class="flex items-center"><i class="far fa-clock mr-1"></i> <span x-text="formatDate(task.date)"></span></span>
                                    <span class="bg-gray-100 px-2 rounded text-xs py-0.5" x-text="task.type"></span>
                                    <span x-show="task.case_id" class="bg-blue-100 text-blue-800 px-2 rounded text-xs py-0.5 flex items-center">
                                        <i class="fas fa-briefcase mr-1 text-[10px]"></i>
                                        <span x-text="getCaseName(task.case_id)"></span>
                                    </span>
                                </div>
                            </div>
                            <div class="flex flex-col space-y-2 ml-2">
                                <button @click="toggleTask(task.id)" class="text-gray-400 hover:text-green-600">
                                    <i :class="task.status === 'completed' ? 'fas fa-check-circle text-green-500 text-xl' : 'far fa-circle text-xl'"></i>
                                </button>
                                <button @click="deleteTask(task.id)" class="text-gray-300 hover:text-red-500">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </div>
                        </div>
                    </template>
                </div>
                
                <!-- Floating Action Button for Mobile -->
                <button @click="showAddModal = true" class="fixed bottom-20 right-4 md:bottom-8 md:right-8 bg-accent text-white w-14 h-14 rounded-full shadow-lg flex items-center justify-center text-2xl hover:bg-blue-700 transition transform hover:scale-105 z-30">
                    <i class="fas fa-plus"></i>
                </button>
            </div>

            <!-- CASES TAB -->
            <div x-show="tab === 'cases'" x-transition.opacity x-cloak>
                 <div class="flex justify-between items-center mb-6">
                    <h3 class="text-lg font-bold">Daftar Kasus</h3>
                    <button @click="showAddCaseModal = true" class="bg-primary text-white px-4 py-2 rounded-lg text-sm shadow hover:bg-slate-700 transition">
                        <i class="fas fa-plus mr-1"></i> Tambah Kasus
                    </button>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 pb-20">
                    <template x-for="c in cases" :key="c.id">
                        <div class="bg-white p-5 rounded-xl shadow-sm border-l-4" :class="c.status === 'Open' ? 'border-green-500' : (c.status === 'On Hold' ? 'border-yellow-500' : 'border-gray-500')">
                            <div class="flex justify-between items-start">
                                <h4 class="font-bold text-lg text-slate-800" x-text="c.title"></h4>
                                <div class="relative" x-data="{ open: false }">
                                    <button @click="open = !open" class="text-gray-400 hover:text-gray-600"><i class="fas fa-ellipsis-v"></i></button>
                                    <div x-show="open" @click.outside="open = false" class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-20 border">
                                        <a href="#" @click.prevent="updateCaseStatus(c.id, 'Open'); open = false" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Set Status: Open</a>
                                        <a href="#" @click.prevent="updateCaseStatus(c.id, 'On Hold'); open = false" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Set Status: On Hold</a>
                                        <a href="#" @click.prevent="updateCaseStatus(c.id, 'Closed'); open = false" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Set Status: Closed</a>
                                        <div class="border-t border-gray-100 my-1"></div>
                                        <a href="#" @click.prevent="deleteCase(c.id); open = false" class="block px-4 py-2 text-sm text-red-600 hover:bg-gray-100">Hapus Kasus</a>
                                    </div>
                                </div>
                            </div>
                            <div class="text-sm text-slate-500 mt-1 mb-3">
                                <i class="fas fa-user mr-1"></i> <span x-text="c.client_name"></span>
                            </div>
                            <p class="text-sm text-gray-600 mb-4 line-clamp-2" x-text="c.description"></p>
                            <div class="flex items-center justify-between">
                                <span class="px-2 py-1 rounded text-xs font-semibold" 
                                    :class="c.status === 'Open' ? 'bg-green-100 text-green-700' : (c.status === 'On Hold' ? 'bg-yellow-100 text-yellow-700' : 'bg-gray-100 text-gray-700')"
                                    x-text="c.status"></span>
                                <button @click="viewCaseDetail(c)" class="text-accent text-sm font-medium hover:underline">Detail <i class="fas fa-arrow-right ml-1"></i></button>
                            </div>
                        </div>
                    </template>
                </div>
            </div>

            <!-- DOCUMENTS TAB -->
            <div x-show="tab === 'documents'" x-transition.opacity x-cloak>
                 <div class="flex justify-between items-center mb-6">
                    <h3 class="text-lg font-bold">Dokumentasi Hukum</h3>
                    <button @click="showAddDocModal = true" class="bg-primary text-white px-4 py-2 rounded-lg text-sm shadow hover:bg-slate-700 transition">
                        <i class="fas fa-upload mr-1"></i> Upload Dokumen
                    </button>
                </div>

                <div class="bg-white rounded-xl shadow-sm overflow-hidden hidden md:block">
                    <table class="w-full text-left text-sm text-gray-600">
                        <thead class="bg-gray-50 text-gray-800 font-bold uppercase text-xs border-b">
                            <tr>
                                <th class="px-6 py-4">Nama Dokumen</th>
                                <th class="px-6 py-4 hidden md:table-cell">Tipe</th>
                                <th class="px-6 py-4 hidden md:table-cell">Kasus Terkait</th>
                                <th class="px-6 py-4 hidden md:table-cell">Tanggal</th>
                                <th class="px-6 py-4 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            <template x-for="doc in documents" :key="doc.id">
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-6 py-4">
                                        <div class="flex items-center">
                                            <div class="w-8 h-8 rounded bg-blue-100 text-blue-600 flex items-center justify-center mr-3 text-lg">
                                                <i class="fas fa-file-alt"></i>
                                            </div>
                                            <div>
                                                <div class="font-bold text-gray-800" x-text="doc.title"></div>
                                                <div class="text-xs text-gray-500 md:hidden mt-1">
                                                    <span x-text="doc.type"></span> &bull; <span x-text="formatDate(doc.date)"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 hidden md:table-cell">
                                        <span class="bg-gray-100 px-2 py-1 rounded text-xs" x-text="doc.type"></span>
                                    </td>
                                    <td class="px-6 py-4 hidden md:table-cell text-xs">
                                        <span x-text="getCaseName(doc.case_id)"></span>
                                    </td>
                                    <td class="px-6 py-4 hidden md:table-cell" x-text="formatDate(doc.date)"></td>
                                    <td class="px-6 py-4 text-right">
                                        <button class="text-gray-400 hover:text-blue-600 mr-2"><i class="fas fa-download"></i></button>
                                        <button @click="deleteDocument(doc.id)" class="text-gray-400 hover:text-red-600"><i class="fas fa-trash-alt"></i></button>
                                    </td>
                                </tr>
                            </template>
                        </tbody>
                    </table>
                     <div x-show="documents.length === 0" class="p-8 text-center text-gray-400">
                        Belum ada dokumen tersimpan.
                    </div>
                </div>
                <div class="md:hidden space-y-4">
                    <template x-for="c in cases" :key="c.id">
                        <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                            <div class="px-4 py-3 bg-gray-50 font-semibold text-gray-800" x-text="c.title"></div>
                            <template x-if="documents.filter(d => d.case_id == c.id).length > 0">
                                <div class="divide-y">
                                    <template x-for="doc in documents.filter(d => d.case_id == c.id)" :key="doc.id">
                                        <div class="px-4 py-3 flex items-center justify-between">
                                            <div class="flex-1">
                                                <div class="font-medium text-gray-800" x-text="doc.title"></div>
                                                <div class="text-xs text-gray-500 mt-1">
                                                    <span x-text="doc.type"></span> • <span x-text="formatDate(doc.date)"></span>
                                                </div>
                                            </div>
                                            <div class="flex items-center gap-3 pl-3">
                                                <button class="text-gray-400 hover:text-blue-600"><i class="fas fa-download"></i></button>
                                                <button @click="deleteDocument(doc.id)" class="text-gray-400 hover:text-red-600"><i class="fas fa-trash-alt"></i></button>
                                            </div>
                                        </div>
                                    </template>
                                </div>
                            </template>
                            <div x-show="documents.filter(d => d.case_id == c.id).length === 0" class="px-4 py-4 text-gray-400 text-sm">
                                Belum ada dokumen untuk kasus ini.
                            </div>
                        </div>
                    </template>
                    <div class="bg-white rounded-xl shadow-sm overflow-hidden" x-show="documents.filter(d => !d.case_id).length > 0">
                        <div class="px-4 py-3 bg-gray-50 font-semibold text-gray-800">Umum</div>
                        <div class="divide-y">
                            <template x-for="doc in documents.filter(d => !d.case_id)" :key="doc.id">
                                <div class="px-4 py-3 flex items-center justify-between">
                                    <div class="flex-1">
                                        <div class="font-medium text-gray-800" x-text="doc.title"></div>
                                        <div class="text-xs text-gray-500 mt-1">
                                            <span x-text="doc.type"></span> • <span x-text="formatDate(doc.date)"></span>
                                        </div>
                                    </div>
                                    <div class="flex items-center gap-3 pl-3">
                                        <button class="text-gray-400 hover:text-blue-600"><i class="fas fa-download"></i></button>
                                        <button @click="deleteDocument(doc.id)" class="text-gray-400 hover:text-red-600"><i class="fas fa-trash-alt"></i></button>
                                    </div>
                                </div>
                            </template>
                        </div>
                    </div>
                </div>
            </div>

            <!-- MASTER DATA TAB (Admin only) -->
            <div x-show="tab === 'master'" x-transition.opacity x-cloak>
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <div class="bg-white rounded-xl shadow-sm p-6">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-lg font-bold">Pengacara</h3>
                            <button @click="openAddUser('lawyer')" class="bg-primary text-white px-3 py-2 rounded-lg text-sm shadow hover:bg-slate-700 transition"><i class="fas fa-plus mr-1"></i> Tambah</button>
                        </div>
                        <div class="space-y-2">
                            <template x-for="u in users.filter(x => x.role === 'lawyer')" :key="u.id">
                                <div class="flex items-center justify-between p-3 rounded border">
                                    <div>
                                        <div class="font-bold" x-text="u.full_name"></div>
                                        <div class="text-xs text-gray-500" x-text="u.email"></div>
                                        <div class="text-xs text-gray-400" x-text="u.username"></div>
                                    </div>
                                    <div class="flex gap-2">
                                        <button @click="openEditUser(u)" class="text-gray-500 hover:text-blue-600"><i class="fas fa-edit"></i></button>
                                        <button @click="deleteUser(u.id)" class="text-gray-400 hover:text-red-600"><i class="fas fa-trash-alt"></i></button>
                                    </div>
                                </div>
                            </template>
                            <div x-show="users.filter(x => x.role === 'lawyer').length === 0" class="text-sm text-gray-400 italic">Belum ada data pengacara.</div>
                        </div>
                    </div>
                    <div class="bg-white rounded-xl shadow-sm p-6">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-lg font-bold">Klien</h3>
                            <button @click="openAddUser('client')" class="bg-primary text-white px-3 py-2 rounded-lg text-sm shadow hover:bg-slate-700 transition"><i class="fas fa-plus mr-1"></i> Tambah</button>
                        </div>
                        <div class="space-y-2">
                            <template x-for="u in users.filter(x => x.role === 'client')" :key="u.id">
                                <div class="flex items-center justify-between p-3 rounded border">
                                    <div>
                                        <div class="font-bold" x-text="u.full_name"></div>
                                        <div class="text-xs text-gray-500" x-text="u.email"></div>
                                        <div class="text-xs text-gray-400" x-text="u.username"></div>
                                    </div>
                                    <div class="flex gap-2">
                                        <button @click="openEditUser(u)" class="text-gray-500 hover:text-blue-600"><i class="fas fa-edit"></i></button>
                                        <button @click="deleteUser(u.id)" class="text-gray-400 hover:text-red-600"><i class="fas fa-trash-alt"></i></button>
                                    </div>
                                </div>
                            </template>
                            <div x-show="users.filter(x => x.role === 'client').length === 0" class="text-sm text-gray-400 italic">Belum ada data klien.</div>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-sm p-6 mt-6">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-bold">Pengadilan</h3>
                        <div class="flex gap-2">
                            <input type="text" x-model="newCourt" placeholder="Nama Pengadilan" class="px-3 py-2 border rounded-lg text-sm">
                            <button @click="addCourt(newCourt)" class="bg-primary text-white px-3 py-2 rounded-lg text-sm">Tambah</button>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-2">
                        <template x-for="c in courts" :key="c">
                            <div class="flex items-center justify-between p-3 rounded border">
                                <div class="flex items-center gap-2 w-full">
                                    <input x-show="editingCourt === c" type="text" x-model="editCourtName" class="flex-1 px-3 py-2 border rounded-lg text-sm">
                                    <span x-show="editingCourt !== c" class="flex-1" x-text="c"></span>
                                    <div class="flex gap-2">
                                        <button x-show="editingCourt !== c" @click="startEditCourt(c)" class="text-gray-500 hover:text-blue-600"><i class="fas fa-edit"></i></button>
                                        <button x-show="editingCourt === c" @click="renameCourt(c, editCourtName)" class="text-white bg-accent px-2 py-1 rounded text-xs">Simpan</button>
                                        <button x-show="editingCourt === c" @click="cancelEditCourt()" class="text-gray-500 px-2 py-1 rounded text-xs">Batal</button>
                                        <button @click="deleteCourt(c)" class="text-gray-400 hover:text-red-600"><i class="fas fa-trash-alt"></i></button>
                                    </div>
                                </div>
                            </div>
                        </template>
                    </div>
                </div>
            </div>
            
            <div x-show="showUserModal" class="fixed inset-0 z-[60] flex items-end md:items-center justify-center" x-cloak>
                <div class="absolute inset-0 bg-black bg-opacity-50 backdrop-blur-sm" @click="showUserModal = false"></div>
                <div class="bg-white w-full md:w-[500px] md:rounded-xl rounded-t-2xl p-6 relative transform transition-transform duration-300"
                     x-transition:enter="translate-y-full md:translate-y-10 opacity-0"
                     x-transition:enter-end="translate-y-0 opacity-100"
                     x-transition:leave="translate-y-full md:translate-y-10 opacity-0">
                    <div class="w-12 h-1.5 bg-gray-300 rounded-full mx-auto mb-6 md:hidden"></div>
                    <h3 class="text-xl font-bold mb-4" x-text="userForm.id ? 'Edit Pengguna' : 'Tambah Pengguna'"></h3>
                    <form @submit.prevent="saveUser">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Role</label>
                                <select x-model="userForm.role" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none">
                                    <option value="admin">Admin</option>
                                    <option value="lawyer">Pengacara</option>
                                    <option value="client">Klien</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Username</label>
                                <input type="text" x-model="userForm.username" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" required>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                                <input type="text" x-model="userForm.full_name" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" required>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                                <input type="email" x-model="userForm.email" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none">
                            </div>
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                                <input type="password" x-model="userForm.password" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" :required="!userForm.id">
                            </div>
                        </div>
                        <div class="mt-3 flex justify-end gap-2">
                            <button type="button" @click="showUserModal = false" class="px-4 py-2 bg-gray-100 text-slate-700 rounded-lg">Batal</button>
                            <button type="submit" class="px-4 py-2 bg-primary text-white rounded-lg">Simpan</button>
                        </div>
                    </form>
                    <button @click="showUserModal = false" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600 md:block hidden">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>
            </div>
             
            
            <!-- WEB MANAGEMENT TAB -->
            <div x-show="tab === 'web'" x-transition.opacity x-cloak>

                <!-- Team Modal -->
                <div x-show="showTeamModal" class="fixed inset-0 z-[70] flex items-center justify-center" x-cloak>
                    <div class="absolute inset-0 bg-black/50 backdrop-blur-sm" @click="showTeamModal = false"></div>
                    <div class="relative bg-white w-full max-w-lg rounded-2xl shadow-2xl p-6 mx-4"
                         x-transition:enter="scale-95 opacity-0"
                         x-transition:enter-end="scale-100 opacity-100">
                        <div class="flex justify-between items-center mb-5">
                            <h3 class="text-xl font-bold text-slate-800" x-text="teamForm.id ? 'Edit Anggota Tim' : 'Tambah Anggota Tim'"></h3>
                            <button @click="showTeamModal = false" class="text-gray-400 hover:text-gray-600"><i class="fas fa-times text-lg"></i></button>
                        </div>

                        <!-- Preview Foto -->
                        <div class="flex justify-center mb-5">
                            <div class="relative group cursor-pointer" @click="$refs.photoInput.click()">
                                <img :src="teamForm.image || 'https://ui-avatars.com/api/?name=' + (teamForm.name || 'Tim') + '&background=e2e8f0&size=96'" class="w-24 h-24 rounded-full object-cover border-4 border-slate-100 shadow">
                                <div class="absolute inset-0 rounded-full bg-black/40 opacity-0 group-hover:opacity-100 flex items-center justify-center transition">
                                    <i class="fas fa-camera text-white text-xl"></i>
                                </div>
                                <div x-show="teamPhotoUploading" class="absolute inset-0 rounded-full bg-white/80 flex items-center justify-center">
                                    <i class="fas fa-spinner fa-spin text-blue-500 text-xl"></i>
                                </div>
                            </div>
                        </div>
                        <input type="file" x-ref="photoInput" accept="image/*" class="hidden" @change="uploadTeamPhoto($event)">

                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap <span class="text-red-500">*</span></label>
                                <input type="text" x-model="teamForm.name" placeholder="Contoh: Budi Santoso, S.H." class="w-full px-4 py-2.5 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:outline-none focus:border-transparent text-sm">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Jabatan <span class="text-red-500">*</span></label>
                                <input type="text" x-model="teamForm.position" placeholder="Contoh: Dewan Pembina" class="w-full px-4 py-2.5 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:outline-none focus:border-transparent text-sm">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Wilayah</label>
                                <input type="text" x-model="teamForm.region" placeholder="Contoh: Purbalingga" class="w-full px-4 py-2.5 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:outline-none focus:border-transparent text-sm">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Foto <span class="text-slate-400 font-normal text-xs">(Klik lingkaran foto di atas untuk upload)</span></label>
                                <div @click="$refs.photoInput.click()" class="w-full px-4 py-2.5 border border-dashed border-gray-300 rounded-xl text-sm text-slate-400 cursor-pointer hover:border-blue-400 hover:text-blue-500 hover:bg-blue-50 transition flex items-center gap-2">
                                    <i class="fas fa-cloud-upload-alt"></i>
                                    <span x-text="teamForm.image ? 'Foto sudah dipilih ✓' : 'Klik untuk upload foto'"></span>
                                </div>
                                <p class="text-xs text-gray-400 mt-1">Format: JPG, PNG, WEBP. Maks 5MB.</p>
                            </div>
                        </div>

                        <div class="flex justify-end gap-3 mt-6">
                            <button @click="showTeamModal = false" class="px-5 py-2.5 bg-gray-100 text-slate-700 rounded-xl text-sm font-medium hover:bg-gray-200 transition">Batal</button>
                            <button @click="saveTeam()" :disabled="!teamForm.name || !teamForm.position" class="px-5 py-2.5 bg-blue-600 text-white rounded-xl text-sm font-medium hover:bg-blue-700 transition disabled:opacity-50 disabled:cursor-not-allowed">
                                <i class="fas fa-save mr-1"></i> Simpan
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Tim Table -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden mb-6">
                    <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center">
                        <div>
                            <h3 class="font-bold text-slate-800 text-lg"><i class="fas fa-users text-blue-500 mr-2"></i> Tim Kami</h3>
                            <p class="text-xs text-slate-400 mt-0.5">Kelola anggota tim yang tampil di website</p>
                        </div>
                        <button @click="openAddTeam()" class="bg-blue-600 text-white px-4 py-2 rounded-xl text-sm font-medium hover:bg-blue-700 transition flex items-center gap-2">
                            <i class="fas fa-plus"></i> Tambah Anggota
                        </button>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead>
                                <tr class="bg-slate-50 text-xs font-semibold text-slate-500 uppercase tracking-wider">
                                    <th class="px-6 py-3 text-left">Foto</th>
                                    <th class="px-6 py-3 text-left">Nama</th>
                                    <th class="px-6 py-3 text-left">Jabatan</th>
                                    <th class="px-6 py-3 text-left">Wilayah</th>
                                    <th class="px-6 py-3 text-right">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-50">
                                <template x-for="t in teams" :key="t.id">
                                    <tr class="hover:bg-slate-50 transition-colors group">
                                        <td class="px-6 py-4">
                                            <img :src="t.image || 'https://ui-avatars.com/api/?name=' + t.name + '&background=e2e8f0'" class="w-11 h-11 rounded-full object-cover border-2 border-white shadow-sm">
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="font-semibold text-slate-800 text-sm" x-text="t.name"></div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <span class="px-2.5 py-1 bg-blue-50 text-blue-700 rounded-lg text-xs font-medium" x-text="t.position"></span>
                                        </td>
                                        <td class="px-6 py-4">
                                            <span class="text-sm text-slate-500" x-text="t.region || '-'"></span>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="flex justify-end gap-2">
                                                <button @click="openEditTeam(t)" class="p-2 text-slate-400 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition" title="Edit">
                                                    <i class="fas fa-pen text-sm"></i>
                                                </button>
                                                <button @click="deleteTeam(t.id)" class="p-2 text-slate-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition" title="Hapus">
                                                    <i class="fas fa-trash-alt text-sm"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                </template>
                                <tr x-show="teams.length === 0">
                                    <td colspan="5" class="px-6 py-12 text-center text-slate-400">
                                        <i class="fas fa-users text-4xl mb-3 block opacity-30"></i>
                                        Belum ada anggota tim. Klik "Tambah Anggota" untuk mulai.
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Galeri Section -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center">
                        <div>
                            <h3 class="font-bold text-slate-800 text-lg"><i class="fas fa-images text-purple-500 mr-2"></i> Galeri Kegiatan</h3>
                            <p class="text-xs text-slate-400 mt-0.5">Foto kegiatan yang tampil di website</p>
                        </div>
                        <div class="flex items-center gap-3">
                            <div x-show="galleryUploading" class="flex items-center gap-2 text-sm text-purple-600">
                                <i class="fas fa-spinner fa-spin"></i> Mengupload...
                            </div>
                            <label class="bg-purple-600 text-white px-4 py-2 rounded-xl text-sm font-medium hover:bg-purple-700 transition flex items-center gap-2 cursor-pointer">
                                <i class="fas fa-cloud-upload-alt"></i> Upload Foto
                                <input type="file" accept="image/*" multiple class="hidden" @change="addGalleryFiles($event)">
                            </label>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
                            <template x-for="g in gallery" :key="g.id">
                                <div class="relative group rounded-xl overflow-hidden border border-gray-100 aspect-square shadow-sm">
                                    <img :src="g.image" class="w-full h-full object-cover">
                                    <div class="absolute inset-0 bg-black/0 group-hover:bg-black/40 transition flex items-center justify-center">
                                        <button @click="deleteGallery(g.id)" class="opacity-0 group-hover:opacity-100 transition bg-red-500 text-white w-9 h-9 rounded-full flex items-center justify-center shadow-lg">
                                            <i class="fas fa-trash text-sm"></i>
                                        </button>
                                    </div>
                                </div>
                            </template>
                            <!-- Empty state -->
                            <div x-show="gallery.length === 0" class="col-span-4 py-14 text-center text-slate-400">
                                <i class="fas fa-images text-5xl mb-3 block opacity-20"></i>
                                Belum ada foto galeri. Klik "Upload Foto" untuk mulai.
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- CONTENT TAB -->
            <div x-show="tab === 'content'" x-transition.opacity x-cloak>
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden mb-6">
                    <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center">
                        <div>
                            <h3 class="font-bold text-slate-800 text-lg"><i class="fas fa-newspaper text-blue-500 mr-2"></i> Manajemen Artikel</h3>
                            <p class="text-xs text-slate-400 mt-0.5">Kelola artikel yang tampil di website</p>
                        </div>
                        <button @click="openAddArticle()" class="bg-blue-600 text-white px-4 py-2 rounded-xl text-sm font-medium hover:bg-blue-700 transition flex items-center gap-2">
                            <i class="fas fa-plus"></i> Tulis Artikel
                        </button>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead>
                                <tr class="bg-slate-50 text-xs font-semibold text-slate-500 uppercase tracking-wider">
                                    <th class="px-6 py-3 text-left">Cover</th>
                                    <th class="px-6 py-3 text-left">Judul Artikel</th>
                                    <th class="px-6 py-3 text-left">Kategori</th>
                                    <th class="px-6 py-3 text-left">Tanggal</th>
                                    <th class="px-6 py-3 text-right">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-50">
                                <template x-for="a in articles" :key="a.id">
                                    <tr class="hover:bg-slate-50 transition-colors group">
                                        <td class="px-6 py-4">
                                            <img :src="a.image || 'https://ui-avatars.com/api/?name=Article&background=e2e8f0'" class="w-12 h-12 rounded object-cover border border-gray-200">
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="font-semibold text-slate-800 text-sm" x-text="a.title"></div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <span class="px-2.5 py-1 bg-gray-100 text-gray-700 rounded-lg text-xs font-medium uppercase" x-text="a.category"></span>
                                        </td>
                                        <td class="px-6 py-4">
                                            <span class="text-sm text-slate-500" x-text="a.created_at"></span>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="flex justify-end gap-2">
                                                <button @click="openEditArticle(a)" class="p-2 text-slate-400 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition" title="Edit">
                                                    <i class="fas fa-pen text-sm"></i>
                                                </button>
                                                <button @click="deleteArticle(a.id)" class="p-2 text-slate-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition" title="Hapus">
                                                    <i class="fas fa-trash-alt text-sm"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                </template>
                                <tr x-show="articles.length === 0">
                                    <td colspan="5" class="px-6 py-12 text-center text-slate-400">
                                        <i class="fas fa-newspaper text-4xl mb-3 block opacity-30"></i>
                                        Belum ada artikel. Klik "Tulis Artikel" untuk mulai.
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            
            <!-- ADD/EDIT ARTICLE MODAL -->
            <div x-show="showAddArticleModal" class="fixed inset-0 z-[70] flex items-center justify-center" x-cloak>
                <div class="absolute inset-0 bg-black/50 backdrop-blur-sm" @click="showAddArticleModal = false"></div>
                <div class="relative bg-white w-full max-w-2xl rounded-2xl shadow-2xl p-6 mx-4"
                     x-transition:enter="scale-95 opacity-0"
                     x-transition:enter-end="scale-100 opacity-100">
                    <div class="flex justify-between items-center mb-5">
                        <h3 class="text-xl font-bold text-slate-800" x-text="newArticle.id ? 'Edit Artikel' : 'Tulis Artikel Baru'"></h3>
                        <button @click="showAddArticleModal = false" class="text-gray-400 hover:text-gray-600"><i class="fas fa-times text-lg"></i></button>
                    </div>
                    <form @submit.prevent="saveArticle">
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Judul <span class="text-red-500">*</span></label>
                                <input type="text" x-model="newArticle.title" class="w-full px-4 py-2.5 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:outline-none text-sm" required>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Kategori <span class="text-red-500">*</span></label>
                                <input type="text" x-model="newArticle.category" placeholder="Misal: Hukum Bisnis" class="w-full px-4 py-2.5 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:outline-none text-sm" required>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Gambar Cover <span class="text-xs text-slate-400 font-normal">(opsional)</span></label>
                                <div class="mt-1 flex items-center gap-4">
                                    <div class="h-20 w-20 shrink-0 rounded-xl bg-gray-100 flex items-center justify-center overflow-hidden border border-gray-200">
                                        <template x-if="newArticle.image">
                                            <img :src="newArticle.image" class="h-full w-full object-cover">
                                        </template>
                                        <template x-if="!newArticle.image">
                                            <i class="fas fa-image text-2xl text-gray-400"></i>
                                        </template>
                                    </div>
                                    <div class="flex-1">
                                        <input type="file" @change="uploadArticleImage" accept="image/*" class="w-full text-sm text-slate-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 cursor-pointer border border-gray-200 rounded-xl" :disabled="articleImageUploading">
                                        <p class="mt-2 text-xs text-slate-500" x-show="articleImageUploading"><i class="fas fa-spinner fa-spin mr-1"></i> Sedang mengupload...</p>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Konten <span class="text-red-500">*</span></label>
                                <textarea x-model="newArticle.content" rows="6" class="w-full px-4 py-2.5 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:outline-none text-sm" required></textarea>
                            </div>
                        </div>
                        <div class="flex justify-end gap-3 mt-6">
                            <button type="button" @click="showAddArticleModal = false" class="px-5 py-2.5 bg-gray-100 text-slate-700 rounded-xl text-sm font-medium hover:bg-gray-200 transition">Batal</button>
                            <button type="submit" class="px-5 py-2.5 bg-blue-600 text-white rounded-xl text-sm font-medium hover:bg-blue-700 transition">
                                <i class="fas fa-save mr-1"></i> Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>

             <!-- PROFILE TAB (Placeholder) -->
             <div x-show="tab === 'profile'" x-transition.opacity x-cloak>
                <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                    <div class="h-24 bg-primary"></div>
                    <div class="px-6 relative">
                        <div class="w-24 h-24 rounded-full border-4 border-white bg-gray-200 absolute -top-12 overflow-hidden">
                            <img :src="currentUser && currentUser.avatar ? currentUser.avatar : ('https://ui-avatars.com/api/?name=' + (currentUser ? currentUser.full_name : 'User') + '&size=200')" alt="Profile">
                        </div>
                    </div>
                    <div class="pt-14 px-6 pb-6">
                        <h2 class="text-2xl font-bold" x-text="currentUser?.full_name"></h2>
                        <p class="text-gray-500 capitalize" x-text="currentUser?.role"></p>
                        
                        <div class="mt-6 space-y-3">
                            <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                                <span class="text-gray-600">Mode Gelap</span>
                                <div class="w-10 h-6 bg-gray-300 rounded-full relative cursor-pointer">
                                    <div class="w-4 h-4 bg-white rounded-full absolute top-1 left-1"></div>
                                </div>
                            </div>
                            <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg cursor-pointer">
                                <span class="text-gray-600">Pengaturan Notifikasi</span>
                                <i class="fas fa-chevron-right text-gray-400"></i>
                            </div>
                            
                            <div class="p-4 bg-gray-50 rounded-lg">
                                <div class="font-bold text-slate-700 mb-2">Edit Profil</div>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-sm text-gray-600 mb-1">Nama Lengkap</label>
                                        <input type="text" x-model="profileForm.full_name" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none">
                                    </div>
                                    <div>
                                        <label class="block text-sm text-gray-600 mb-1">Email</label>
                                        <input type="email" x-model="profileForm.email" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none">
                                    </div>
                                    <div class="md:col-span-2">
                                        <label class="block text-sm text-gray-600 mb-1">Password (opsional)</label>
                                        <input type="password" x-model="profileForm.password" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" placeholder="Isi untuk ganti password">
                                    </div>
                                </div>
                                <div class="mt-3 flex justify-end">
                                    <button @click="updateProfile" class="px-4 py-2 bg-primary text-white rounded-lg">Simpan Perubahan</button>
                                </div>
                            </div>

                            <div class="p-4 bg-gray-50 rounded-lg">
                                <div class="font-bold text-slate-700 mb-2">Foto Avatar</div>
                                <div class="flex items-center gap-4">
                                    <img class="w-16 h-16 rounded-full border" :src="avatarPreview || (currentUser && currentUser.avatar ? currentUser.avatar : ('https://ui-avatars.com/api/?name=' + (currentUser ? currentUser.full_name : 'User')))">
                                    <input type="file" accept="image/*" @change="onAvatarChange">
                                    <button @click="uploadAvatar" class="px-4 py-2 bg-accent text-white rounded-lg">Upload</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </main>

    <!-- MOBILE BOTTOM NAVIGATION -->
    <nav class="md:hidden fixed bottom-0 w-full bg-white border-t border-gray-200 flex justify-around py-2 z-50 safe-area-pb">
        <a href="#" @click.prevent="setTab('home')" class="flex flex-col items-center p-2 w-14 transition" :class="tab === 'home' ? 'text-accent' : 'text-slate-400'">
            <i class="fas fa-home text-xl mb-1"></i>
            <span class="text-[9px] font-medium">Beranda</span>
        </a>
        <a href="#" @click.prevent="setTab('tasks')" class="flex flex-col items-center p-2 w-14 transition" :class="tab === 'tasks' ? 'text-accent' : 'text-slate-400'">
            <i class="fas fa-tasks text-xl mb-1"></i>
            <span class="text-[9px] font-medium">Tugas</span>
        </a>
        <a href="#" @click.prevent="showAddModal = true" class="flex flex-col items-center justify-center -mt-6">
            <div class="w-12 h-12 bg-accent rounded-full shadow-lg flex items-center justify-center text-white text-xl">
                <i class="fas fa-plus"></i>
            </div>
        </a>
        <a href="#" @click.prevent="setTab('cases')" class="flex flex-col items-center p-2 w-14 transition" :class="tab === 'cases' ? 'text-accent' : 'text-slate-400'">
            <i class="fas fa-briefcase text-xl mb-1"></i>
            <span class="text-[9px] font-medium">Kasus</span>
        </a>
        <a href="#" @click.prevent="setTab('documents')" class="flex flex-col items-center p-2 w-14 transition" :class="tab === 'documents' ? 'text-accent' : 'text-slate-400'">
            <i class="fas fa-file-alt text-xl mb-1"></i>
            <span class="text-[9px] font-medium">Dokumen</span>
        </a>
    </nav>

    <!-- ADD TASK MODAL -->
    <div x-show="showAddModal" class="fixed inset-0 z-[60] flex items-end md:items-center justify-center" x-cloak>
        <div class="absolute inset-0 bg-black bg-opacity-50 backdrop-blur-sm" @click="showAddModal = false"></div>
        <div class="bg-white w-full md:w-[500px] md:rounded-xl rounded-t-2xl p-6 relative transform transition-transform duration-300" 
             x-transition:enter="translate-y-full md:translate-y-10 opacity-0"
             x-transition:enter-end="translate-y-0 opacity-100"
             x-transition:leave="translate-y-full md:translate-y-10 opacity-0">
            
            <div class="w-12 h-1.5 bg-gray-300 rounded-full mx-auto mb-6 md:hidden"></div>
            
            <h3 class="text-xl font-bold mb-4">Tambah Tugas Baru</h3>
            
            <form @submit.prevent="addTask">
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Judul Tugas</label>
                    <input type="text" x-model="newTask.title" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" placeholder="Contoh: Sidang Kasus..." required>
                </div>
                
                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal</label>
                        <input type="date" x-model="newTask.date" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Tipe</label>
                        <select x-model="newTask.type" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none">
                            <option value="Sidang">Sidang</option>
                            <option value="Dokumen">Dokumen</option>
                            <option value="Pertemuan">Pertemuan</option>
                            <option value="Riset">Riset</option>
                        </select>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Tautkan ke Kasus (Opsional)</label>
                    <select x-model="newTask.case_id" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none">
                        <option value="">- Pilih Kasus -</option>
                        <template x-for="c in cases" :key="c.id">
                            <option :value="c.id" x-text="c.title"></option>
                        </template>
                    </select>
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Prioritas</label>
                    <div class="flex space-x-2">
                        <button type="button" @click="newTask.priority = 'Tinggi'" :class="newTask.priority === 'Tinggi' ? 'bg-red-100 border-red-500 text-red-700' : 'bg-white border-gray-200 text-gray-600'" class="flex-1 py-2 border rounded-lg text-sm font-medium transition">Tinggi</button>
                        <button type="button" @click="newTask.priority = 'Sedang'" :class="newTask.priority === 'Sedang' ? 'bg-yellow-100 border-yellow-500 text-yellow-700' : 'bg-white border-gray-200 text-gray-600'" class="flex-1 py-2 border rounded-lg text-sm font-medium transition">Sedang</button>
                        <button type="button" @click="newTask.priority = 'Rendah'" :class="newTask.priority === 'Rendah' ? 'bg-green-100 border-green-500 text-green-700' : 'bg-white border-gray-200 text-gray-600'" class="flex-1 py-2 border rounded-lg text-sm font-medium transition">Rendah</button>
                    </div>
                </div>

                <button type="submit" class="w-full bg-accent text-white py-3 rounded-xl font-bold text-lg shadow-lg hover:bg-blue-700 transition">Simpan Tugas</button>
            </form>
            
            <button @click="showAddModal = false" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600 md:block hidden">
                <i class="fas fa-times text-xl"></i>
            </button>
        </div>
    </div>

    <!-- ADD CASE MODAL -->
    <div x-show="showAddCaseModal" class="fixed inset-0 z-[60] flex items-end md:items-center justify-center" x-cloak>
        <div class="absolute inset-0 bg-black bg-opacity-50 backdrop-blur-sm" @click="showAddCaseModal = false"></div>
        <div class="bg-white w-full md:w-[500px] md:rounded-xl rounded-t-2xl p-6 relative transform transition-transform duration-300"
             x-transition:enter="translate-y-full md:translate-y-10 opacity-0"
             x-transition:enter-end="translate-y-0 opacity-100"
             x-transition:leave="translate-y-full md:translate-y-10 opacity-0">
             
            <h3 class="text-xl font-bold mb-4">Buat Kasus Baru</h3>
            <form @submit.prevent="addCase">
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Kasus</label>
                    <input type="text" x-model="newCase.title" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" required>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Klien</label>
                    <input type="text" x-model="newCase.client_name" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" required>
                </div>
                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Pengadilan</label>
                        <div class="flex gap-2">
                            <select x-model="newCase.court" class="flex-1 px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none">
                                <option value="">- Pilih Pengadilan -</option>
                                <template x-for="c in courts" :key="c">
                                    <option :value="c" x-text="c"></option>
                                </template>
                            </select>
                            <button type="button" @click="promptAddCourt()" class="px-3 py-2 bg-accent text-white rounded-lg text-sm">Tambah</button>
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nomor Perkara</label>
                        <div class="flex gap-2">
                            <input list="caseNumbers" type="text" x-model="newCase.case_number" class="flex-1 px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" placeholder="123/Pdt.G/2025/...">
                            <datalist id="caseNumbers">
                                <template x-for="n in case_numbers" :key="n">
                                    <option :value="n" x-text="n"></option>
                                </template>
                            </datalist>
                            <button type="button" @click="addCaseNumber(newCase.case_number)" class="px-3 py-2 bg-accent text-white rounded-lg text-sm">Simpan ke Master</button>
                        </div>
                    </div>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Mulai</label>
                    <div class="flex gap-2">
                        <input list="startDates" type="date" x-model="newCase.start_date" class="flex-1 px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none">
                        <datalist id="startDates">
                            <template x-for="d in start_dates" :key="d">
                                <option :value="d" x-text="d"></option>
                            </template>
                        </datalist>
                        <button type="button" @click="addStartDate(newCase.start_date)" class="px-3 py-2 bg-accent text-white rounded-lg text-sm">Simpan ke Master</button>
                    </div>
                </div>
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi Singkat</label>
                    <textarea x-model="newCase.description" rows="3" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"></textarea>
                </div>
                <button type="submit" class="w-full bg-primary text-white py-3 rounded-xl font-bold text-lg shadow-lg hover:bg-slate-700 transition">Simpan Kasus</button>
            </form>
            <button @click="showAddCaseModal = false" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600 md:block hidden"><i class="fas fa-times text-xl"></i></button>
        </div>
    </div>

    <!-- ADD DOCUMENT MODAL -->
    <div x-show="showAddDocModal" class="fixed inset-0 z-[60] flex items-end md:items-center justify-center" x-cloak>
        <div class="absolute inset-0 bg-black bg-opacity-50 backdrop-blur-sm" @click="showAddDocModal = false"></div>
        <div class="bg-white w-full md:w-[500px] md:rounded-xl rounded-t-2xl p-6 relative transform transition-transform duration-300"
             x-transition:enter="translate-y-full md:translate-y-10 opacity-0"
             x-transition:enter-end="translate-y-0 opacity-100"
             x-transition:leave="translate-y-full md:translate-y-10 opacity-0">
             
            <h3 class="text-xl font-bold mb-4">Upload Dokumen</h3>
            <form @submit.prevent="addDocument">
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Dokumen</label>
                    <input type="text" x-model="newDoc.title" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" placeholder="example.pdf" required>
                </div>
                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Tipe</label>
                        <select x-model="newDoc.type" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none">
                            <option value="Kontrak">Kontrak</option>
                            <option value="Gugatan">Gugatan</option>
                            <option value="Bukti">Bukti</option>
                            <option value="Surat">Surat</option>
                            <option value="BAP">BAP</option>
                            <option value="Lainnya">Lainnya</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal</label>
                        <input type="date" x-model="newDoc.date" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" required>
                    </div>
                </div>
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Terkait Kasus</label>
                    <select x-model="newDoc.case_id" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" required>
                        <option value="">- Pilih Kasus -</option>
                        <template x-for="c in cases" :key="c.id">
                            <option :value="c.id" x-text="c.title"></option>
                        </template>
                    </select>
                </div>
                <button type="submit" class="w-full bg-primary text-white py-3 rounded-xl font-bold text-lg shadow-lg hover:bg-slate-700 transition">Simpan Dokumen</button>
            </form>
            <button @click="showAddDocModal = false" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600 md:block hidden"><i class="fas fa-times text-xl"></i></button>
        </div>
    </div>

    <!-- DETAIL CASE MODAL -->
    <div x-show="showDetailCaseModal" class="fixed inset-0 z-[60] flex items-end md:items-center justify-center" x-cloak>
        <div class="absolute inset-0 bg-black bg-opacity-50 backdrop-blur-sm" @click="showDetailCaseModal = false"></div>
        <div class="bg-white w-full md:w-[600px] md:max-h-[90vh] md:rounded-xl rounded-t-2xl p-6 relative transform transition-transform duration-300 overflow-y-auto"
             x-transition:enter="translate-y-full md:translate-y-10 opacity-0"
             x-transition:enter-end="translate-y-0 opacity-100"
             x-transition:leave="translate-y-full md:translate-y-10 opacity-0">
             
            <template x-if="selectedCase">
                <div>
                    <div class="flex justify-between items-start mb-4">
                        <div>
                            <span class="px-2 py-1 rounded text-xs font-semibold mb-2 inline-block" 
                                  :class="selectedCase.status === 'Open' ? 'bg-green-100 text-green-700' : (selectedCase.status === 'On Hold' ? 'bg-yellow-100 text-yellow-700' : 'bg-gray-100 text-gray-700')"
                                  x-text="selectedCase.status"></span>
                            <h3 class="text-xl font-bold text-slate-800" x-text="selectedCase.title"></h3>
                            <div class="text-sm text-slate-500 mt-1">
                                <i class="fas fa-user mr-1"></i> <span x-text="selectedCase.client_name"></span>
                            </div>
                        </div>
                        <button @click="showDetailCaseModal = false" class="text-gray-400 hover:text-gray-600"><i class="fas fa-times text-xl"></i></button>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6 text-sm">
                        <div class="bg-gray-50 p-3 rounded-lg">
                            <div class="text-gray-500">Pengadilan</div>
                            <div class="font-medium text-gray-800" x-text="selectedCase.court || '-'"></div>
                        </div>
                        <div class="bg-gray-50 p-3 rounded-lg">
                            <div class="text-gray-500">No. Perkara</div>
                            <div class="font-medium text-gray-800" x-text="selectedCase.case_number || '-'"></div>
                        </div>
                        <div class="bg-gray-50 p-3 rounded-lg">
                            <div class="text-gray-500">Mulai</div>
                            <div class="font-medium text-gray-800" x-text="selectedCase.start_date || '-'"></div>
                        </div>
                    </div>

                    <div class="mb-6">
                        <h4 class="font-bold text-sm text-gray-700 uppercase mb-2">Penugasan Pengacara</h4>
                        <div class="flex items-center gap-3">
                            <span class="text-sm text-gray-600">Ditugaskan ke:</span>
                            <span class="px-2 py-1 rounded bg-blue-50 text-blue-700 text-xs" x-text="getUserName(selectedCase.assigned_to) || 'Belum ditugaskan'"></span>
                        </div>
                        <div class="mt-3" x-show="currentUser && (currentUser.role === 'admin' || currentUser.role === 'lawyer')">
                            <label class="block text-xs text-gray-500 mb-1">Ganti Penugasan</label>
                            <div class="flex gap-2">
                                <select x-model="assignForm.user_id" class="flex-1 px-3 py-2 border rounded-lg text-sm">
                                    <option value="">- Pilih Pengacara -</option>
                                    <template x-for="u in lawyerUsers" :key="u.id">
                                        <option :value="u.id" x-text="u.full_name"></option>
                                    </template>
                                </select>
                                <button @click="assignCase(selectedCase.id, assignForm.user_id)" class="px-3 py-2 bg-primary text-white rounded-lg text-sm">Simpan</button>
                            </div>
                        </div>
                    </div>

                    <div class="mb-6">
                        <h4 class="font-bold text-sm text-gray-700 uppercase mb-2">Deskripsi</h4>
                        <p class="text-gray-600 text-sm leading-relaxed" x-text="selectedCase.description || 'Tidak ada deskripsi.'"></p>
                    </div>

                    <div class="mb-6">
                        <h4 class="font-bold text-sm text-gray-700 uppercase mb-2">Timeline Kasus</h4>
                        <div class="space-y-2">
                            <template x-for="t in (selectedCase.timeline || [])" :key="t.date + t.activity">
                                <div class="flex items-start gap-3 bg-gray-50 p-3 rounded-lg border border-gray-100">
                                    <div class="w-2 h-2 rounded-full bg-blue-500 mt-2"></div>
                                    <div>
                                        <div class="text-sm font-medium text-gray-800" x-text="t.activity"></div>
                                        <div class="text-xs text-gray-500" x-text="formatDate(t.date) + ' • ' + (t.by || '-')"></div>
                                    </div>
                                </div>
                            </template>
                            <div x-show="!selectedCase.timeline || selectedCase.timeline.length === 0" class="text-sm text-gray-400 italic">Belum ada aktivitas.</div>
                        </div>
                        <div class="mt-3" x-show="currentUser && (currentUser.role === 'admin' || currentUser.role === 'lawyer')">
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-2">
                                <input type="date" x-model="timelineForm.date" class="px-3 py-2 border rounded-lg text-sm">
                                <input type="text" x-model="timelineForm.activity" placeholder="Aktivitas..." class="md:col-span-2 px-3 py-2 border rounded-lg text-sm">
                            </div>
                            <button @click="addTimeline(selectedCase.id)" class="mt-2 px-3 py-2 bg-accent text-white rounded-lg text-sm">Tambah Aktivitas</button>
                        </div>
                    </div>

                    <div class="mb-6">
                        <h4 class="font-bold text-sm text-gray-700 uppercase mb-2">Dokumen Terkait</h4>
                        <div class="space-y-2">
                            <template x-for="doc in documents.filter(d => d.case_id == selectedCase.id)" :key="doc.id">
                                <div class="flex items-center justify-between bg-gray-50 p-3 rounded-lg border border-gray-100">
                                    <div class="flex items-center">
                                        <i class="fas fa-file-alt text-blue-500 mr-3"></i>
                                        <div>
                                            <div class="text-sm font-medium text-gray-800" x-text="doc.title"></div>
                                            <div class="text-xs text-gray-500" x-text="doc.type + ' • ' + formatDate(doc.date)"></div>
                                        </div>
                                    </div>
                                    <button class="text-gray-400 hover:text-blue-600"><i class="fas fa-download"></i></button>
                                </div>
                            </template>
                            <div x-show="documents.filter(d => d.case_id == selectedCase.id).length === 0" class="text-sm text-gray-400 italic">
                                Belum ada dokumen.
                            </div>
                        </div>
                    </div>

                    <div>
                        <h4 class="font-bold text-sm text-gray-700 uppercase mb-2">Tugas & Agenda</h4>
                        <div class="space-y-2">
                            <template x-for="task in tasks.filter(t => t.case_id == selectedCase.id)" :key="task.id">
                                <div class="flex items-center justify-between bg-gray-50 p-3 rounded-lg border border-gray-100">
                                    <div class="flex items-center">
                                        <div class="w-2 h-2 rounded-full mr-3" :class="task.status === 'completed' ? 'bg-green-500' : 'bg-yellow-500'"></div>
                                        <div>
                                            <div class="text-sm font-medium text-gray-800" :class="task.status === 'completed' ? 'line-through text-gray-500' : ''" x-text="task.title"></div>
                                            <div class="text-xs text-gray-500" x-text="formatDate(task.date) + ' • ' + task.type"></div>
                                        </div>
                                    </div>
                                </div>
                            </template>
                            <div x-show="tasks.filter(t => t.case_id == selectedCase.id).length === 0" class="text-sm text-gray-400 italic">
                                Belum ada tugas terkait.
                            </div>
                        </div>
                    </div>
                </div>
            </template>
        </div>
    </div>
    
    <!-- End of Main App Div -->
    </div>

    <script>
        // Force register the new "killer" service worker to overwrite the old one
        if ('serviceWorker' in navigator) {
            navigator.serviceWorker.register('sw.js?v=' + new Date().getTime()).then(function(registration) {
                registration.update();
            }).catch(function(error) {
                console.log('SW registration failed: ', error);
            });
        }

        function app() {
            return {
                showLogin: false,
                isLoggedIn: false,
                currentUser: null,
                isLoading: false,
                loginError: '',
                loginForm: { username: '', password: '' },
                profileForm: { full_name: '', email: '', password: '' },
                avatarFile: null,
                avatarPreview: '',

                tab: 'home',
                filter: 'all',
                showAddModal: false,
                showAddCaseModal: false,
                showAddDocModal: false,
                showDetailCaseModal: false,
                selectedCase: null,
                stats: { total: 0, pending: 0, completed: 0 },
                tasks: [],
                cases: [],
                documents: [],
                newTask: {
                    title: '',
                    date: new Date().toISOString().split('T')[0],
                    priority: 'Sedang',
                    type: 'Sidang',
                    status: 'pending',
                    case_id: ''
                },
                newCase: {
                    title: '',
                    client_name: '',
                    status: 'Open',
                    description: '',
                    court: '',
                    case_number: '',
                    start_date: new Date().toISOString().split('T')[0]
                },
                newDoc: {
                    title: '',
                    type: 'Kontrak',
                    date: new Date().toISOString().split('T')[0],
                    case_id: ''
                },
                users: [],
                courts: [],
                case_numbers: [],
                start_dates: [],
                assignForm: { user_id: '' },
                timelineForm: { date: new Date().toISOString().split('T')[0], activity: '' },
                newCourt: '',
                editingCourt: null,
                editCourtName: '',
                showUserModal: false,
                showAddArticleModal: false,
                showTeamModal: false,
                teamPhotoUploading: false,
                galleryUploading: false,
                articleImageUploading: false,
                teamForm: { id: null, name: '', position: '', region: '', image: '' },
                articles: [],
                newArticle: {id: null, title: '', category: '', content: '', image: ''},
                userForm: { id: null, role: 'lawyer', username: '', full_name: '', email: '', password: '' },
                
                init() {
                    const savedUser = localStorage.getItem('lawyerAppUser');
                    if (savedUser) {
                        this.currentUser = JSON.parse(savedUser);
                        this.isLoggedIn = true;
                        this.fetchData();
                        this.profileForm = { full_name: this.currentUser.full_name || '', email: this.currentUser.email || '', password: '' };
                    }
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
                            localStorage.setItem('lawyerAppUser', JSON.stringify(result.user));
                            this.fetchData();
                            this.loginForm = { username: '', password: '' };
                        } else {
                            this.loginError = result.message;
                        }
                    } catch (e) {
                        this.loginError = 'Terjadi kesalahan koneksi';
                        console.error(e);
                    } finally {
                        this.isLoading = false;
                    }
                },

                 logout() {
                     this.isLoggedIn = false;
                     this.currentUser = null;
                     this.tab = 'home';
                     localStorage.removeItem('lawyerAppUser');
                 },

                 async updateProfile() {
                     if (!this.currentUser) return;
                     try {
                         const res = await fetch('api.php', {
                             method: 'POST',
                             headers: { 'Content-Type': 'application/json' },
                             body: JSON.stringify({ 
                                 action: 'update_profile', 
                                 id: this.currentUser.id, 
                                 full_name: this.profileForm.full_name, 
                                 email: this.profileForm.email, 
                                 password: this.profileForm.password 
                             })
                         });
                         const result = await res.json();
                         if (result.success) {
                             const updatedUser = (result.data.users || []).find(u => u.id == this.currentUser.id) || this.currentUser;
                             this.currentUser = updatedUser;
                             localStorage.setItem('lawyerAppUser', JSON.stringify(this.currentUser));
                             this.profileForm.password = '';
                         }
                     } catch (e) { console.error(e); }
                 },

                 onAvatarChange(e) {
                     const file = e.target.files[0];
                     if (!file) return;
                     this.avatarFile = file;
                     this.avatarPreview = URL.createObjectURL(file);
                 },

                 async uploadAvatar() {
                     if (!this.avatarFile || !this.currentUser) return;
                     const fd = new FormData();
                     fd.append('action', 'upload_avatar');
                     fd.append('user_id', this.currentUser.id);
                     fd.append('avatar', this.avatarFile);
                     try {
                         const res = await fetch('api.php', { method: 'POST', body: fd });
                         const result = await res.json();
                         if (result.success) {
                             const updatedUser = (result.data.users || []).find(u => u.id == this.currentUser.id) || this.currentUser;
                             this.currentUser = updatedUser;
                             localStorage.setItem('lawyerAppUser', JSON.stringify(this.currentUser));
                             this.avatarPreview = '';
                             this.avatarFile = null;
                         }
                     } catch (e) { console.error(e); }
                 },
                get pageTitle() {
                    const titles = {
                        'home': 'Dashboard',
                        'tasks': 'Daftar Tugas',
                        'cases': 'Manajemen Kasus',
                        'documents': 'Dokumentasi',
                        'clients': 'Manajemen Klien',
                        'profile': 'Profil Saya'
                    };
                    return titles[this.tab];
                },

                get filteredTasks() {
                    if (this.filter === 'all') return this.tasks;
                    return this.tasks.filter(t => t.status === this.filter);
                },

                get priorityTasks() {
                    return this.tasks.filter(t => t.priority === 'Tinggi' && t.status === 'pending');
                },

                get lawyerUsers() {
                    return (this.users || []).filter(u => u.role === 'lawyer');
                },

                openAddUser(role) {
                    this.userForm = { id: null, role, username: '', full_name: '', email: '', password: '' };
                    this.showUserModal = true;
                },
                openEditUser(u) {
                    this.userForm = { id: u.id, role: u.role, username: u.username, full_name: u.full_name, email: u.email, password: '' };
                    this.showUserModal = true;
                },
                async saveUser() {
                    const action = this.userForm.id ? 'update_user' : 'create_user';
                    try {
                        const res = await fetch('api.php', {
                            method: 'POST',
                            headers: { 'Content-Type': 'application/json' },
                            body: JSON.stringify({ action, user: this.userForm })
                        });
                        const result = await res.json();
                        if (result.success) {
                            this.updateLocalData(result.data);
                            this.showUserModal = false;
                        }
                    } catch (e) { console.error(e); }
                },
                async deleteUser(id) {
                    if (!confirm('Hapus user ini?')) return;
                    try {
                        const res = await fetch('api.php', {
                            method: 'POST',
                            headers: { 'Content-Type': 'application/json' },
                            body: JSON.stringify({ action: 'delete_user', id })
                        });
                        const result = await res.json();
                        if (result.success) this.updateLocalData(result.data);
                    } catch (e) { console.error(e); }
                },
                async addCourt(name) {
                    if (!name) return;
                    try {
                        const res = await fetch('api.php', {
                            method: 'POST',
                            headers: { 'Content-Type': 'application/json' },
                            body: JSON.stringify({ action: 'add_court', name })
                        });
                        const result = await res.json();
                        if (result.success) {
                            this.updateLocalData(result.data);
                            this.newCourt = '';
                        }
                    } catch (e) { console.error(e); }
                },
                async deleteCourt(name) {
                    if (!confirm('Hapus pengadilan ini?')) return;
                    try {
                        const res = await fetch('api.php', {
                            method: 'POST',
                            headers: { 'Content-Type': 'application/json' },
                            body: JSON.stringify({ action: 'delete_court', name })
                        });
                        const result = await res.json();
                        if (result.success) this.updateLocalData(result.data);
                    } catch (e) { console.error(e); }
                },
                startEditCourt(name) {
                    this.editingCourt = name;
                    this.editCourtName = name;
                },
                cancelEditCourt() {
                    this.editingCourt = null;
                    this.editCourtName = '';
                },
                async renameCourt(oldName, newName) {
                    const name = (newName || '').trim();
                    if (!name || name === oldName) { this.cancelEditCourt(); return; }
                    try {
                        const res = await fetch('api.php', {
                            method: 'POST',
                            headers: { 'Content-Type': 'application/json' },
                            body: JSON.stringify({ action: 'rename_court', old_name: oldName, new_name: name })
                        });
                        const result = await res.json();
                        if (result.success) {
                            this.updateLocalData(result.data);
                            this.cancelEditCourt();
                        }
                    } catch (e) { console.error(e); }
                },
 
                setTab(val) {
                    this.tab = val;
                    // Reset Modals
                    this.showAddModal = false;
                    this.showAddCaseModal = false;
                    this.showAddDocModal = false;
                    this.showDetailCaseModal = false;
                    this.showUserModal = false;
                },

                viewCaseDetail(c) {
                    console.log('Opening case detail:', c);
                    this.selectedCase = c;
                    this.assignForm.user_id = c.assigned_to || '';
                    this.timelineForm = { date: new Date().toISOString().split('T')[0], activity: '' };
                    this.showDetailCaseModal = true;
                },

                getCaseName(id) {
                    const c = (this.cases || []).find(x => x.id == id);
                    return c ? c.title : 'Umum';
                },
                
                getUserName(id) {
                    const u = (this.users || []).find(x => x.id == id);
                    return u ? u.full_name : '';
                },

                async fetchData() {
                    try {
                        const res = await fetch('api.php?t=' + new Date().getTime());
                        const data = await res.json();
                        this.tasks = data.tasks || [];
                        this.cases = data.cases || [];
                        this.documents = data.documents || [];
                        this.articles = data.articles || [];
                        this.stats = data.stats || { total: 0, pending: 0, completed: 0 };
                        this.users = data.users || [];
                        this.courts = data.courts || [];
                        this.case_numbers = data.case_numbers || [];
                    this.articles = data.articles || [];
                        
                    this.start_dates = data.start_dates || [];
                    this.teams = data.teams || [];
                    this.gallery = data.gallery || [];

                    } catch (e) {
                        console.error("Error fetching data", e);
                    }
                },

                async addTask() {
                    if (!this.newTask.title) return;
                    
                    try {
                        const res = await fetch('api.php', {
                            method: 'POST',
                            headers: { 'Content-Type': 'application/json' },
                            body: JSON.stringify({ action: 'add', task: this.newTask })
                        });
                        const result = await res.json();
                        if (result.success) {
                            this.updateLocalData(result.data);
                            this.showAddModal = false;
                            this.resetForm();
                            this.setTab('tasks');
                        }
                    } catch (e) {
                        alert('Gagal menyimpan tugas');
                    }
                },

                async addCase() {
                    if (!this.newCase.title) return;
                    try {
                        const res = await fetch('api.php', {
                            method: 'POST',
                            headers: { 'Content-Type': 'application/json' },
                            body: JSON.stringify({ action: 'add_case', case: this.newCase })
                        });
                        const result = await res.json();
                        if (result.success) {
                            this.updateLocalData(result.data);
                            this.showAddCaseModal = false;
                            this.newCase = { title: '', client_name: '', status: 'Open', description: '', court: '', case_number: '', start_date: new Date().toISOString().split('T')[0] };
                        }
                    } catch (e) { alert('Gagal menyimpan kasus'); }
                },

                async addDocument() {
                    if (!this.newDoc.title) return;
                    try {
                        const res = await fetch('api.php', {
                            method: 'POST',
                            headers: { 'Content-Type': 'application/json' },
                            body: JSON.stringify({ action: 'add_document', document: this.newDoc })
                        });
                        const result = await res.json();
                        if (result.success) {
                            this.updateLocalData(result.data);
                            this.showAddDocModal = false;
                            this.newDoc = { title: '', type: 'Kontrak', date: new Date().toISOString().split('T')[0], case_id: '' };
                        }
                    } catch (e) { alert('Gagal menyimpan dokumen'); }
                },

                async toggleTask(id) {
                    try {
                        const res = await fetch('api.php', {
                            method: 'POST',
                            headers: { 'Content-Type': 'application/json' },
                            body: JSON.stringify({ action: 'toggle', id: id })
                        });
                        const result = await res.json();
                        if (result.success) this.updateLocalData(result.data);
                    } catch (e) { console.error(e); }
                },

                async deleteTask(id) {
                    if(!confirm('Hapus tugas ini?')) return;
                    try {
                        const res = await fetch('api.php', {
                            method: 'POST',
                            headers: { 'Content-Type': 'application/json' },
                            body: JSON.stringify({ action: 'delete', id: id })
                        });
                        const result = await res.json();
                        if (result.success) this.updateLocalData(result.data);
                    } catch (e) { console.error(e); }
                },

                async deleteCase(id) {
                    if(!confirm('Hapus kasus ini beserta datanya?')) return;
                    try {
                        const res = await fetch('api.php', {
                            method: 'POST',
                            headers: { 'Content-Type': 'application/json' },
                            body: JSON.stringify({ action: 'delete_case', id: id })
                        });
                        const result = await res.json();
                        if (result.success) this.updateLocalData(result.data);
                    } catch (e) { console.error(e); }
                },

                openAddArticle() {
                    this.newArticle = { id: null, title: '', category: '', content: '', image: '' };
                    this.showAddArticleModal = true;
                },
                openEditArticle(a) {
                    this.newArticle = { id: a.id, title: a.title, category: a.category, content: a.content, image: a.image || '' };
                    this.showAddArticleModal = true;
                },
                async uploadArticleImage(event) {
                    const file = event.target.files[0];
                    if (!file) return;
                    if (file.size > 5 * 1024 * 1024) {
                        alert('Ukuran file terlalu besar. Maksimal 5MB.');
                        return;
                    }
                    this.articleImageUploading = true;
                    const formData = new FormData();
                    formData.append('action', 'upload_image');
                    formData.append('file', file);
                    try {
                        const res = await fetch('api.php', { method: 'POST', body: formData });
                        const result = await res.json();
                        if (result.success) {
                            this.newArticle.image = result.path;
                        } else {
                            alert('Upload gagal: ' + (result.message || 'Coba lagi.'));
                        }
                    } catch (e) {
                        alert('Terjadi kesalahan saat upload.');
                        console.error(e);
                    } finally {
                        this.articleImageUploading = false;
                        event.target.value = '';
                    }
                },
                async saveArticle() {
                    if (!this.newArticle.title) return;
                    const action = this.newArticle.id ? 'update_article' : 'add_article';
                    try {
                        const res = await fetch('api.php', {
                            method: 'POST',
                            headers: { 'Content-Type': 'application/json' },
                            body: JSON.stringify({ action, article: this.newArticle })
                        });
                        const result = await res.json();
                        if (result.success) {
                            this.updateLocalData(result.data);
                            this.showAddArticleModal = false;
                        }
                    } catch (e) { console.error(e); }
                },
                async deleteArticle(id) {
                    if (!confirm('Hapus artikel ini?')) return;
                    try {
                        const res = await fetch('api.php', {
                            method: 'POST',
                            headers: { 'Content-Type': 'application/json' },
                            body: JSON.stringify({ action: 'delete_article', id: id })
                        });
                        const result = await res.json();
                        if (result.success) this.updateLocalData(result.data);
                    } catch (e) { console.error(e); }
                },

                async deleteDocument(id) {
                    if(!confirm('Hapus dokumen ini?')) return;
                    try {
                        const res = await fetch('api.php', {
                            method: 'POST',
                            headers: { 'Content-Type': 'application/json' },
                            body: JSON.stringify({ action: 'delete_document', id: id })
                        });
                        const result = await res.json();
                        if (result.success) this.updateLocalData(result.data);
                    } catch (e) { console.error(e); }
                },

                async updateCaseStatus(id, status) {
                    try {
                        const res = await fetch('api.php', {
                            method: 'POST',
                            headers: { 'Content-Type': 'application/json' },
                            body: JSON.stringify({ action: 'update_case_status', id: id, status: status })
                        });
                        const result = await res.json();
                        if (result.success) this.updateLocalData(result.data);
                    } catch (e) { console.error(e); }
                },

                async promptAddCourt() {
                    const name = prompt('Nama Pengadilan');
                    if (!name) return;
                    try {
                        const res = await fetch('api.php', {
                            method: 'POST',
                            headers: { 'Content-Type': 'application/json' },
                            body: JSON.stringify({ action: 'add_court', name })
                        });
                        const result = await res.json();
                        if (result.success) {
                            this.updateLocalData(result.data);
                            this.newCase.court = name;
                        }
                    } catch (e) { console.error(e); }
                },

                async addCaseNumber(val) {
                    if (!val) return;
                    try {
                        const res = await fetch('api.php', {
                            method: 'POST',
                            headers: { 'Content-Type': 'application/json' },
                            body: JSON.stringify({ action: 'add_case_number', value: val })
                        });
                        const result = await res.json();
                        if (result.success) this.updateLocalData(result.data);
                    } catch (e) { console.error(e); }
                },

                async addStartDate(date) {
                    if (!date) return;
                    try {
                        const res = await fetch('api.php', {
                            method: 'POST',
                            headers: { 'Content-Type': 'application/json' },
                            body: JSON.stringify({ action: 'add_start_date', date })
                        });
                        const result = await res.json();
                        if (result.success) this.updateLocalData(result.data);
                    } catch (e) { console.error(e); }
                },

                async addTimeline(caseId) {
                    if (!this.timelineForm.activity) return;
                    try {
                        const res = await fetch('api.php', {
                            method: 'POST',
                            headers: { 'Content-Type': 'application/json' },
                            body: JSON.stringify({ 
                                action: 'add_case_timeline', 
                                id: caseId, 
                                entry: { 
                                    date: this.timelineForm.date, 
                                    activity: this.timelineForm.activity, 
                                    by: this.currentUser ? this.currentUser.full_name : 'system' 
                                } 
                            })
                        });
                        const result = await res.json();
                        if (result.success) {
                            this.updateLocalData(result.data);
                            this.selectedCase = (result.data.cases || []).find(c => c.id == caseId) || this.selectedCase;
                            this.timelineForm.activity = '';
                        }
                    } catch (e) { console.error(e); }
                },

                async assignCase(caseId, userId) {
                    try {
                        const res = await fetch('api.php', {
                            method: 'POST',
                            headers: { 'Content-Type': 'application/json' },
                            body: JSON.stringify({ action: 'assign_case', id: caseId, user_id: userId })
                        });
                        const result = await res.json();
                        if (result.success) {
                            this.updateLocalData(result.data);
                            this.selectedCase = (result.data.cases || []).find(c => c.id == caseId) || this.selectedCase;
                        }
                    } catch (e) { console.error(e); }
                },

                updateLocalData(data) {
                    this.tasks = data.tasks || [];
                    this.cases = data.cases || [];
                    this.documents = data.documents || [];
                        this.articles = data.articles || [];
                    this.stats = data.stats || { total: 0, pending: 0, completed: 0 };
                    this.users = data.users || [];
                    this.courts = data.courts || [];
                    this.case_numbers = data.case_numbers || [];
                    this.articles = data.articles || [];
                    
                    this.start_dates = data.start_dates || [];
                    this.teams = data.teams || [];
                    this.gallery = data.gallery || [];

                },

                resetForm() {
                    this.newTask = {
                        title: '',
                        date: new Date().toISOString().split('T')[0],
                        priority: 'Sedang',
                        type: 'Sidang',
                        status: 'pending',
                        case_id: ''
                    };
                },

                
                openAddTeam() {
                    this.teamForm = { id: null, name: '', position: '', region: '', image: '' };
                    this.showTeamModal = true;
                },

                openEditTeam(t) {
                    this.teamForm = { id: t.id, name: t.name, position: t.position, region: t.region || '', image: t.image || '' };
                    this.showTeamModal = true;
                },

                async uploadTeamPhoto(event) {
                    const file = event.target.files[0];
                    if (!file) return;
                    if (file.size > 5 * 1024 * 1024) {
                        alert('Ukuran file terlalu besar. Maksimal 5MB.');
                        return;
                    }
                    this.teamPhotoUploading = true;
                    const formData = new FormData();
                    formData.append('action', 'upload_image');
                    formData.append('file', file);
                    try {
                        const res = await fetch('api.php', { method: 'POST', body: formData });
                        const result = await res.json();
                        if (result.success) {
                            this.teamForm.image = result.path;
                        } else {
                            alert('Upload gagal: ' + (result.message || 'Coba lagi.'));
                        }
                    } catch (e) {
                        alert('Terjadi kesalahan saat upload.');
                        console.error(e);
                    } finally {
                        this.teamPhotoUploading = false;
                        event.target.value = '';
                    }
                },

                async saveTeam() {
                    if (!this.teamForm.name || !this.teamForm.position) return;
                    const action = this.teamForm.id ? 'update_team' : 'add_team';
                    try {
                        const res = await fetch('api.php', {
                            method: 'POST',
                            headers: { 'Content-Type': 'application/json' },
                            body: JSON.stringify({ action, team: this.teamForm })
                        });
                        const result = await res.json();
                        if (result.success) {
                            this.updateLocalData(result.data);
                            this.showTeamModal = false;
                        }
                    } catch (e) { console.error(e); }
                },

                async addTeam() { this.openAddTeam(); },
                async deleteTeam(id) {
                    if (!confirm('Hapus anggota tim ini?')) return;
                    try {
                        const res = await fetch('api.php', { method: 'POST', headers: { 'Content-Type': 'application/json' }, body: JSON.stringify({ action: 'delete_team', id }) });
                        const result = await res.json();
                        if (result.success) this.updateLocalData(result.data);
                    } catch (e) {}
                },
                async addGalleryFiles(event) {
                    const files = Array.from(event.target.files);
                    if (!files.length) return;
                    this.galleryUploading = true;
                    for (const file of files) {
                        if (file.size > 10 * 1024 * 1024) {
                            alert(`File "${file.name}" terlalu besar. Maksimal 10MB.`);
                            continue;
                        }
                        const formData = new FormData();
                        formData.append('action', 'upload_image');
                        formData.append('file', file);
                        try {
                            const res = await fetch('api.php', { method: 'POST', body: formData });
                            const uploaded = await res.json();
                            if (uploaded.success) {
                                const addRes = await fetch('api.php', {
                                    method: 'POST',
                                    headers: { 'Content-Type': 'application/json' },
                                    body: JSON.stringify({ action: 'add_gallery', gallery: { image: uploaded.path, css_class: '' } })
                                });
                                const result = await addRes.json();
                                if (result.success) this.updateLocalData(result.data);
                            }
                        } catch (e) { console.error(e); }
                    }
                    this.galleryUploading = false;
                    event.target.value = '';
                },

                async addGallery() { /* diganti dengan addGalleryFiles */ },
                async deleteGallery(id) {
                    if (!confirm('Hapus foto galeri ini?')) return;
                    try {
                        const res = await fetch('api.php', { method: 'POST', headers: { 'Content-Type': 'application/json' }, body: JSON.stringify({ action: 'delete_gallery', id }) });
                        const result = await res.json();
                        if (result.success) this.updateLocalData(result.data);
                    } catch (e) {}
                },
                formatDate(dateString) {

                    const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
                    return new Date(dateString).toLocaleDateString('id-ID', options);
                }
            }
        }
    </script>
</body>
</html>
