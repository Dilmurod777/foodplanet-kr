<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once APPPATH . '/third_party/aws/aws-autoloader.php'; 

use Aws\S3\S3Client;
use Aws\Exception\AwsException;
use Aws\Credentials\CredentialProvider;

class Awss3_lib 
{
    function upload_s3($target, $path, $file) {
        $result = array();
        
        $s3Client = S3Client::factory(array(
            'region' => 'ap-northeast-2', // S3 리전을 입력합니다.(저는 서울 리전)
            'version' => 'latest',
            'signature' => 'v4',
            'credentials' => [
                'key'    => S3_ACCESS, 
                'secret' => S3_SECRET,
            ],
            'scheme' => 'http',
        ));


        try {
            // URL 주소를 통해 업로드 할 경우 아래와 같이 사용됩니다.
            $s3_path = $target . '/' . date('Y') . '/' . date('m') . '/' . $file; // 업로드할 위치와 파일명 입니다.
            $res = $s3Client->putObject(array(
                'Bucket' => S3_BUCKET,
                'Key'    => $s3_path,
                'SourceFile' => $path,
                'ACL'    => 'public-read'
            ));
            $result['result'] = 'succ';
            $result['msg'] = '';
            $result['data'] = $res['ObjectURL'];
        }
        catch (S3Exception $e) {
            $result['result'] = 'fail';
            $result['msg'] = $e;
        }
        return $result;
    }
}