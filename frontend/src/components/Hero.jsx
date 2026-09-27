import React from 'react';

const Hero = () => {
  return (
    <section id="home" className="relative pt-20 flex items-center justify-center min-h-screen">
      <div className="absolute inset-0 z-0">
        <img src="/galeri/WhatsApp Image 2026-09-21 at 19.12.05 (2).jpeg" className="w-full h-full object-cover" alt="Hero Background" />
        <div className="absolute inset-0 bg-gradient-to-b from-slate-900/90 via-slate-900/70 to-slate-900/95"></div>
      </div>
      <div className="relative z-10 text-center px-6 max-w-4xl mx-auto text-white">
        <img src="/logo lbh.jpeg" alt="Logo" className="h-28 w-28 mx-auto rounded-full border-4 border-yellow-600 shadow-2xl mb-8 object-cover" />
        <div className="inline-block px-4 py-1.5 rounded-full bg-yellow-600/20 border border-yellow-600/50 text-yellow-300 text-xs font-bold tracking-[0.3em] uppercase mb-6">
          Lembaga Bantuan Hukum
        </div>
        <h2 className="text-5xl md:text-7xl font-bold mb-4 font-serif leading-tight">PUNGGAWA KEADILAN</h2>
        <p className="text-2xl text-yellow-400 italic mb-8 font-serif">Pro Justitia</p>
        <p className="text-lg text-gray-300 mb-10 max-w-2xl mx-auto leading-relaxed">
          &ldquo;Pembela Rakyat, Penegak Keadilan&rdquo; &mdash; Memberikan layanan bantuan hukum yang independen, profesional, dan terpercaya bagi seluruh lapisan masyarakat.
        </p>
        <div className="flex flex-col sm:flex-row justify-center gap-4">
          <a href="https://wa.me/628820003620210" target="_blank" rel="noreferrer" className="flex items-center justify-center gap-2 bg-green-600 text-white px-8 py-4 rounded font-bold hover:bg-green-500 transition shadow-xl text-lg">
            Konsultasi Gratis
          </a>
          <a href="#layanan" className="bg-yellow-600/20 backdrop-blur-md text-yellow-300 border border-yellow-600/50 px-8 py-4 rounded font-bold hover:bg-yellow-600/40 transition text-lg">
            Layanan Kami
          </a>
        </div>
      </div>
    </section>
  );
};

export default Hero;
