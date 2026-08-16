<?php require __DIR__ . '/../config.php'; ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - Administration ACONOQ</title>
    <link rel="icon" href="../aconoq_logo.png" type="image/png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/@supabase/supabase-js@2"></script>
    <style>
        body {
            min-height: 100vh;
            background: linear-gradient(135deg, #0f7140 0%, #0a5c32 50%, #073d21 100%);
        }
        .login-card {
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.95);
        }
        .input-group {
            position: relative;
        }
        .input-group .icon {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: #9ca3af;
            transition: color 0.2s;
        }
        .input-group input:focus ~ .icon,
        .input-group input:focus + .icon {
            color: #0f7140;
        }
        .btn-login {
            background: #0f7140;
            transition: all 0.3s ease;
        }
        .btn-login:hover:not(:disabled) {
            background: #0a5c32;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(15, 113, 64, 0.4);
        }
        .btn-login:disabled {
            opacity: 0.7;
            cursor: not-allowed;
        }
        .spinner {
            display: inline-block;
            width: 20px;
            height: 20px;
            border: 3px solid rgba(255,255,255,0.3);
            border-radius: 50%;
            border-top-color: #fff;
            animation: spin 0.8s linear infinite;
        }
        @keyframes spin {
            to { transform: rotate(360deg); }
        }
        .fade-in {
            animation: fadeIn 0.5s ease-out;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .view { display: none; }
        .view.active { display: block; }
    </style>
</head>
<body class="flex items-center justify-center p-4">

    <div class="login-card w-full max-w-md rounded-2xl shadow-2xl p-8 fade-in">

        <div class="text-center mb-8">
            <img src="https://www.aconoq-apps.com/aconoq/wp-content/uploads/2020/07/aconoq_logo.png"
                 alt="ACONOQ Logo"
                 class="mx-auto mb-4 h-16 object-contain">
            <h1 id="view-title" class="text-2xl font-bold text-gray-800">Administration ACONOQ</h1>
            <p id="view-subtitle" class="text-gray-500 text-sm mt-1">Connectez-vous pour acc&eacute;der au tableau de bord</p>
        </div>

        <div id="error-message" class="hidden mb-4 p-3 rounded-lg bg-red-50 border border-red-200 text-red-700 text-sm">
            <div class="flex items-center gap-2">
                <i class="fas fa-exclamation-circle"></i>
                <span id="error-text"></span>
            </div>
        </div>

        <div id="success-message" class="hidden mb-4 p-3 rounded-lg bg-green-50 border border-green-200 text-green-700 text-sm">
            <div class="flex items-center gap-2">
                <i class="fas fa-check-circle"></i>
                <span id="success-text"></span>
            </div>
        </div>

        <!-- ===== VIEW: LOGIN ===== -->
        <div id="view-login" class="view active">
            <form id="login-form" class="space-y-5">
                <div class="input-group">
                    <input type="email"
                           id="email"
                           placeholder="Adresse e-mail"
                           required
                           autocomplete="email"
                           class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-600 focus:border-transparent outline-none transition text-gray-800">
                    <i class="fas fa-envelope icon"></i>
                </div>

                <div class="input-group">
                    <input type="password"
                           id="password"
                           placeholder="Mot de passe"
                           required
                           autocomplete="current-password"
                           class="w-full pl-10 pr-10 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-600 focus:border-transparent outline-none transition text-gray-800">
                    <i class="fas fa-lock icon"></i>
                    <button type="button"
                            id="toggle-password"
                            class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 transition"
                            tabindex="-1">
                        <i class="fas fa-eye" id="eye-icon"></i>
                    </button>
                </div>

                <div class="text-right">
                    <button type="button" id="show-forgot" class="text-sm text-gray-500 hover:text-green-700 transition">
                        <i class="fas fa-key mr-1"></i> Mot de passe oubli&eacute; ?
                    </button>
                </div>

                <button type="submit"
                        id="login-btn"
                        class="btn-login w-full text-white font-semibold py-3 rounded-lg flex items-center justify-center gap-2">
                    <i class="fas fa-sign-in-alt"></i>
                    <span id="btn-text">Se connecter</span>
                    <span id="btn-spinner" class="spinner hidden"></span>
                </button>
            </form>
        </div>

        <!-- ===== VIEW: FORGOT PASSWORD ===== -->
        <div id="view-forgot" class="view">
            <form id="forgot-form" class="space-y-5">
                <div class="input-group">
                    <input type="email"
                           id="forgot-email"
                           placeholder="Votre adresse e-mail"
                           required
                           autocomplete="email"
                           class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-600 focus:border-transparent outline-none transition text-gray-800">
                    <i class="fas fa-envelope icon"></i>
                </div>

                <button type="submit"
                        id="forgot-btn"
                        class="btn-login w-full text-white font-semibold py-3 rounded-lg flex items-center justify-center gap-2">
                    <i class="fas fa-paper-plane"></i>
                    <span id="forgot-btn-text">Envoyer le lien</span>
                    <span id="forgot-btn-spinner" class="spinner hidden"></span>
                </button>
            </form>

            <div class="mt-4 text-center">
                <button type="button" id="show-login" class="text-sm text-gray-500 hover:text-green-700 transition">
                    <i class="fas fa-arrow-left mr-1"></i> Retour &agrave; la connexion
                </button>
            </div>
        </div>

        <div class="mt-6 text-center">
            <a href="../index.php" class="text-sm text-gray-500 hover:text-green-700 transition">
                <i class="fas fa-arrow-left mr-1"></i> Retour au site
            </a>
        </div>
    </div>

    <script>
        const SUPABASE_URL = '<?php echo SUPABASE_URL; ?>';
        const SUPABASE_ANON_KEY = '<?php echo SUPABASE_ANON_KEY; ?>';
        const supabaseClient = supabase.createClient(SUPABASE_URL, SUPABASE_ANON_KEY);

        // Elements
        const viewTitle = document.getElementById('view-title');
        const viewSubtitle = document.getElementById('view-subtitle');
        const viewLogin = document.getElementById('view-login');
        const viewForgot = document.getElementById('view-forgot');
        const errorMsg = document.getElementById('error-message');
        const errorText = document.getElementById('error-text');
        const successMsg = document.getElementById('success-message');
        const successText = document.getElementById('success-text');

        // Auth check
        (async () => {
            const { data: { session } } = await supabaseClient.auth.getSession();
            if (session) window.location.href = 'dashboard.php';
        })();

        // View switching
        function showView(view) {
            hideMessages();
            viewLogin.classList.remove('active');
            viewForgot.classList.remove('active');
            if (view === 'login') {
                viewLogin.classList.add('active');
                viewTitle.textContent = 'Administration ACONOQ';
                viewSubtitle.textContent = 'Connectez-vous pour acc\u00e9der au tableau de bord';
            } else {
                viewForgot.classList.add('active');
                viewTitle.textContent = 'Mot de passe oubli\u00e9';
                viewSubtitle.textContent = 'Entrez votre e-mail pour recevoir un lien de r\u00e9initialisation';
            }
        }

        function hideMessages() {
            errorMsg.classList.add('hidden');
            successMsg.classList.add('hidden');
        }

        function showError(msg) {
            errorText.textContent = msg;
            errorMsg.classList.remove('hidden');
            successMsg.classList.add('hidden');
        }

        function showSuccess(msg) {
            successText.innerHTML = msg;
            successMsg.classList.remove('hidden');
            errorMsg.classList.add('hidden');
        }

        // Toggle password visibility
        document.getElementById('toggle-password').addEventListener('click', () => {
            const inp = document.getElementById('password');
            const icon = document.getElementById('eye-icon');
            const isP = inp.type === 'password';
            inp.type = isP ? 'text' : 'password';
            icon.className = isP ? 'fas fa-eye-slash' : 'fas fa-eye';
        });

        // Switch views
        document.getElementById('show-forgot').addEventListener('click', () => {
            const email = document.getElementById('email').value.trim();
            showView('forgot');
            const forgotEmail = document.getElementById('forgot-email');
            if (email) forgotEmail.value = email;
            forgotEmail.focus();
        });
        document.getElementById('show-login').addEventListener('click', () => showView('login'));

        // Login form
        document.getElementById('login-form').addEventListener('submit', async (e) => {
            e.preventDefault();
            hideMessages();
            const email = document.getElementById('email').value.trim();
            const password = document.getElementById('password').value;
            if (!email || !password) { showError('Veuillez remplir tous les champs.'); return; }

            const btn = document.getElementById('login-btn');
            const txt = document.getElementById('btn-text');
            const spn = document.getElementById('btn-spinner');
            btn.disabled = true; txt.classList.add('hidden'); spn.classList.remove('hidden');

            try {
                const { data, error } = await supabaseClient.auth.signInWithPassword({ email, password });
                if (error) {
                    let msg = 'Erreur de connexion.';
                    if (error.message.includes('Invalid login credentials')) msg = 'Adresse e-mail ou mot de passe incorrect.';
                    else if (error.message.includes('Email not confirmed')) msg = 'Veuillez confirmer votre adresse e-mail.';
                    else if (error.message.includes('Too many requests')) msg = 'Trop de tentatives. R\u00e9essayez plus tard.';
                    showError(msg);
                } else if (data.session) {
                    sessionStorage.setItem('aconoq_access_token', data.session.access_token);
                    window.location.href = 'auth-callback.php?token=' + encodeURIComponent(data.session.access_token);
                }
            } catch (err) {
                showError('Une erreur inattendue est survenue. V\u00e9rifiez votre connexion.');
            }
            btn.disabled = false; txt.classList.remove('hidden'); spn.classList.add('hidden');
        });

        // Forgot password form
        document.getElementById('forgot-form').addEventListener('submit', async (e) => {
            e.preventDefault();
            hideMessages();
            const email = document.getElementById('forgot-email').value.trim();
            if (!email) { showError('Veuillez entrer votre adresse e-mail.'); return; }

            const btn = document.getElementById('forgot-btn');
            const txt = document.getElementById('forgot-btn-text');
            const spn = document.getElementById('forgot-btn-spinner');
            btn.disabled = true; txt.classList.add('hidden'); spn.classList.remove('hidden');

            const REDIRECT_URL = window.location.origin + '/admin/login.php';
            const { error } = await supabaseClient.auth.resetPasswordForEmail(email, {
                redirectTo: REDIRECT_URL
            });

            if (error) {
                showError('Erreur : ' + error.message);
            } else {
                showSuccess('Un lien de r\u00e9initialisation a \u00e9t\u00e9 envoy\u00e9 \u00e0 <strong>' + email + '</strong>. V\u00e9rifiez votre bo\u00eete de r\u00e9ception.');
            }
            btn.disabled = false; txt.classList.remove('hidden'); spn.classList.add('hidden');
        });
    </script>
</body>
</html>
