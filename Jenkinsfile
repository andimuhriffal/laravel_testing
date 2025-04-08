pipeline {
    agent { label 'agent-laravel' }

    options {
        buildDiscarder(logRotator(numToKeepStr: '5'))
    }

    environment {
        REMOTE_USER = 'riffal'
        REMOTE_HOST = '192.168.1.24'
        DEPLOY_DIR = '/var/www/html/laravel-testing-server'
        BRANCH = 'main'
    }

    stages {
        stage('Setup Agent Laravel') {
            steps {
                sh '''
                    echo "⚙️  Mulai Setup Agent Laravel"
                    sudo apt update
                    sudo apt install -y php-cli php-mbstring unzip curl php-xml php-curl php-bcmath php-tokenizer php-mysql php-zip

                    if ! command -v composer &> /dev/null
                    then
                        echo "📦 Composer belum ada. Menginstal Composer..."
                        php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
                        php composer-setup.php
                        sudo mv composer.phar /usr/local/bin/composer
                        rm composer-setup.php
                    else
                        echo "✅ Composer sudah terinstal: $(composer --version)"
                    fi

                    echo "PHP Version:"
                    php -v
                    echo "Composer Version:"
                    composer --version
                '''
            }
        }

        stage('Clone Repo') {
            steps {
                git branch: "${env.BRANCH}", url: 'https://github.com/andimuhriffal/laravel_testing.git'
            }
        }

        stage('Install Dependencies') {
            steps {
                sh 'composer install --no-interaction --prefer-dist --optimize-autoloader'
            }
        }

        stage('Setup PHP & Nginx on Remote') {
            steps {
                sshagent (credentials: ['ssh-credential-id']) {
                    sh """
                        ssh -o StrictHostKeyChecking=no $REMOTE_USER@$REMOTE_HOST '
                            sudo apt update &&
                            sudo apt install -y software-properties-common &&
                            sudo add-apt-repository ppa:ondrej/php -y &&
                            sudo apt update &&
                            sudo apt install -y php8.1 php8.1-fpm php8.1-cli php8.1-mbstring php8.1-xml php8.1-mysql php8.1-curl php8.1-zip php8.1-bcmath unzip nginx &&
                            sudo systemctl enable php8.1-fpm &&
                            sudo systemctl enable nginx &&
                            sudo systemctl restart php8.1-fpm &&
                            sudo systemctl restart nginx &&
                            if ! command -v composer &> /dev/null; then
                                php -r "copy(\'https://getcomposer.org/installer\', \'composer-setup.php\');"
                                php composer-setup.php
                                sudo mv composer.phar /usr/local/bin/composer
                            fi
                        '
                    """
                }
            }
        }

        stage('Deploy to Ubuntu Server') {
            steps {
                sshagent (credentials: ['ssh-credential-id']) {
                    sh """
                        ssh -o StrictHostKeyChecking=no $REMOTE_USER@$REMOTE_HOST '
                            if [ ! -d "$DEPLOY_DIR" ]; then
                                mkdir -p $DEPLOY_DIR &&
                                git clone https://github.com/andimuhriffal/laravel_testing.git $DEPLOY_DIR
                            fi &&
                            cd $DEPLOY_DIR &&
                            git pull origin $BRANCH &&
                            composer install --no-interaction --prefer-dist --optimize-autoloader &&
                            cp .env.example .env &&
                            php artisan key:generate &&
                            php artisan migrate --force &&
                            php artisan config:cache &&
                            php artisan route:cache &&
                            php artisan view:cache &&
                            chmod -R 775 storage bootstrap/cache &&
                            chown -R www-data:www-data storage bootstrap/cache
                        '
                    """
                }
            }
        }
    }

    post {
        success {
            echo '✅ Deployment Berhasil ke Ubuntu Server!'
        }
        failure {
            echo '❌ Deployment Gagal!'
        }
    }
}
