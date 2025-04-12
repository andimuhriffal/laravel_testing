pipeline {
    agent 'agent-laravel'

    environment {
        COMPOSE_PROJECT_NAME = "laravel"
    }

    stages {
        stage('Build Docker Images') {
            steps {
                sh 'docker-compose build'
            }
        }

        stage('Run Containers') {
            steps {
                sh 'docker-compose down'
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
                docker exec laravel_app php artisan config:clear
                docker exec laravel_app php artisan key:generate
                docker exec laravel_app php artisan migrate --force
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
