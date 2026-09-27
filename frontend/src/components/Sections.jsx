import React from 'react';

const VisiMisi = () => {
  const misi = [
    { no: 1, bold: 'Bantuan Hukum Merata:', text: 'Memberikan layanan bantuan hukum secara cuma-cuma bagi masyarakat kurang mampu, petani, nelayan, dan kelompok rentan.' },
    { no: 2, bold: 'Pengawasan Sosial:', text: 'Melaksanakan fungsi kontrol sosial terhadap penyelenggaraan negara dan pelayanan publik.' },
    { no: 3, bold: 'Pendidikan Hukum Masyarakat:', text: 'Melakukan sosialisasi dan penyuluhan agar masyarakat sadar dan mampu menggunakan hak hukumnya.' },
    { no: 4, bold: 'Penegakan Hukum Berkeadilan:', text: 'Melakukan penelitian, pengkajian, dan advokasi kebijakan guna meluruskan ketimpangan hukum.' },
  ];

  return (
    <section className="py-20 bg-slate-900 px-6 relative overflow-hidden">
      <div className="absolute inset-0 opacity-5">
        <img src="/galeri/WhatsApp Image 2026-09-21 at 19.12.05 (2).jpeg" className="w-full h-full object-cover" alt="" />
      </div>
      <div className="max-w-5xl mx-auto relative z-10">
        <div className="text-center mb-14">
          <h3 className="text-yellow-500 text-xs font-bold tracking-[0.3em] uppercase mb-2">Tujuan Kami</h3>
          <h2 className="text-4xl font-bold text-white font-serif">Visi & Misi</h2>
          <div className="w-20 h-1 bg-yellow-600 mx-auto mt-5"></div>
        </div>
        <div className="bg-white/5 backdrop-blur-sm border border-yellow-700/20 rounded-xl p-8 mb-8">
          <h3 className="text-yellow-400 font-bold text-lg mb-4 flex items-center gap-2">👁️ Visi</h3>
          <p className="text-gray-300 leading-relaxed">Menjadi Lembaga Bantuan Hukum yang independen, profesional, dan terpercaya sebagai benteng perlindungan hukum bagi seluruh lapisan masyarakat, guna mewujudkan keadilan sejati, supremasi hukum, dan kesejahteraan bersama di seluruh wilayah Negara Kesatuan Republik Indonesia.</p>
        </div>
        <div className="bg-white/5 backdrop-blur-sm border border-yellow-700/20 rounded-xl p-8">
          <h3 className="text-yellow-400 font-bold text-lg mb-4 flex items-center gap-2">🎯 Misi</h3>
          <div className="space-y-4 text-gray-300 text-sm leading-relaxed">
            {misi.map(m => (
              <div key={m.no} className="flex gap-3">
                <span className="bg-yellow-600 text-slate-900 w-6 h-6 flex items-center justify-center rounded-full text-xs font-bold shrink-0 mt-0.5">{m.no}</span>
                <p><strong className="text-yellow-400">{m.bold}</strong>{m.text}</p>
              </div>
            ))}
          </div>
        </div>
      </div>
    </section>
  );
};

const KontakCTA = () => {
  return (
    <section id="kontak" className="py-20 px-6 bg-yellow-600 relative">
      <div className="max-w-4xl mx-auto text-center text-slate-900">
        <h2 className="text-4xl font-bold mb-4 font-serif">Butuh Bantuan Hukum?</h2>
        <p className="text-xl text-slate-800/80 mb-10 leading-relaxed">Jangan hadapi masalah hukum sendirian. Hubungi kami sekarang untuk konsultasi gratis.</p>
        <div className="flex flex-col md:flex-row justify-center items-center gap-4">
          <a href="tel:+6208820003620210" className="flex items-center gap-3 bg-slate-900 text-yellow-400 px-8 py-4 rounded font-bold hover:bg-slate-800 transition shadow-xl text-lg w-full md:w-auto justify-center">
            📞 0882 003 620 210
          </a>
          <a href="https://wa.me/6208137876191" target="_blank" rel="noreferrer" className="flex items-center gap-3 bg-green-600 text-white px-8 py-4 rounded font-bold hover:bg-green-500 transition shadow-xl text-lg w-full md:w-auto justify-center">
            💬 0813 7876 1915
          </a>
          <a href="mailto:lbhpungawakeadilan.eka@gmail.com" className="flex items-center gap-3 bg-white text-slate-900 px-8 py-4 rounded font-bold hover:bg-gray-100 transition shadow-xl text-lg w-full md:w-auto justify-center">
            ✉️ Email Kami
          </a>
        </div>
      </div>
    </section>
  );
};

