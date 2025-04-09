pipeline {
    agent { label 'agent-laravel' }

    environment {
        DEPLOY_USER = 'riffal'
        DEPLOY_HOST = '192.168.1.24'
        DEPLOY_PATH = '/var/www/html/laravel-testing'
        SSH_CREDENTIALS = 'laravel-agent'
    }

    stages {
        stage('Checkout Kode') {
            steps {
                git branch: 'main', url: 'https://github.com/andimuhriffal/laravel_testing.git'
            }
        }

        stage('Siapkan Laravel (di Jenkins)') {
            steps {
                sh '''
                cp .env.example .env || true
                composer install --no-interaction --prefer-dist --optimize-autoloader
                php artisan key:generate
                php artisan config:cache
                php artisan route:cache
                '''
            }
        }

        stage('Deploy ke Ubuntu Server') {
            steps {
                sshagent (credentials: [SSH_CREDENTIALS]) {
                    sh '''
                    echo "Sinkronisasi project ke server..."
                    rsync -avz --delete --exclude=".env" --exclude="node_modules" ./ $DEPLOY_USER@$DEPLOY_HOST:$DEPLOY_PATH

                    echo "Menjalankan setup Laravel di server..."
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
