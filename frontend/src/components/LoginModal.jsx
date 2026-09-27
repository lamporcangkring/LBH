import React, { useState } from 'react';

const LoginModal = ({ show, onClose, onLoginSuccess }) => {
  const [username, setUsername] = useState('');
  const [password, setPassword] = useState('');
  const [error, setError] = useState('');
  const [loading, setLoading] = useState(false);

  if (!show) return null;

  const handleSubmit = async (e) => {
    e.preventDefault();
    setError('');
    setLoading(true);

    try {
      const res = await fetch('/data.json');
      const data = await res.json();
      const user = (data.users || []).find(u => u.username === username && u.password === password);

      if (user) {
        localStorage.setItem('lbh_user', JSON.stringify(user));
        if (onLoginSuccess) onLoginSuccess(user);
        onClose();
      } else {
        setError('Username atau password salah.');
      }
    } catch {
      setError('Gagal terhubung ke server.');
    } finally {
      setLoading(false);
    }
  };

  return (
    <div className="fixed inset-0 z-[100] bg-black bg-opacity-50 backdrop-blur-sm flex items-center justify-center p-4">
      <div className="bg-white w-full max-w-md p-8 rounded-2xl shadow-xl relative">
        <button onClick={onClose} className="absolute top-4 right-4 text-gray-400 hover:text-gray-600 text-xl">✕</button>
        <div className="text-center mb-8 mt-2">
          <div className="mb-4">
            <img src="/logo lbh.jpeg" alt="Logo LBH PK" className="h-24 mx-auto rounded-full object-cover border-4 border-yellow-600 shadow-lg" />
          </div>
          <h1 className="text-2xl font-bold text-yellow-700">PUNGGAWA KEADILAN</h1>
          <p className="text-[10px] text-yellow-600/80 tracking-widest italic mt-1">Pro Justitia</p>
          <p className="text-slate-500 text-sm mt-3">Sistem Manajemen Kantor Hukum</p>
        </div>

        <form onSubmit={handleSubmit}>
          <div className="mb-4">
            <label className="block text-sm font-medium text-gray-700 mb-1">Username</label>
            <input
              type="text"
              value={username}
              onChange={e => setUsername(e.target.value)}
              className="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-yellow-500 focus:outline-none"
              placeholder="Username"
              required
            />
          </div>

          <div className="mb-6">
            <label className="block text-sm font-medium text-gray-700 mb-1">Password</label>
            <input
              type="password"
              value={password}
              onChange={e => setPassword(e.target.value)}
              className="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-yellow-500 focus:outline-none"
              placeholder="Password"
              required
            />
          </div>

          {error && (
            <div className="mb-4 p-3 bg-red-50 text-red-600 text-sm rounded-lg flex items-center gap-2">
              ⚠️ <span>{error}</span>
            </div>
          )}

          <button type="submit" disabled={loading} className="w-full bg-slate-900 text-yellow-400 py-3 rounded-xl font-bold text-lg shadow-lg hover:bg-slate-800 transition disabled:opacity-60">
            {loading ? '⏳ Memproses...' : 'Masuk'}
          </button>
        </form>

        <div className="mt-6 text-center text-xs text-gray-400">
          <p>Demo Credentials:</p>
          <p>Admin: admin / admin123</p>
          <p>Lawyer: lawyer1 / password123</p>
          <p>Client: client1 / client123</p>
        </div>
      </div>
    </div>
  );
};

export default LoginModal;
