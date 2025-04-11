pipeline {
  agent {
    label 'agent-laravel' // ganti sesuai nama agen di Jenkins kamu
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

    stage('Run Laravel Commands') {
      steps {
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
