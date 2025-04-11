pipeline {
    agent { label 'agent-laravel' } // <-- ganti sesuai label node yang kamu maksud

    environment {
        COMPOSE_PROJECT_NAME = "laravel_project"
    }

    stages {
        stage('Checkout') {
            steps {
                git branch: 'main', url: 'https://github.com/andimuhriffal/laravel_testing.git'
            }
        }

        stage('Build and Deploy') {
            steps {
                sh '''
                    echo "[1/3] Stop and remove previous containers"
                    docker-compose down || true

                    echo "[2/3] Fix permissions for Laravel storage and cache"
                    sudo chown -R $(id -u):www-data storage bootstrap/cache
                    sudo chmod -R 775 storage bootstrap/cache

                    echo "[3/3] Build and run docker-compose"
                    docker-compose up -d --build

                    echo "[✅] Deployment complete"
                '''
            }
        }
    }

    post {
        success {
            echo "✅ Laravel berhasil dideploy ke agent-laravel2 (port 8000)"
        }
        failure {
            echo "❌ Deployment gagal. Cek error log."
        }
    }
}
