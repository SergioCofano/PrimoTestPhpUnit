pipeline {
    agent any

    environment {
        // Configura il percorso di PHP, Composer e altri strumenti
        PATH = "/c/php/8.3:/c/ProgramData/ComposerSetup/bin:/c/Users/Utente/AppData/Roaming/Composer/vendor/bin:$PATH"
    }

    stages {
        stage('Checkout') {
            steps {
                git branch: 'main', url: 'https://github.com/SergioCofano/PrimoTestPhpUnit.git'
            }
        }

        stage('Install Dependencies') {
            steps {
                script {
                    if (fileExists('composer.json')) {
                        sh 'composer install'
                    } else {
                        error 'composer.json not found!'
                    }
                }
            }
        }

        stage('Run Tests') {
            steps {
                script {
                    if (fileExists('vendor/bin/phpunit')) {
                        // Rendi eseguibile PHPUnit
                        sh 'chmod +x vendor/bin/phpunit'  
                        sh 'vendor/bin/phpunit --configuration phpunit.xml'
                    } else {
                        error 'PHPUnit executable not found!'
                    }
                }
            }
        }
    }

    post {
        success {
            echo 'Build and tests passed!'
        }
        failure {
            echo 'Build or tests failed.'
        }
        always {
            cleanWs()
        }
    }
}
