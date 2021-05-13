# needed to install ext-dom, mbstring 7.4
# update .env 
# had to run php artisan key:generate to fix 500 error 
# running on docker
# https://devcenter.heroku.com/articles/custom-php-settings#setting-the-document-root had to create Procfile for deployment to heroku
# local dev is done on docker

# look into swagger here https://github.com/DarkaOnLine/L5-Swagger/wiki/Installation-&-Configuration

# genius API https://docs.genius.com/
# spotify API https://developer.spotify.com/documentation/web-api/
# youtube API https://developers.google.com/youtube/v3/

APP_NAME=Laravel
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost

POSTGRES_USER=
POSTGRES_PASSWORD=
POSTGRES_DB=
PROJECT_NAME=