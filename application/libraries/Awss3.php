<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once APPPATH . '/third_party/aws/aws-autoloader.php'; 

use Aws\S3\S3Client;
use Aws\Exception\AwsException;
use Aws\Credentials\CredentialProvider;

class Awss3 extends CI_Controller 
{
	public function __construct() 
	{
		parent::__construct();
	}
}