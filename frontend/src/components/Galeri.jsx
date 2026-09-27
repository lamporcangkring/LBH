import React, { useEffect, useState } from 'react';

const Galeri = () => {
  const [gallery, setGallery] = useState([]);

  useEffect(() => {
    fetch('/data.json')
      .then(r => r.json())
      .then(d => setGallery(d.gallery || []))
      .catch(() => setGallery([]));
  }, []);

  return (
    <section id="galeri" className="py-20 bg-white px-6">
      <div className="max-w-7xl mx-auto">
        <div className="text-center mb-14">
          <h3 className="text-yellow-600 text-xs font-bold tracking-[0.3em] uppercase mb-2">Dokumentasi</h3>
          <h2 className="text-4xl font-bold text-slate-800 font-serif">Galeri Kegiatan</h2>
          <div className="w-20 h-1 bg-yellow-600 mx-auto mt-5"></div>
        </div>
        <div className="grid grid-cols-2 md:grid-cols-4 gap-4 auto-rows-[256px]">
          {gallery.map(g => (
            <div key={g.id} className={`rounded-lg overflow-hidden shadow-md hover:shadow-xl transition cursor-pointer ${g.css_class || ''}`}>
              <img
                src={'/' + (g.image || '').replace(/^\/+/, '')}
                className="w-full h-full object-cover hover:scale-105 transition duration-500"
                alt="Galeri"
              />
            </div>
          ))}
        </div>
      </div>
    </section>
  );
};

export default Galeri;
