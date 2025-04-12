pipeline {
    agent { label 'agent-laravel' }

    environment {
        COMPOSE_PROJECT_NAME = "laravel"
    }

    stages {
        stage('Clean Old Docker Containers & Images') {
            steps {
                sh '''
                    docker-compose down --rmi all --volumes --remove-orphans || true
                    docker image prune -af || true
                '''
            }
        }

        stage('Build Docker Images') {
            steps {
                sh 'docker-compose build'
            }
        }

        stage('Run Containers') {
            steps {
                sh 'docker-compose up -d'
            }
        }

        stage('Install Dependencies') {
            steps {
                sh 'docker exec laravel_app composer install'
            }
        }

        stage('Set Permissions & Generate Key') {
            steps {
                sh '''
                    docker exec laravel_app sh -c '[ -f .env ] || cp .env.example .env'
                    docker exec laravel_app chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache
                    docker exec laravel_app chmod -R 775 /var/www/storage /var/www/bootstrap/cache
                    docker exec laravel_app php artisan config:clear
                    docker exec laravel_app php artisan key:generate
                    docker exec laravel_app php artisan migrate
                '''
            }
        }
    }

    post {
        success {
            echo 'Laravel app deployed successfully in Docker container.'
        }
        failure {
            echo 'Deployment failed.'
        }
    }
}
