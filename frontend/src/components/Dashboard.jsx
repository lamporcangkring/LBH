import React, { useEffect, useMemo, useState } from 'react';

const pageTitles = {
  home: 'Beranda',
  tasks: 'Tugas & Sidang',
  cases: 'Manajemen Kasus',
  documents: 'Dokumentasi',
  profile: 'Profil Pengguna',
  web: 'Manajemen Web',
  master: 'Master Data',
  content: 'Konten Web',
};

const seedTasks = [
  { id: 1, title: 'Persiapan sidang kasus perdata No. 123', type: 'Sidang', priority: 'Tinggi', date: '2026-09-28', status: 'pending', case_id: null },
  { id: 2, title: 'Draft surat somasi ke PT Maju Mundur', type: 'Dokumen', priority: 'Sedang', date: '2026-09-29', status: 'pending', case_id: null },
  { id: 3, title: 'Meeting dengan klien Bapak Hartono', type: 'Konsultasi', priority: 'Rendah', date: '2026-09-30', status: 'completed', case_id: null },
  { id: 4, title: 'Pendampingan pelaporan ke Polres Purbalingga', type: 'Laporan', priority: 'Tinggi', date: '2026-10-01', status: 'pending', case_id: null },
  { id: 5, title: 'Mediasi sengketa waris Keluarga Sudrajat', type: 'Mediasi', priority: 'Sedang', date: '2026-10-03', status: 'pending', case_id: null },
];

const seedCases = [
  { id: 1, title: 'Gugatan Perdata PT Sejahtera vs CV Makmur', client_name: 'Ibu Siti Rahmawati', description: 'Sengketa perjanjian kerjasama distribusi barang di wilayah Jawa Tengah.', status: 'Open', court: 'PN Purbalingga', case_number: '123/Pdt.G/2026/PN.Pbg' },
  { id: 2, title: 'Perceraian & Hak Asuh Anak', client_name: 'Bapak Dimas Prayoga', description: 'Gugatan perceraian dengan sengketa hak asuh 2 orang anak di bawah umur.', status: 'On Hold', court: 'PA Purbalingga', case_number: '045/Pdt.P/2026/PA.Pbg' },
  { id: 3, title: 'Pengaduan Dugaan Korupsi Desa Sukamaju', client_name: 'LSM Cahaya Desa', description: 'Pengaduan dan pendampingan pelaporan dugaan penyalahgunaan dana desa.', status: 'Open', court: 'Kejaksaan Negeri', case_number: 'LAP-07/2026' },
];

const seedDocuments = [
  { id: 1, title: 'Surat Kuasa Khusus - Kasus 123', type: 'Surat Kuasa', case_id: 1, date: '2026-09-15' },
  { id: 2, title: 'Somasi PT Maju Mundur', type: 'Somasi', case_id: null, date: '2026-09-20' },
  { id: 3, title: 'Akta Perdamaian Sengketa Tanah', type: 'Akta', case_id: 2, date: '2026-09-22' },
];

function formatDate(s) {
  if (!s) return '-';
  const d = new Date(s);
  if (isNaN(d.getTime())) return s;
  return d.toLocaleDateString('id-ID', { day: '2-digit', month: 'short', year: 'numeric' });
}

function seed(data, key, fallback) {
  return (data && data[key] && data[key].length > 0) ? data[key] : fallback;
}

