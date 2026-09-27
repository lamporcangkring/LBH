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

const BottomNavItem = ({ href, label, icon, active }) => (
  <a
    href={href}
    className={`flex-1 flex flex-col items-center justify-center gap-0.5 py-2 px-1 transition-all duration-150 ${
      active ? 'text-yellow-400' : 'text-gray-400 hover:text-yellow-300'
    }`}
  >
    {icon}
    <span className="text-[10px] font-semibold tracking-wide leading-tight">{label}</span>
  </a>
);

const BottomNav = () => {
  return (
    <nav className="md:hidden fixed bottom-0 left-0 right-0 z-50 bg-slate-900/98 backdrop-blur-md border-t border-yellow-700/30 shadow-[0_-4px_20px_rgba(0,0,0,0.4)]">
      <div className="flex items-stretch justify-between px-1 pb-[calc(env(safe-area-inset-bottom,0px)+2px)] pt-1">
        <BottomNavItem
          href="#home"
          label="Beranda"
          icon={
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round">
              <path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
              <polyline points="9 22 9 12 15 12 15 22"></polyline>
            </svg>
          }
        />
        <BottomNavItem
          href="#layanan"
          label="Layanan"
          icon={
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round">
              <rect x="3" y="3" width="7" height="7"></rect>
              <rect x="14" y="3" width="7" height="7"></rect>
              <rect x="14" y="14" width="7" height="7"></rect>
              <rect x="3" y="14" width="7" height="7"></rect>
            </svg>
          }
        />
        <BottomNavItem
          href="#tim"
          label="Tim"
          icon={
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round">
              <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
              <circle cx="9" cy="7" r="4"></circle>
              <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
              <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
            </svg>
          }
        />
        <BottomNavItem
          href="#legalitas"
          label="Legal"
          icon={
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round">
              <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
            </svg>
          }
        />
        <BottomNavItem
          href="#artikel"
          label="Artikel"
          icon={
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round">
              <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path>
              <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path>
            </svg>
          }
        />
        <BottomNavItem
          href="#galeri"
          label="Galeri"
          icon={
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round">
              <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
              <circle cx="8.5" cy="8.5" r="1.5"></circle>
              <polyline points="21 15 16 10 5 21"></polyline>
            </svg>
          }
        />
      </div>
    </nav>
  );
};

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
    <div className="min-h-screen bg-white flex flex-col font-sans pt-16 md:pt-20 pb-24 md:pb-0">
      <Header onLoginClick={() => setShowLogin(true)} />
      <Hero />

      <section className="bg-slate-900 py-6 md:py-10 border-y border-yellow-700/30">
        <div className="max-w-7xl mx-auto px-3 md:px-6 grid grid-cols-2 md:grid-cols-4 gap-3 md:gap-6 text-center">
          <div className="p-2 md:p-4">
            <div className="text-2xl md:text-3xl font-bold text-yellow-500 mb-0.5 md:mb-1">📍 2</div>
            <div className="text-gray-400 text-[10px] md:text-xs uppercase tracking-wider font-medium">Kantor Wilayah</div>
            <div className="text-gray-500 text-[10px] md:text-[11px] mt-0.5 md:mt-1">Purbalingga & Lampung</div>
          </div>
          <div className="p-2 md:p-4">
            <div className="text-2xl md:text-3xl font-bold text-yellow-500 mb-0.5 md:mb-1">👥 10+</div>
            <div className="text-gray-400 text-[10px] md:text-xs uppercase tracking-wider font-medium">Tenaga Hukum</div>
            <div className="text-gray-500 text-[10px] md:text-[11px] mt-0.5 md:mt-1">Profesional & Berdedikasi</div>
          </div>
          <div className="p-2 md:p-4">
            <div className="text-2xl md:text-3xl font-bold text-yellow-500 mb-0.5 md:mb-1">⚖️ 9</div>
            <div className="text-gray-400 text-[10px] md:text-xs uppercase tracking-wider font-medium">Layanan Hukum</div>
            <div className="text-gray-500 text-[10px] md:text-[11px] mt-0.5 md:mt-1">Pidana, Perdata & Lainnya</div>
          </div>
          <div className="p-2 md:p-4">
            <div className="text-2xl md:text-3xl font-bold text-yellow-500 mb-0.5 md:mb-1">📞 24/7</div>
            <div className="text-gray-400 text-[10px] md:text-xs uppercase tracking-wider font-medium">Konsultasi</div>
            <div className="text-gray-500 text-[10px] md:text-[11px] mt-0.5 md:mt-1">Siap Melayani Anda</div>
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

      <BottomNav />
      <LoginModal show={showLogin} onClose={() => setShowLogin(false)} onLoginSuccess={handleLoginSuccess} />
    </div>
  );
}

export default App;
