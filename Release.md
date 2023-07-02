<h1 align="center" style="font-size:50px"><strong>Recycle Admin</strong></h1>

You need to use Amazon Cloud and MYSQL to the database, S3 to upload files.

## I. Source code clone

<!-- ### 1. Source code clone from github -->
<!-- 
> `git@github.com:Kozocom/recycle-admin.git` -->

### 2. Change branch depending on usage environment

-   Develop environment:
    > `git checkout -b develop`
-   Production environment:
    > `git checkout main`

## II. Setting env file

### 1. Create env file

> `cd ./recycle-admin/` </br> > `cp .env.example .env`

### 2. Update env file

1. Open env file
    > `vi .env`
2. Set app name
    > `APP_NAME=YOUR_APP_NAME`
3. Change app url
    > `APP_URL=YOUR_APP_URL`
4. Set name environment
    - Develop environment
        > `APP_ENV=develop`
    - Production environment
        > `APP_ENV=production` <br/> `APP_DEBUG=false`
5. Change database connection information
    > `DB_HOST=YOUR_DB_HOST`<br/> `DB_PORT=YOUR_DB_PORT`<br/> `DB_DATABASE=YOUR_DB_DATABASE`<br/> `DB_USERNAME=YOUR_DB_USERNAME`<br/> `DB_PASSWORD=YOUR_DB_PASSWORD`<br/>

6. Change AWS information
    <!-- > `AWS_ACCESS_KEY_ID=YOUR_KEY_ID` <br/> `AWS_SECRET_ACCESS_KEY=YOUR_ACCESS_KEY`<br/>`AWS_DEFAULT_REGION=YOUR_DEFAULT_REGION`<br/> `AWS_BUCKET=YOUR_AWS_BUCKET` <br/> `AWS_URL=YOUR_AWS_URL` -->

7. Save env file
    > `:wq`

## III. Setup website

1. Install composer
    > `composer install`
2. Build website
    > `npm run build`
3. Running migrations
    > `php artisan migrate`
3. Running seeders
    > `php artisan db:seed`
