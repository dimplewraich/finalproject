<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('download_pdf')) {

	function download_pdf($html, $file_name, $orientation = "portrait") {
		require_once('dompdf/dompdf_config.inc.php');
		
		$CI =& get_instance();
		
		$CI->load->helper('download');
		
		spl_autoload_register('DOMPDF_autoload');
		
		$dompdf = new DOMPDF();
		
		$dompdf->set_paper("A4");
		/*$dompdf->set_paper('letter', $orientation);*/
		$dompdf->load_html($html);
		$dompdf->render();
		
		force_download($file_name.'.pdf', $dompdf->output());
	}
}

if ( ! function_exists('pdf_create')) {

	function pdf_create($html, $file_name, $stream = TRUE, $path = FALSE, $orientation = "portrait") {
		require_once('dompdf/dompdf_config.inc.php');
		
		$CI =& get_instance();
		
		$CI->load->helper('download');
		$CI->load->helper('file');
		
		spl_autoload_register('DOMPDF_autoload');

		$dompdf = new DOMPDF();
		$dompdf->set_paper('letter', $orientation);
		$dompdf->load_html($html);
		$dompdf->render();

		if ($stream) {

			$dompdf->stream($file_name.".pdf");

		} else {

			write_file($path.$file_name.'.pdf', $dompdf->output());
		}
	}
}

?>