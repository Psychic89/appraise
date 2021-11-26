def incrementVersion() {
    echo "incrementing application version"
    sh 'mvn build-helper:parse-version versions:set \
        -DnewVersion=\\\${parsedVersion.majorVersion}.\\\${parsedVersion.minorVersion}.\\\${parsedVersion.nextIncrementalVersion} \
        versions:commit'
    def matcher = readFile('pom.xml') =~ '<version>(.+)</version>'
    def version = matcher[0][1]
    env.IMAGE_NAME = "$version-$BUILD_NUMBER"
}

def buildJar() {
    echo "building the application..."
    sh 'mvn clean package'
} 

def buildImage() {
    echo "building the docker image..."
    withCredentials([usernamePassword(credentialsId: 'docker-hub-repo', passwordVariable: 'PASS', usernameVariable: 'USER')]) {
        sh "docker build -t shofrica/demo-app:${IMAGE_NAME} ."
        sh "echo $PASS | docker login -u $USER --password-stdin"
        sh "docker push shofrica/demo-app:${IMAGE_NAME}"

    }
} 

def deployApp() {
    echo 'deploying the application...'
    def dockerCmd = 'docker run -p 3080:3080 -d shofrica/demo-app:1.1.16-30'
    sshagent(['ec2-server-key']) {
        sh "ssh -o StrictHostKeyChecking=no ec2-user@3.125.160.134 ${dockerCmd}"
    }
}

def commitVersion() {
    withCredentials([usernamePassword(credentialsId: 'gitlab-credentials', passwordVariable: 'PASS', usernameVariable: 'USER')]) {
        sh 'git config --global user.email "robertmutua@web.de"'
        sh 'git config --global user.name "jenkins"'

        sh 'git status'
        sh 'git branch'
        sh 'git config --list'
        sh "git remote set-url origin https://${USER}:${PASS}@gitlab.com/Psychic89/java-maven-app.git"
        sh 'git add .'
        sh 'git commit -m "ci: version bump"'
        sh 'git push origin HEAD:jenkins-jobs'
    }
}

return this
