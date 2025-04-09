pipeline {
    agent { label 'agent-laravel' }

    environment {
        DEPLOY_USER = 'riffal'
        DEPLOY_HOST = '192.168.1.24'  // Ganti dengan IP Ubuntu Server kamu
        DEPLOY_PATH = '/var/www/html/laravel-testing'
        SSH_CREDENTIALS = 'laravel-agent'  // ID SSH Key di Jenkins
    }

    stages {
        stage('Checkout Kode') {
            steps {
                git branch: 'main', url: 'https://github.com/andimuhriffal/laravel_testing.git'
            }
        }

        stage('Install Dependencies') {
            steps {
                sh '''
                apt install software-properties-common -y
                add-apt-repository ppa:ondrej/php -y
                apt update
                apt install php8.1 php8.1-cli php8.1-fpm php8.1-mysql php8.1-curl php8.1-mbstring php8.1-xml php8.1-zip php8.1-bcmath php8.1-soap php8.1-intl unzip -y
                apt install nginx -y
                ln -s /etc/nginx/sites-available/laravelapp /etc/nginx/sites-enabled/
                systemctl restart php8.1-fpm
                systemctl restart nginx

                '''
            }
        }

        stage('Siapkan Laravel') {
            steps {
                sh '''
                cp .env.example .env || true
                php artisan key:generate
                php artisan config:cache
                php artisan route:cache
                '''
            }
        }

        stage('Deploy to Ubuntu Server') {
            steps {
                sshagent (credentials: [SSH_CREDENTIALS]) {
                    sh '''
                    echo "Sync project to server..."
                    rsync -avz --delete --exclude=".env" --exclude="node_modules" ./ $DEPLOY_USER@$DEPLOY_HOST:$DEPLOY_PATH

                    echo "Running Laravel setup on remote server..."
                    ssh $DEPLOY_USER@$DEPLOY_HOST "
                        cd $DEPLOY_PATH &&
                        composer install --no-interaction --prefer-dist --optimize-autoloader &&
                        php artisan migrate --force &&
                        php artisan config:cache &&
                        php artisan route:cache &&
                        sudo systemctl reload php8.1-fpm &&
                        sudo systemctl reload nginx
                    "
                    '''
                }
            }
        }
    }

    post {
        success {
            echo '✅ Deploy Laravel ke Ubuntu + Nginx berhasil!'
        }
        failure {
            echo '❌ Deploy gagal. Cek log error.'
        }
    }
}
