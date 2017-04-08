pipeline {
    agent { docker 'php' }
    stages {
        stage('Build') {
            steps {
                sh 'php --version'
                sh 'echo "Hello World"'
                sh '''
                    echo "Multiline shell steps works too"
                    ls -lah
                '''
            }
        }
    }
}
