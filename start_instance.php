<?php
// BASIC認証の設定
$username = 'your_username';
$password = 'your_password';

if (!isset($_SERVER['PHP_AUTH_USER']) ||
    !isset($_SERVER['PHP_AUTH_PW']) ||
    $_SERVER['PHP_AUTH_USER'] != $username ||
    $_SERVER['PHP_AUTH_PW'] != $password) {
    header('WWW-Authenticate: Basic realm="My Realm"');
    header('HTTP/1.0 401 Unauthorized');
    echo 'Unauthorized';
    exit;
}

// AWS SDK for PHPをインストールしている前提
require 'vendor/autoload.php';

use Aws\Ec2\Ec2Client;

// AWS認証情報を設定
$aws_access_key_id = 'your_aws_access_key_id';
$aws_secret_access_key = 'your_aws_secret_access_key';
$region = 'your_region'; // 例: 'us-west-2'

// EC2クライアントの作成
$client = new Aws\Ec2\Ec2Client([
    'version' => 'latest',
    'region'  => $region,
    'credentials' => [
        'key'    => $aws_access_key_id,
        'secret' => $aws_secret_access_key,
    ]
]);

// インスタンスID、スポットリクエストID、状態をGETパラメータから取得
$instance_id = $_GET['instance'] ?? null;
$spot_request_id = $_GET['spot_request_id'] ?? null;
$state = $_GET['state'] ?? null;

if ((!$instance_id && !$spot_request_id) || !$state) {
    echo 'Error: Missing instance ID, spot request ID, or state.';
    exit;
}

// インスタンスの開始または停止
try {
    if ($instance_id) {
        if ($state === 'start') {
            $result = $client->startInstances([
                'InstanceIds' => [$instance_id],
            ]);
            echo 'OK: Started instance ' . $instance_id;
        } elseif ($state === 'stop') {
            $result = $client->stopInstances([
                'InstanceIds' => [$instance_id],
            ]);
            echo 'OK: Stopped instance ' . $instance_id;
        } else {
            echo 'Error: Invalid state.';
        }
    } elseif ($spot_request_id) {
        // スポットリクエストIDからインスタンスIDを取得
        $result = $client->describeSpotInstanceRequests([
            'SpotInstanceRequestIds' => [$spot_request_id],
        ]);
        $instance_id = $result->search('SpotInstanceRequests[0].InstanceId');

        if ($instance_id) {
            if ($state === 'start') {
                $result = $client->startInstances([
                    'InstanceIds' => [$instance_id],
                ]);
                echo 'OK: Started spot instance ' . $instance_id;
            } elseif ($state === 'stop') {
                $result = $client->stopInstances([
                    'InstanceIds' => [$instance_id],
                ]);
                echo 'OK: Stopped spot instance ' . $instance_id;
            } else {
                echo 'Error: Invalid state.';
	        }
	    } else {
	        echo 'Error: Instance not found for spot request ID ' . $spot_request_id;
            }
        }
    } catch (Exception $e) {
    // エラー時の処理
    echo 'Error: ', $e->getMessage();
    }
?>