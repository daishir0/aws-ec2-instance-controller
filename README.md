# AWS EC2 Instance Controller

A simple PHP script to control the start and stop of AWS EC2 instances, including both On-Demand and Spot instances. It can be easily deployed on a web server and used with Basic Authentication.

※日本語のREADMEは下部にあります。

## Disclaimer

Please note that this script contains sensitive information, such as AWS access keys and Basic Authentication credentials. Make sure to properly secure your server and take necessary precautions to protect your sensitive information. This script is provided "AS IS" without any warranties or guarantees. Use at your own risk.


## Installation

1. Clone this repository to your web server:

```
git clone https://github.com/daishir0/aws-ec2-instance-controller.git
```

2. Install AWS SDK for PHP using Composer:

```
cd aws-ec2-instance-controller
composer require aws/aws-sdk-php
```

If you don't have Composer installed, you can follow the installation instructions on the [official Composer website](https://getcomposer.org/doc/00-intro.md).

3. Open `start_instance.php` and replace the placeholders with your actual AWS access keys, region, Basic Authentication username, and password.

4. Configure your web server to serve the `aws-ec2-instance-controller` directory.

## Usage

Access the script using a web browser or any HTTP client, providing the necessary GET parameters:

- On-Demand Instance Start: `https://your_domain.com/start_instance.php?instance=i-12345678&state=start`
- On-Demand Instance Stop: `https://your_domain.com/start_instance.php?instance=i-12345678&state=stop`
- Spot Instance Start: `https://your_domain.com/start_instance.php?spot_request_id=sir-12345678&state=start`
- Spot Instance Stop: `https://your_domain.com/start_instance.php?spot_request_id=sir-12345678&state=stop`

Please note that you will be prompted for Basic Authentication credentials.

## License

This project is licensed under the MIT License. See the [LICENSE](LICENSE) file for details.

---

## インストール

1. このリポジトリをWebサーバーにクローンします。

```
git clone https://github.com/daishir0/aws-ec2-instance-controller.git
```

2. Composerを使ってAWS SDK for PHP をインストールします。

```
cd aws-ec2-instance-controller
composer require aws/aws-sdk-php
```

Composerがインストールされていない場合は、[公式Composerウェブサイト](https://getcomposer.org/doc/00-intro.md) のインストール手順に従ってインストールできます。

3. `start_instance.php` を開き、実際の AWS アクセスキー、リージョン、Basic 認証ユーザー名、およびパスワードでプレースホルダーを置き換えます。

4. Web サーバーを設定して、`aws-ec2-instance-controller` ディレクトリを提供するようにします。

## 使い方

Web ブラウザーや HTTP クライアントを使用して、必要な GET パラメーターを指定してスクリプトにアクセスします。

- オンデマンドインスタンス開始：https://your_domain.com/start_instance.php?instance=i-12345678&state=start
- オンデマンドインスタンス停止：https://your_domain.com/start_instance.php?instance=i-12345678&state=stop
- スポットインスタンス開始：https://your_domain.com/start_instance.php?spot_request_id=sir-12345678&state=start
- スポットインスタンス停止：https://your_domain.com/start_instance.php?spot_request_id=sir-12345678&state=stop

Basic 認証の資格情報が求められることに注意してください。

## ライセンス

このプロジェクトは MIT ライセンスの下でライセンスされています。詳細については、LICENSE ファイルを参照してください。
