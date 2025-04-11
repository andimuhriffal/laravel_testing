pipeline {
    agent { label 'agent-laravel' }

    environment {
        COMPOSE_PROJECT_NAME = "laravel_project"
    }

    stages {
        stage('Checkout') {
            steps {
                git 'https://github.com/andimuhriffal/laravel_testing.git' // ganti sesuai repo kamu
            }
        }

        stage('Build and Deploy') {
            steps {
                sh '''
                    echo "[1/3] Stop and remove previous containers"
                    docker-compose down || true

                    echo "[2/3] Build and run docker-compose"
                    docker-compose up -d --build

                    echo "[3/3] Deployment complete"
                '''
            }
        }
    }

    post {
        success {
            echo "✅ Laravel berhasil dideploy ke laravel-agent (port 8000)"
        }
        failure {
            echo "❌ Deployment gagal. Cek error log."
        }
    }
}
