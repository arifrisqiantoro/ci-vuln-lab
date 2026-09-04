<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * VULNERABLE MODULE — Upload
 * -----------------------------------------------------------------
 * Kerentanan:
 *   1. Unrestricted File Upload — tidak ada validasi ekstensi/MIME,
 *      file (termasuk .php) langsung disimpan ke folder yang bisa
 *      diakses via web -> berpotensi Remote Code Execution.
 *   2. Nama file asli dipakai apa adanya -> path traversal / overwrite.
 * Contoh: upload file "shell.php" lalu akses /uploads/shell.php
 * -----------------------------------------------------------------
 */
class Upload extends CI_Controller {

	public function index()
	{
		$this->load->view('tools/upload_form');
	}

	public function do_upload()
	{
		if (!empty($_FILES['userfile']['name'])) {
			// --- SENGAJA RENTAN: tanpa whitelist ekstensi/MIME ---
			$target = FCPATH . 'uploads/' . $_FILES['userfile']['name'];
			move_uploaded_file($_FILES['userfile']['tmp_name'], $target);
			echo 'Uploaded to: uploads/' . $_FILES['userfile']['name'];
		} else {
			echo 'No file uploaded.';
		}
	}
}
