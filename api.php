<?php
header('Content-Type: application/json');
header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');
header('Cache-Control: post-check=0, pre-check=0', false);
header('Pragma: no-cache');

$USE_JSON_ONLY = true;

$file = 'data.json';

try {
    $pdo = new PDO('mysql:host=localhost', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->exec("CREATE DATABASE IF NOT EXISTS lawyer_app CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
    $pdo->exec("USE lawyer_app");
    $pdo->exec("CREATE TABLE IF NOT EXISTS users (id INT AUTO_INCREMENT PRIMARY KEY, username VARCHAR(64) UNIQUE, password VARCHAR(255), role VARCHAR(32), full_name VARCHAR(128), email VARCHAR(128), avatar VARCHAR(255))");
    $pdo->exec("CREATE TABLE IF NOT EXISTS cases (id INT AUTO_INCREMENT PRIMARY KEY, title VARCHAR(255), client_id INT NULL, client_name VARCHAR(128), status VARCHAR(32), description TEXT, court VARCHAR(128), case_number VARCHAR(128), start_date DATE NULL, assigned_to INT NULL)");
    $pdo->exec("CREATE TABLE IF NOT EXISTS case_timeline (id INT AUTO_INCREMENT PRIMARY KEY, case_id INT, date DATE, activity TEXT, `by` VARCHAR(128))");
    $pdo->exec("CREATE TABLE IF NOT EXISTS tasks (id INT AUTO_INCREMENT PRIMARY KEY, title VARCHAR(255), date DATE, priority VARCHAR(16), status VARCHAR(16), type VARCHAR(32), case_id INT NULL, assigned_to INT NULL)");
    $pdo->exec("CREATE TABLE IF NOT EXISTS documents (id INT AUTO_INCREMENT PRIMARY KEY, title VARCHAR(255), type VARCHAR(32), case_id INT, date DATE, uploaded_by INT NULL)");
    $pdo->exec("CREATE TABLE IF NOT EXISTS courts (id INT AUTO_INCREMENT PRIMARY KEY, name VARCHAR(128) UNIQUE)");
    $pdo->exec("CREATE TABLE IF NOT EXISTS case_numbers (id INT AUTO_INCREMENT PRIMARY KEY, value VARCHAR(128) UNIQUE)");
    $pdo->exec("CREATE TABLE IF NOT EXISTS start_dates (id INT AUTO_INCREMENT PRIMARY KEY, date DATE UNIQUE)");
    $pdo->exec("CREATE TABLE IF NOT EXISTS meta (k VARCHAR(64) PRIMARY KEY, v VARCHAR(255))");
    
    $pdo->exec("CREATE TABLE IF NOT EXISTS teams (id INT AUTO_INCREMENT PRIMARY KEY, name VARCHAR(255), position VARCHAR(128), region VARCHAR(128), image VARCHAR(255))");
    $pdo->exec("CREATE TABLE IF NOT EXISTS legalitas (id INT AUTO_INCREMENT PRIMARY KEY, title VARCHAR(128), doc_no VARCHAR(255), description TEXT, icon VARCHAR(64))");
    $pdo->exec("CREATE TABLE IF NOT EXISTS legalitas_images (id INT AUTO_INCREMENT PRIMARY KEY, image VARCHAR(255))");
    $pdo->exec("CREATE TABLE IF NOT EXISTS gallery (id INT AUTO_INCREMENT PRIMARY KEY, image VARCHAR(255), css_class VARCHAR(64))");

    $pdo->exec("CREATE TABLE IF NOT EXISTS articles (id INT AUTO_INCREMENT PRIMARY KEY, category VARCHAR(64), title VARCHAR(255), content TEXT, image VARCHAR(255), created_at DATE)");
    try { 
        $pdo->query("SELECT avatar FROM users LIMIT 1"); 
    } catch (Exception $e) { 
        try { $pdo->exec("ALTER TABLE users ADD COLUMN avatar VARCHAR(255) NULL"); } catch (Exception $ignored) {} 
    }
    $seeded = null;
    try {
        $seeded = $pdo->query("SELECT v FROM meta WHERE k='seeded'")->fetchColumn();
    } catch (Exception $e) {
        try { $pdo->exec("CREATE TABLE IF NOT EXISTS meta (k VARCHAR(64) PRIMARY KEY, v VARCHAR(255))");
    
    $pdo->exec("CREATE TABLE IF NOT EXISTS teams (id INT AUTO_INCREMENT PRIMARY KEY, name VARCHAR(255), position VARCHAR(128), region VARCHAR(128), image VARCHAR(255))");
    $pdo->exec("CREATE TABLE IF NOT EXISTS legalitas (id INT AUTO_INCREMENT PRIMARY KEY, title VARCHAR(128), doc_no VARCHAR(255), description TEXT, icon VARCHAR(64))");
    $pdo->exec("CREATE TABLE IF NOT EXISTS legalitas_images (id INT AUTO_INCREMENT PRIMARY KEY, image VARCHAR(255))");
    $pdo->exec("CREATE TABLE IF NOT EXISTS gallery (id INT AUTO_INCREMENT PRIMARY KEY, image VARCHAR(255), css_class VARCHAR(64))");

    $pdo->exec("CREATE TABLE IF NOT EXISTS articles (id INT AUTO_INCREMENT PRIMARY KEY, category VARCHAR(64), title VARCHAR(255), content TEXT, image VARCHAR(255), created_at DATE)"); } catch (Exception $ignored) {}
    }
    if (!$seeded && file_exists($file)) {
        $seed = json_decode(file_get_contents($file), true);
        if (is_array($seed)) {
            foreach ($seed['users'] ?? [] as $u) {
                $stmt = $pdo->prepare("INSERT IGNORE INTO users (id, username, password, role, full_name, email) VALUES (?, ?, ?, ?, ?, ?)");
                $stmt->execute([$u['id'] ?? null, $u['username'] ?? '', $u['password'] ?? '', $u['role'] ?? '', $u['full_name'] ?? '', $u['email'] ?? '']);
            }
            foreach ($seed['cases'] ?? [] as $c) {
                $stmt = $pdo->prepare("INSERT INTO cases (id, title, client_id, client_name, status, description, court, case_number, start_date, assigned_to) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                $stmt->execute([$c['id'] ?? null, $c['title'] ?? '', $c['client_id'] ?? null, $c['client_name'] ?? ($c['client'] ?? ''), $c['status'] ?? '', $c['description'] ?? '', $c['court'] ?? null, $c['case_number'] ?? null, isset($c['start_date']) ? $c['start_date'] : null, $c['assigned_to'] ?? null]);
                $cid = $c['id'] ?? $pdo->lastInsertId();
                foreach ($c['timeline'] ?? [] as $t) {
                    $st = $pdo->prepare("INSERT INTO case_timeline (case_id, date, activity, `by`) VALUES (?, ?, ?, ?)");
                    $st->execute([$cid, $t['date'] ?? null, $t['activity'] ?? '', $t['by'] ?? null]);
                }
            }
            foreach ($seed['tasks'] ?? [] as $t) {
                $stmt = $pdo->prepare("INSERT INTO tasks (id, title, date, priority, status, type, case_id, assigned_to) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
                $stmt->execute([$t['id'] ?? null, $t['title'] ?? '', $t['date'] ?? null, $t['priority'] ?? '', $t['status'] ?? '', $t['type'] ?? '', $t['case_id'] ?? null, $t['assigned_to'] ?? null]);
            }
            foreach ($seed['documents'] ?? [] as $d) {
                $stmt = $pdo->prepare("INSERT INTO documents (id, title, type, case_id, date, uploaded_by) VALUES (?, ?, ?, ?, ?, ?)");
                $stmt->execute([$d['id'] ?? null, $d['title'] ?? '', $d['type'] ?? '', $d['case_id'] ?? null, $d['date'] ?? null, $d['uploaded_by'] ?? null]);
            }
            foreach ($seed['courts'] ?? [] as $v) {
                $pdo->prepare("INSERT IGNORE INTO courts (name) VALUES (?)")->execute([$v]);
            }
            foreach ($seed['case_numbers'] ?? [] as $v) {
                $pdo->prepare("INSERT IGNORE INTO case_numbers (value) VALUES (?)")->execute([$v]);
            }
            foreach ($seed['start_dates'] ?? [] as $v) {
                $pdo->prepare("INSERT IGNORE INTO start_dates (date) VALUES (?)")->execute([$v]);
            }
            try {
                $pdo->exec("INSERT INTO meta (k, v) VALUES ('seeded','1') ON DUPLICATE KEY UPDATE v='1'");
            } catch (Exception $e) {
                // ignore if insert fails
            }
        }
    }
    function allData($pdo) {
        $users = $pdo->query("SELECT id, username, role, full_name, email, avatar FROM users")->fetchAll(PDO::FETCH_ASSOC);
        $tasks = $pdo->query("SELECT id, title, date, priority, status, type, case_id, assigned_to FROM tasks")->fetchAll(PDO::FETCH_ASSOC);
        $cases = $pdo->query("SELECT id, title, client_id, client_name, status, description, court, case_number, start_date, assigned_to FROM cases")->fetchAll(PDO::FETCH_ASSOC);
        foreach ($cases as &$c) {
            $st = $pdo->prepare("SELECT date, activity, `by` FROM case_timeline WHERE case_id = ? ORDER BY date ASC, id ASC");
            $st->execute([$c['id']]);
            $c['timeline'] = $st->fetchAll(PDO::FETCH_ASSOC);
        }
        $documents = $pdo->query("SELECT id, title, type, case_id, date, uploaded_by FROM documents")->fetchAll(PDO::FETCH_ASSOC);
        
        $teams = $pdo->query("SELECT * FROM teams")->fetchAll(PDO::FETCH_ASSOC);
        $legalitas = $pdo->query("SELECT * FROM legalitas")->fetchAll(PDO::FETCH_ASSOC);
        $legalitas_images = $pdo->query("SELECT * FROM legalitas_images")->fetchAll(PDO::FETCH_ASSOC);
        $gallery = $pdo->query("SELECT * FROM gallery")->fetchAll(PDO::FETCH_ASSOC);

        $articles = $pdo->query("SELECT id, category, title, content, image, created_at FROM articles")->fetchAll(PDO::FETCH_ASSOC);
        $total = (int)$pdo->query("SELECT COUNT(*) FROM tasks")->fetchColumn();
        $pending = (int)$pdo->query("SELECT COUNT(*) FROM tasks WHERE status = 'pending'")->fetchColumn();
        $stats = ['total' => $total, 'pending' => $pending, 'completed' => $total - $pending];
        $courts = array_map(function($r){return $r['name'];}, $pdo->query("SELECT name FROM courts ORDER BY name")->fetchAll(PDO::FETCH_ASSOC));
        $case_numbers = array_map(function($r){return $r['value'];}, $pdo->query("SELECT value FROM case_numbers ORDER BY value")->fetchAll(PDO::FETCH_ASSOC));
        $start_dates = array_map(function($r){return $r['date'];}, $pdo->query("SELECT date FROM start_dates ORDER BY date")->fetchAll(PDO::FETCH_ASSOC));
        return ['users'=>$users,'tasks'=>$tasks,'cases'=>$cases,'documents'=>$documents,'stats'=>$stats,'courts'=>$courts,'case_numbers'=>$case_numbers,'start_dates'=>$start_dates,'articles'=>$articles,'teams'=>$teams,'legalitas'=>$legalitas,'legalitas_images'=>$legalitas_images,'gallery'=>$gallery];
    }
    $useDb = true;
} catch (Exception $e) {
    $useDb = false;
}
if ($USE_JSON_ONLY) {
    $useDb = false;
}
// Ensure data file exists
if (!file_exists($file)) {
    file_put_contents($file, json_encode([
        'tasks' => [], 
        'cases' => [], 
        'documents' => [],
        'stats' => ['total' => 0, 'pending' => 0, 'completed' => 0]
    ]));
}

$method = $_SERVER['REQUEST_METHOD'];
$data = $useDb ? allData($pdo) : json_decode(file_get_contents($file), true);

// Initialize missing arrays if old version
if (!isset($data['cases'])) $data['cases'] = [];
if (!isset($data['documents'])) $data['documents'] = [];
if (!isset($data['users'])) $data['users'] = [];
if (!isset($data['courts'])) $data['courts'] = [];
if (!isset($data['case_numbers'])) $data['case_numbers'] = [];
if (!isset($data['start_dates'])) $data['start_dates'] = [];
if (!isset($data['articles'])) $data['articles'] = [];
if (!isset($data['teams'])) $data['teams'] = [];
if (!isset($data['legalitas'])) $data['legalitas'] = [];
if (!isset($data['legalitas_images'])) $data['legalitas_images'] = [];
if (!isset($data['gallery'])) $data['gallery'] = [];


if ($method === 'GET') {
    echo json_encode($data);
    exit;
}

if ($method === 'POST') {
    // Handle file upload (multipart, not JSON)
    if (isset($_POST['action']) && $_POST['action'] === 'upload_image') {
        if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = __DIR__ . '/uploads/';
            if (!is_dir($uploadDir)) mkdir($uploadDir, 0755, true);
            $ext = strtolower(pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION));
            $allowed = ['jpg','jpeg','png','webp','gif','avif'];
            if (!in_array($ext, $allowed)) {
                echo json_encode(['success' => false, 'message' => 'Format file tidak didukung.']);
                exit;
            }
            $filename = uniqid('team_', true) . '.' . $ext;
            $dest = $uploadDir . $filename;
            if (move_uploaded_file($_FILES['file']['tmp_name'], $dest)) {
                echo json_encode(['success' => true, 'path' => 'uploads/' . $filename]);
            } else {
                echo json_encode(['success' => false, 'message' => 'Gagal menyimpan file.']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Tidak ada file yang diupload.']);
        }
        exit;
    }

    $input = json_decode(file_get_contents('php://input'), true);
    
    if (isset($input['action']) || isset($_POST['action'])) {
        $action = $input['action'] ?? $_POST['action'];

        if ($useDb) {
            if ($action === 'login') {
                $stmt = $pdo->prepare("SELECT id, username, role, full_name, email, avatar FROM users WHERE username=? AND password=?");
                $stmt->execute([$input['username'] ?? '', $input['password'] ?? '']);
                $user = $stmt->fetch(PDO::FETCH_ASSOC);
                if ($user) {
                    echo json_encode(['success'=>true,'user'=>$user]);
                } else {
                    echo json_encode(['success'=>false,'message'=>'Username atau password salah']);
                }
                exit;
            }
            if ($action === 'update_profile') {
                $id = $input['id'];
                $full_name = $input['full_name'] ?? null;
                $email = $input['email'] ?? null;
                $password = $input['password'] ?? null;
                if ($password && $password !== '') {
                    $stmt = $pdo->prepare("UPDATE users SET full_name=?, email=?, password=? WHERE id=?");
                    $stmt->execute([$full_name, $email, $password, $id]);
                } else {
                    $stmt = $pdo->prepare("UPDATE users SET full_name=?, email=? WHERE id=?");
                    $stmt->execute([$full_name, $email, $id]);
                }
            } elseif ($action === 'upload_avatar') {
                $id = $_POST['user_id'] ?? null;
                if ($id && isset($_FILES['avatar'])) {
                    $dir = __DIR__ . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'avatars';
                    if (!is_dir($dir)) { @mkdir($dir, 0777, true); }
                    $fname = 'u' . $id . '_' . time() . '_' . preg_replace('/[^a-zA-Z0-9\.\-_]/','', $_FILES['avatar']['name']);
                    $path = $dir . DIRECTORY_SEPARATOR . $fname;
                    if (move_uploaded_file($_FILES['avatar']['tmp_name'], $path)) {
                        $rel = 'uploads/avatars/' . $fname;
                        $stmt = $pdo->prepare("UPDATE users SET avatar=? WHERE id=?");
                        $stmt->execute([$rel, $id]);
                        echo json_encode(['success'=>true,'data'=>allData($pdo)]);
                        exit;
                    }
                }
                echo json_encode(['success'=>false,'message'=>'Upload gagal']);
                exit;
            }
            if ($action === 'add') {
                $t = $input['task'];
                $stmt = $pdo->prepare("INSERT INTO tasks (title, date, priority, status, type, case_id, assigned_to) VALUES (?, ?, ?, ?, ?, ?, ?)");
                $stmt->execute([$t['title'] ?? '', $t['date'] ?? null, $t['priority'] ?? 'Sedang', $t['status'] ?? 'pending', $t['type'] ?? 'Sidang', $t['case_id'] ?? null, $t['assigned_to'] ?? null]);
            } elseif ($action === 'delete') {
                $stmt = $pdo->prepare("DELETE FROM tasks WHERE id=?");
                $stmt->execute([$input['id']]);
            } elseif ($action === 'toggle') {
                $stmt = $pdo->prepare("UPDATE tasks SET status = CASE WHEN status='pending' THEN 'completed' ELSE 'pending' END WHERE id=?");
                $stmt->execute([$input['id']]);
            } elseif ($action === 'add_case') {
                $c = $input['case'];
                $stmt = $pdo->prepare("INSERT INTO cases (title, client_id, client_name, status, description, court, case_number, start_date, assigned_to) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
                $stmt->execute([$c['title'] ?? '', null, $c['client_name'] ?? '', $c['status'] ?? 'Open', $c['description'] ?? '', $c['court'] ?? null, $c['case_number'] ?? null, $c['start_date'] ?? null, null]);
            } elseif ($action === 'delete_case') {
                $stmt = $pdo->prepare("DELETE FROM cases WHERE id=?");
                $stmt->execute([$input['id']]);
                $stmt = $pdo->prepare("DELETE FROM tasks WHERE case_id=?");
                $stmt->execute([$input['id']]);
            } elseif ($action === 'update_case_status') {
                $stmt = $pdo->prepare("UPDATE cases SET status=? WHERE id=?");
                $stmt->execute([$input['status'], $input['id']]);
            } elseif ($action === 'add_case_timeline') {
                $e = $input['entry'] ?? [];
                $stmt = $pdo->prepare("INSERT INTO case_timeline (case_id, date, activity, `by`) VALUES (?, ?, ?, ?)");
                $stmt->execute([$input['id'], $e['date'] ?? date('Y-m-d'), $e['activity'] ?? '', $e['by'] ?? 'system']);
            } elseif ($action === 'assign_case') {
                $stmt = $pdo->prepare("UPDATE cases SET assigned_to=? WHERE id=?");
                $stmt->execute([$input['user_id'], $input['id']]);
            } elseif ($action === 'add_document') {
                $d = $input['document'];
                $stmt = $pdo->prepare("INSERT INTO documents (title, type, case_id, date, uploaded_by) VALUES (?, ?, ?, ?, ?)");
                $stmt->execute([$d['title'] ?? '', $d['type'] ?? '', $d['case_id'] ?? null, $d['date'] ?? null, null]);
            } elseif ($action === 'delete_document') {
                $stmt = $pdo->prepare("DELETE FROM documents WHERE id=?");
                $stmt->execute([$input['id']]);
            } elseif ($action === 'add_court') {
                $name = trim($input['name'] ?? '');
                if ($name !== '') $pdo->prepare("INSERT IGNORE INTO courts (name) VALUES (?)")->execute([$name]);
            } elseif ($action === 'delete_court') {
                $pdo->prepare("DELETE FROM courts WHERE name=?")->execute([$input['name'] ?? '']);
            } elseif ($action === 'rename_court') {
                $old = $input['old_name'] ?? '';
                $new = trim($input['new_name'] ?? '');
                if ($old !== '' && $new !== '') {
                    $stmt = $pdo->prepare("UPDATE courts SET name=? WHERE name=?");
                    $stmt->execute([$new, $old]);
                }
            } elseif ($action === 'add_case_number') {
                $val = trim($input['value'] ?? '');
                if ($val !== '') $pdo->prepare("INSERT IGNORE INTO case_numbers (value) VALUES (?)")->execute([$val]);
            } elseif ($action === 'delete_case_number') {
                $pdo->prepare("DELETE FROM case_numbers WHERE value=?")->execute([$input['value'] ?? '']);
            } elseif ($action === 'add_start_date') {
                $date = trim($input['date'] ?? '');
                if ($date !== '') $pdo->prepare("INSERT IGNORE INTO start_dates (date) VALUES (?)")->execute([$date]);
            } elseif ($action === 'delete_start_date') {
                $pdo->prepare("DELETE FROM start_dates WHERE date=?")->execute([$input['date'] ?? '']);
            
            
            } elseif ($action === 'add_team') {
                $a = $input['team'];
                $stmt = $pdo->prepare("INSERT INTO teams (name, position, region, image) VALUES (?, ?, ?, ?)");
                $stmt->execute([$a['name'] ?? '', $a['position'] ?? '', $a['region'] ?? '', $a['image'] ?? '']);
            } elseif ($action === 'update_team') {
                $a = $input['team'];
                $stmt = $pdo->prepare("UPDATE teams SET name=?, position=?, region=?, image=? WHERE id=?");
                $stmt->execute([$a['name'] ?? '', $a['position'] ?? '', $a['region'] ?? '', $a['image'] ?? '', $a['id']]);
            } elseif ($action === 'delete_team') {
                $stmt = $pdo->prepare("DELETE FROM teams WHERE id=?");
                $stmt->execute([$input['id']]);
            } elseif ($action === 'add_gallery') {
                $a = $input['gallery'];
                $stmt = $pdo->prepare("INSERT INTO gallery (image, css_class) VALUES (?, ?)");
                $stmt->execute([$a['image'] ?? '', $a['css_class'] ?? '']);
            } elseif ($action === 'delete_gallery') {
                $stmt = $pdo->prepare("DELETE FROM gallery WHERE id=?");
                $stmt->execute([$input['id']]);

            } elseif ($action === 'add_article') {
                $a = $input['article'];
                $stmt = $pdo->prepare("INSERT INTO articles (category, title, content, image, created_at) VALUES (?, ?, ?, ?, ?)");
                $stmt->execute([$a['category'] ?? '', $a['title'] ?? '', $a['content'] ?? '', $a['image'] ?? '', date('Y-m-d')]);
            } elseif ($action === 'update_article') {
                $a = $input['article'];
                $stmt = $pdo->prepare("UPDATE articles SET category=?, title=?, content=?, image=? WHERE id=?");
                $stmt->execute([$a['category'] ?? '', $a['title'] ?? '', $a['content'] ?? '', $a['image'] ?? '', $a['id']]);
            } elseif ($action === 'delete_article') {
                $stmt = $pdo->prepare("DELETE FROM articles WHERE id=?");
                $stmt->execute([$input['id']]);
} elseif ($action === 'create_user') {
                $u = $input['user'];
                $stmt = $pdo->prepare("INSERT INTO users (username, password, role, full_name, email) VALUES (?, ?, ?, ?, ?)");
                $stmt->execute([$u['username'] ?? '', $u['password'] ?? '', $u['role'] ?? 'lawyer', $u['full_name'] ?? '', $u['email'] ?? '']);
            } elseif ($action === 'update_user') {
                $u = $input['user'];
                if (isset($u['password']) && $u['password'] !== '') {
                    $stmt = $pdo->prepare("UPDATE users SET username=?, password=?, role=?, full_name=?, email=? WHERE id=?");
                    $stmt->execute([$u['username'] ?? '', $u['password'] ?? '', $u['role'] ?? 'lawyer', $u['full_name'] ?? '', $u['email'] ?? '', $u['id']]);
                } else {
                    $stmt = $pdo->prepare("UPDATE users SET username=?, role=?, full_name=?, email=? WHERE id=?");
                    $stmt->execute([$u['username'] ?? '', $u['role'] ?? 'lawyer', $u['full_name'] ?? '', $u['email'] ?? '', $u['id']]);
                }
            } elseif ($action === 'delete_user') {
                $stmt = $pdo->prepare("DELETE FROM users WHERE id=?");
                $stmt->execute([$input['id']]);
            }
            echo json_encode(['success'=>true,'data'=>allData($pdo)]);
            exit;
        }
        // --- AUTH ---
        if ($action === 'login') {
            $username = $input['username'] ?? '';
            $password = $input['password'] ?? '';
            
            $user = null;
            foreach ($data['users'] as $u) {
                if ($u['username'] === $username && $u['password'] === $password) {
                    $user = $u;
                    break;
                }
            }
            
            if ($user) {
                // Remove password from response
                unset($user['password']);
                echo json_encode(['success' => true, 'user' => $user]);
            } else {
                echo json_encode(['success' => false, 'message' => 'Username atau password salah']);
            }
            exit;
        }
        if (isset($_POST['action']) && $_POST['action'] === 'upload_avatar' && isset($_FILES['avatar'])) {
            $id = $_POST['user_id'] ?? null;
            if ($id) {
                $dir = __DIR__ . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'avatars';
                if (!is_dir($dir)) { @mkdir($dir, 0777, true); }
                $fname = 'u' . $id . '_' . time() . '_' . preg_replace('/[^a-zA-Z0-9\.\-_]/','', $_FILES['avatar']['name']);
                $path = $dir . DIRECTORY_SEPARATOR . $fname;
                if (move_uploaded_file($_FILES['avatar']['tmp_name'], $path)) {
                    foreach ($data['users'] as &$uu) {
                        if ($uu['id'] == $id) {
                            $uu['avatar'] = 'uploads/avatars/' . $fname;
                            break;
                        }
                    }
                    file_put_contents($file, json_encode($data, JSON_PRETTY_PRINT));
                    echo json_encode(['success'=>true, 'data'=>$data]);
                    exit;
                }
            }
            echo json_encode(['success'=>false, 'message'=>'Upload gagal']);
            exit;
        }
        if ($action === 'update_profile') {
            $id = $input['id'];
            foreach ($data['users'] as &$uu) {
                if ($uu['id'] == $id) {
                    if (isset($input['full_name'])) $uu['full_name'] = $input['full_name'];
                    if (isset($input['email'])) $uu['email'] = $input['email'];
                    if (isset($input['password']) && $input['password'] !== '') $uu['password'] = $input['password'];
                    break;
                }
            }
            file_put_contents($file, json_encode($data, JSON_PRETTY_PRINT));
            echo json_encode(['success'=>true, 'data'=>$data]);
            exit;
        }
        
        // Masters
        if ($action === 'add_court') {
            $name = trim($input['name'] ?? '');
            if ($name !== '' && !in_array($name, $data['courts'])) {
                $data['courts'][] = $name;
            }
        } elseif ($action === 'delete_court') {
            $name = $input['name'] ?? '';
            $data['courts'] = array_values(array_filter($data['courts'], function($c) use ($name) { return $c !== $name; }));
        } elseif ($action === 'rename_court') {
            $old = $input['old_name'] ?? '';
            $new = trim($input['new_name'] ?? '');
            if ($old !== '' && $new !== '' && in_array($old, $data['courts']) && !in_array($new, $data['courts'])) {
                $data['courts'] = array_map(function($c) use ($old, $new) { return $c === $old ? $new : $c; }, $data['courts']);
            }
        } elseif ($action === 'add_case_number') {
            $val = trim($input['value'] ?? '');
            if ($val !== '' && !in_array($val, $data['case_numbers'])) {
                $data['case_numbers'][] = $val;
            }
        } elseif ($action === 'delete_case_number') {
            $val = $input['value'] ?? '';
            $data['case_numbers'] = array_values(array_filter($data['case_numbers'], function($c) use ($val) { return $c !== $val; }));
        } elseif ($action === 'add_start_date') {
            $date = trim($input['date'] ?? '');
            if ($date !== '' && !in_array($date, $data['start_dates'])) {
                $data['start_dates'][] = $date;
            }
        } elseif ($action === 'delete_start_date') {
            $date = $input['date'] ?? '';
            $data['start_dates'] = array_values(array_filter($data['start_dates'], function($d) use ($date) { return $d !== $date; }));
        }
        elseif ($action === 'create_user') {
            $u = $input['user'];
            $u['id'] = time();
            $data['users'][] = $u;
        } elseif ($action === 'update_user') {
            $u = $input['user'];
            foreach ($data['users'] as &$x) {
                if ($x['id'] == $u['id']) { $x = array_merge($x, $u); break; }
            }
        } elseif ($action === 'delete_user') {
            $idToDelete = $input['id'];
            $data['users'] = array_values(array_filter($data['users'], function($x) use ($idToDelete) { return $x['id'] != $idToDelete; }));
        } elseif ($action === 'add_article') {
            $a = $input['article'];
            $a['id'] = time();
            $a['created_at'] = date('Y-m-d');
            $data['articles'][] = $a;
        } elseif ($action === 'update_article') {
            $a = $input['article'];
            foreach ($data['articles'] as &$x) {
                if ($x['id'] == $a['id']) {
                    $x['title'] = $a['title'] ?? $x['title'];
                    $x['category'] = $a['category'] ?? $x['category'];
                    $x['content'] = $a['content'] ?? $x['content'];
                    $x['image'] = $a['image'] ?? $x['image'];
                    break;
                }
            }
        } elseif ($action === 'delete_article') {
            $idToDelete = $input['id'];
            $data['articles'] = array_values(array_filter($data['articles'], function($a) use ($idToDelete) {
                return $a['id'] != $idToDelete;
            }));

        // --- TEAMS ---
        } elseif ($action === 'add_team') {
            if (!isset($data['teams'])) $data['teams'] = [];
            $t = $input['team'];
            $t['id'] = time() . rand(100,999);
            $data['teams'][] = $t;
        } elseif ($action === 'update_team') {
            $t = $input['team'];
            foreach ($data['teams'] as &$x) {
                if ($x['id'] == $t['id']) {
                    $x['name']     = $t['name']     ?? $x['name'];
                    $x['position'] = $t['position'] ?? $x['position'];
                    $x['region']   = $t['region']   ?? $x['region'];
                    $x['image']    = $t['image']    ?? $x['image'];
                    break;
                }
            }
            unset($x);
        } elseif ($action === 'delete_team') {
            $idToDelete = $input['id'];
            $data['teams'] = array_values(array_filter($data['teams'] ?? [], function($t) use ($idToDelete) {
                return $t['id'] != $idToDelete;
            }));

        // --- GALLERY ---
        } elseif ($action === 'add_gallery') {
            if (!isset($data['gallery'])) $data['gallery'] = [];
            $g = $input['gallery'];
            $g['id'] = time() . rand(100,999);
            $data['gallery'][] = $g;
        } elseif ($action === 'delete_gallery') {
            $idToDelete = $input['id'];
            $data['gallery'] = array_values(array_filter($data['gallery'] ?? [], function($g) use ($idToDelete) {
                return $g['id'] != $idToDelete;
            }));
        }
        
        // --- TASKS ---
        elseif ($action === 'add') {
            $newTask = $input['task'];
            $newTask['id'] = time();
            $data['tasks'][] = $newTask;
        } elseif ($action === 'delete') {
            $idToDelete = $input['id'];
            $data['tasks'] = array_values(array_filter($data['tasks'], function($t) use ($idToDelete) {
                return $t['id'] != $idToDelete;
            }));
        } elseif ($action === 'toggle') {
            $idToToggle = $input['id'];
            foreach ($data['tasks'] as &$task) {
                if ($task['id'] == $idToToggle) {
                    $task['status'] = ($task['status'] === 'pending') ? 'completed' : 'pending';
                    break;
                }
            }
        } 
        
        // --- CASES ---
        elseif ($action === 'add_case') {
            $newCase = $input['case'];
            $newCase['id'] = time();
            if (!isset($newCase['client_name']) && isset($newCase['client'])) {
                $newCase['client_name'] = $newCase['client'];
                unset($newCase['client']);
            }
            if (!isset($newCase['timeline'])) $newCase['timeline'] = [];
            if (!isset($newCase['assigned_to'])) $newCase['assigned_to'] = null;
            $data['cases'][] = $newCase;
        } elseif ($action === 'delete_case') {
            $idToDelete = $input['id'];
            $data['cases'] = array_values(array_filter($data['cases'], function($c) use ($idToDelete) {
                return $c['id'] != $idToDelete;
            }));
            $data['tasks'] = array_values(array_filter($data['tasks'], function($t) use ($idToDelete) {
                return !isset($t['case_id']) || $t['case_id'] != $idToDelete;
            }));
        } elseif ($action === 'update_case_status') {
            $idToUpdate = $input['id'];
            $newStatus = $input['status'];
            foreach ($data['cases'] as &$c) {
                if ($c['id'] == $idToUpdate) {
                    $c['status'] = $newStatus;
                    break;
                }
            }
        } elseif ($action === 'add_case_timeline') {
            $idToUpdate = $input['id'];
            $entry = $input['entry'] ?? [];
            foreach ($data['cases'] as &$c) {
                if ($c['id'] == $idToUpdate) {
                    if (!isset($c['timeline']) || !is_array($c['timeline'])) $c['timeline'] = [];
                    $c['timeline'][] = [
                        'date' => $entry['date'] ?? date('Y-m-d'),
                        'activity' => $entry['activity'] ?? '',
                        'by' => $entry['by'] ?? 'system'
                    ];
                    break;
                }
            }
        } elseif ($action === 'assign_case') {
            $idToUpdate = $input['id'];
            $userId = $input['user_id'];
            foreach ($data['cases'] as &$c) {
                if ($c['id'] == $idToUpdate) {
                    $c['assigned_to'] = $userId;
                    break;
                }
            }
        }

        // --- DOCUMENTS ---
        elseif ($action === 'add_document') {
            $newDoc = $input['document'];
            $newDoc['id'] = time();
            $data['documents'][] = $newDoc;
        } elseif ($action === 'delete_document') {
            $idToDelete = $input['id'];
            $data['documents'] = array_values(array_filter($data['documents'], function($d) use ($idToDelete) {
                return $d['id'] != $idToDelete;
            }));
        }
        
        // Update stats
        $total = count($data['tasks']);
        $pending = count(array_filter($data['tasks'], function($t) { return $t['status'] === 'pending'; }));
        $completed = $total - $pending;
        
        $data['stats'] = [
            'total' => $total,
            'pending' => $pending,
            'completed' => $completed
        ];

        file_put_contents($file, json_encode($data, JSON_PRETTY_PRINT));
        echo json_encode(['success' => true, 'data' => $data]);
        exit;
    }
}
?>
