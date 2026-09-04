<!DOCTYPE html>
<html lang="id">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Peralatan</title>
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

		.ping-form {
			display: flex;
			gap: 8px;
			padding: 20px 24px;
			background: #f8f9fb;
			border-bottom: 1px solid #eee;
		}

		.ping-form input[type="text"] {
			flex: 1;
			padding: 10px 14px;
			border: 1px solid #ddd;
			border-radius: 8px;
			font-size: 14px;
			font-family: monospace;
			outline: none;
			transition: border-color 0.2s;
		}

		.ping-form input[type="text"]:focus {
			border-color: #764ba2;
		}

		.ping-form input[type="submit"] {
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

		.ping-form input[type="submit"]:hover {
			background: #5f3a85;
		}

		.output-wrap {
			padding: 20px 24px 24px;
		}

		.output-label {
			font-size: 12px;
			text-transform: uppercase;
			letter-spacing: 0.5px;
			color: #999;
			margin-bottom: 8px;
			font-weight: 600;
		}

		.output-box {
			background: #1e1e2e;
			color: #d4d4d4;
			border-radius: 10px;
			padding: 16px;
			font-family: 'Consolas', 'Courier New', monospace;
			font-size: 13px;
			line-height: 1.5;
			overflow-x: auto;
			white-space: pre-wrap;
			word-break: break-word;
			min-height: 60px;
		}

		.output-box:empty::before {
			content: "Belum ada hasil.";
			color: #666;
			font-style: italic;
		}
	</style>
</head>
<body>

<div class="container">
	<div class="header">
		<h2>Network Utility</h2>
		<p>Masukkan target host untuk memeriksa status</p>
	</div>

	<form class="ping-form" action="<?php echo base_url('tools/ping'); ?>" method="get">
		<input type="text" name="host" value="<?php echo htmlspecialchars($host); ?>" placeholder="masukkan target">
		<input type="submit" value="Cek">
	</form>

	<div class="output-wrap">
		<div class="output-label">Output</div>
		<pre class="output-box"><?php echo htmlspecialchars($output); ?></pre>
	</div>
</div>

</body>
</html>