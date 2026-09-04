<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * VULNERABLE MODULE — Auth
 * -----------------------------------------------------------------
 * Sengaja dibuat rentan untuk keperluan lab / latihan pentest.
 * JANGAN dipakai sebagai referensi coding, dan JANGAN di-deploy
 * ke server yang bisa diakses publik.
 *
 * Kerentanan yang disematkan di controller ini:
 *   1. SQL Injection (login bypass) — query dibangun dengan
 *      concatenation string, bukan parameter binding.
 *   2. Password disimpan & dibandingkan dalam bentuk plaintext.
 *   3. Tidak ada rate limiting / lockout -> rentan brute force.
 *   4. Session tanpa regenerate ID setelah login -> session fixation.
 * -----------------------------------------------------------------
 */
class Auth extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->library('session');
	}

	public function index()
	{
		$this->load->view('auth/login');
	}

	public function login()
	{
		$username = $this->input->post('username');
		$password = $this->input->post('password');

		$sql = "SELECT id, username, role FROM users
				WHERE username = '" . $username . "'
				AND password = '" . $password . "'";

		$query = $this->db->query($sql);
		$row = $query->row();

		if ($row) {
			// VULNERABLE: no session regenerate -> session fixation
			$this->session->set_userdata('user_id', $row->id);
			$this->session->set_userdata('username', $row->username);
			$this->session->set_userdata('role', $row->role);
			redirect('profile/view/' . $row->id);
		} else {
			$this->session->set_flashdata('error', 'Login gagal.');
			redirect('auth');
		}
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect('auth');
	}
}
