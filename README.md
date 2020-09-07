# Laravel_CRUD_API

### Tools you will need:
- Docker https://hub.docker.com/editions/community/docker-ce-desktop-windows/
- Git https://git-scm.com/downloads


### Steps to setup this application:
1) Clone this repository to your local computer. Run "git clone https://github.com/sbriggs-wtc/Laravel_CRUD_API.git Laravel_CRUD_API".
2) Make sure the docker daemon is running. Run "docker ps -a" to check.
3) Build the containers. Run "docker-compose up" from the root directory.
4) Navigate to http://localhost:3000/ in your web browser. You should see the home page.
5) To remove the containers, Run "docker-compose down".

Note that you will have to populate the database with some dummy data. 
Data will not be persisted when the containers are removed as no volume has been provisioned.