const Dashboard = ({ user, onLogout }) => {
  const [tab, setTab] = useState('home');
  const [filter, setFilter] = useState('all');
  const [sidebarOpen, setSidebarOpen] = useState(false);
  const [data, setData] = useState({ users: [], tasks: [], cases: [], documents: [], courts: [], teams: [], gallery: [], articles: [] });

  useEffect(() => {
    fetch('/data.json')
      .then(r => r.json())
      .then(d => {
        setData({
          users: seed(d, 'users', []),
          tasks: seed(d, 'tasks', seedTasks),
          cases: seed(d, 'cases', seedCases),
          documents: seed(d, 'documents', seedDocuments),
          courts: d.courts && d.courts.length ? d.courts : seedCases.map(c => c.court),
          teams: seed(d, 'teams', []),
          gallery: seed(d, 'gallery', []),
          articles: seed(d, 'articles', []),
        });
      })
      .catch(() => {
        setData({
          users: [], tasks: seedTasks, cases: seedCases, documents: seedDocuments,
          courts: seedCases.map(c => c.court), teams: [], gallery: [], articles: [],
        });
      });
  }, []);

  const tasks = data.tasks;
  const cases = data.cases;
  const documents = data.documents;
  const users = data.users;
  const articles = data.articles;
  const gallery = data.gallery;
  const teams = data.teams;
  const courts = data.courts;

  const priorityTasks = useMemo(
    () => tasks.filter(t => t.priority === 'Tinggi' && t.status !== 'completed').slice(0, 5),
    [tasks]
  );

  const filteredTasks = useMemo(() => {
    if (filter === 'all') return tasks;
    if (filter === 'completed') return tasks.filter(t => t.status === 'completed');
    return tasks.filter(t => t.status !== 'completed');
  }, [tasks, filter]);

  const toggleTask = (id) => setData(d => ({
    ...d,
    tasks: d.tasks.map(t => t.id === id ? { ...t, status: t.status === 'completed' ? 'pending' : 'completed' } : t),
  }));

  const getCaseName = (id) => {
    const c = cases.find(x => x.id == id);
    return c ? c.title : '-';
  };

  const updateCaseStatus = (id, status) => setData(d => ({
    ...d, cases: d.cases.map(c => c.id === id ? { ...c, status } : c),
  }));

  const deleteCase = (id) => setData(d => ({ ...d, cases: d.cases.filter(c => c.id !== id) }));
  const deleteTask = (id) => setData(d => ({ ...d, tasks: d.tasks.filter(t => t.id !== id) }));
  const deleteDocument = (id) => setData(d => ({ ...d, documents: d.documents.filter(x => x.id !== id) }));
  const deleteUser = (id) => setData(d => ({ ...d, users: d.users.filter(u => u.id !== id) }));
  const deleteTeam = (id) => setData(d => ({ ...d, teams: d.teams.filter(t => t.id !== id) }));
  const deleteGallery = (id) => setData(d => ({ ...d, gallery: d.gallery.filter(g => g.id !== id) }));
  const deleteArticle = (id) => setData(d => ({ ...d, articles: d.articles.filter(a => a.id !== id) }));

  const [showAddModal, setShowAddModal] = useState(false);
  const [showAddCaseModal, setShowAddCaseModal] = useState(false);
  const [showAddDocModal, setShowAddDocModal] = useState(false);
  const [showUserModal, setShowUserModal] = useState(false);
  const [showTeamModal, setShowTeamModal] = useState(false);
  const [showAddArticleModal, setShowAddArticleModal] = useState(false);

  const [taskForm, setTaskForm] = useState({ title: '', type: 'Sidang', priority: 'Sedang', date: '' });
  const [caseForm, setCaseForm] = useState({ title: '', client_name: '', description: '', status: 'Open' });
  const [docForm, setDocForm] = useState({ title: '', type: 'Surat Kuasa', case_id: '' });
  const [userForm, setUserForm] = useState({ id: null, role: 'lawyer', username: '', full_name: '', email: '', password: '' });
  const [teamForm, setTeamForm] = useState({ id: null, name: '', position: '', region: '', image: '' });
  const [newArticle, setNewArticle] = useState({ id: null, title: '', category: '', content: '', image: '', created_at: '' });
  const [newCourt, setNewCourt] = useState('');
  const [editingCourt, setEditingCourt] = useState(null);
  const [editCourtName, setEditCourtName] = useState('');

  const addTask = () => {
    if (!taskForm.title) return;
    const t = { id: Date.now(), ...taskForm, status: 'pending' };
    setData(d => ({ ...d, tasks: [...d.tasks, t] }));
    setTaskForm({ title: '', type: 'Sidang', priority: 'Sedang', date: '' });
    setShowAddModal(false);
  };

  const addCase = () => {
    if (!caseForm.title) return;
    const c = { id: Date.now(), ...caseForm };
    setData(d => ({ ...d, cases: [...d.cases, c] }));
    setCaseForm({ title: '', client_name: '', description: '', status: 'Open' });
    setShowAddCaseModal(false);
  };

  const addDocument = () => {
    if (!docForm.title) return;
    const d = { id: Date.now(), ...docForm, date: new Date().toISOString().slice(0, 10) };
    setData(s => ({ ...s, documents: [...s.documents, d] }));
    setDocForm({ title: '', type: 'Surat Kuasa', case_id: '' });
    setShowAddDocModal(false);
  };

  const openAddUser = (role) => {
    setUserForm({ id: null, role: role || 'lawyer', username: '', full_name: '', email: '', password: '' });
    setShowUserModal(true);
  };
  const openEditUser = (u) => {
    setUserForm({ id: u.id, role: u.role, username: u.username, full_name: u.full_name, email: u.email || '', password: '' });
    setShowUserModal(true);
  };
  const saveUser = () => {
    if (!userForm.username || !userForm.full_name) return;
    setData(d => {
      if (userForm.id) {
        return { ...d, users: d.users.map(u => u.id === userForm.id ? { ...u, ...userForm, password: userForm.password || u.password } : u) };
      }
      return { ...d, users: [...d.users, { id: Date.now(), ...userForm }] };
    });
    setShowUserModal(false);
  };

  const addCourt = (name) => {
    if (!name) return;
    setData(d => ({ ...d, courts: [...d.courts, name] }));
    setNewCourt('');
  };
  const startEditCourt = (c) => { setEditingCourt(c); setEditCourtName(c); };
  const renameCourt = (old, name) => {
    if (!name) return;
    setData(d => ({ ...d, courts: d.courts.map(x => x === old ? name : x) }));
    setEditingCourt(null);
  };
  const cancelEditCourt = () => setEditingCourt(null);
  const deleteCourt = (c) => setData(d => ({ ...d, courts: d.courts.filter(x => x !== c) }));

  const openAddTeam = () => { setTeamForm({ id: null, name: '', position: '', region: '', image: '' }); setShowTeamModal(true); };
  const openEditTeam = (t) => { setTeamForm({ ...t }); setShowTeamModal(true); };
  const saveTeam = () => {
    if (!teamForm.name || !teamForm.position) return;
    setData(d => {
      if (teamForm.id) {
        return { ...d, teams: d.teams.map(t => t.id === teamForm.id ? { ...t, ...teamForm } : t) };
      }
      return { ...d, teams: [...d.teams, { id: Date.now().toString(), ...teamForm }] };
    });
    setShowTeamModal(false);
  };

  const openAddArticle = () => { setNewArticle({ id: null, title: '', category: '', content: '', image: '', created_at: '' }); setShowAddArticleModal(true); };
  const openEditArticle = (a) => { setNewArticle({ ...a }); setShowAddArticleModal(true); };
  const saveArticle = () => {
    if (!newArticle.title || !newArticle.category || !newArticle.content) return;
    setData(d => {
      if (newArticle.id) {
        return { ...d, articles: d.articles.map(a => a.id === newArticle.id ? { ...a, ...newArticle } : a) };
      }
      return { ...d, articles: [...d.articles, { id: Date.now().toString(), created_at: new Date().toISOString().slice(0, 10), ...newArticle }] };
    });
    setShowAddArticleModal(false);
  };

  const stats = {
    tasks: tasks.length,
    tasksDone: tasks.filter(t => t.status === 'completed').length,
    casesOpen: cases.filter(c => c.status === 'Open').length,
    casesTotal: cases.length,
    docs: documents.length,
    clients: users.filter(u => u.role === 'client').length,
  };

  const isAdmin = user && user.role === 'admin';

  return (
    <div className="min-h-screen flex bg-gray-50">
      {/* Mobile Sidebar Overlay */}
      {sidebarOpen && (
        <div
          className="fixed inset-0 bg-black/50 z-40 md:hidden backdrop-blur-sm"
          onClick={() => setSidebarOpen(false)}
        ></div>
      )}

      {/* Sidebar (Desktop + Mobile) */}
      <aside
        className={`fixed z-50 h-screen bg-slate-950 text-white shadow-[10px_0_30px_rgba(15,23,42,0.25)] flex flex-col
          w-72 transition-transform duration-300
          md:translate-x-0 ${sidebarOpen ? 'translate-x-0' : '-translate-x-full'}`}
      >
        {/* Header Sidebar */}
        <div className="relative overflow-hidden border-b border-yellow-700/30 flex-shrink-0">
          <div className="absolute inset-0 bg-[radial-gradient(ellipse_at_top,rgba(234,179,8,0.08),transparent_60%)] pointer-events-none"></div>
          <div className="relative pt-4 pb-4 px-5">
            {/* Close button (mobile) */}
            <button
              onClick={() => setSidebarOpen(false)}
              className="absolute top-3 right-3 md:hidden w-7 h-7 flex items-center justify-center text-slate-400 hover:text-white rounded hover:bg-slate-800"
            >
              ✕
            </button>
            {/* Logo Circular naik ke atas - lebih kecil */}
            <div className="flex justify-center mb-3">
              <div className="relative">
                <img src="/logo lbh.jpeg" alt="Logo LBH PK" className="h-16 w-16 md:h-20 md:w-20 rounded-full object-cover border-[2.5px] border-yellow-500 shadow-[0_0_0_5px_rgba(234,179,8,0.08)]" />
              </div>
            </div>
            {/* Judul */}
            <h1 className="text-lg md:text-xl font-extrabold text-yellow-400 tracking-wide leading-tight text-center">
              PUNGGAWA KEADILAN
            </h1>
            <p className="text-xs md:text-sm text-yellow-600/90 italic mt-0.5 text-center font-serif">
              Pro Justitia
            </p>
            <p className="text-[11px] text-slate-400 mt-2 text-center font-medium tracking-wide">
              Sistem Manajemen Kantor
            </p>
            {/* Badge Role */}
            <div className="mt-3 flex justify-center">
              <div className={`text-[10px] uppercase tracking-[0.15em] font-bold py-1 px-4 rounded-lg border ${isAdmin ? 'bg-slate-700/80 text-slate-200 border-slate-600/60' : 'bg-slate-700/60 text-slate-300 border-slate-600/50'}`}>
                {(user?.role || 'USER').toUpperCase()}
              </div>
            </div>
          </div>
        </div>

        {/* Nav Menu - semua terlihat tanpa scroll */}
        <nav className="flex-1 overflow-y-visible py-0 px-0 space-y-0 no-scrollbar min-h-0">
          {[
            ['home', 'Beranda'],
            ['tasks', 'Tugas & Sidang'],
            ['cases', 'Manajemen Kasus'],
            ['documents', 'Dokumentasi'],
            ['profile', 'Profil'],
          ].map(([k, l]) => (
            <NavItem key={k} id={k} label={l} active={tab === k} onClick={() => { setTab(k); setSidebarOpen(false); }} />
          ))}

          {isAdmin && (
            <>
              <div className="my-2 mx-6 border-t border-slate-800/80"></div>
              {[
                ['web', 'Manajemen Web'],
                ['master', 'Master Data'],
                ['content', 'Konten Web'],
              ].map(([k, l]) => (
                <NavItem key={k} id={k} label={l} active={tab === k} onClick={() => { setTab(k); setSidebarOpen(false); }} admin />
              ))}
            </>
          )}
        </nav>

        {/* Tombol Keluar */}
        <div className="p-4 pt-2 border-t border-slate-800/70 bg-slate-950 flex-shrink-0">
          <button onClick={onLogout} className="group w-full relative overflow-hidden py-2.5 px-5 rounded-lg bg-red-600 hover:bg-red-700 shadow-lg shadow-red-900/30 hover:shadow-red-900/50 transition-all duration-200 text-sm font-bold flex items-center justify-center gap-2 tracking-wide text-white">
            <span className="relative z-10">Keluar</span>
          </button>
        </div>
      </aside>

      {/* Main */}
      <main className="md:ml-72 w-full min-h-screen pb-20 md:pb-0 transition-all duration-300">
        <header className="bg-white shadow-sm sticky top-0 z-30 px-4 md:px-8 py-3 flex justify-between items-center">
          <div className="flex items-center gap-3">
            {/* Hamburger (mobile) */}
            <button
              onClick={() => setSidebarOpen(true)}
              className="md:hidden w-10 h-10 flex items-center justify-center text-slate-700 hover:bg-gray-100 rounded-lg"
            >
              <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2.5" strokeLinecap="round">
                <line x1="3" y1="6" x2="21" y2="6" />
                <line x1="3" y1="12" x2="21" y2="12" />
                <line x1="3" y1="18" x2="21" y2="18" />
              </svg>
            </button>
            <img src="/logo lbh.jpeg" alt="Logo" className="md:hidden w-8 h-8 rounded-full object-cover border border-yellow-600" />
            <h2 className="text-lg md:text-2xl font-semibold text-slate-800">{pageTitles[tab]}</h2>
          </div>
          <div className="flex items-center space-x-2 md:space-x-3">
            <button className="p-2 rounded-full hover:bg-gray-100 relative" title="Notifikasi">
              🔔
              <span className="absolute top-1 right-1 w-2 h-2 bg-red-500 rounded-full"></span>
            </button>
            <button onClick={onLogout} className="p-2 rounded-full hover:bg-gray-100" title="Keluar">
              <span className="text-red-500">⏻</span>
            </button>
            <div className="w-8 h-8 md:w-9 md:h-9 rounded-full bg-slate-300 overflow-hidden border border-slate-400">
              <img src={user?.avatar || `https://ui-avatars.com/api/?name=${encodeURIComponent(user?.full_name || 'User')}&background=random`} alt="User" className="w-full h-full object-cover" />
            </div>
          </div>
        </header>

        <div className="p-4 md:p-8 max-w-7xl mx-auto">
          {tab === 'home' && (
            <div>
              <div className="relative bg-gradient-to-r from-yellow-600 to-amber-700 rounded-2xl p-6 md:p-8 mb-8 text-white shadow-xl overflow-hidden">
                <div className="relative z-10">
                  <h2 className="text-2xl md:text-3xl font-bold mb-2">Selamat datang kembali, {user?.full_name || 'User'}! 👋</h2>
                  <p className="text-yellow-100 max-w-xl">Ini adalah ringkasan aktivitas kantor hukum Anda hari ini. Tetap semangat dalam menegakkan keadilan.</p>
                </div>
                <div className="absolute top-0 right-0 -mt-4 -mr-4 opacity-20 text-9xl">⚖️</div>
              </div>

              <div className="grid grid-cols-2 md:grid-cols-4 gap-4 md:gap-6 mb-8">
                <StatCard icon="📋" color="blue" label="Total Tugas" value={stats.tasks} sub={`${stats.tasksDone} selesai`} />
                <StatCard icon="💼" color="indigo" label="Kasus Aktif" value={stats.casesOpen} sub={`${stats.casesTotal} total kasus`} />
                <StatCard icon="📄" color="amber" label="Total Dokumen" value={stats.docs} sub="Tersimpan di sistem" />
                <StatCard icon="👥" color="emerald" label="Total Klien" value={stats.clients} sub="Terdaftar aktif" />
              </div>

              <div className="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
                <div className="lg:col-span-2 bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                  <div className="flex justify-between items-center mb-6">
                    <h3 className="font-bold text-lg text-slate-800">Kasus Terbaru</h3>
                    <button onClick={() => setTab('cases')} className="text-sm font-medium text-yellow-600 hover:text-yellow-700">Lihat Semua</button>
                  </div>
                  <div className="space-y-4">
                    {cases.length > 0 ? cases.slice(-4).reverse().map(c => (
                      <div key={c.id} className="flex items-center justify-between p-4 rounded-xl border border-gray-50 hover:bg-slate-50 transition cursor-pointer">
                        <div className="flex items-center gap-4">
                          <div className={`w-10 h-10 rounded-lg flex items-center justify-center font-bold text-sm ${statusColor(c.status, 'bg', 'text')}`}>⚖️</div>
                          <div>
                            <div className="font-bold text-slate-800 text-sm">{c.title}</div>
                            <div className="text-xs text-slate-500">{c.client_name}</div>
                          </div>
                        </div>
                        <span className={`px-3 py-1 rounded-full text-xs font-medium border ${statusColor(c.status, 'bg', 'text', 'border')}`}>{c.status}</span>
                      </div>
                    )) : <div className="text-center py-6 text-slate-400">Belum ada kasus tercatat.</div>}
                  </div>
                </div>

                <div className="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                  <div className="flex justify-between items-center mb-6">
                    <h3 className="font-bold text-lg text-slate-800 flex items-center">🔥 Tugas Prioritas</h3>
                  </div>
                  <div className="space-y-4">
                    {priorityTasks.length > 0 ? priorityTasks.map(task => (
                      <div key={task.id} className="relative pl-6 before:absolute before:left-2 before:top-2 before:bottom-0 before:w-0.5 before:bg-gray-100 last:before:hidden">
                        <div className="absolute left-0 top-1 w-4 h-4 rounded-full bg-red-500 border-4 border-white shadow-sm z-10"></div>
                        <div className="bg-gray-50 p-4 rounded-xl border border-gray-100 group hover:border-red-200 transition">
                          <div className="flex justify-between items-start mb-1">
                            <div className="font-bold text-sm text-slate-800">{task.title}</div>
                            <button onClick={() => toggleTask(task.id)} className="text-gray-300 hover:text-green-500 transition">✓</button>
                          </div>
                          <div className="text-xs text-slate-500 flex items-center gap-2">
                            <span>⏰ {formatDate(task.date)}</span>
                          </div>
                        </div>
                      </div>
                    )) : (
                      <div className="text-center py-8 text-slate-400 border border-dashed border-gray-200 rounded-xl">Tidak ada tugas prioritas tinggi.</div>
                    )}
                  </div>
                </div>
              </div>
            </div>
          )}

          {tab === 'tasks' && (
            <div>
              <div className="flex justify-between items-center mb-4">
                <div className="flex space-x-2 overflow-x-auto no-scrollbar pb-2">
                  {[['all', 'Semua'], ['pending', 'Belum Selesai'], ['completed', 'Selesai']].map(([k, l]) => (
                    <button key={k} onClick={() => setFilter(k)} className={`px-4 py-2 rounded-lg text-sm font-medium shadow-sm whitespace-nowrap ${filter === k ? 'bg-slate-900 text-white' : 'bg-white text-slate-600'}`}>{l}</button>
                  ))}
                </div>
              </div>
              <div className="space-y-3 pb-20">
                {filteredTasks.map(task => (
                  <div key={task.id} className={`bg-white p-4 rounded-xl shadow-sm flex justify-between items-start transition-all ${task.status === 'completed' ? 'opacity-60' : ''}`}>
                    <div className="flex-1">
                      <div className="flex items-center mb-1">
                        {task.priority === 'Tinggi' && <span className="w-2 h-2 rounded-full bg-red-500 mr-2"></span>}
                        {task.priority === 'Sedang' && <span className="w-2 h-2 rounded-full bg-yellow-500 mr-2"></span>}
                        {task.priority === 'Rendah' && <span className="w-2 h-2 rounded-full bg-green-500 mr-2"></span>}
                        <h4 className={`font-bold text-slate-800 ${task.status === 'completed' ? 'line-through' : ''}`}>{task.title}</h4>
                      </div>
                      <div className="text-sm text-slate-500 flex flex-wrap gap-2">
                        <span className="flex items-center">⏰ {formatDate(task.date)}</span>
                        <span className="bg-gray-100 px-2 rounded text-xs py-0.5">{task.type}</span>
                        {task.case_id && <span className="bg-blue-100 text-blue-800 px-2 rounded text-xs py-0.5 flex items-center">💼 {getCaseName(task.case_id)}</span>}
                      </div>
                    </div>
                    <div className="flex flex-col space-y-2 ml-2">
                      <button onClick={() => toggleTask(task.id)} className="text-gray-400 hover:text-green-600 text-xl">{task.status === 'completed' ? '✅' : '○'}</button>
                      <button onClick={() => deleteTask(task.id)} className="text-gray-300 hover:text-red-500">🗑️</button>
                    </div>
                  </div>
                ))}
                {filteredTasks.length === 0 && <div className="text-center py-12 text-slate-400">Tidak ada tugas.</div>}
              </div>

              <button onClick={() => setShowAddModal(true)} className="fixed bottom-20 right-4 md:bottom-8 md:right-8 bg-yellow-600 text-white w-14 h-14 rounded-full shadow-lg flex items-center justify-center text-2xl hover:bg-yellow-700 transition transform hover:scale-105 z-30">+</button>
            </div>
          )}

          {tab === 'cases' && (
            <div>
              <div className="flex justify-between items-center mb-6">
                <h3 className="text-lg font-bold">Daftar Kasus</h3>
                <button onClick={() => setShowAddCaseModal(true)} className="bg-slate-900 text-white px-4 py-2 rounded-lg text-sm shadow hover:bg-slate-700 transition">+ Tambah Kasus</button>
              </div>
              <div className="grid grid-cols-1 md:grid-cols-2 gap-4 pb-20">
                {cases.map(c => (
                  <div key={c.id} className={`bg-white p-5 rounded-xl shadow-sm border-l-4 ${c.status === 'Open' ? 'border-green-500' : c.status === 'On Hold' ? 'border-yellow-500' : 'border-gray-500'}`}>
                    <div className="flex justify-between items-start">
                      <h4 className="font-bold text-lg text-slate-800">{c.title}</h4>
                    </div>
                    <div className="text-sm text-slate-500 mt-1 mb-3">👤 {c.client_name}</div>
                    <p className="text-sm text-gray-600 mb-4 line-clamp-2">{c.description}</p>
                    <div className="flex items-center justify-between">
                      <span className={`px-2 py-1 rounded text-xs font-semibold ${statusColor(c.status, 'bg', 'text')}`}>{c.status}</span>
                      <div className="flex gap-2">
                        <select value={c.status} onChange={e => updateCaseStatus(c.id, e.target.value)} className="text-xs border rounded px-2 py-1">
                          <option value="Open">Open</option>
                          <option value="On Hold">On Hold</option>
                          <option value="Closed">Closed</option>
                        </select>
                        <button onClick={() => deleteCase(c.id)} className="text-red-400 hover:text-red-600 text-sm">Hapus</button>
                      </div>
                    </div>
                  </div>
                ))}
                {cases.length === 0 && <div className="col-span-2 text-center py-12 text-slate-400">Belum ada kasus.</div>}
              </div>
            </div>
          )}

          {tab === 'documents' && (
            <div>
              <div className="flex justify-between items-center mb-6">
                <h3 className="text-lg font-bold">Dokumentasi Hukum</h3>
                <button onClick={() => setShowAddDocModal(true)} className="bg-slate-900 text-white px-4 py-2 rounded-lg text-sm shadow hover:bg-slate-700 transition">⬆ Upload Dokumen</button>
              </div>
              <div className="bg-white rounded-xl shadow-sm overflow-hidden">
                <table className="w-full text-left text-sm text-gray-600">
                  <thead className="bg-gray-50 text-gray-800 font-bold uppercase text-xs border-b">
                    <tr>
                      <th className="px-6 py-4">Nama Dokumen</th>
                      <th className="px-6 py-4">Tipe</th>
                      <th className="px-6 py-4">Kasus Terkait</th>
                      <th className="px-6 py-4">Tanggal</th>
                      <th className="px-6 py-4 text-right">Aksi</th>
                    </tr>
                  </thead>
                  <tbody className="divide-y divide-gray-100">
                    {documents.map(doc => (
                      <tr key={doc.id} className="hover:bg-gray-50 transition">
                        <td className="px-6 py-4">
                          <div className="flex items-center gap-3">
                            <div className="w-8 h-8 rounded bg-blue-100 text-blue-600 flex items-center justify-center">📄</div>
                            <div className="font-bold text-gray-800">{doc.title}</div>
                          </div>
                        </td>
                        <td className="px-6 py-4"><span className="bg-gray-100 px-2 py-1 rounded text-xs">{doc.type}</span></td>
                        <td className="px-6 py-4 text-xs">{getCaseName(doc.case_id)}</td>
                        <td className="px-6 py-4">{formatDate(doc.date)}</td>
                        <td className="px-6 py-4 text-right">
                          <button className="text-gray-400 hover:text-blue-600 mr-2">⬇</button>
                          <button onClick={() => deleteDocument(doc.id)} className="text-gray-400 hover:text-red-600">🗑️</button>
                        </td>
                      </tr>
                    ))}
                  </tbody>
                </table>
                {documents.length === 0 && <div className="p-8 text-center text-gray-400">Belum ada dokumen tersimpan.</div>}
              </div>
            </div>
          )}

          {tab === 'profile' && (
            <div className="max-w-3xl mx-auto">
              <div className="bg-white rounded-2xl shadow-sm p-8">
                <div className="flex flex-col md:flex-row gap-6 items-center md:items-start mb-8">
                  <img src={user?.avatar || `https://ui-avatars.com/api/?name=${encodeURIComponent(user?.full_name || 'User')}&background=1e293b&color=eab308&size=160`} alt="Avatar" className="w-32 h-32 rounded-full border-4 border-yellow-500 shadow-lg object-cover" />
                  <div className="text-center md:text-left flex-1">
                    <h3 className="text-2xl font-bold text-slate-800">{user?.full_name}</h3>
                    <span className="inline-block mt-2 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider bg-yellow-100 text-yellow-700">{user?.role}</span>
                    <div className="mt-4 space-y-1 text-sm text-slate-600">
                      <p>👤 Username: <strong>{user?.username}</strong></p>
                      <p>📧 Email: <strong>{user?.email || '-'}</strong></p>
                    </div>
                  </div>
                </div>
                <div className="border-t pt-6 space-y-3 text-sm text-slate-600">
                  <p className="text-slate-400 text-xs uppercase tracking-wider font-bold mb-2">Informasi Akun</p>
                  <div className="grid md:grid-cols-2 gap-4">
                    <div className="p-4 rounded-lg bg-gray-50"><p className="text-xs text-slate-400 mb-1">ID Pengguna</p><p className="font-mono">{user?.id}</p></div>
                    <div className="p-4 rounded-lg bg-gray-50"><p className="text-xs text-slate-400 mb-1">Hak Akses</p><p className="font-semibold capitalize">{user?.role}</p></div>
                  </div>
                </div>
              </div>
            </div>
          )}

          {isAdmin && tab === 'master' && (
            <div>
              <div className="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <div className="bg-white rounded-xl shadow-sm p-6">
                  <div className="flex justify-between items-center mb-4">
                    <h3 className="text-lg font-bold">Pengacara</h3>
                    <button onClick={() => openAddUser('lawyer')} className="bg-slate-900 text-white px-3 py-2 rounded-lg text-sm shadow hover:bg-slate-700 transition">+ Tambah</button>
                  </div>
                  <div className="space-y-2">
                    {users.filter(u => u.role === 'lawyer').map(u => (
                      <div key={u.id} className="flex items-center justify-between p-3 rounded border">
                        <div>
                          <div className="font-bold">{u.full_name}</div>
                          <div className="text-xs text-gray-500">{u.email}</div>
                          <div className="text-xs text-gray-400">{u.username}</div>
                        </div>
                        <div className="flex gap-2">
                          <button onClick={() => openEditUser(u)} className="text-gray-500 hover:text-blue-600">✏️</button>
                          <button onClick={() => deleteUser(u.id)} className="text-gray-400 hover:text-red-600">🗑️</button>
                        </div>
                      </div>
                    ))}
                    {users.filter(u => u.role === 'lawyer').length === 0 && <div className="text-sm text-gray-400 italic">Belum ada data pengacara.</div>}
                  </div>
                </div>
                <div className="bg-white rounded-xl shadow-sm p-6">
                  <div className="flex justify-between items-center mb-4">
                    <h3 className="text-lg font-bold">Klien</h3>
                    <button onClick={() => openAddUser('client')} className="bg-slate-900 text-white px-3 py-2 rounded-lg text-sm shadow hover:bg-slate-700 transition">+ Tambah</button>
                  </div>
                  <div className="space-y-2">
                    {users.filter(u => u.role === 'client').map(u => (
                      <div key={u.id} className="flex items-center justify-between p-3 rounded border">
                        <div>
                          <div className="font-bold">{u.full_name}</div>
                          <div className="text-xs text-gray-500">{u.email}</div>
                          <div className="text-xs text-gray-400">{u.username}</div>
                        </div>
                        <div className="flex gap-2">
                          <button onClick={() => openEditUser(u)} className="text-gray-500 hover:text-blue-600">✏️</button>
                          <button onClick={() => deleteUser(u.id)} className="text-gray-400 hover:text-red-600">🗑️</button>
                        </div>
                      </div>
                    ))}
                    {users.filter(u => u.role === 'client').length === 0 && <div className="text-sm text-gray-400 italic">Belum ada data klien.</div>}
                  </div>
                </div>
              </div>

              <div className="bg-white rounded-xl shadow-sm p-6 mt-6">
                <div className="flex justify-between items-center mb-4">
                  <h3 className="text-lg font-bold">Pengadilan</h3>
                  <div className="flex gap-2">
                    <input type="text" value={newCourt} onChange={e => setNewCourt(e.target.value)} placeholder="Nama Pengadilan" className="px-3 py-2 border rounded-lg text-sm" />
                    <button onClick={() => addCourt(newCourt)} className="bg-slate-900 text-white px-3 py-2 rounded-lg text-sm">Tambah</button>
                  </div>
                </div>
                <div className="grid grid-cols-1 md:grid-cols-3 gap-2">
                  {courts.map((c, i) => (
                    <div key={i} className="flex items-center justify-between p-3 rounded border">
                      <div className="flex items-center gap-2 w-full">
                        {editingCourt === c ? <input type="text" value={editCourtName} onChange={e => setEditCourtName(e.target.value)} className="flex-1 px-3 py-2 border rounded-lg text-sm" /> : <span className="flex-1">{c}</span>}
                        <div className="flex gap-2">
                          {editingCourt !== c ? <button onClick={() => startEditCourt(c)} className="text-gray-500 hover:text-blue-600">✏️</button> : (
                            <>
                              <button onClick={() => renameCourt(c, editCourtName)} className="text-white bg-yellow-600 px-2 py-1 rounded text-xs">Simpan</button>
                              <button onClick={cancelEditCourt} className="text-gray-500 px-2 py-1 rounded text-xs">Batal</button>
                            </>
                          )}
                          <button onClick={() => deleteCourt(c)} className="text-gray-400 hover:text-red-600">🗑️</button>
                        </div>
                      </div>
                    </div>
                  ))}
                </div>
              </div>
            </div>
          )}

          {isAdmin && tab === 'web' && (
            <div>
              <div className="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden mb-6">
                <div className="px-6 py-4 border-b border-gray-100 flex justify-between items-center">
                  <div>
                    <h3 className="font-bold text-slate-800 text-lg">👥 Tim Kami</h3>
                    <p className="text-xs text-slate-400 mt-0.5">Kelola anggota tim yang tampil di website</p>
                  </div>
                  <button onClick={openAddTeam} className="bg-yellow-600 text-white px-4 py-2 rounded-xl text-sm font-medium hover:bg-yellow-700 transition flex items-center gap-2">+ Tambah Anggota</button>
                </div>
                <div className="overflow-x-auto">
                  <table className="w-full">
                    <thead><tr className="bg-slate-50 text-xs font-semibold text-slate-500 uppercase tracking-wider">
                      <th className="px-6 py-3 text-left">Foto</th>
                      <th className="px-6 py-3 text-left">Nama</th>
                      <th className="px-6 py-3 text-left">Jabatan</th>
                      <th className="px-6 py-3 text-left">Wilayah</th>
                      <th className="px-6 py-3 text-right">Aksi</th>
                    </tr></thead>
                    <tbody className="divide-y divide-gray-50">
                      {teams.map(t => (
                        <tr key={t.id} className="hover:bg-slate-50 transition-colors group">
                          <td className="px-6 py-4"><img src={t.image ? `/${t.image.replace(/^\/+/, '')}` : `https://ui-avatars.com/api/?name=${encodeURIComponent(t.name)}&background=e2e8f0`} className="w-11 h-11 rounded-full object-cover border-2 border-white shadow-sm" alt="" /></td>
                          <td className="px-6 py-4"><div className="font-semibold text-slate-800 text-sm">{t.name}</div></td>
                          <td className="px-6 py-4"><span className="px-2.5 py-1 bg-yellow-50 text-yellow-700 rounded-lg text-xs font-medium">{t.position}</span></td>
                          <td className="px-6 py-4"><span className="text-sm text-slate-500">{t.region || '-'}</span></td>
                          <td className="px-6 py-4"><div className="flex justify-end gap-2">
                            <button onClick={() => openEditTeam(t)} className="p-2 text-slate-400 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition">✏️</button>
                            <button onClick={() => deleteTeam(t.id)} className="p-2 text-slate-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition">🗑️</button>
                          </div></td>
                        </tr>
                      ))}
                      {teams.length === 0 && <tr><td colSpan={5} className="px-6 py-12 text-center text-slate-400">Belum ada anggota tim.</td></tr>}
                    </tbody>
                  </table>
                </div>
              </div>

              <div className="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div className="px-6 py-4 border-b border-gray-100 flex justify-between items-center">
                  <div>
                    <h3 className="font-bold text-slate-800 text-lg">🖼️ Galeri Kegiatan</h3>
                    <p className="text-xs text-slate-400 mt-0.5">Foto kegiatan yang tampil di website</p>
                  </div>
                  <button onClick={() => alert('Upload galeri: untuk demo, edit data.json secara manual.')} className="bg-purple-600 text-white px-4 py-2 rounded-xl text-sm font-medium hover:bg-purple-700 transition flex items-center gap-2">⬆ Upload Foto</button>
                </div>
                <div className="p-6">
                  <div className="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
                    {gallery.map(g => (
                      <div key={g.id} className="relative group rounded-xl overflow-hidden border border-gray-100 aspect-square shadow-sm">
                        <img src={`/${(g.image || '').replace(/^\/+/, '')}`} className="w-full h-full object-cover" alt="" />
                        <div className="absolute inset-0 bg-black/0 group-hover:bg-black/40 transition flex items-center justify-center">
                          <button onClick={() => deleteGallery(g.id)} className="opacity-0 group-hover:opacity-100 transition bg-red-500 text-white w-9 h-9 rounded-full flex items-center justify-center shadow-lg">🗑️</button>
                        </div>
                      </div>
                    ))}
                    {gallery.length === 0 && <div className="col-span-4 py-14 text-center text-slate-400">🖼️ Belum ada foto galeri.</div>}
                  </div>
                </div>
              </div>
            </div>
          )}

          {isAdmin && tab === 'content' && (
            <div>
              <div className="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden mb-6">
                <div className="px-6 py-4 border-b border-gray-100 flex justify-between items-center">
                  <div>
                    <h3 className="font-bold text-slate-800 text-lg">📰 Manajemen Artikel</h3>
                    <p className="text-xs text-slate-400 mt-0.5">Kelola artikel yang tampil di website</p>
                  </div>
                  <button onClick={openAddArticle} className="bg-yellow-600 text-white px-4 py-2 rounded-xl text-sm font-medium hover:bg-yellow-700 transition flex items-center gap-2">+ Tulis Artikel</button>
                </div>
                <div className="overflow-x-auto">
                  <table className="w-full">
                    <thead><tr className="bg-slate-50 text-xs font-semibold text-slate-500 uppercase tracking-wider">
                      <th className="px-6 py-3 text-left">Cover</th>
                      <th className="px-6 py-3 text-left">Judul Artikel</th>
                      <th className="px-6 py-3 text-left">Kategori</th>
                      <th className="px-6 py-3 text-left">Tanggal</th>
                      <th className="px-6 py-3 text-right">Aksi</th>
                    </tr></thead>
                    <tbody className="divide-y divide-gray-50">
                      {articles.map(a => (
                        <tr key={a.id} className="hover:bg-slate-50 transition-colors group">
                          <td className="px-6 py-4"><img src={`/${(a.image || '').replace(/^\/+/, '')}`} className="w-12 h-12 rounded object-cover border border-gray-200" alt="" /></td>
                          <td className="px-6 py-4"><div className="font-semibold text-slate-800 text-sm">{a.title}</div></td>
                          <td className="px-6 py-4"><span className="px-2.5 py-1 bg-gray-100 text-gray-700 rounded-lg text-xs font-medium uppercase">{a.category}</span></td>
                          <td className="px-6 py-4"><span className="text-sm text-slate-500">{a.created_at}</span></td>
                          <td className="px-6 py-4"><div className="flex justify-end gap-2">
                            <button onClick={() => openEditArticle(a)} className="p-2 text-slate-400 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition">✏️</button>
                            <button onClick={() => deleteArticle(a.id)} className="p-2 text-slate-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition">🗑️</button>
                          </div></td>
                        </tr>
                      ))}
                      {articles.length === 0 && <tr><td colSpan={5} className="px-6 py-12 text-center text-slate-400">Belum ada artikel.</td></tr>}
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          )}
        </div>
      </main>

      {/* Modals */}
      {showAddModal && (
        <Modal onClose={() => setShowAddModal(false)} title="Tambah Tugas Baru">
          <div className="space-y-3 text-sm">
            <Input label="Judul Tugas" value={taskForm.title} onChange={v => setTaskForm({ ...taskForm, title: v })} />
            <div className="grid grid-cols-2 gap-3">
              <Select label="Tipe" value={taskForm.type} onChange={v => setTaskForm({ ...taskForm, type: v })} options={['Sidang', 'Dokumen', 'Konsultasi', 'Laporan', 'Mediasi']} />
              <Select label="Prioritas" value={taskForm.priority} onChange={v => setTaskForm({ ...taskForm, priority: v })} options={['Tinggi', 'Sedang', 'Rendah']} />
            </div>
            <Input label="Tanggal" type="date" value={taskForm.date} onChange={v => setTaskForm({ ...taskForm, date: v })} />
          </div>
          <div className="mt-5 flex justify-end gap-2">
            <button onClick={() => setShowAddModal(false)} className="px-4 py-2 bg-gray-100 text-slate-700 rounded-lg">Batal</button>
            <button onClick={addTask} className="px-4 py-2 bg-slate-900 text-white rounded-lg">Simpan</button>
          </div>
        </Modal>
      )}

      {showAddCaseModal && (
        <Modal onClose={() => setShowAddCaseModal(false)} title="Tambah Kasus Baru">
          <div className="space-y-3 text-sm">
            <Input label="Judul Kasus" value={caseForm.title} onChange={v => setCaseForm({ ...caseForm, title: v })} />
            <Input label="Nama Klien" value={caseForm.client_name} onChange={v => setCaseForm({ ...caseForm, client_name: v })} />
            <Select label="Status" value={caseForm.status} onChange={v => setCaseForm({ ...caseForm, status: v })} options={['Open', 'On Hold', 'Closed']} />
            <label className="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
            <textarea rows={3} value={caseForm.description} onChange={e => setCaseForm({ ...caseForm, description: e.target.value })} className="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-yellow-500 focus:outline-none text-sm"></textarea>
          </div>
          <div className="mt-5 flex justify-end gap-2">
            <button onClick={() => setShowAddCaseModal(false)} className="px-4 py-2 bg-gray-100 text-slate-700 rounded-lg">Batal</button>
            <button onClick={addCase} className="px-4 py-2 bg-slate-900 text-white rounded-lg">Simpan</button>
          </div>
        </Modal>
      )}

      {showAddDocModal && (
        <Modal onClose={() => setShowAddDocModal(false)} title="Upload Dokumen">
          <div className="space-y-3 text-sm">
            <Input label="Nama Dokumen" value={docForm.title} onChange={v => setDocForm({ ...docForm, title: v })} />
            <div className="grid grid-cols-2 gap-3">
              <Select label="Tipe" value={docForm.type} onChange={v => setDocForm({ ...docForm, type: v })} options={['Surat Kuasa', 'Somasi', 'Akta', 'Perjanjian', 'Lainnya']} />
              <Select label="Kasus Terkait (opsional)" value={docForm.case_id} onChange={v => setDocForm({ ...docForm, case_id: v })} options={['', ...cases.map(c => ({ value: c.id, label: c.title }))]} />
            </div>
          </div>
          <div className="mt-5 flex justify-end gap-2">
            <button onClick={() => setShowAddDocModal(false)} className="px-4 py-2 bg-gray-100 text-slate-700 rounded-lg">Batal</button>
            <button onClick={addDocument} className="px-4 py-2 bg-slate-900 text-white rounded-lg">Simpan</button>
          </div>
        </Modal>
      )}

      {showUserModal && (
        <Modal onClose={() => setShowUserModal(false)} title={userForm.id ? 'Edit Pengguna' : 'Tambah Pengguna'}>
          <div className="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4 text-sm">
            <Select label="Role" value={userForm.role} onChange={v => setUserForm({ ...userForm, role: v })} options={[
              { value: 'admin', label: 'Admin' },
              { value: 'lawyer', label: 'Pengacara' },
              { value: 'client', label: 'Klien' },
            ]} />
            <Input label="Username" value={userForm.username} onChange={v => setUserForm({ ...userForm, username: v })} />
            <Input label="Nama Lengkap" value={userForm.full_name} onChange={v => setUserForm({ ...userForm, full_name: v })} />
            <Input label="Email" type="email" value={userForm.email} onChange={v => setUserForm({ ...userForm, email: v })} />
            <div className="md:col-span-2">
              <Input label={`Password${userForm.id ? ' (opsional)' : ''}`} type="password" value={userForm.password} onChange={v => setUserForm({ ...userForm, password: v })} />
            </div>
          </div>
          <div className="mt-3 flex justify-end gap-2">
            <button onClick={() => setShowUserModal(false)} className="px-4 py-2 bg-gray-100 text-slate-700 rounded-lg">Batal</button>
            <button onClick={saveUser} className="px-4 py-2 bg-slate-900 text-white rounded-lg">Simpan</button>
          </div>
        </Modal>
      )}

      {showTeamModal && (
        <Modal onClose={() => setShowTeamModal(false)} title={teamForm.id ? 'Edit Anggota Tim' : 'Tambah Anggota Tim'}>
          <div className="space-y-4 text-sm">
            <Input label="Nama Lengkap *" value={teamForm.name} onChange={v => setTeamForm({ ...teamForm, name: v })} />
            <Input label="Jabatan *" value={teamForm.position} onChange={v => setTeamForm({ ...teamForm, position: v })} />
            <Input label="Wilayah" value={teamForm.region} onChange={v => setTeamForm({ ...teamForm, region: v })} />
            <Input label="URL Foto (opsional)" value={teamForm.image} onChange={v => setTeamForm({ ...teamForm, image: v })} placeholder="uploads/team_xxx.jpeg" />
          </div>
          <div className="flex justify-end gap-3 mt-6">
            <button onClick={() => setShowTeamModal(false)} className="px-5 py-2.5 bg-gray-100 text-slate-700 rounded-xl text-sm font-medium hover:bg-gray-200 transition">Batal</button>
            <button onClick={saveTeam} disabled={!teamForm.name || !teamForm.position} className="px-5 py-2.5 bg-yellow-600 text-white rounded-xl text-sm font-medium hover:bg-yellow-700 transition disabled:opacity-50 disabled:cursor-not-allowed">💾 Simpan</button>
          </div>
        </Modal>
      )}

      {showAddArticleModal && (
        <Modal onClose={() => setShowAddArticleModal(false)} title={newArticle.id ? 'Edit Artikel' : 'Tulis Artikel Baru'}>
          <div className="space-y-4 text-sm">
            <Input label="Judul *" value={newArticle.title} onChange={v => setNewArticle({ ...newArticle, title: v })} />
            <Input label="Kategori *" value={newArticle.category} onChange={v => setNewArticle({ ...newArticle, category: v })} placeholder="Misal: Hukum Bisnis" />
            <Input label="URL Cover (opsional)" value={newArticle.image} onChange={v => setNewArticle({ ...newArticle, image: v })} placeholder="law2.jpg" />
            <label className="block text-sm font-medium text-gray-700 mb-1">Konten *</label>
            <textarea rows={6} value={newArticle.content} onChange={e => setNewArticle({ ...newArticle, content: e.target.value })} className="w-full px-4 py-2.5 border border-gray-200 rounded-xl focus:ring-2 focus:ring-yellow-500 focus:outline-none text-sm"></textarea>
          </div>
          <div className="flex justify-end gap-3 mt-6">
            <button onClick={() => setShowAddArticleModal(false)} className="px-5 py-2.5 bg-gray-100 text-slate-700 rounded-xl text-sm font-medium hover:bg-gray-200 transition">Batal</button>
            <button onClick={saveArticle} className="px-5 py-2.5 bg-yellow-600 text-white rounded-xl text-sm font-medium hover:bg-yellow-700 transition">💾 Simpan</button>
          </div>
        </Modal>
      )}
    </div>
  );
};

