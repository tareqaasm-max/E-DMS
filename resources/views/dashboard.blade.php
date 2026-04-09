<!doctype html>
<html lang="en" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-DMS Dashboard</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; background: #f5f7fa; }
        .layout { display: grid; grid-template-columns: 260px 1fr; min-height: 100vh; }
        .sidebar { background: #1f2937; color: #fff; padding: 20px; }
        .content { padding: 20px; }
        .cards { display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 16px; }
        .card { background: #fff; border-radius: 12px; padding: 16px; box-shadow: 0 2px 8px rgba(0,0,0,.06); }
    </style>
</head>
<body>
<div class="layout">
    <aside class="sidebar">
        <h2>E-DMS</h2>
        <p>Engineering Document Control</p>
    </aside>
    <main class="content">
        <h1>Dashboard</h1>
        <div class="cards">
            <div class="card">Projects: {{ $stats['projects'] ?? 0 }}</div>
            <div class="card">Pending approvals: {{ $stats['pending_approvals'] ?? 0 }}</div>
            <div class="card">Documents: {{ $stats['documents'] ?? 0 }}</div>
            <div class="card">Overdue: {{ $stats['overdue'] ?? 0 }}</div>
        </div>
    </main>
</div>
</body>
</html>
