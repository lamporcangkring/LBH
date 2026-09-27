import React, { useEffect, useState } from 'react';

const Artikel = () => {
  const [articles, setArticles] = useState([]);

  useEffect(() => {
    fetch('/data.json')
      .then(r => r.json())
      .then(d => setArticles(d.articles || []))
      .catch(() => setArticles([]));
  }, []);

  return (
    <section id="artikel" className="py-20 px-6 bg-gray-50">
      <div className="max-w-7xl mx-auto">
        <div className="text-center mb-14">
          <h3 className="text-yellow-600 text-xs font-bold tracking-[0.3em] uppercase mb-2">Berita & Wawasan</h3>
          <h2 className="text-4xl font-bold text-slate-800 font-serif">Artikel Hukum</h2>
          <div className="w-20 h-1 bg-yellow-600 mx-auto mt-5"></div>
        </div>
        <div className="grid grid-cols-1 md:grid-cols-3 gap-8">
          {articles.length > 0 ? (
            articles.map(art => (
              <div key={art.id} className="bg-white rounded-lg overflow-hidden shadow-sm hover:shadow-xl transition border border-gray-100 flex flex-col text-left group">
                <div className="h-52 bg-gray-200 overflow-hidden">
                  <img src={art.image || '/law2.jpg'} className="w-full h-full object-cover group-hover:scale-105 transition duration-500" alt={art.title} />
                </div>
                <div className="p-6 flex-1 flex flex-col">
                  <div className="text-xs text-yellow-600 font-bold mb-2 uppercase tracking-wider">{art.category}</div>
                  <h4 className="text-lg font-bold mb-2 text-slate-800 leading-snug group-hover:text-yellow-700 transition">{art.title}</h4>
                  <p className="text-gray-500 text-sm flex-1 leading-relaxed">
                    {art.content.length > 120 ? art.content.substring(0, 120) + '...' : art.content}
                  </p>
                  <div className="mt-4 pt-4 border-t border-gray-100 flex justify-between items-center">
                    <span className="text-gray-400 text-xs">{art.created_at}</span>
                    <a href="#" className="text-yellow-600 font-medium text-sm hover:underline">Baca &rarr;</a>
                  </div>
                </div>
              </div>
            ))
          ) : (
            <div className="col-span-3 text-center py-16 text-gray-400">
              <div className="text-4xl mb-4">📰</div>
              Artikel akan segera hadir.
            </div>
          )}
        </div>
      </div>
    </section>
  );
};

export default Artikel;
