import React, { useState } from 'react';
import Header from './components/Header';
import Hero from './components/Hero';
import Services from './components/Services';
import Team from './components/Team';
import Legalitas from './components/Legalitas';
import Artikel from './components/Artikel';
import Galeri from './components/Galeri';
import { VisiMisi, KontakCTA, Footer } from './components/Sections';
import LoginModal from './components/LoginModal';
import Dashboard from './components/Dashboard';

function App() {
  const [showLogin, setShowLogin] = useState(false);
  const [currentUser, setCurrentUser] = useState(() => {
    try {
      const raw = localStorage.getItem('lbh_user');
      return raw ? JSON.parse(raw) : null;
    } catch {
      return null;
    }
  });

  const handleLoginSuccess = (user) => {
    setCurrentUser(user);
  };

  const handleLogout = () => {
    localStorage.removeItem('lbh_user');
    setCurrentUser(null);
  };

  if (currentUser) {
    return <Dashboard user={currentUser} onLogout={handleLogout} />;
  }

  return (
    <div className="min-h-screen bg-white flex flex-col font-sans">
      <Header onLoginClick={() => setShowLogin(true)} />
      <Hero />

      <section className="bg-slate-900 py-10 border-y border-yellow-700/30">
        <div className="max-w-7xl mx-auto px-6 grid grid-cols-2 md:grid-cols-4 gap-6 text-center">
          <div className="p-4">
            <div className="text-3xl font-bold text-yellow-500 mb-1">📍 2</div>
            <div className="text-gray-400 text-xs uppercase tracking-wider font-medium">Kantor Wilayah</div>
            <div className="text-gray-500 text-[11px] mt-1">Purbalingga & Lampung</div>
          </div>
          <div className="p-4">
            <div className="text-3xl font-bold text-yellow-500 mb-1">👥 10+</div>
            <div className="text-gray-400 text-xs uppercase tracking-wider font-medium">Tenaga Hukum</div>
            <div className="text-gray-500 text-[11px] mt-1">Profesional & Berdedikasi</div>
          </div>
          <div className="p-4">
            <div className="text-3xl font-bold text-yellow-500 mb-1">⚖️ 9</div>
            <div className="text-gray-400 text-xs uppercase tracking-wider font-medium">Layanan Hukum</div>
            <div className="text-gray-500 text-[11px] mt-1">Pidana, Perdata & Lainnya</div>
          </div>
          <div className="p-4">
            <div className="text-3xl font-bold text-yellow-500 mb-1">📞 24/7</div>
            <div className="text-gray-400 text-xs uppercase tracking-wider font-medium">Konsultasi</div>
            <div className="text-gray-500 text-[11px] mt-1">Siap Melayani Anda</div>
          </div>
        </div>
      </section>

      <Services />
      <Team />
      <Legalitas />
      <Artikel />
      <Galeri />
      <VisiMisi />
      <KontakCTA />
      <Footer />

      <LoginModal show={showLogin} onClose={() => setShowLogin(false)} onLoginSuccess={handleLoginSuccess} />
    </div>
  );
}

export default App;
