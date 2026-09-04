<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * VULNERABLE MODULE — Profile
 * -----------------------------------------------------------------
 * Kerentanan:
 *   1. Insecure Direct Object Reference (IDOR) — siapapun yang
 *      login bisa buka profil user lain hanya dengan ganti ID di
 *      URL, tanpa cek kepemilikan (ownership check).
 *   2. Tidak ada access control granular (semua role bisa akses).
 * Contoh: /profile/view/1, /profile/view/2, dst — coba ganti ID.
 * -----------------------------------------------------------------
 */
class Profile extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->library('session');
	}

	// VULNERABLE: tidak ada pengecekan apakah $id milik user yang login
	public function view($id = NULL)
	{
		if (!$this->session->userdata('user_id')) {
			redirect('auth');
		}

		// --- SENGAJA RENTAN: no ownership / authorization check ---
		$query = $this->db->get_where('users', array('id' => $id));
		$user = $query->row();

		$this->load->view('profile/view', array('user' => $user));
	}
}
