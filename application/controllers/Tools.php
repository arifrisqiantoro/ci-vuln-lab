<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * VULNERABLE MODULE — Tools
 * -----------------------------------------------------------------
 * Kerentanan:
 *   1. OS Command Injection — parameter `host` dimasukkan langsung
 *      ke shell_exec() tanpa sanitasi/escaping.
 * Contoh payload: 127.0.0.1; id
 *                 127.0.0.1 && whoami
 * -----------------------------------------------------------------
 */
class Tools extends CI_Controller {

	public function ping()
	{
		$host = $this->input->get('host');
		$output = '';

		if ($host !== NULL && $host !== '') {
			// --- SENGAJA RENTAN: user input langsung ke shell_exec ---
			$cmd = 'ping -c 2 ' . $host;
			$output = shell_exec($cmd);
		}

		$this->load->view('tools/ping', array('host' => $host, 'output' => $output));
	}
}
