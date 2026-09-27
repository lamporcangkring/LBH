import React from 'react';

const services = [
  { icon: '💬', title: 'Konsultasi Hukum Segala Perkara', desc: 'Layanan konsultasi hukum komprehensif untuk semua jenis permasalahan hukum yang Anda hadapi.' },
  { icon: '⚖️', title: 'Pendampingan & Pembelaan', desc: 'Pendampingan dan pembelaan di semua tingkat pengadilan, mulai dari PN hingga MA.' },
  { icon: '📄', title: 'Penyusunan Dokumen Hukum', desc: 'Surat Kuasa, Perjanjian, Somasi, Akta, dan dokumen hukum lainnya yang Anda butuhkan.' },
  { icon: '📢', title: 'Pengaduan & Laporan', desc: 'Pengaduan dan laporan ke Kepolisian, Kejaksaan, dan instansi terkait lainnya.' },
  { icon: '🤝', title: 'Penyelesaian Sengketa', desc: 'Mediasi, Negosiasi, dan Arbitrase sebagai alternatif penyelesaian sengketa di luar pengadilan.' },
  { icon: '🌳', title: 'Hukum Agraria & SDA', desc: 'Bantuan hukum bidang agraria, pertanahan, dan sumber daya alam.' },
  { icon: '👨‍🏫', title: 'Pendidikan & Penyuluhan Hukum', desc: 'Sosialisasi dan penyuluhan hukum ke masyarakat agar sadar, paham, dan mampu menggunakan hak hukumnya.' },
  { icon: '💛', title: 'Pendampingan Khusus', desc: 'Masyarakat tidak mampu, mantan narapidana, dan kelompok rentan lainnya.' },
  { icon: '💔', title: 'Gugatan Perceraian & Konseling', desc: 'Penanganan kasus perceraian, hak asuh anak, dan konseling keluarga secara profesional.' },
];

const Services = () => {
  return (
    <section id="layanan" className="py-20 bg-gray-50 px-6">
      <div className="max-w-7xl mx-auto">
        <div className="text-center mb-14">
          <h3 className="text-yellow-600 text-xs font-bold tracking-[0.3em] uppercase mb-2">Pelayanan Hukum</h3>
          <h2 className="text-4xl font-bold text-slate-800 font-serif">Layanan Kami</h2>
          <div className="w-20 h-1 bg-yellow-600 mx-auto mt-5"></div>
        </div>
        <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
          {services.map((s, i) => (
            <div key={i} className="bg-white p-7 rounded-lg border border-gray-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 group">
              <div className="w-14 h-14 bg-yellow-50 text-yellow-600 flex items-center justify-center rounded-full text-2xl mb-5 group-hover:bg-yellow-600 group-hover:text-white transition">
                {s.icon}
              </div>
              <h4 className="text-lg font-bold text-slate-800 mb-2">{s.title}</h4>
              <p className="text-gray-500 text-sm leading-relaxed">{s.desc}</p>
            </div>
          ))}
        </div>
      </div>
    </section>
  );
};

export default Services;
