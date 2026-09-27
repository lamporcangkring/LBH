import React from 'react';

const Header = ({ onLoginClick }) => {
  return (
    <header className="bg-slate-900/95 backdrop-blur-md fixed w-full top-0 z-50 border-b border-yellow-700/30 shadow-lg transition-all duration-300">
      <div className="max-w-7xl mx-auto px-6 h-20 flex justify-between items-center">
        <div className="flex items-center gap-3">
          <img src="/logo lbh.jpeg" alt="Logo LBH PK" className="h-12 w-12 rounded-full object-cover border-2 border-yellow-600" />
          <div>
            <h1 className="text-lg font-bold text-yellow-500 tracking-tight leading-tight">PUNGGAWA KEADILAN</h1>
            <p className="text-[10px] text-yellow-600/80 tracking-widest italic">Pro Justitia</p>
          </div>
        </div>
        <nav className="hidden md:flex gap-6 font-medium text-gray-300 text-sm">
          <a href="#home" className="hover:text-yellow-400 transition">Beranda</a>
          <a href="#layanan" className="hover:text-yellow-400 transition">Layanan</a>
          <a href="#tim" className="hover:text-yellow-400 transition">Tim Kami</a>
          <a href="#legalitas" className="hover:text-yellow-400 transition">Legalitas</a>
          <a href="#artikel" className="hover:text-yellow-400 transition">Artikel</a>
          <a href="#galeri" className="hover:text-yellow-400 transition">Galeri</a>
        </nav>
        <button onClick={onLoginClick} className="bg-yellow-600 text-slate-900 px-5 py-2 rounded font-bold text-sm hover:bg-yellow-500 transition shadow-lg">
          Masuk Portal
        </button>
      </div>
    </header>
  );
};

export default Header;
