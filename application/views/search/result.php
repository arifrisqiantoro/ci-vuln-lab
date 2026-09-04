<!DOCTYPE html>
<html lang="id">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>User Search</title>
	<style>
		* { margin: 0; padding: 0; box-sizing: border-box; }

		body {
			font-family: 'Segoe UI', Roboto, Arial, sans-serif;
			background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
			min-height: 100vh;
			padding: 40px 20px;
			display: flex;
			justify-content: center;
		}

		.container {
			background: #fff;
			border-radius: 16px;
			box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
			width: 100%;
			max-width: 560px;
			overflow: hidden;
		}

		.header {
			background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
			padding: 28px 24px;
			color: #fff;
		}

		.header h2 { font-size: 20px; font-weight: 600; margin-bottom: 4px; }
		.header p { font-size: 13px; opacity: 0.85; }

		.search-form {
			display: flex;
			gap: 8px;
			padding: 20px 24px;
			background: #f8f9fb;
			border-bottom: 1px solid #eee;
		}

		.search-form input[type="text"] {
			flex: 1;
			padding: 10px 14px;
			border: 1px solid #ddd;
			border-radius: 8px;
			font-size: 14px;
			outline: none;
			transition: border-color 0.2s;
		}

		.search-form input[type="text"]:focus {
			border-color: #764ba2;
		}

		.search-form input[type="submit"] {
			padding: 10px 20px;
			border: none;
			border-radius: 8px;
			background: #764ba2;
			color: #fff;
			font-weight: 600;
			font-size: 14px;
			cursor: pointer;
			transition: background 0.2s;
		}

		.search-form input[type="submit"]:hover {
			background: #5f3a85;
		}

		.result-info {
			padding: 16px 24px 0;
			font-size: 13px;
			color: #888;
		}

		.result-info strong { color: #444; }

		.result-list {
			list-style: none;
			padding: 12px 24px 24px;
		}

		.result-list li {
			display: flex;
			align-items: center;
			gap: 12px;
			padding: 12px 14px;
			border-radius: 10px;
			margin-top: 8px;
			background: #f8f9fb;
			border: 1px solid #f0f0f0;
			font-size: 14px;
		}

		.result-list .id-badge {
			background: #eef2ff;
			color: #4f46e5;
			font-weight: 700;
			font-size: 12px;
			padding: 4px 8px;
			border-radius: 6px;
			min-width: 28px;
			text-align: center;
		}

		.result-list .username {
			font-weight: 600;
			color: #333;
			flex: 1;
		}

		.result-list .role {
			font-size: 12px;
			padding: 3px 10px;
			border-radius: 20px;
			background: #fff0f0;
			color: #d33;
			text-transform: capitalize;
		}

		.empty {
			padding: 32px 24px;
			text-align: center;
			color: #999;
			font-size: 14px;
		}
	</style>
</head>
<body>

<div class="container">
	<div class="header">
		<h2>User Search</h2>
		<p>Cari data user berdasarkan keyword</p>
	</div>

	<form class="search-form" action="<?php echo base_url('search'); ?>" method="get">
		<input type="text" name="q" value="<?php echo $q; ?>" placeholder="Masukkan keyword...">
		<input type="submit" value="Cari">
	</form>

	<p class="result-info">Hasil pencarian untuk: <strong><?php echo $q; ?></strong></p>

	<ul class="result-list">
	<?php if (empty($results)): ?>
		<li class="empty" style="justify-content:center; background:none; border:none;">Tidak ada hasil ditemukan.</li>
	<?php else: ?>
		<?php foreach ($results as $r): ?>
			<li>
				<span class="id-badge">#<?php echo $r->id; ?></span>
				<span class="username"><?php echo $r->username; ?></span>
				<span class="role"><?php echo $r->role; ?></span>
			</li>
		<?php endforeach; ?>
	<?php endif; ?>
	</ul>
</div>

</body>
</html>