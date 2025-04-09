pipeline {
    agent { label 'agent-laravel' }

    environment {
        DEPLOY_USER = 'ubuntu'
        DEPLOY_HOST = '192.168.1.100'  // Ganti dengan IP Ubuntu Server kamu
        DEPLOY_PATH = '/var/www/html/laravel-app'
        SSH_CREDENTIALS = 'ssh-key-jenkins'  // ID SSH Key di Jenkins
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
                php -v  # Cek versi PHP

                # Install dependencies Laravel
                composer install --no-interaction --prefer-dist --optimize-autoloader

                # Frontend (jika pakai Laravel Mix)
                npm install
                npm run build
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
