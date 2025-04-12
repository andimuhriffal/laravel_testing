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

    stage('Prepare Environment') {
      steps {
        sh '''
          # Jika file .env belum ada, buat dari .env.example
          if [ ! -f .env ]; then
            cp .env.example .env
          fi

          # Ubah nilai pada .env sesuai konfigurasi docker-compose
          sed -i 's|APP_URL=.*|APP_URL=http://localhost:8000|' .env
          sed -i 's|DB_HOST=.*|DB_HOST=mysql|' .env
          sed -i 's|DB_PORT=.*|DB_PORT=3306|' .env
          sed -i 's|DB_DATABASE=.*|DB_DATABASE=laravel|' .env
          sed -i 's|DB_USERNAME=.*|DB_USERNAME=laravel|' .env
          sed -i 's|DB_PASSWORD=.*|DB_PASSWORD=secret|' .env
        '''
      }
    }

    stage('Build & Start Docker Compose') {
      steps {
        sh 'docker-compose down --remove-orphans'
        sh 'docker-compose build --no-cache'
        sh 'docker-compose up -d'
      }
    }

    stage('Generate Key & Migrate') {
      steps {
        sh 'docker exec laravel-app php artisan key:generate'
        sh 'docker exec laravel-app php artisan config:cache'
        sh 'docker exec laravel-app php artisan migrate --force'
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
      echo 'Pipeline failed!'
    }
    always {
      echo 'Cleaning up unused Docker resources...'
      sh 'docker system prune -f'
    }
  }
}