const StatCard = ({ icon, color, label, value, sub }) => {
  const colorMap = {
    blue:    { accent: 'text-blue-500',   soft: 'bg-blue-50',   deep: 'bg-blue-100' },
    indigo:  { accent: 'text-indigo-500', soft: 'bg-indigo-50', deep: 'bg-indigo-100' },
    amber:   { accent: 'text-amber-500',  soft: 'bg-amber-50',  deep: 'bg-amber-100' },
    emerald: { accent: 'text-emerald-500',soft: 'bg-emerald-50',deep: 'bg-emerald-100' },
  };
  const c = colorMap[color] || colorMap.blue;
  return (
    <div className="bg-white p-5 md:p-6 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition-all relative overflow-hidden group">
      <div className={`absolute -top-6 -right-6 w-24 h-24 ${c.soft} rounded-full transition-transform group-hover:scale-110`}></div>
      <div className={`absolute top-3 right-4 w-11 h-11 ${c.deep} rounded-[30%] flex items-center justify-center shadow-sm`}>
        <span className={`${c.accent} text-xl`}>{icon}</span>
      </div>
      <div className="text-slate-400 text-xs font-bold uppercase tracking-[0.15em] mb-1.5">{label}</div>
      <div className="text-3xl md:text-4xl font-bold text-slate-800">{value}</div>
      <div className="mt-2 text-xs text-slate-500">{sub}</div>
    </div>
  );
};

