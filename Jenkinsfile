pipeline {
    
  agent {
    label 'agent-laravel'  // gunakan label sesuai agent node milikmu
  }

  options {
    buildDiscarder(logRotator(numToKeepStr: '5'))
  }

  environment {
    IMAGE_NAME = 'riffal/laravel-app'
    IMAGE_TAG = 'latest'
    CONTAINER_NAME = 'laravel-app'
  }

  stages {
    stage('Build Image') {
      steps {
        sh 'docker build -t $IMAGE_NAME:$IMAGE_TAG .'
      }
    }

    stage('Stop Existing Container') {
      steps {
        sh '''
          docker stop $CONTAINER_NAME || true
          docker rm $CONTAINER_NAME || true
        '''
      }
    }

    stage('Run Container') {
      steps {
        sh '''
          docker run -d --name $CONTAINER_NAME \
          -p 9000:9000 \
          -v $WORKSPACE:/var/www \
          $IMAGE_NAME:$IMAGE_TAG
        '''
      }
    }

    stage('List Running Containers') {
      steps {
        sh 'docker ps'
      }
    }
  }

  post {
    failure {
      echo 'Pipeline gagal!'
    }
    always {
      sh 'docker image prune -f'
    }
  }
}
