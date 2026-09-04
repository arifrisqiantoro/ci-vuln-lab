<!DOCTYPE html>
<html lang="id">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Profile</title>
	<style>
		* { margin: 0; padding: 0; box-sizing: border-box; }

		body {
			font-family: 'Segoe UI', Roboto, Arial, sans-serif;
			background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
			min-height: 100vh;
			display: flex;
			align-items: center;
			justify-content: center;
			padding: 20px;
		}

		.card {
			background: #fff;
			border-radius: 16px;
			box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
			width: 100%;
			max-width: 420px;
			overflow: hidden;
		}

		.card-header {
			background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
			padding: 32px 24px;
			text-align: center;
			color: #fff;
		}

		.avatar {
			width: 72px;
			height: 72px;
			border-radius: 50%;
			background: rgba(255, 255, 255, 0.2);
			display: flex;
			align-items: center;
			justify-content: center;
			font-size: 28px;
			font-weight: 600;
			margin: 0 auto 12px;
			border: 3px solid rgba(255, 255, 255, 0.5);
		}

		.card-header h2 { font-size: 20px; font-weight: 600; }

		.card-body { padding: 24px; }

		.info-row {
			display: flex;
			justify-content: space-between;
			align-items: center;
			padding: 14px 0;
			border-bottom: 1px solid #f0f0f0;
		}
		.info-row:last-child { border-bottom: none; }

		.info-label {
			color: #888;
			font-size: 13px;
			text-transform: uppercase;
			letter-spacing: 0.5px;
		}

		.info-value { color: #333; font-weight: 600; font-size: 15px; }

		.badge {
			display: inline-block;
			padding: 4px 12px;
			border-radius: 20px;
			font-size: 12px;
			font-weight: 600;
			background: #eef2ff;
			color: #4f46e5;
			text-transform: capitalize;
		}

		.empty-state { padding: 48px 24px; text-align: center; color: #999; }
		.empty-state .icon { font-size: 40px; margin-bottom: 12px; }
	</style>
</head>
<body>

<div class="card">
	<?php if ($user): ?>
		<div class="card-header">
			<div class="avatar">
				<?php echo strtoupper(substr($user->username, 0, 1)); ?>
			</div>
			<!-- VULNERABLE: no output escaping -> XSS -->
			<h2><?php echo $user->username; ?></h2>
		</div>
		<div class="card-body">
			<div class="info-row">
				<span class="info-label">ID</span>
				<span class="info-value">#<?php echo $user->id; ?></span>
			</div>
			<div class="info-row">
				<span class="info-label">Username</span>
				<span class="info-value"><?php echo $user->username; ?></span>
			</div>
			<div class="info-row">
				<span class="info-label">Role</span>
				<span class="badge"><?php echo $user->role; ?></span>
			</div>
		</div>
	<?php else: ?>
		<div class="empty-state">
			<div class="icon">🔍</div>
			<p>User tidak ditemukan.</p>
		</div>
	<?php endif; ?>
</div>

</body>
</html>