const Modal = ({ onClose, title, children }) => (
  <div className="fixed inset-0 z-[60] flex items-end md:items-center justify-center p-4">
    <div className="absolute inset-0 bg-black bg-opacity-50 backdrop-blur-sm" onClick={onClose}></div>
    <div className="bg-white w-full md:max-w-lg md:rounded-xl rounded-t-2xl p-6 relative transform transition-transform duration-300 max-h-[90vh] overflow-y-auto">
      <button onClick={onClose} className="absolute top-4 right-4 text-gray-400 hover:text-gray-600 text-xl">✕</button>
      <h3 className="text-xl font-bold mb-4 pr-8">{title}</h3>
      {children}
    </div>
  </div>
);

const Input = ({ label, value, onChange, type = 'text', placeholder = '' }) => (
  <div>
    <label className="block text-sm font-medium text-gray-700 mb-1">{label}</label>
    <input type={type} value={value} onChange={e => onChange(e.target.value)} placeholder={placeholder} className="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-yellow-500 focus:outline-none text-sm" />
  </div>
);

const Select = ({ label, value, onChange, options }) => {
  const opts = options.map(o => typeof o === 'string' ? { value: o, label: o } : o);
  return (
    <div>
      <label className="block text-sm font-medium text-gray-700 mb-1">{label}</label>
      <select value={value} onChange={e => onChange(e.target.value)} className="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-yellow-500 focus:outline-none text-sm">
        {opts.map(o => <option key={o.value} value={o.value}>{o.label}</option>)}
      </select>
    </div>
  );
};

