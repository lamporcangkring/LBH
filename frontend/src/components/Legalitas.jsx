import React from 'react';

const legalitasCards = [
  { icon: '🪙', title: 'Akta Notaris', line1: 'Notaris Deni Nurhayati, S.H., M.Kn.', line2: 'No. 03 Tanggal 22 Desember 2022' },
  { icon: '📜', title: 'SK Menkumham', line1: 'No. AHU-0000128-AH.01.22', line2: 'Tahun 2023' },
  { icon: '🏛️', title: 'Legal Standing', line1: 'UU No. 16 Tahun 2011 (Bantuan Hukum)', line2: 'UU No. 18 Tahun 2003 (Advokat)' },
];

const legalImages = [
  '/legalitas/WhatsApp Image 2026-09-21 at 19.11.59 (2).jpeg',
  '/legalitas/WhatsApp Image 2026-09-21 at 19.11.59 (1).jpeg',
  '/legalitas/WhatsApp Image 2026-09-21 at 19.11.59.jpeg',
  '/legalitas/WhatsApp Image 2026-09-21 at 19.12.02.jpeg',
];

const Legalitas = () => {
  return (
    <section id="legalitas" className="py-20 bg-white px-6">
      <div className="max-w-7xl mx-auto">
        <div className="text-center mb-14">
          <h3 className="text-yellow-600 text-xs font-bold tracking-[0.3em] uppercase mb-2">Terdaftar & Resmi</h3>
          <h2 className="text-4xl font-bold text-slate-800 font-serif">Legalitas Kami</h2>
          <div className="w-20 h-1 bg-yellow-600 mx-auto mt-5"></div>
        </div>
        <div className="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">
          {legalitasCards.map((c, i) => (
            <div key={i} className="bg-gradient-to-br from-slate-900 to-slate-800 p-8 rounded-xl text-center shadow-xl border border-yellow-700/30">
              <div className="w-16 h-16 bg-yellow-600/20 text-yellow-500 flex items-center justify-center rounded-full text-3xl mb-5 mx-auto">{c.icon}</div>
              <h4 className="text-lg font-bold text-yellow-400 mb-3">{c.title}</h4>
              <p className="text-gray-300 text-sm leading-relaxed">{c.line1}</p>
              <p className="text-gray-400 text-sm">{c.line2}</p>
            </div>
          ))}
        </div>
        <div className="grid grid-cols-2 md:grid-cols-4 gap-4">
          {legalImages.map((src, i) => (
            <div key={i} className="rounded-lg overflow-hidden shadow-md hover:shadow-xl transition cursor-pointer">
              <img src={src} className={`w-full ${i < 2 ? 'h-48 object-cover object-top' : 'h-48 object-cover'} hover:scale-105 transition duration-500`} alt={`Legalitas ${i + 1}`} />
            </div>
          ))}
        </div>
      </div>
    </section>
  );
};

export default Legalitas;
