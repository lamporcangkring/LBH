import React, { useEffect, useState } from 'react';

const Team = () => {
  const [teams, setTeams] = useState([]);

  useEffect(() => {
    fetch('/data.json')
      .then(r => r.json())
      .then(d => setTeams(d.teams || []))
      .catch(() => setTeams([]));
  }, []);

  return (
    <section id="tim" className="py-20 bg-slate-900 px-0">
      <div className="max-w-7xl mx-auto px-6">
        <div className="text-center mb-14">
          <h3 className="text-yellow-500 text-xs font-bold tracking-[0.3em] uppercase mb-2">Struktur Organisasi</h3>
          <h2 className="text-4xl font-bold text-white font-serif">Tim Kami</h2>
          <div className="w-20 h-1 bg-yellow-600 mx-auto mt-5"></div>
        </div>
      </div>

      {teams.length > 0 ? (
        <div className="marquee-container">
          <div className="marquee-content">
            {[...teams, ...teams].map((t, idx) => (
              <div key={idx} className="team-card text-center group shrink-0">
                <div className="w-32 h-32 mx-auto rounded-full overflow-hidden border-4 border-yellow-600/50 shadow-lg mb-4 group-hover:border-yellow-400 transition">
                  <img
                    src={t.image || `https://ui-avatars.com/api/?name=${encodeURIComponent(t.name)}&background=1e293b&color=eab308&size=128`}
                    className="w-full h-full object-cover object-top"
                    alt={t.name}
                  />
                </div>
                <h4 className="text-white font-bold text-sm">{t.name}</h4>
                <p className="text-yellow-500 text-xs mt-1">{t.position}</p>
                {t.region && <p className="text-gray-500 text-[10px]">{t.region}</p>}
              </div>
            ))}
          </div>
        </div>
      ) : (
        <div className="text-center py-12 text-gray-500">
          <div className="text-4xl mb-3 opacity-30">👥</div>
          <p className="text-sm">Data tim sedang dimuat...</p>
        </div>
      )}
    </section>
  );
};

export default Team;