const statusColor = (status, bg = 'bg', text = 'text', border) => {
  const map = {
    Open: `${bg}-green-100 ${text}-green-700`,
    'On Hold': `${bg}-yellow-100 ${text}-yellow-700`,
    Closed: `${bg}-gray-100 ${text}-gray-700`,
  };
  let cls = map[status] || map.Open;
  if (border) {
    const bMap = { Open: 'border-green-200', 'On Hold': 'border-yellow-200', Closed: 'border-gray-200' };
    cls += ` border ${bMap[status] || bMap.Open}`;
  }
  return cls;
};

const HexIcon = ({ active }) => (
  <svg width="20" height="20" viewBox="0 0 24 24" fill={active ? '#eab308' : 'none'} stroke={active ? '#eab308' : '#64748b'} strokeWidth="2.5" strokeLinejoin="round">
    <polygon points="12 2 22 7 22 17 12 22 2 17 2 7 12 2" />
  </svg>
);

const NavItem = ({ id: _id, label, active, onClick, admin }) => {
  return (
    <button
      onClick={onClick}
      className={`w-full flex items-center gap-3 py-2.5 pl-6 pr-5 text-base font-semibold transition-all duration-150 group relative ${
        active
          ? 'bg-slate-700/90 text-white'
          : admin
          ? 'text-slate-400 hover:text-white hover:bg-slate-800/40'
          : 'text-slate-300 hover:text-white hover:bg-slate-800/40'
      }`}
    >
      {active && (
        <span className="absolute right-0 top-0 bottom-0 w-1.5 bg-yellow-500 rounded-l-sm"></span>
      )}
      <HexIcon active={active} />
      <span className="tracking-wide">{label}</span>
    </button>
  );
};

export default Dashboard;
