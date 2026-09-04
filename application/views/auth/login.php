<!DOCTYPE html>
<html lang="id">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>PT Joko Abadi Jaya - Login</title>
	<style>
		* { box-sizing: border-box; margin: 0; padding: 0; }
		body {
			font-family: 'Segoe UI', Arial, sans-serif;
			background: linear-gradient(135deg, #1f2937, #111827);
			min-height: 100vh;
			display: flex;
			flex-direction: column;
			align-items: center;
			justify-content: center;
			padding: 20px;
		}
		.card {
			background: #ffffff;
			width: 100%;
			max-width: 380px;
			border-radius: 14px;
			box-shadow: 0 20px 40px rgba(0,0,0,0.35);
			padding: 36px 32px;
		}
		.logo-wrap {
			display: flex;
			flex-direction: column;
			align-items: center;
			margin-bottom: 22px;
		}
		.logo-circle {
			width: 52px;
			height: 52px;
			border-radius: 50%;
			background: linear-gradient(135deg, #4f46e5, #4338ca);
			display: flex;
			align-items: center;
			justify-content: center;
			margin-bottom: 12px;
			box-shadow: 0 6px 14px rgba(79,70,229,0.35);
		}
		.logo-circle svg {
			width: 24px;
			height: 24px;
			fill: #ffffff;
		}
		.company {
			font-size: 15px;
			font-weight: 700;
			color: #111827;
			letter-spacing: 0.3px;
		}
		.company-sub {
			font-size: 12px;
			color: #9ca3af;
			margin-top: 2px;
		}
		h2 {
			font-size: 20px;
			color: #111827;
			text-align: center;
			margin-bottom: 4px;
		}
		.subtitle {
			font-size: 13px;
			color: #6b7280;
			text-align: center;
			margin-bottom: 22px;
		}
		.alert {
			background: #fee2e2;
			color: #b91c1c;
			border: 1px solid #fecaca;
			border-radius: 8px;
			padding: 10px 12px;
			font-size: 13px;
			margin-bottom: 16px;
		}
		label {
			display: block;
			font-size: 13px;
			font-weight: 600;
			color: #374151;
			margin-bottom: 6px;
			margin-top: 14px;
		}
		input[type="text"],
		input[type="password"] {
			width: 100%;
			padding: 10px 12px;
			border: 1px solid #d1d5db;
			border-radius: 8px;
			font-size: 14px;
			outline: none;
			transition: border-color 0.15s, box-shadow 0.15s;
		}
		input[type="text"]:focus,
		input[type="password"]:focus {
			border-color: #6366f1;
			box-shadow: 0 0 0 3px rgba(99,102,241,0.15);
		}
		button {
			width: 100%;
			margin-top: 24px;
			padding: 11px;
			border: none;
			border-radius: 8px;
			background: #4f46e5;
			color: #fff;
			font-size: 14px;
			font-weight: 600;
			cursor: pointer;
			transition: background 0.15s, transform 0.1s;
		}
		button:hover { background: #4338ca; }
		button:active { transform: scale(0.98); }
		.footer {
			margin-top: 20px;
			text-align: center;
			font-size: 11px;
			color: rgba(255,255,255,0.4);
		}
	</style>
</head>
<body>
	<div class="card">
		<div class="logo-wrap">
			<div class="logo-circle">
				<svg viewBox="0 0 24 24"><path d="M12 1a5 5 0 00-5 5v3H6a2 2 0 00-2 2v9a2 2 0 002 2h12a2 2 0 002-2v-9a2 2 0 00-2-2h-1V6a5 5 0 00-5-5zm-3 8V6a3 3 0 016 0v3H9zm3 4a2 2 0 012 2c0 .74-.4 1.38-1 1.72V19a1 1 0 01-2 0v-1.28a2 2 0 011-3.72z"/></svg>
			</div>
			<div class="company">PT JOKO ABADI JAYA</div>
			<div class="company-sub">Internal System Portal</div>
		</div>

		<h2>Masuk ke Akun Anda</h2>
		<p class="subtitle">Silakan login menggunakan akun perusahaan Anda</p>

		<?php if ($this->session->flashdata('error')): ?>
			<div class="alert"><?php echo $this->session->flashdata('error'); ?></div>
		<?php endif; ?>

		<form action="<?php echo base_url('auth/login'); ?>" method="post">
			<label for="username">Username</label>
			<input type="text" id="username" name="username" placeholder="Masukkan username" autocomplete="off">

			<label for="password">Password</label>
			<input type="password" id="password" name="password" placeholder="Masukkan password">

			<button type="submit">Login</button>
		</form>
	</div>
	<p class="footer">&copy; 2026 PT Joko Abadi Jaya &mdash; Internal Use Only</p>
</body>
</html>