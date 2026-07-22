<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AutoChain EmmaPlus - Connexion Sécurisée</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
            background: linear-gradient(135deg, #0b1120 0%, #0f172a 50%, #1a1a3e 100%);
            color: #f8fafc;
            margin: 0;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
            overflow: hidden;
        }
        body::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(ellipse at 20% 50%, rgba(56, 189, 248, 0.05) 0%, transparent 50%),
                        radial-gradient(ellipse at 80% 50%, rgba(99, 102, 241, 0.05) 0%, transparent 50%);
            pointer-events: none;
        }
        .login-card {
            background: rgba(15, 23, 42, 0.9);
            backdrop-filter: blur(20px);
            padding: 45px 40px;
            border-radius: 16px;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.5);
            width: 100%;
            max-width: 440px;
            border: 1px solid rgba(56, 189, 248, 0.1);
            position: relative;
            z-index: 1;
        }
        .brand {
            text-align: center;
            margin-bottom: 30px;
        }
        .brand-icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 56px;
            height: 56px;
            background: rgba(56, 189, 248, 0.15);
            border-radius: 14px;
            margin-bottom: 16px;
        }
        h1 {
            color: #f1f5f9;
            text-align: center;
            font-size: 22px;
            font-weight: 700;
            margin-bottom: 4px;
        }
        .subtitle {
            text-align: center;
            color: #64748b;
            font-size: 14px;
            margin-bottom: 30px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        label {
            display: flex;
            align-items: center;
            gap: 6px;
            margin-bottom: 8px;
            color: #94a3b8;
            font-size: 13px;
            font-weight: 500;
        }
        label svg { width: 14px; height: 14px; flex-shrink: 0; }
        input, select {
            width: 100%;
            padding: 12px 14px;
            border: 1px solid #334155;
            background: #0b1120;
            color: #f1f5f9;
            border-radius: 10px;
            font-size: 14px;
            box-sizing: border-box;
            outline: none;
            transition: all 0.2s;
        }
        input:focus, select:focus {
            border-color: #38bdf8;
            box-shadow: 0 0 0 3px rgba(56, 189, 248, 0.1);
        }
        button {
            background: linear-gradient(135deg, #38bdf8, #6366f1);
            color: white;
            padding: 13px;
            border: none;
            border-radius: 10px;
            width: 100%;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            margin-top: 8px;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }
        button:hover {
            transform: translateY(-1px);
            box-shadow: 0 8px 20px rgba(56, 189, 248, 0.3);
        }
        .footer-text {
            text-align: center;
            margin-top: 24px;
            font-size: 13px;
            color: #475569;
        }
        .divider {
            display: flex;
            align-items: center;
            gap: 12px;
            margin: 24px 0;
            color: #334155;
            font-size: 12px;
        }
        .divider::before, .divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: #334155;
        }
        .wallet-btn {
            background: transparent;
            border: 1px solid #334155;
            color: #94a3b8;
            padding: 11px;
            border-radius: 10px;
            width: 100%;
            font-size: 14px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: all 0.2s;
            margin-top: 0;
        }
        .wallet-btn:hover {
            border-color: #38bdf8;
            color: #f1f5f9;
            background: rgba(56, 189, 248, 0.05);
            transform: none;
            box-shadow: none;
        }
    </style>
</head>
<body>
    <div class="login-card">
        <div class="brand">
            <div class="brand-icon">
                <svg viewBox="0 0 24 24" width="28" height="28" fill="none" stroke="#38bdf8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
            </div>
            <h1>AutoChain EmmaPlus</h1>
            <div class="subtitle">Plateforme de Gestion de Parc Automobile — Blockchain & Rôles</div>
        </div>

        <form action="{{ route('login.submit') }}" method="POST">
            @csrf

            @if(session('error'))
                <div style="background:rgba(248,113,113,0.15);color:#f87171;padding:12px 16px;border-radius:8px;margin-bottom:16px;font-size:13px;border:1px solid rgba(248,113,113,0.2);display:flex;align-items:center;gap:8px;">
                    <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="15" y1="9" x2="9" y2="15"/><line x1="9" y1="9" x2="15" y2="15"/></svg>
                    {{ session('error') }}
                </div>
            @endif

            @if(session('bloque'))
                <div style="background:rgba(248,113,113,0.15);color:#f87171;padding:14px 16px;border-radius:8px;margin-bottom:16px;font-size:13px;border:1px solid rgba(248,113,113,0.3);line-height:1.6;">
                    <div style="display:flex;align-items:flex-start;gap:8px;">
                        <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" style="flex-shrink:0;margin-top:2px;"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                        <span>{{ session('bloque') }}</span>
                    </div>
                </div>
            @endif

            <div class="form-group">
                <label>
                    <svg viewBox="0 0 24 24" fill="none" stroke="#64748b" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                    Adresse Email
                </label>
                <input type="email" name="email" required placeholder="e.g., bikoumoutheresa@gmail.com">
            </div>

            <div class="form-group">
                <label>
                    <svg viewBox="0 0 24 24" fill="none" stroke="#64748b" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                    Adresse Wallet (Ethereum)
                </label>
                <input type="text" name="wallet" required placeholder="e.g., 0x...">
            </div>

            <button type="submit">
                <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"/><polyline points="10 17 15 12 10 7"/><line x1="15" y1="12" x2="3" y2="12"/></svg>
                Se connecter
            </button>
        </form>

        @if(session('demande_envoyee'))
            <div style="background:rgba(74,222,128,0.15);color:#4ade80;padding:14px 16px;border-radius:8px;margin-top:20px;font-size:13px;border:1px solid rgba(74,222,128,0.2);line-height:1.6;">
                <div style="display:flex;align-items:flex-start;gap:8px;">
                    <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" style="flex-shrink:0;margin-top:2px;"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                    <span>{{ session('demande_envoyee') }}</span>
                </div>
            </div>
        @endif

        <div class="divider"></div>
        <div class="footer-text">
            <strong>Compte créé uniquement par la Directrice Générale</strong><br>
            <span style="color:#64748b;font-size:12px;">Contactez BIKOUMOU Theresa Dinilie — Tél: <strong style="color:#94a3b8;">053909481</strong> | Email: <strong style="color:#94a3b8;">bikoumoutheresa@gmail.com</strong></span>
        </div>
    </div>
</body>
</html>

