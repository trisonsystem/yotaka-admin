<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');  
require_once APPPATH."/third_party/tcpdf/tcpdf.php";
class Pdf extends TCPDF 
{
    public function __construct() {
        parent::__construct();
    }
}

//	https://www.ninenik.com/%E0%B8%9B%E0%B8%A3%E0%B8%B0%E0%B8%A2%E0%B8%B8%E0%B8%81%E0%B8%95%E0%B9%8C%E0%B8%81%E0%B8%B2%E0%B8%A3%E0%B9%83%E0%B8%8A%E0%B9%89%E0%B8%87%E0%B8%B2%E0%B8%99_tcpdf_%E0%B8%AA%E0%B8%A3%E0%B9%89%E0%B8%B2%E0%B8%87_pdf_%E0%B9%84%E0%B8%9F%E0%B8%A5%E0%B9%8C_%E0%B9%83%E0%B8%99_codeigniter-717.html