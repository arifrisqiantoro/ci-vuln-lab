<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * VULNERABLE MODULE — Search
 * -----------------------------------------------------------------
 * Kerentanan:
 *   1. SQL Injection (UNION-based) via parameter GET `q`.
 *   2. Reflected XSS — hasil pencarian & query di-echo tanpa escaping
 *      di view (lihat application/views/search/result.php).
 * Contoh payload SQLi: ' UNION SELECT username,password,3 FROM users -- 
 * Contoh payload XSS : <script>alert(document.cookie)</script>
 * -----------------------------------------------------------------
 */
class Search extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function index()
	{
		$q = $this->input->get('q');
		$results = array();

		if ($q !== NULL && $q !== '') {
			// --- SENGAJA RENTAN: concatenation langsung ke query ---
			$sql = "SELECT id, username, role FROM users WHERE username LIKE '%" . $q . "%'";
			$query = $this->db->query($sql);
			$results = $query->result();
		}

		// $q dikirim mentah ke view -> reflected XSS disengaja
		$data = array('q' => $q, 'results' => $results);
		$this->load->view('search/result', $data);
	}
}
