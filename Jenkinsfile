pipeline {
    agent any

    environment {
        // Configura il percorso di PHP e PHPUnit se non è nel PATH di sistema
        PATH ="/c/php/8.3:/c/ProgramData/ComposerSetup/bin:/c/Users/Utente/AppData/Roaming/Composer/vendor/bin:$PATH"
    }

    stages {
        stage('Checkout') {
            steps {
                // Clona il repository Git
                git branch: 'main', url: 'https://github.com/SergioCofano/PrimoTestPhpUnit.git'
            }
        }

        stage('Install Dependencies') {
            steps {
                // Installa le dipendenze PHP con Composer
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
                // Esegue i test con PHPUnit
                script {
                    if (fileExists('vendor/bin/phpunit')) {
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
            // Aggiungi qualsiasi pulizia o azioni finali qui
            cleanWs() // Pulisce la workspace dopo ogni build
        }
    }
}