const Footer = () => {
  return (
    <footer className="bg-slate-900 pt-14 pb-6 px-6 text-gray-400">
      <div className="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-10 mb-10">
        <div>
          <div className="flex items-center gap-3 mb-5">
            <img src="/logo lbh.jpeg" alt="Logo" className="h-10 w-10 rounded-full object-cover border border-yellow-700" />
            <div>
              <h2 className="text-lg font-bold text-yellow-500">Punggawa Keadilan</h2>
              <p className="text-[10px] text-yellow-600/70 italic">Pro Justitia</p>
            </div>
          </div>
          <p className="text-sm leading-relaxed mb-4">Pembela Rakyat, Penegak Keadilan. Mendedikasikan ilmu dan pengalaman untuk memberikan bantuan hukum berkualitas bagi seluruh lapisan masyarakat.</p>
          <div className="flex gap-3">
            <a href="#" className="w-9 h-9 rounded-full bg-slate-800 flex items-center justify-center hover:bg-yellow-600 hover:text-slate-900 transition text-sm">f</a>
            <a href="#" className="w-9 h-9 rounded-full bg-slate-800 flex items-center justify-center hover:bg-yellow-600 hover:text-slate-900 transition text-sm">ig</a>
            <a href="#" className="w-9 h-9 rounded-full bg-slate-800 flex items-center justify-center hover:bg-yellow-600 hover:text-slate-900 transition text-sm">tt</a>
          </div>
        </div>
        <div>
          <h4 className="text-yellow-500 font-bold mb-5 text-sm">Sekretariat Pusat</h4>
          <ul className="space-y-3 text-sm">
            <li className="flex items-start gap-2">
              <span className="mt-1 text-yellow-600 text-xs">📍</span>
              <span>Jl. Amarta Raya Blok D4 No. 2<br/>Bojanegara, Padamara<br/>Purbalingga - Jawa Tengah 53372</span>
            </li>
            <li className="flex items-center gap-2"><span className="text-yellow-600 text-xs">📞</span><span>085732101212</span></li>
            <li className="flex items-center gap-2"><span className="text-yellow-600 text-xs">✉️</span><span>lbhpungawakeadilan.eka@gmail.com</span></li>
          </ul>
        </div>
        <div>
          <h4 className="text-yellow-500 font-bold mb-5 text-sm">Kantor Cabang Lampung</h4>
          <ul className="space-y-3 text-sm">
            <li className="flex items-start gap-2">
              <span className="mt-1 text-yellow-600 text-xs">📍</span>
              <span>Jl. Wan Abdul Rahman Perum Villa Jasmin Blok B No.2 LK.II, RT 005/RW 000<br/>Kel. Sumber Agung, Kec. Kemiling<br/>Kota Bandar Lampung</span>
            </li>
          </ul>
          <h4 className="text-yellow-500 font-bold mb-3 mt-6 text-sm">Korwil II OKU Raya</h4>
          <ul className="text-sm">
            <li className="flex items-start gap-2">
              <span className="mt-1 text-yellow-600 text-xs">📍</span>
              <span>Jln. Raya Rasuan Ruko Cempaka Indah<br/>Desa Lubuk Harjo, Kab. OKU Timur</span>
            </li>
          </ul>
        </div>
      </div>
      <div className="border-t border-slate-800 pt-6 text-center text-xs">
        <p>&copy; 2026 LBH Punggawa Keadilan - Pro Justitia. Hak Cipta Dilindungi Undang-Undang.</p>
        <p className="text-gray-600 mt-1">Direktur: Ganjar Gesang Nugroho, S.H.</p>
      </div>
    </footer>
  );
};

export { VisiMisi, KontakCTA, Footer };
