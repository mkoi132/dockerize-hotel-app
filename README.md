# This project renovate old project "[Melbourne Hotel Website](github-link)" with Docker and Docker Compose

## The purpose of this is to move away the original project dependency from running on local apache server, containerize the application for potential deployment on cloud flatforms.

# Highlights

1. [Introduction](#introduction)
2. [Quick start guide](#quick-start)
   1. [Development Environement](#dev-mode)
   2. [Production Environment](#prod-mod)
3. [Folder structure](#folder-structure)
4. [Dockerfile](#dockerfile)
5. [Docker-compose](#docker_compose)
6. [`db/d_data` and sql init script](#dbandsqlscript)

### Introduction

With the help of Docker official images, I containerized my application into three containers.

- Nginx container as the webserver.
- php container as a server to translate the php script so Nginx could understand it. I also enable MySQL service in addition to the defaut php image.
- Mariadb container to handle simple SQL queries and provide outputs.
  Container Orchestration (here i use docker compose) declare a setup so that containers can properly interact with each other

### Quick start guide

Containers can be built and run under two different environment, which are slightly different from each other, to serve different usages.
_IMPORTANT: A [ Docker desktop application](https://www.docker.com/products/docker-desktop/) is required to run this successfully._

#### Development environment

This setup is be ideal for Development purpose, since we don't have to compile our PHP container every-time our code changes.
To run the application in this mode, make sure you are in the project directory `docker-php-app`, then execute these commands:

```bash
$ docker compose built
$ docker compose up -d
```

This will build up the project as configured and will leave it up running on your **localhost:80**
To stop and delete containers, execute the command

```bash
$ docker compose down
```

However, this will presist the database volume generated from before. To also **DELETE** all volume generated, execute the command

```bash
$ docker compose down -v
```

#### Production environment

For production, we want to prevent on-demand source code changes and avoid using docker-created volumes, since we should probaly use some form of online shared storage for scaling purposes.
Although it could be hard-mounted of shared volume but we should preferably let our back-end to handle it, and leave alone the host file system. To this approach, since we no longer use volumes, we need to copy source code straight to containers, and adjusst our set up for docker compose.
We will execute the build from the adjusted `docker-compose-prod.yml`:

```bash
$ docker compose -f docker-compose-prod.yml build
$ docker compose -f docker-compose-prod.yml up -d
```

To Stop the project and delete containers, execute

```bash
$ docker compose down
```

### Folder structure

As docker concept is relatively simple to implement to an existing project, I simply keep the old project structure, and add some extra directories and files for `Dockerfile` and `docker-compose.yml`, definding services for php, Nginx, and database(db).

```
    docker-php-app/
    ├── app/                                *Hotel website source code directory*
    |   ├── docker/                         *Directory for php app docker files*
    |   |   ├── production/
    |   |   |   └── Dockerfile              *Docker file for production build*
    |   |   └── Dockerfile                  *Docker file for development build*
    |   └── ...                             *Website source code*
    ├── db/                                 *Directory for database container*
    |   ├── d_data/                         *Pretend to mount a remote db volume*
    |   |   └── ...                         *Mariadb-managed database files*
    |   └── init.sql                        *sql inititalisation script for first time database config*
    ├── nginx/                              *Directory for nginx container build*
    |   ├── production/
    |   |   └── Dockerfile                  *Docker file for production build*
    |   ├── Dockerfile                      *Docker file for development build*
    |   └── default.conf                    *Configure reverse proxy between Nginx and php app container*
    |
    ├── docker-compose-prod.yml             *compose file for production build*
    └── docker-compose.yml                  *compose file for development build*
```

### Dockerfile

There are two different version of docker files, each will serve different purpose as described in the [Quick start guide](#quick-start-guide). Whereas the development simply build and initiate container from official images, The production include instruction to copy the app source code into the container.

### Docker-compose

- The **development** version `docker-compose.yml` build the project and initiated a docker-managed database volume which then attached to the database container. This volume and its data presists until being deleted by user. The script also mount the website code base to it source code for visualizing on-demand changes to source code, without the need to rebuild the project time-to-time.
- The **production** version `docker-compose.yml` build the project, and copy the source code under
  `/app/` local directory into container app directory. This way no connection with local host exists and the backend will handle changes to dynamic contents itself. In case of this project, the backend would handle image upload to `src/gallery/imgaes/`, but this directory reside within the container, and is seperated from the host machine file system.

### `db/d_data` and sql init script

`db/d_data` is a hard-mounted external volume, which stimulate the use of shared file system/database. It is independent from the container. If this directory is empty, when execute `docker compose build`, the **init.sql** will be executed to initialize neccessary tables and user in the database to get it ready before the application is accessible.
