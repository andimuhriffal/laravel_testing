pipeline {
  agent {
    label 'agent-laravel'
  }

  options {
    buildDiscarder(logRotator(numToKeepStr: '5'))
  }

  environment {
    COMPOSE_PROJECT_NAME = 'laravel_project'
  }

  stages {
    stage('Checkout') {
      steps {
        checkout scm
      }
    }

    stage('Build & Start Docker Compose') {
      steps {
        sh 'docker-compose down --remove-orphans'
        sh 'docker-compose build --no-cache'
        sh 'docker-compose up -d'
      }
    }

    stage('Prepare Environment') {
      steps {
        sh '''
          echo "Menyalin .env ke dalam container..."
          docker exec laravel-app cp .env.example .env

          echo "Mengatur variabel .env..."
          docker exec laravel-app sed -i 's|APP_URL=.*|APP_URL=http://localhost:8000|' .env
          docker exec laravel-app sed -i 's|DB_HOST=.*|DB_HOST=mysql|' .env
          docker exec laravel-app sed -i 's|DB_PORT=.*|DB_PORT=3306|' .env
          docker exec laravel-app sed -i 's|DB_DATABASE=.*|DB_DATABASE=laravel|' .env
          docker exec laravel-app sed -i 's|DB_USERNAME=.*|DB_USERNAME=laravel|' .env
          docker exec laravel-app sed -i 's|DB_PASSWORD=.*|DB_PASSWORD=secret|' .env
        '''
      }
    }

    stage('Run Laravel Commands') {
      steps {
        sh '''
          docker exec laravel-app php artisan config:clear
          docker exec laravel-app php artisan config:cache
          docker exec laravel-app php artisan migrate --force
        '''
      }
    }

    stage('Check Running Containers') {
      steps {
        sh 'docker ps'
      }
    }
  }

  post {
    failure {
      echo '❌ Pipeline gagal!'
    }
    always {
      echo '🧹 Membersihkan resource Docker yang tidak terpakai...'
      sh 'docker system prune -f'
    }
  }
}
